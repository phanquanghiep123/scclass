<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blocks extends CI_Controller {
  	public $_fix   = "ewd_";
  	public $_table = "blocks";
  	public $_view  = "blocks";
    public $_cname = "blocks";
    public $_model = "Blocks_model";
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
      $this->_data["tables"] = $this->Common_model->get_result($this->_fix.$this->_table,null,$offset,$limit);
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
      $this->_data["post"]["parts"]  = $this->Common_model->get_result($this->_fix."parts");
      $this->_data["action_save"] = $this->_cname."/save_create";
      $this->_data["post"]["actions"]  = $this->Common_model->get_like($this->_fix."actions","support_key","/part/");
      $this->load->view($this->_view . "/create_and_edit",$this->_data);
    }
    public function edit($id){
      $item = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
      $this->_data["post"] = $item;
      $this->_data["post"]["parts"]  = $this->Common_model->get_result($this->_fix."parts");
      $this->_data["action_save"] = $this->_cname."/save_create";
      $this->_data["post"]["actions"]  = $this->Common_model->get_like($this->_fix."actions","support_key","/part/");
      $this->_data["action_save"] = $this->_cname."/save_edit/".$id;
      $this->load->model("Blocks_model");
      $this->_data["my_parts"]  = $this->Blocks_model->get_part_by_id($id);
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
      $this->form_validation->set_rules('status', 'Trạng thái', 'required');
      if ($this->form_validation->run() !== FALSE)
      {
        $name = $this->input->post("name");
        $status = $this->input->post("status");
        $ids = $this->input->post("ids");
        $ramkey = $this->input->post("ramkey");
        $id = $this->Common_model->add($this->_fix.$this->_table,["name" => $name,"status" => $status]);
        if($id && $ids){
          $ramkeyn = uniqid();
          foreach ($ids as $key => $value) {
            $update = [
              "block_id" => $id,
              "sort"     => $key,
              "ramkey"   => $ramkeyn
            ];
            $this->Common_model->update($this->_fix."theme_sections_block_part",$update,["id" => $value]);
          }
          $this->db->delete($this->_fix."theme_sections_block_part",["ramkey" => $ramkey]);
        }
        redirect(base_url($this->_cname.'/edit/' . $id ."?action=create&status=success"));
      }else
      {
        redirect(base_url($this->_cname.'/create/'."?action=create&status=error"));
      }
    }
    public function save_edit($id){ 
      $this->load->library('form_validation');
      $this->form_validation->set_rules('name', 'Name', 'required');
      $this->form_validation->set_rules('status', 'Trạng thái', 'required');
      $block = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id ]);
      if($block == null) redirect(base_url($this->_cname));
      if ($this->form_validation->run() !== FALSE)
      {
        $name   = $this->input->post("name");
        $status = $this->input->post("status");
        $ids    = $this->input->post("ids");
        $ramkey = null;
        $this->Common_model->update($this->_fix.$this->_table,["name" => $name,"status" => $status],["id" => $id]);
        if($ids){
          $ramkeyn = uniqid();
          foreach ($ids as $key => $value) {
            if($key == 0){
              $v = $this->Common_model->get_record($this->_fix."theme_sections_block_part",["id" => $value]);
              if($v != null) $ramkey = $v["ramkey"];
            }
            $update = [
              "block_id" => $id,
              "sort"     => $key,
              "ramkey"   => $ramkeyn
            ];
            $this->Common_model->update($this->_fix."theme_sections_block_part",$update,["id" => $value]);
          }
          $this->db->delete($this->_fix."theme_sections_block_part",["ramkey" => $ramkey]);
        }
        redirect(base_url($this->_cname.'/edit/' . $id ."?action=create&status=success"));
      }else
      {
        redirect(base_url($this->_cname.'/edit/'."?action=create&status=error"));
      }
    }
    public function update_part_block(){
      $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
      if($this->input->is_ajax_request()){
        $id = $this->input->post("id");
        $block_part = $this->Common_model->get_record($this->_fix."theme_sections_block_part",["id" => $id]);
        if($block_part){
          $part  = $this->Common_model->get_record($this->_fix."parts",["id" => $block_part["part_id"]]);
          if($part){
            $metas = $this->Common_model->get_result($this->_fix."block_part_meta",["block_part_id" => $block_part["id"]]);
            $html_show = $part["list_show"];
            $media = $this->Common_model->get_record($this->_fix."medias",["id" => $part["path_html"]]);
            $media_ids = [];
            if(file_exists( FCPATH . $media["path"] )){
              $file_content = file_get_contents(FCPATH . $media["path"]); 
              if($file_content){
                $htmls = "";
                foreach ($metas as $key => $value) {
                  if($value["media_id"] != null && $value["media_id"] > 0){
                    $media_ids[] = $value["media_id"] ;
                    $media = $this->Common_model->get_record($this->_fix."medias",["id" => $value["media_id"]]);
                    if($media){
                      $html = '<div data-id="'.$value["media_id"].'" class="info-item">'.str_replace("{{value}}",base_url($media["thumb"]), $html_show ).'</div>';
                    }
                  }else{
                    $html = str_replace("{{value}}",$value["value"], $html_show );
                  }
                  $htmls .= $html;
                }
              } 
              $htmls = str_replace("{{value}}",$htmls, $file_content );
            }
            $a = $this->Common_model->get_result($this->_fix."part_action",["block_part_id" => $id]);
            $editstring = "<h3 class='title-block'>".$part["name"]."</h3>";
            $editstring = '<div class="block-part">
            <div class="row"><div class="col-md-12"><div class="box-slider box-full">
            <div class="row"><div class="col-md-2"><p class="lable">Rows:</p></div>
            <div class="col-md-10">
            <select class="none" name="minbeds" id="minbeds">';
            $colum = $block_part["ncolum"];
            $cs = 13;
            for ($i=0; $i < $cs; $i++) { 
              if($i == $colum){
                $editstring .='<option value="'.$i.'" selected>'.$i.'</option>';
              }else{
                $editstring .='<option value="'.$i.'">'.$i.'</option>';
              }   
            }
            $editstring .= '</select></div></div></div></div>';
            $actions = $this->Common_model->get_like($this->_fix."actions","support_key","/part/");
            if($actions){
              $editstring .= '<div class="col-md-12"><div class="box-action box-full"><p class="lable">Actions: ';
              foreach ($actions as $key => $value) {
                $atv = "";
                foreach ($a as $key_1 => $value_1) {
                  if($value_1["action_id"] == $value["id"] && $value_1["active"] == 1){
                    $atv = "checked";
                  }
                }
                $editstring .= '<label><input id="action-item" name="actions[]" type="checkbox" value="'.$value["id"].'" '.$atv.'>'.$value["name"].'</label>';
              }
              $editstring .= '</p></div></div>';
            }
            $editstring .= '</div>';
            $editstring .= '<div class="box-part box-full">'.$htmls.'
              <div class ="form-group">
                <div class="input-group input-group-sm">
                  <label class="input-group-addon" for="class-name">Class name</label>
                  <input type="text"  name="class_name" class="form-control" id="class-name" value="'.$block_part["class_name"].'" placeholder="Enter class name">
                </div>
              </div>
              <div class ="form-group">
                <div class="input-group input-group-sm">
                  <label class="input-group-addon" for="id-name">Id name</label>
                  <input type="text" name="id_name" class="form-control" id="id-name" value="'.$block_part["id_name"].'" placeholder="Enter Id name">
                </div>
              </div>
            </div>
            <div id="box-info-part">
              <input name="id" value="'.$id.'" type="hidden">
              <input type="hidden" value="'.implode(",",$media_ids).'" id="list_media" name="list_media"/>
            </div>';
            $data["status"] = "success";
            $data["response"] = $editstring;
          }
        }
      }  
      die( json_encode($data) );
    }
    public function value_part (){
      $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
      if($this->input->is_ajax_request()){
        $id = $this->input->post("id");
        $pb = $this->Common_model->get_record($this->_fix."theme_sections_block_part",["id" => $id]);
        if( $pb ){
          $p = $this->Common_model->get_record($this->_fix."parts",["id" => $pb["part_id"]]);
          $data["status"] = "success";
          $data["response"] = $p["list_show"];
        }
      }
      die( json_encode($data) );
    }
    public function save_block_part(){
      $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
      if($this->input->is_ajax_request()){
        $id = $this->input->post("id");
        $actions    = $this->input->post("actions");
        $list_media = $this->input->post("list_media");
        $ncolum     = $this->input->post("minbeds");
        $cln        = $this->input->post("class_name");
        $idn        = $this->input->post("id_name");
        $value_text = $this->input->post("value_text");
        $bp = $this->Common_model->get_record($this->_fix."theme_sections_block_part",["id" => $id]);
        if($bp){
          $data_update = [
            "ncolum" => $ncolum,
            "id_name" => $idn,           
            "class_name" => $cln
          ];
          $this->Common_model->update($this->_fix."theme_sections_block_part", $data_update ,["id" => $id]);
          $this->Common_model->update($this->_fix."part_action",["active" => 0],["block_part_id" => $id]);
          if($actions != null){
            foreach ($actions as $key => $value) {
              $r = $this->Common_model->get_record($this->_fix."part_action",["block_part_id" => $id,"action_id" => $value]);
              if($r != null){
                $this->Common_model->update($this->_fix."part_action",["active" => 1],["block_part_id" => $id,"action_id" => $value]);
              }else{
                $this->Common_model->add($this->_fix."part_action",["active" => 1,"block_part_id" => $id,"action_id" => $value]);
              }
            }
          }
          $c = $this->Common_model->delete($this->_fix."block_part_meta",["block_part_id" => $id]);
          if($value_text != null){
            $this->Common_model->add($this->_fix."block_part_meta",[
              "block_part_id" => $id, 
              "meta_key"      => "value_text",
              "theme_id"      => 0 ,
              "section_id"    => 0,
              "value"         =>  $value_text,
            ]);
          }
          if($list_media != null){
            $args = explode (",",$list_media);
            foreach ($args as $key => $value) {
              $i = [
                "block_part_id" => $id, 
                "meta_key"      => "value_media",
                "theme_id"      => 0 ,
                "section_id"    => 0,
                "media_id"      => $value,
              ];
              $this->Common_model->add($this->_fix."block_part_meta",$i);
            }
          }
          $data["status"] = "success";
        }
      }
      die( json_encode($data) );
    }
    public function __destruct(){
      if(!$this->input->is_ajax_request())
        $this->load->view("block/footer");
    }
   
}
