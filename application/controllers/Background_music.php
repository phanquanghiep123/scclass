<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Background_music extends CI_Controller {
  	public $_fix   = "ewd_";
	public $_table = "background_music";
	public $_view  = "background_music";
  	public $_cname = "background_music";
  	public $_model = "Background_music_model";
  	public $_data  = [];
	public function __construct(){
		parent::__construct();
      ini_set('max_execution_time', 0);
		if(!$this->input->is_ajax_request())
			$this->load->view("block/header");
    $this->session->set_flashdata('post',$this->input->post());
    $this->session->set_flashdata('get',$this->input->get());
	}
	public function index (){
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
	public function create (){
		$groups = $this->Common_model->get_result($this->_fix."groups_background_music");
		$this->_data["groups"] = $groups;
		$this->_data["action_save"] = $this->_cname."/save_create";
		$this->load->view($this->_view . "/create_and_edit",$this->_data);
	}
	public function edit($id){

	}
	public function save_create (){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','', 'required');
		$this->form_validation->set_rules('group_id','', 'required');
		$this->form_validation->set_rules('media_id','', 'required');
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
	public function save_edit ($id){

	}
	public function delete($id){

	} 

	public function __destruct(){
		if(!$this->input->is_ajax_request()) $this->load->view("block/footer");
	}
}