<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Parts extends CI_Controller {
  	public $_fix   = "ewd_";
  	public $_table = "parts";
  	public $_view  = "parts";
    public $_cname = "parts";
    public $_model = "Parts_model";
    public $_data  = [];
  	public function __construct(){
    		parent::__construct();
            ini_set('max_execution_time', 0);
    		if(!$this->input->is_ajax_request())
    			$this->load->view("block/header");
        $this->session->set_flashdata('post',$this->input->post());
        $this->session->set_flashdata('get',$this->input->get());
  	}
  	public function index(){
      $limit = 40;
      $offset = $this->input->post("per_page") ? $this->input->post("per_page") : 0;
      $this->load->model($this->_model);
      $this->_data["tables"] = $this->{$this->_model}->get($offset,$limit);
      $total_rows = $this->Common_model->count_table($this->_fix.$this->_table);
      $this->load->library('pagination');
      $config['base_url']   = base_url($this->_cname);
      $config['total_rows'] = $total_rows;
      $config['per_page']   = $limit;
      $config['page_query_string'] = true;
      $this->_data["action_create"] = base_url($this->_cname."/create");
      $this->pagination->initialize($config);
      $this->_data["_cname"] = $this->_cname;
      $this->load->view($this->_view . "/index",$this->_data);
  	}
    public function create(){
      $this->_data["post"] = $this->session->flashdata('post');
      $this->_data["action_save"] = $this->_cname."/save_create";
      $this->load->view($this->_view . "/create_and_edit",$this->_data);
    }
    public function edit($id){
      $this->_data["action_save"] = $this->_cname."/save_edit/".$id;
      $item      = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
      $get_media = $this->Common_model->get_record($this->_fix ."medias",["id" =>  $item['path_html']]);
      $item["path_name"]   = $get_media["name"];
      $this->_data["post"] = $item;
      $this->load->view($this->_view . "/create_and_edit",$this->_data);
    }
    public function delete($id){
      $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
      if($this->input->is_ajax_request()){
        $this->Common_model->delete($this->_fix.$this->_table,["id" => $id]);
        $data ["status"] = "success";
      }  
      die( json_encode($data) );
    }
    public function save_create(){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('path_html', 'File html', 'required');
      $this->form_validation->set_rules('path_name', 'File name', 'required');
      $this->form_validation->set_rules('status', 'Trạng thái', 'required');
      if ($this->form_validation->run() !== FALSE)
      {
        $columns = $this->db->list_fields($this->_fix.$this->_table);
        $data_post = $this->input->post();
        $data_insert = array();
        foreach ($data_post as $key => $value) {
          if(in_array($key, $columns)){
            $data_insert[$key] = $value;
          }              
        }
        $id = $this->Common_model->add($this->_fix.$this->_table,$data_insert);  
        redirect(base_url($this->_cname.'/edit/' . $id ."?action=create&status=success"));
      }else
      {
        redirect(base_url($this->_cname.'/create/'."?action=create&status=error"));
      }
    }
    public function save_edit($id){ 
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('path_html', 'File html', 'required');
      $this->form_validation->set_rules('path_name', 'File name', 'required');
      $this->form_validation->set_rules('status', 'Trạng thái', 'required');
      if ($this->form_validation->run() !== FALSE)
      {
        $columns = $this->db->list_fields($this->_fix.$this->_table);
        $data_post = $this->input->post();
        $data_update = array();
        foreach ($data_post as $key => $value) {
          if(in_array($key, $columns)){
            $data_update[$key] = $value;
          }              
        }
        $this->Common_model->update($this->_fix.$this->_table,$data_update,["id" => $id]);  
        redirect(base_url($this->_cname.'/edit/' . $id ."?action=update&status=success"));
      }else
      {
        redirect(base_url($this->_cname.'/edit/'. $id ."?action=update&status=error"));
      }
    }
    public function get (){
      $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
      if($this->input->is_ajax_request()){
        $id = $this->input->post("id");
        $column  = $this->input->post("column");
        $actions = $this->input->post("actions");
        $ramkey  = $this->input->post("ramkey");
        $sort    = $this->input->post("sort");
        if($id){
          $p = $this->Common_model->get_record($this->_fix."parts",["id" => $id]);
          if($p){ 
            $data_insert = [
              "part_id"    => $p["id"],
              "block_id"   => 0,
              "section_id" => 0,
              "theme_id"   => 0,
              "ncolum"     => $column,
              "ramkey"     => $ramkey,
              "is_system"  => 1,
              "sort"       => $sort
            ];
            $part_id = $this->Common_model->add($this->_fix."theme_sections_block_part",$data_insert);            if($actions != null)
            if($actions != null){
              foreach ($actions as $key => $value) {
                $inser_data = [
                  "block_part_id" => $part_id,
                  "section_id"    => 0,
                  "theme_id"      => 0,
                  "action_id"     => $value
                ];
                $this->Common_model->add($this->_fix."part_action",$inser_data);
              }
              $actions = implode(',',$actions) ;
            }
            else
            {
              $actions = "";
            }
            $editstring = "<h3 class='title-block'>".$p["name"]."</h3>";
            $editstring = '<div data-id="'.$p["id"].'" class="col-md-'.$column.'"><div class="block-part">'
            . $editstring.
            '<div id="box-info-part"><input name="id" value="'.$part_id.'" type="hidden">
            <input name="column" value="'.$column.'" type="hidden">
            <input name="actions" value="'.$actions.'" type="hidden">
            <input name="sort" value="'.$sort.'" type="hidden"></div>
              <div class="menu-action">
                <ul class="menu-block">
                  <li><a href="javascript:;" id="edit-part"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></li>
                  <li><a href="javascript:;" id="delete-part"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                </ul>
              <div/>
            </div>
            </div>';
            $data["status"] = "success";
            $data["response"] = $editstring;
          }
        }
      }  
      die( json_encode($data) );
    }
    public function __destruct(){
      if(!$this->input->is_ajax_request())
        $this->load->view("block/footer");
    }
}
