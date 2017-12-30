<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medias extends CI_Controller {
	public $_fix   = "ewd_";
	public $_table = "medias";
	public $_view  = "medias";
    public $_data  = [];
	public function __construct()
	{
		parent::__construct();
		if(!$this->input->is_ajax_request())
			$this->load->view("block/header");
	}
	public function index()
	{
        $this->data["mediatype"] = $this->Common_model->get_result($this->_fix."media_type");
        $this->load->model("Medias_model");
		$this->data["list_media"] =  $this->Medias_model->get();
        $this->load->view($this->_view . "/index",$this->data);
	}
    public function get (){
        $data = ["status" => "no","message" => null,"thumb" => null];
        if($this->input->is_ajax_request()){
            $id       = $this->input->post("id");
            $type     = $this->input->post("type");
            $keyword  = $this->input->post("keyword") ? $this->input->post("keyword") : -1;
            $order    = $this->input->post("keyword") ? $this->input->post("order") : -1;
            $offset   = $this->input->post("offset") ? $this->input->post("offset") : 0;
            $limit    = 50;
            $html = "";
            if($type == "folder"){
                $this->load->model("Medias_model");
                $list_medias = $this->Medias_model->get($offset ,$limit,$id,$keyword,$order);
                if(@$list_medias != null){
                    $sizeData = [
                      "Kb" => 1024,
                      "Mb" => (1024 * 1024),
                      "GB" => (1024 * 1024 * 1024),
                      "Tb" => (1024 * 1024 * 1024 * 1024)
                    ];
                    foreach ($list_medias as $key => $value) {
                        $stringicon = "";
                        $sizestring = "";
                        if($value["type_name"] != "folder"){
                            foreach ($sizeData as $key_1 => $value_1) {
                                if($value_1 < $value["size"]){
                                    $sizestring = "(" .round(($value["size"] / $value_1),2) .  $key_1 .")";
                                }
                            }
                        }
                        if($value["icon"] == null && $value["icon"] == ""){
                            $stringicon = '<img class="thumb-media" src="'.base_url( $value["thumb"]).'">';
                        }else{
                            $stringicon = '<i class="thumb-media '.$value["icon"].'" ></i>';
                        }
                        $html +='<div class="col-md-2">
                        <div id="contaner-item" data-type="'. $value["type_name"].'" class="'. $value["type_name"].'" data-id="'. $value["id"].'" data-typeid="'. $value["type_id"].'">
                          <div class="action" data-id="'. $value["id"].'" data-type="'. $value["type_id"].'">
                            <a href="javascript:;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                          </div>
                          <div class="bg-info">
                            <p>'.$value["name"].' '. $sizestring.'</p>
                          </div>
                          '.$stringicon.'
                        </div>
                        </div>';
                    }
                }else{
                    $html = '<div class="empty-folder"><p><i class="fa fa-thermometer-empty" aria-hidden="true"></i></p><p>Folder is emty</p></div>';
                }
            } 
            $data["response"] = $html;
            $data["status"] = "success";
        }
        die(json_encode($data));
    }
    public function add($type){
        $data = ["status" => "no","message" => null,"thumb" => null];
        if($this->input->is_ajax_request()){
            $r = $this->Common_model->get_record($this->_fix."media_type",["name" => $type]);
            if($r != null){
                switch ($r["name"]) {
                    case 'folder':
                        $name   = $this->input->post("name");
                        $folder = $this->input->post("folder");
                        if( $name != null && $folder != null){
                            $i = [
                                "name"      => $name,
                                "type_id"   => $r["id"],
                                "folder_id" => $folder
                            ];
                            $id = $this->Common_model->add($this->_fix.$this->_table,$i);
                            $record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
                            $data["status"] = "success";
                            $show_view = "";
                            if($r["name"] == "image"){
                                $show_view = '<img class="thumb-media" src="'.base_url($record["thumb"]).'" />';
                            }else{
                                $show_view = '<i class="thumb-media '.$r["icon"].'" ></i>';
                            }
                            $data["response"] = '<div class="col-md-2">
                            <div id="contaner-item" data-type="'.$r["name"].'" class="'.$r["name"].'" data-id="'.$record["id"].'" data-typeid="'.$record["type_id"].'">
                              <div class="action" data-id="'.$record["id"].'" data-type="'.$r["id"].'">
                                <a href="javascript:;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              </div>
                              <div class="bg-info">
                                <p>'.$record["name"].'</p>
                              </div>
                              '.$show_view.'
                            </div>
                          </div>';
                        }
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        die(json_encode($data));
    }
	public function upload(){
		$data = ["status" => "no","message" => null,"thumb" => null ,"post" =>  $this->input->post()];
        if($this->input->is_ajax_request()){
    		$config["upload_path"] = "/uploads";
            $folder = $this->input->post("folder");
    		$dataupload = $this->saveflie("file",$config);
    		if($dataupload ["status"]){
    			$r = $dataupload["response"];
    			//get type 
                $this->db->from($this->_fix."media_type");
                $this->db->like('extension', '/'.$r["extention"].'/');
                $exe = $this->db->get()->row_array();
                if($exe == null){
                    $r["type_id"] = 3;
                    $exe  = $this->Common_model->get_record($this->_fix."media_type",["id" => 3]);
                }else{
                    $r["type_id"] = $exe["id"];
                }
                $r["folder_id"] = $folder;
    			$id = $this->Common_model->add($this->_fix.$this->_table,$r);
    			$record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
    			if($exe["name"] == "image"){
                    $record["show_view"] = '<img class="thumb-media" src="'.base_url($record["thumb"]).'" />';
                }else{
                    $record["show_view"] = '<i class="thumb-media '.$exe["icon"].'" ></i>';
                }
                $data = ["status" => "ok","message" => "Upload successfully","response" => $record,"post" =>  $this->input->post()];
    		}
            $sizeData = [
              "Kb" => 1024,
              "Mb" => (1024 * 1024),
              "GB" => (1024 * 1024 * 1024),
              "Tb" => (1024 * 1024 * 1024 * 1024)
            ];
            $sizestring = "";
            if($exe["name"] != "folder"){
                foreach ($sizeData as $key => $value) {
                    if($value < $record["size"]){
                        $sizestring = "(".round(($record["size"] / $value),2) .  $key .")";
                    }
                }
            }
            $data["response"] = '<div class="col-md-2">
                <div id="contaner-item" data-type="'.$exe["name"].'" class="'.$exe["name"].'" data-id="'.$record["id"].'" data-typeid="'.$record["type_id"].'">
                  <div class="action" data-id="'.$record["id"].'" data-type="'.$record["type_id"].'">
                    <a href="javascript:;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  </div>
                  <div class="bg-info">
                    <p>'.$record["name"].' '.$sizestring.'</p>
                  </div>
                  '.$record["show_view"].'
                </div>
              </div>';
        }
		die (json_encode($data));
	}
	private function saveflie($file, $config = null){
		$data_return = ["status" => false];
		$data_file = [];
		$config_file = [
			"full"   => 1920,
			"large"  => 1366,
			"medium" => 768,
			"small"  => 640,
			"thumb"  => 420
		];
        $path_parts             = pathinfo($_FILES["file"]["name"]);
        $data_file["name"]      = $_FILES["file"]["name"];
		$extension              = $path_parts['extension'];
		$data_file["extention"] = strtolower($extension);
		$data_file["size"]      = $_FILES["file"]["size"];
		$name = uniqid().".".strtolower($extension);
        if (!is_dir($config['upload_path'] )) {
            mkdir($config['upload_path'] , 0777, TRUE);
        }
        $pathsave  = $config["upload_path"];
        $config['allowed_types']  = '*';
        $config["file_name"]      = $name;
        $config["upload_path"]    = FCPATH . $config["upload_path"];
		$this->load->library('upload');
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload($file))
        {
            $data_return["response"] = $this->upload->display_errors();    
        }
        else
        {
            $data = $this->upload->data();
            $data_file["path"] = $pathsave . "/" . $data['file_name'];
            $data_return["status"] = true;
            if($data["is_image"]){
            	$this->load->library('image_lib');
            	$full_path = $data["full_path"];
            	$w = $data["image_width"];
            	$h = $data["image_height"];
            	foreach ($config_file as $key => $value) {
            		$new_path = $config['upload_path'] . "/" . $key;
        	 		if (!is_dir( $new_path)) {
			            mkdir($new_path, 0777, TRUE);
			        }
            	 	if($value < $w){
            	 		$ratio_image = $this->ratio_image($w ,$h,$value,0);
            	 		$config['width']  = $value;
            	 		$config['height'] = $ratio_image["height"];
            	 		$config['source_image']   = $full_path;
            	 		$config['new_image']      = $new_path ."/". $data['file_name'];
            	 		$config['maintain_ratio'] = FALSE;
            	 		$config['quality'] = 100;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $data_resize = $this->image_lib->resize();
                        $data_file[$key] = $pathsave . "/" . $key ."/". $data['file_name'];;
            	 	}else{
            	 		$data_file[$key] = $pathsave . "/" . $data['file_name'];
            	 	}
            	}
            } else{
                foreach ($config_file as $key => $value) {
                    $data_file[$key] = $pathsave . "/" . $data['file_name'];
                }
            }
            $data_return["response"] = $data_file;         
        }
        return $data_return;
	}
	private function ratio_image($original_width, $original_height, $new_width = 0, $new_heigh = 0) {
        $size['width'] = $new_width;
        $size['height'] = $new_heigh;
        if ($new_heigh != 0) {
            $size['width'] = intval(($original_wdith / $original_height) * $new_height);
        }
        if ($new_width != 0) {
            $size['height'] = intval(($original_height / $original_width) * $new_width);
        }
        return $size;
    }
	function gen_slug_name_file($str){
		$a = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă","ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề" , "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ" , "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă" , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ" , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", " ","ö","ü"); 
		$b = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a" , "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o " , "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A " , "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O " , "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "-","o","u");
		return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
	}
	public function __destruct(){
		if(!$this->input->is_ajax_request())
			$this->load->view("block/footer");
	}
}
