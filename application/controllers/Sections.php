<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sections extends CI_Controller {
	public $_fix   = "ewd_";
	public $_table = "sections";
	public $_view  = "sections";
  public $_cname = "sections";
  public $_model = "Sections_model";
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

  }
  public function edit($id){

  }
  public function save_create (){

  }
  public function save_edit ($id){

  }
  public function delete($id){

  } 
  public function __destruct(){
    if(!$this->input->is_ajax_request())
      $this->load->view("block/footer");
  }
}