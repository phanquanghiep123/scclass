<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medias extends CI_Controller {
	public $_fix   = "ewd_";
	public $_table = "medias";
	public $_view  = "medias";
	public function __construct()
	{
		parent::__construct();
		if(!$this->input->is_ajax_request())
			$this->load->view("block/header");
	}
	public function index()
	{
		$this->load->view($this->_view . "/index");
	}
	public function upload(){
		$data = ["status" => "no","message" => null,"thumb" => null];
		$config["upload_path"] = FCPATH . "/uploads";
		$dataupload = $this->saveflie("file",$config);
		if($dataupload ["status"]){
			$r = $dataupload["response"];
			$r["type_id"] = 1;
			$id = $this->Common_model->add($this->_fix.$this->_table,$r);
			$record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
			$data = ["status" => "ok","message" => "Upload successfully","response" => $record];
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
		$data_file["extention"] = $extension;
		$data_file["size"]      = $_FILES["file"]["size"];
		$name = uniqid().".".$extension;
        if (!is_dir($config['upload_path'] )) {
            mkdir($config['upload_path'] , 0777, TRUE);
        }
        $config['allowed_types']  = '*';
        $config["file_name"]      = $name;
		$this->load->library('upload');
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload($file))
        {
            $data_return["response"] = $this->upload->display_errors();    
        }
        else
        {
            $data = $this->upload->data();
            $data_return["status"] = true;
            if($data["is_image"]){
            	$this->load->library('image_lib');
            	$full_path = $data["full_path"];
            	$w = $data["image_width"];
            	$h = $data["image_height"];
            	$data_file["path"] = $full_path;
            	foreach ($config_file as $key => $value) {
            		$new_path = $config['upload_path'] . "/" . $key;
        	 		if (!is_dir( $new_path)) {
			            mkdir($new_path, 0777, TRUE);
			        }
            	 	if($value < $w){
            	 		$ratio_image = $this->ratio_image($w ,$h,$value,0);
            	 		$config['width']  = $value;
            	 		$config['height'] = $ratio_image["height"];
            	 		$config['source_image'] = $full_path;
            	 		$config['new_image']    = $new_path ."/". $data['file_name'];
            	 		$config['maintain_ratio'] = FALSE;
            	 		$config['quality'] = 100;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $data_resize = $this->image_lib->resize();
                        $data_file[$key] = $config['new_image'];
            	 	}else{
            	 		$data_file[$key] = $full_path;
            	 	}
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
