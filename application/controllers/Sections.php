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
		$this->_data["ramkey"] = uniqid();
		$this->load->model("Sections_model");
		$this->_data["post"] = $this->session->flashdata('post');
		$this->_data["action_save"] = $this->_cname."/save_create";
		$this->_data["post"]["blocks"] = $this->Common_model->get_result($this->_fix."blocks",["status" => 1]); 
		$this->_data["post"]["parts"]  = $this->Common_model->get_result($this->_fix."parts",["status" => 1]); 		
		$this->_data["post"]["actions"] = $this->Sections_model->get_action_like("/section/",0)	;
		$this->_data["post"]["styles"]  = $this->Common_model->get_like($this->_fix."styles","support_key","/section/");
		$this->load->view($this->_view . "/create_and_edit",$this->_data);
	}
	public function edit($id){
		$this->_data["ramkey"] = uniqid();
		$this->Common_model->update($this->_fix."theme_sections_block",["ramkey" => $this->_data["ramkey"]],["section_id" => $id]);
		$theme_id = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0;
		$s = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
		$ts = $this->Common_model->get_record($this->_fix."theme_section",["section_id" => $s["id"],"theme_id" => $theme_id]);
		$tso = $this->Common_model->get_record($this->_fix."theme_section_order",["theme_section_id" => $ts["id"]]);
		$s = array_merge ($tso,$s);
		$s = array_merge ($ts,$s);
		$this->_data["post"] = $s;
		$this->_data["action_save"] = $this->_cname."/save_edit/".$id;
		$this->_data["post"]["blocks"] = $this->Common_model->get_result($this->_fix."blocks",["status" => 1]);
		$this->_data["post"]["parts"]  = $this->Common_model->get_result($this->_fix."parts",["status" => 1]);
		$this->load->model("Sections_model");
		$this->load->model("Blocks_model");
		$this->load->model("Parts_model");
		$my_blocks = $this->Sections_model->get_blocks($id);
		$this->_data["post"]["my_blocks"] = null;
		foreach ($my_blocks as $key => $value) {
			$ps = $this->Blocks_model->get_part_by_id($value["id"],$value["section_block_id"],$theme_id);
			$items = [];
			foreach ($ps as $key_1 => $value_1) {
				$value_1["actions"] = $this->Parts_model->get_action_like($value_1["block_part_id"],$value["section_block_id"],$theme_id);
				$items[] = $value_1;
			}
			$value['ps'] = $items;
			$this->_data["post"]["my_blocks"][]  = $value;
		}

		$this->_data["post"]["actions"] = $this->Sections_model->get_action_like("/section/",$id);
		$this->_data["post"]["styles"]  = $this->Common_model->get_like($this->_fix."styles","support_key","/section/");
		$this->load->view($this->_view . "/create_and_edit",$this->_data);
		//$this->output->enable_profiler(TRUE);
	}
	public function save_create (){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('status', 'Trạng thái', 'required');
		$this->form_validation->set_rules('ramkey', 'Trạng thái', 'required');
		if ($this->form_validation->run() !== FALSE)
		{
			$name   = $this->input->post("name");
			$status = $this->input->post("status");
			$is_full = $this->input->post("is_full");
			$default_block = $this->input->post("default_block");
			$class_name = $this->input->post("class_name");
			$id_name = $this->input->post("id_name");
			$section_block_id = $this->input->post("section_block_id");
			$ramkey = $this->input->post("ramkey"); 
			$actions = $this->input->post("actions"); 
			$sort = $this->input->post("sort") ? $this->input->post("sort") : 0; 
			$i = [
				"name" => $name,
				"status" => $status
			];
			$id = $this->Common_model->add($this->_fix.$this->_table,$i);
			if($id){
				$ramkeyn = uniqid();
				$u = [
					"section_id" => $id,
					"ramkey"     => $ramkeyn
				];
				$this->Common_model->update($this->_fix."theme_sections_block",$u,["ramkey" => $ramkey]);
				$i = [
					"section_id" => $id,
					"theme_id"   => 0
				];
				$tsid = $this->Common_model->add($this->_fix."theme_section",$i);
				$i = [
					"theme_section_id" 	=> $tsid,
					"sort"  		 	=> $sort,
					"class_name" 		=> $class_name,
					"id_name"    		=> $id_name,
					"is_full"    		=> $is_full,
					"default_block" 	=> $default_block
 				];
 				$this->Common_model->add($this->_fix.'theme_section_order',$i);
 				if($section_block_id != null && is_array($section_block_id)){
 					foreach ($section_block_id as $key => $value) {
 						$this->Common_model->update($this->_fix."theme_section_block_order",["sort" => $key],["section_block_id" => $value]);
 					}
 				}
 				if($actions != null && is_array($actions)){
 					foreach ($actions as $key => $value) {
 						$this->Common_model->add($this->_fix."section_action",[
 							"theme_section_id" 	=> $tsid,
 							"action_id" 		=> $value,
 							"active"    		=> 1
 						]);
 					}
 				}
 				redirect(base_url($this->_cname.'/edit/'.$id."?action=create&status=success"));
			}else{
				redirect(base_url($this->_cname.'/create/'."?action=create&status=error"));
			}
		}else{
			redirect(base_url($this->_cname.'/create/'."?action=create&status=error"));
		}
	}
	public function save_edit ($id){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('status', 'Trạng thái', 'required');
		$this->form_validation->set_rules('ramkey', 'Trạng thái', 'required');
		if ($this->form_validation->run() !== FALSE)
		{
			$name   = $this->input->post("name");
			$status = $this->input->post("status");
			$is_full = $this->input->post("is_full");
			$default_block = $this->input->post("default_block");
			$class_name = $this->input->post("class_name");
			$id_name = $this->input->post("id_name");
			$section_block_id = $this->input->post("section_block_id");
			$theme_id = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0 ;
			$ramkey = $this->input->post("ramkey"); 
			$actions = $this->input->post("actions"); 
			$sort = $this->input->post("sort") ? $this->input->post("sort") : 0; 
			$i = [
				"name" => $name,
				"status" => $status
			];
			$this->Common_model->update($this->_fix.$this->_table,$i,["id" => $id]);
			if($id){
				$w = ["section_id" => $id, "theme_id"  => $theme_id];
				$ramkeyn = uniqid();
				$ts = $this->Common_model->get_record($this->_fix."theme_section",$w);
				$i = [
					"sort"  		 	=> $sort,
					"class_name" 		=> $class_name,
					"id_name"    		=> $id_name,
					"is_full"    		=> $is_full,
					"default_block" 	=> $default_block
 				];
 				$this->Common_model->update($this->_fix.'theme_section_order',$i,["id" => $ts["id"]]);
 				if($section_block_id != null && is_array($section_block_id)){
 					foreach ($section_block_id as $key => $value) {
 						$this->Common_model->update($this->_fix."theme_section_block_order",["sort" => $key],["section_block_id" => $value]);
 					}
 				}
 				$this->Common_model->update($this->_fix."section_action",["active" => 0],["theme_section_id" => $ts["id"]]);
 				if($actions != null && is_array($actions)){
 					foreach ($actions as $key => $value) {
 						$c = $this->Common_model->get_record($this->_fix."section_action",[
	 						"theme_section_id" 	=> $ts["id"],
	 						"action_id" 		=> $value
	 					]);
 						if($c){
 							$this->Common_model->update($this->_fix."section_action",["active" => 1],["theme_section_id" => $c["theme_section_id"],"action_id"=> $value]);
 						}else{
 							$this->Common_model->add($this->_fix."section_action",["theme_section_id" => $ts["id"],"action_id"=> $value,"active"=> 1]);
 						}	
 					}
 				}
 				redirect(base_url($this->_cname.'/edit/'.$id."?action=create&status=success"));
			}else{
				redirect(base_url($this->_cname.'/edit/'.$id."?action=create&status=error"));
			}
		}else{
			redirect(base_url($this->_cname.'/edit/'.$id."?action=create&status=error"));
		}	
	}
	public function delete($id){
	} 
	public function upload (){
		$ramkey = uniqid();
		$html = '<div id="'.$ramkey.'">
		  <div class="box-container-upload">
		    <ul class="nav nav-tabs nav-'.$ramkey.'">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Menu 1</a></li>
		      <li><a href="#">Menu 2</a></li>
		      <li><a href="#">Menu 3</a></li>
		    </ul>
		    <ul class="nav nav-pills nav-'.$ramkey.'">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Menu 1</a></li>
		      <li><a href="#">Menu 2</a></li>
		      <li><a href="#">Menu 3</a></li>
		    </ul>
		    <a id="toggle-upload-file" data-type="image" class="button ui-button-primary">Select image</a>
		    <a class="button ui-button-text" data-type="image" data-max ="1" id="open-file-manage">Explore free image</a>
		  </div>
		</div>';
		return $html;
	}
	public function color(){
		$ramkey = uniqid();
		$html = '<div id="'.$ramkey.'">
		  <div class="box-container-upload">
		    <a id="toggle-upload-file" data-type="image" class="button ui-button-primary">Select image</a>
		    <a class="button ui-button-text" data-type="image" data-max ="1" id="open-file-manage">Explore free image</a>
		  </div>
		</div>';
		return $html;
	}
	public function add_blocks (){
		$data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
		if($this->input->is_ajax_request()){
		  	$id         = $this->input->post("ids");
		  	$ramkey     = $this->input->post("ramkey") ;
		  	$section_id = $this->input->post("section_id") ? $this->input->post("section_id")  : -1;
		  	$theme_id   = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0;
		  	$this->load->model("Blocks_model");
		  	if(is_array($id)){
			    $html = "";
			    foreach ($id as $key => $value) {
			      	$b = $this->Common_model->get_record($this->_fix."blocks",["id" => $value]);
			     	if($b){
				        $sbId  = $this->Common_model->add($this->_fix."theme_sections_block",[
				          "block_id"   => $value,
				          "section_id" => $section_id,
				          "ramkey"     => $ramkey
				        ]); 
				        if($sbId){
							$this->Common_model->add($this->_fix."theme_section_block_order",[
								"section_block_id" => $sbId,
								"theme_id"         => $theme_id,
								"ncolum"           => 12
							]);   
				          	$html .= '<div data-colum="12" data-id="'.$sbId.'" class="block-item col-md-12 ui-sortable-handle"><div class="wrapper-block">
				          	<h4 class="block-title text-center">'.$b["name"].'</h4>
				          	<div class="menu-action" id="support_block">
				              <ul class="menu-block">
				                <li><a href="javascript:;" id="edit-block"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
				                <li><a href="javascript:;" id="add-part"><i class="fa fa-plus-square" aria-hidden="true"></i></a></li>
				                <li><a href="javascript:;" id="delete-block"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
				              </ul>
				              <input type="hidden" value="'.$sbId.'" name="section_block_id[]">
				            </div>
				            <div id="list-part">';
				          	$ps = $this->Blocks_model->get_part_by_id($b["id"],0,$theme_id,["tbl2.is_default" => 1]);
				            if($ps){
					            foreach ($ps as $key => $value) {
					                //clone block_part_meta
						        	$cmt = $this->Common_model->get_record($this->_fix."block_part_meta",[ "block_part_id" => $value["block_part_id"] , "section_block_id" => 0,"theme_id" => $theme_id ]);
						            if($cmt != null){
						            	$cmt["section_block_id"] = $sbId;
						            	unset($cmt["id"]);
						            	$this->Common_model->add($this->_fix."block_part_meta",$cmt);
						            }
						            //!clone block_part_meta
						            
						            //clone order block_part_orde
						            $cpo = $this->Common_model->get_record($this->_fix."theme_section_block_part_order",[ "block_part_id" => $value["block_part_id"] ,"section_block_id" => 0,"theme_id" => $theme_id ]);
						            if($cpo != null){
						            	$cpo["section_block_id"] = $sbId;
							            unset($cpo["id"]);
							            $this->Common_model->add($this->_fix."theme_section_block_part_order",$cpo);
						            }
					              	$as = $this->Common_model->get_result($this->_fix."part_action",["block_part_id" => $value["block_part_id"],"section_block_id" => 0 ,"theme_id" => $theme_id,"active" => 1]);
					              	$as_html = "";
					              	if($as){
						                $as_html = '<div class="menu-action" id="support_part"><ul class="menu-block">';
						                foreach ($as as $key_1 => $value_1) {
						                	//clone order part_action
						                	$ca = $value_1;
						                	$ca["section_block_id"] = $sbId;
						                	unset($ca["id"]);
						                	$this->Common_model->add($this->_fix."part_action",$ca);
						                    $a = $this->Common_model->get_record($this->_fix."actions",["id" => $value_1["action_id"]]);
						                    if($a){
						                      	$as_html .= '<li><a href="javascript:;" id="'.$a["key_id"].'-part">'.$a["icon"].'</a></li>';
						                    }
						                }
						                $as_html .= '</ul></div>';
					             	} 
					              $html .= '
					              <div data-colum="'.$value["ncolum"].'" data-id="'.$value["block_part_id"].'" class="item-part-block col-md-'.$value["ncolum"].' ui-sortable-handle"> 
					                <div class="block-part">
					                  <h3 class="title-block">'.$value["name"].'</h3>
					                  '.$as_html.'
					                </div>
					              </div>'; 
					            }
				          	}
				          	$html .= '</div>';
				        }
			      	}
			      	$html .= '</div></div>';
			    }
			    $data["response"] = $html;
			    $data["status"]   = "success";
		  	}     
		}
		die(json_encode($data));
	}
	public function edit_block(){
        $data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
		if($this->input->is_ajax_request()){
	    	$id = $this->input->post("id");
	    	$sb = $this->Common_model->get_record($this->_fix."theme_sections_block",["id" => $id]);
	    	if($sb){
	    		$info_sb = $this->Common_model->get_record($this->_fix."theme_section_block_order",["section_block_id" => $sb["id"]]);
	    		$b = $this->Common_model->get_record($this->_fix."blocks",["id" => $sb["block_id"]]);
	    		if($b){
		    		$this->load->model("Blocks_model");
		    		$as = $this->Blocks_model->get_actions($id);
		    		$colum = $info_sb["ncolum"];
		    		$editstring = "<h3 class='title-block'>".$b["name"]."</h3>";
					$editstring = '<div class="block-part">
					<div class="row"><div class="col-md-12"><div class="box-slider box-full">
					<div class="row"><div class="col-md-2"><p class="lable">Rows:</p></div>
					<div class="col-md-10">
					<select class="none" name="minbeds" id="minbeds">';
					$cs = 13;
					for ($i=0; $i < $cs; $i++) { 
						if($i == $colum){
							$editstring .='<option value="'.$i.'" selected>'.$i.'</option>';
						}else{
							$editstring .='<option value="'.$i.'">'.$i.'</option>';
						}   
					}
					$editstring .= '</select></div></div></div></div>';
					if($as){
						$editstring .= '<div class="col-md-12"><div class="box-action box-full"><p class="lable">Actions: ';
						foreach ($as as $key => $value) {
							if($value["active"] == 1){
								$atv = "checked";
							}else{
								$atv = "";
							}
							$editstring .= '<label><input id="action-item" name="actions[]" type="checkbox" value="'.$value["id"].'" '.$atv.'>'.$value["name"].'</label>';
						}
						$editstring .= '</p></div></div>';
					}
					$editstring .= '</div>';
					$editstring .= '<div class="box-part box-full">
					<div class ="form-group">
						<div class="input-group input-group-sm">
							<label class="input-group-addon" for="class-name">Class name</label>
							<input type="text"  name="class_name" class="form-control" id="class-name" value="'.$info_sb["class_name"].'" placeholder="Enter class name">
						</div>
					</div>
					<div class ="form-group">
						<div class="input-group input-group-sm">
							<label class="input-group-addon" for="id-name">Id name</label>
							<input type="text" name="id_name" class="form-control" id="id-name" value="'.$info_sb["id_name"].'" placeholder="Enter Id name">
						</div>
					</div>
					</div>
					<div id="box-info-part">
						<input name="id" value="'.$id.'" type="hidden">
					</div>';
					$data["status"] = "success";
					$data["response"] = $editstring;
	    		}	
	    	}
	    }
	    die(json_encode($data));
	}
	public function delete_block(){
		$data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
		if($this->input->is_ajax_request()){
	    	$id = $this->input->post("id");
	    	$theme_id = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0;
	    	$sb = $this->Common_model->get_record($this->_fix."theme_sections_block",["id" => $id]);
	    	if($sb){
	    		// delete part order has cloned;
	    		$this->Common_model->delete($this->_fix."theme_section_block_part_order",['section_block_id' => $id]);
	    		// !delete part has cloned;

	    		// delete part meta has cloned;
	    		$this->Common_model->delete($this->_fix."block_part_meta",['section_block_id' => $id]);
	    		// !delete part meta cloned;

	    		// delete block order has added;
	    		$this->Common_model->delete($this->_fix."theme_section_block_order",['section_block_id' => $id,"theme_id" => $theme_id]);
	    		// !delete block order added;

	    		// delete ections block has added;
	    		$this->Common_model->delete($this->_fix."theme_sections_block",['id' => $id]);
	    		// !delete ections block added;
	    	}
	    	$data["status"] = "success";
	    }
	    die(json_encode($data));
	}
	public function save_block(){
		$data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
		if($this->input->is_ajax_request()){
			$ncolum = $this->input->post("minbeds");
			$actions = $this->input->post("actions");
			$class_name = $this->input->post("class_name");
			$id_name = $this->input->post("id_name");
			$id = $this->input->post("id");
			$theme_id = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0;
			$sb = $this->Common_model->get_record($this->_fix."theme_section_block_order",["section_block_id" => $id ,"theme_id" => $theme_id ]);
			if($sb){
				$u = [
					"class_name" => $class_name,
					"id_name"    => $id_name,
					"ncolum"     => $ncolum
				];
				$this->Common_model->update($this->_fix."theme_section_block_order",$u,["section_block_id" => $id ,"theme_id" => $theme_id ]);
				$this->Common_model->update($this->_fix."block_action",["active" => 0],["section_block_id" => $id ,"theme_id" => $theme_id ]);
				if($actions){
					foreach ($actions as $key => $value) {
						$a = $this->Common_model->get_record($this->_fix."block_action",["action_id" => $value,"section_block_id" => $id ,"theme_id" => $theme_id ]);
						if($a == null){
							$this->Common_model->add($this->_fix."block_action",[
								"action_id" => $value,
								"section_block_id" => $id,
								"theme_id" => $theme_id,
								"active" => 1
							]);
						}else{
							$this->Common_model->update($this->_fix."block_action",["active" => 1],["action_id" => $value,"section_block_id" => $id ,"theme_id" => $theme_id ]);
						}
					}
				}
				$data["status"] = "success";
			}
		}
		die(json_encode($data));
	}
	public function add_parts(){
		$data = ["status" => "error","message" => null,"response" => null ,"record" => null,"post" => $this->input->post() ];
		if($this->input->is_ajax_request()){
			$ids = $this->input->post("ids");
			$ramkey = $this->input->post("ramkey");
			$theme_id = $this->input->post("theme_id") ? $this->input->post("theme_id") : 0 ;
			$section_block_id = $this->input->post("section_block_id");
			$sort = $this->input->post("sort");
			$html = "";
			if($section_block_id && is_array($ids)){
				$get_current_block = $this->Common_model->get_record($this->_fix."theme_sections_block",["id" => $section_block_id]);
				if($get_current_block){
					$block_id = $get_current_block["block_id"];
					foreach ($ids as $key => $value) {
						$i = [
							"part_id"    => $value ,
							"block_id"   => $block_id,
							"is_default" => 0,
							"ramkey"     => $ramkey
						];
						$bp_id = $this->Common_model->add($this->_fix."theme_sections_block_part",$i);
						if($bp_id){
							$i = [
								"block_part_id"    => $bp_id,
								"section_block_id" => $section_block_id,
								"theme_id"         => $theme_id,
								"ncolum"           => 12,
								"sort"             => $sort
							];
							$this->Common_model->add($this->_fix."theme_section_block_part_order",$i);
						}
					}					
				}
			}
		}
		die(json_encode($data));
	}
	public function __destruct(){
		if(!$this->input->is_ajax_request())
		  $this->load->view("block/footer");
	}
}