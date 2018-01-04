<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medias extends CI_Controller {
  	public $_fix   = "ewd_";
  	public $_table = "medias";
  	public $_view  = "medias";
    public $_data  = [];
  	public function __construct(){
    		parent::__construct();
            ini_set('max_execution_time', 0);
    		if(!$this->input->is_ajax_request())
    			$this->load->view("block/header");
  	}
  	public function index(){
        $this->data["mediatype"]  = $this->Common_model->get_result($this->_fix."media_type");
        $this->load->model("Medias_model");
        $this->data["list_media"]  =  $this->Medias_model->get();
        $list_folder = ["name" => "root" ,"id" => 0,"iconOpen"=>skin_url("images/1_open.png"),"iconClose" => skin_url("images/1_close.png"),"icon" => skin_url("images/1_open.png"),"children" => $this->Medias_model->get_list_folder(),"open" => true];
        $this->data["list_folder"] = $list_folder;
        $this->data["sizeData"] = $this->Common_model->get_result($this->_fix."config",["support" => "file_size"]);
        $config_file_allow_upload = $this->Common_model->get_record($this->_fix."config",["support" => "file_allow_upload"]);
        $this->data["allow_uploads"] = "*";
        if($config_file_allow_upload){
            $string_allow = $config_file_allow_upload["value"];
            $arg_allow    = explode("/",$string_allow );
            $set_allow_not_null = array_diff($arg_allow ,[""]);
            $string_allo_new = implode(";", $set_allow_not_null);
            $this->data["allow_uploads"]  = $string_allo_new;
        }
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
                    $sizeData = $this->Common_model->get_result($this->_fix."config",["support" => "file_size"]);
                    foreach ($list_medias as $key => $value) {
                        $stringicon = "";
                        $sizestring = "";
                        if($value["type_name"] != "folder"){
                            foreach ($sizeData as $key_1 => $value_1) {
                                if( ((int)$value_1["value"]) < $value["size"]){
                                    $sizestring = "(" .round(($value["size"] / ((int)$value_1["value"]) ),2) .  $value_1["key_id"] .")";
                                }
                            }
                        }
                        if($value["icon"] == null && $value["icon"] == ""){
                            $stringicon = '<img class="thumb-media" src="'.base_url( $value["thumb"]).'">';
                        }else{
                            $stringicon = '<i class="thumb-media '.$value["icon"].'" ></i>';
                        }
                        $html .='<div class="col-md-2 item-colums">
                        <div id="contaner-item" data-type="'. $value["type_name"].'" class="'. $value["type_name"].'" data-id="'. $value["id"].'" data-typeid="'. $value["type_id"].'">
                          <div class="action" data-id="'. $value["id"].'" data-type="'. $value["type_id"].'">
                            <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                            <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
    public function get_folder_by_id(){
        $id = ($_REQUEST["id"]);
        $this->load->model("Medias_model");
        $list_foldes =  $this->Medias_model->get_list_folder($id);
        die(json_encode($list_foldes));
    }
    public function add($type){
        $data = ["status" => "error","message" => null,"thumb" => null ,"post" => $this->input->post(),"record" => null];
        if($this->input->is_ajax_request()){
            $r = $this->Common_model->get_record($this->_fix."media_type",["name" => $type]);
            if($r != null){
                switch ($r["name"]) {
                    case 'folder':
                        $name   = $this->input->post("name") ;
                        $folder = $this->input->post("folder") ? $this->input->post("folder") : 0;
                        $check  = $this->Common_model->get_record($this->_fix.$this->_table,["name" => $name,"folder_id" =>$folder]) ; 
                        if($check == null){
                            $path_folder = '/0/';
                            if($folder != null){
                                $f = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $folder]);
                                if( $f != null)
                                    $path_folder = $f["path_folder"] . $f["id"] .'/';
                            }else{
                                $folder = 0;
                            }
                            if( $name != null){
                                $i = [
                                    "name"        => $name,
                                    "type_id"     => $r["id"],
                                    "folder_id"   => $folder,
                                    "path_folder" => $path_folder,
                                    "extension"   =>"folder"
                                ];
                                $id       = $this->Common_model->add($this->_fix.$this->_table,$i);
                                $record   = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
                                $record["isParent"] = true;
                                $record["icon"] = skin_url("images/folder_open.png");
                                $record["iconOpen"] = skin_url("images/folder_open.png");
                                $record["iconClose"] = skin_url("images/folder_close.png");
                                $data['record'] = $record ;
                                $show_view    = "";
                                if($r["name"] == "image"){
                                    $show_view = '<img class="thumb-media" src="'.base_url($record["thumb"]).'" />';
                                }else{
                                    $show_view = '<i class="thumb-media '.$r["icon"].'" ></i>';
                                }
                                $data["response"] = '<div class="col-md-2 item-colums">
                                <div id="contaner-item" data-type="'.$r["name"].'" class="'.$r["name"].'" data-id="'.$record["id"].'" data-typeid="'.$record["type_id"].'">
                                  <div class="action" data-id="'.$record["id"].'" data-type="'.$r["id"].'" data-type-name="'.$r["name"].'">
                                    <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                                    <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  </div>
                                  <div class="bg-info">
                                    <p>'.$record["name"].'</p>
                                  </div>
                                  '.$show_view.'
                                </div>
                              </div>';
                              $data["status"] = "success";
                            }
                        }else{
                            $data["message"] = "Folder is exits!";
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
    public function edit(){
        $data = ["status" => "error","message" => null,"thumb" => null ,"post" => $this->input->post(),"record" => null];
        if($this->input->is_ajax_request()){
            $html = '<div id="content-edit-media">';
            $id = $this->input->post("id");
            if($id){
                $record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
                if($record){
                    $get_type = $this->Common_model->get_record($this->_fix."media_type",["id" => $record["type_id"]]);
                    $data["mediatype"] = $get_type ;
                    if($get_type["name"] == "image"){
                        $size = getimagesize(FCPATH . $record["path"]);
                        $html .='<div class="row">
                          <div class="col-md-9">
                            <div class="img-container">
                              <img id="image" src="'.base_url($record["path"]).'" alt="Picture">
                            </div>
                          </div>
                          <div class="col-md-3">
                            <!-- <h3>Preview:</h3> -->
                            <div class="docs-preview clearfix">
                              <div class="img-preview preview-lg"></div>
                              <div class="img-preview preview-md"></div>
                            </div>
                            <!-- <h3>Data:</h3> -->
                            <div class="docs-data">
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataX">X</label>
                                <input type="text" class="form-control" value="0" id="dataX" placeholder="x" readonly>
                                <span class="input-group-addon">px</span>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataY">Y</label>
                                <input type="text" class="form-control" value="0" id="dataY" placeholder="y" readonly>
                                <span class="input-group-addon">px</span>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataWidth">Width</label>
                                <input type="text" value="'.@$size[0].'" class="form-control" id="dataWidth" placeholder="width" readonly>
                                <span class="input-group-addon">px</span>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataHeight">Height</label>
                                <input type="text" value="'.@$size[1].'" class="form-control" id="dataHeight" placeholder="height" readonly>
                                <span class="input-group-addon">px</span>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataRotate">Rotate</label>
                                <input type="text" class="form-control" id="dataRotate" placeholder="rotate" readonly>
                                <span class="input-group-addon">deg</span>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX" readonly>
                              </div>
                              <div class="input-group input-group-sm">
                                <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY" readonly>
                              </div>
                            </div>
                          </div>
                        </div><div class="row">
                            <div class="col-md-9 docs-buttons">
                            <!-- <h3>Toolbar:</h3> -->
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
                                  <span class="fa fa-arrows"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)">
                                  <span class="fa fa-crop"></span>
                                </span>
                              </button>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, 0.1)">
                                  <span class="fa fa-search-plus"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;zoom&quot;, -0.1)">
                                  <span class="fa fa-search-minus"></span>
                                </span>
                              </button>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, -10, 0)">
                                  <span class="fa fa-arrow-left"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 10, 0)">
                                  <span class="fa fa-arrow-right"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, -10)">
                                  <span class="fa fa-arrow-up"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;move&quot;, 0, 10)">
                                  <span class="fa fa-arrow-down"></span>
                                </span>
                              </button>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, -45)">
                                  <span class="fa fa-rotate-left"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;rotate&quot;, 45)">
                                  <span class="fa fa-rotate-right"></span>
                                </span>
                              </button>
                            </div>

                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleX&quot;, -1)">
                                  <span class="fa fa-arrows-h"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;scaleY&quot;, -1)">
                                  <span class="fa fa-arrows-v"></span>
                                </span>
                              </button>
                            </div>

                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;crop&quot;)">
                                  <span class="fa fa-check"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;clear&quot;)">
                                  <span class="fa fa-remove"></span>
                                </span>
                              </button>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;disable&quot;)">
                                  <span class="fa fa-lock"></span>
                                </span>
                              </button>
                              <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;enable&quot;)">
                                  <span class="fa fa-unlock"></span>
                                </span>
                              </button>
                            </div>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
                                  <span class="fa fa-refresh"></span>
                                </span>
                              </button>
                              <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                                <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Import image with Blob URLs">
                                  <span class="fa fa-upload"></span>
                                </span>
                              </label>
                            </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group input-group-sm">
                                    <label class="input-group-addon" for="media-name">Media name</label>
                                    <input type="text" class="form-control" id="media-name" value="'.$record["name"].'" placeholder="Enter media name">
                                </div>
                                <input type="hidden" name="is-change" id="is-change" value="0">
                                <input type="hidden" name="id" id="media-id" value="'.$record["id"].'">
                                <input type="hidden" name="type" id="media-type" value="'.$get_type["name"].'">
                                <input type="hidden" name="extension" id="media-extension" value="'.$record["extension"].'">
                                <input type="hidden" name="size" id="media-size" value="'.$record["size"].'">
                            </div>
                          </div>';
                    }else{
                      $name = "Folder";
                      if($get_type["name"] != "folder"){
                        $name = "File";
                      }
                      $html = '<div class="input-group input-group-sm">
                        <label class="input-group-addon" for="media-name">'.$name .' name</label>
                        <input type="text" class="form-control" id="media-name" value="'.$record["name"].'" placeholder="Enter media name">
                      </div>
                      <input type="hidden" name="is-change" id="is-change" value="0">
                      <input type="hidden" name="id" id="media-id" value="'.$record["id"].'">
                      <input type="hidden" name="type" id="media-type" value="'.$get_type["name"].'">
                      <input type="hidden" name="extension" id="media-extension" value="'.$record["extension"].'">
                      <input type="hidden" name="size" id="media-size" value="'.$record["size"].'">';
                    }
                    $data["status"] = "success";
                    $data["record"] = $record;   
                }   
            }
            $data["response"] = $html;
            $html = '</div>';
        }
        die(json_encode($data));
    }
    public function save_edit(){
        $data = ["status" => "no","response" => false,"message" => null,"thumb" => null ,"post" =>  $this->input->post()];
        if($this->input->is_ajax_request()){
            $id = $this->input->post("id");
            $record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
            if($record){
                $allow_save = true;
                $type = $this->input->post("type");
                $name = $this->input->post("name");
                $get_type = $this->Common_model->get_record($this->_fix."media_type",["id" => $record["type_id"]]);
                $sizeData = $this->Common_model->get_result($this->_fix."config",["support" => "file_size"]);
                if($get_type["name"] == "image"){
                    $imgbase64 = $this->input->post("imgbase64");
                    $is_change = $this->input->post("is_change");
                    $size = $this->input->post("size");
                    $extension = $this->input->post("extension") ? $this->input->post("extension") : "jpg";
                    if($is_change == 1 && $imgbase64 != null){
                        $upload_path = FCPATH.'uploads/';
                        if (!is_dir($upload_path)) {
                            mkdir($upload_path, 0777, TRUE);
                        }
                        $name_save =  uniqid() .".". strtolower($extension);
                        $file = $upload_path . $name_save;
                        $front_content = substr($imgbase64, strpos($imgbase64, ",")+1);
                        $decodedData = base64_decode($front_content);
                        $fp = fopen( $file, 'wb' );
                        fwrite( $fp, $decodedData);
                        fclose( $fp );
                        $update_path    = "/uploads/".$name_save;
                        $record["size"] = $size;
                        $data_resize    = $this->resizeImage($file,$name_save,"/uploads/");
                        if($data_resize["status"] =="success"){
                            $data_resize["response"]["path"]= $update_path;
                            foreach ($data_resize["response"] as $key => $value) {
                                if($record[$key] != null)
                                    if(file_exists( FCPATH . $record[$key] ))
                                        unlink( FCPATH . $record[$key] );
                                $record[$key] = $value;
                            }
                        }
                    }
                }else if($get_type["name"] == "folder"){
                  $check = $this->Common_model->get_record($this->_fix.$this->_table,["id !=" => $record["id"],"name" => $name,"folder_id" => $record["folder_id"]]);
                  if($check != null){
                    $allow_save = false;
                    $data["message"] = "Folder has been exist";
                  }
                }
                if($allow_save){
                  $record["name"] = $name;
                  $response = $record;
                  $id = $record["id"];
                  unset($record["id"]);
                  $this->Common_model->update($this->_fix.$this->_table,$record,["id" => $id]);
                  $data ["status"] = "success";
                  $sizestring = "";
                  foreach ($sizeData as $key_1 => $value_1) {
                      if( ((int)$value_1["value"]) < $response["size"]){
                          $sizestring = "(" .round(($response["size"] / ((int)$value_1["value"]) ),2) .  $value_1["key_id"] .")";
                      }
                  }
                  $stringthumb = '<img class="thumb-media" src="'.base_url($response["thumb"]).'">';
                  if($get_type["icon"] != ""){
                    $stringthumb = '<i class="thumb-media '.$get_type["icon"].'"></i>';
                  }
                  $html = '<div class="action" data-id="'.$response["id"].'" data-type="'.@$get_type["id"].'" data-type-name="'.@$get_type["name"].'">
                    <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                    <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  </div>
                  <div class="bg-info">
                    <p>'.$response["name"].$sizestring.'</p>
                  </div>
                  '.$stringthumb.'';
                  $data["response"] = $html;
                  $data["record"]   = $response;
                  $data["get_type"] = $get_type;
                }
            } 
        }
        die(json_encode($data));
    }
  	public function upload(){
  		$data = ["status" => "no","response" => false,"message" => null,"thumb" => null ,"post" =>  $this->input->post()];
          if($this->input->is_ajax_request()){
      		$config["upload_path"] = "/uploads";
              $folder = $this->input->post("folder");
              $path_folder = '/0/';
              if($folder != null){
                  $f = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $folder]);
                  if( $f != null)
                      $path_folder = $f["path_folder"] . $f["id"] .'/';
              }else{
                  $folder = 0;
              }
              try {
                  $dataupload = $this->saveflie("file",$config);
                  if($dataupload ["status"]){
                      $r = $dataupload["response"];
                      //get type 
                      $this->db->from($this->_fix."media_type");
                      $this->db->like('extension', '/'.$r["extension"].'/');
                      $exe = $this->db->get()->row_array();
                      if($exe == null){
                          $r["type_id"] = 3;
                          $exe  = $this->Common_model->get_record($this->_fix."media_type",["id" => 3]);
                      }else{
                          $r["type_id"] = $exe["id"];
                      }
                      $r["folder_id"]   = $folder;
                      $r["path_folder"] = $path_folder;
                      $id = $this->Common_model->add($this->_fix.$this->_table,$r);
                      $record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $id]);
                      if($exe["name"] == "image"){
                          $record["show_view"] = '<img class="thumb-media" src="'.base_url($record["thumb"]).'" />';
                      }else{
                          $record["show_view"] = '<i class="thumb-media '.$exe["icon"].'" ></i>';
                      }
                      $sizeData = $this->Common_model->get_result($this->_fix."config",["support" => "file_size"]);
                      $sizestring = "";
                      if($exe["name"] != "folder"){
                          foreach ($sizeData as $key => $value) {
                              if(((int)$value["value"]) < $record["size"]){
                                  $sizestring = "(".round(($record["size"] / ((int)$value["value"])),2) .  $value["key_id"] .")";
                              }
                          }
                      }
                      $data["status"]  = "ok";
                      $data["message"] = "Upload successfully";
                      $data["response"] = '<div class="col-md-2 item-colums">
                          <div id="contaner-item" data-type="'.$exe["name"].'" class="'.$exe["name"].'" data-id="'.$record["id"].'" data-typeid="'.$record["type_id"].'">
                            <div class="action" data-id="'.$record["id"].'" data-type="'.$record["type_id"].'" data-type-name="'.$exe["name"].'">
                              <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                              <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            </div>
                            <div class="bg-info">
                              <p>'.$record["name"].' '.$sizestring.'</p>
                            </div>
                            '.$record["show_view"].'
                          </div>
                      </div>';
                  }else{
                      $data["error"] = $dataupload;
                      $data["message"] = "Upload file Error!";
                  }
              }catch(Exception $e){
                  $data["message"] = "Upload file Error!" ;
              }  		
          }
  		die (json_encode($data));
  	}
    public function delete(){
        $data = ["status" => "error","message" => null,"thumb" => null ,"post" => $this->input->post(),"record" => null];
        if($this->input->is_ajax_request()){
            $data = $this->input->post("data");
            $config_file = $this->Common_model->get_result($this->_fix."config",["support" => "media_width_upload"]);
            foreach ($data as $key => $value) {
                $get_record = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $value]);
                if( $get_record != null ){
                    if($get_record["extension"] == "folder"){
                        $this->db->from($this->_fix.$this->_table);
                        $this->db->like("path_folder",$get_record["path_folder"].$get_record["id"] .'/');
                        $l = $this->db->get()->result_array();
                        foreach ($l as $key_2 => $value_2) {
                            foreach ($config_file as $key_1 => $value_1) {
                                try{
                                    if($value_2[$value_1["key_id"]] != null)
                                        if(file_exists(FCPATH . $value_2[$value_1["key_id"]]) )
                                            unlink(FCPATH . $value_2[$value_1["key_id"]]);
                                }catch (Exception $e){

                                }
                            } 
                            if($value_2["path"] != null){
                                if(file_exists(FCPATH . $value_2["path"]) )
                                    unlink(FCPATH . $value_2["path"]);
                            }                          
                            $this->Common_model->delete($this->_fix.$this->_table,["id" => $value_2["id"]]); 
                        }
                    }else{
                        foreach ($config_file as $key => $value) {
                            try{
                                if($get_record[$value["key_id"]] != null)
                                    if( file_exists(FCPATH . $get_record[$value["key_id"]]) )       
                                        unlink(FCPATH . $get_record[$value["key_id"]]);    
                            }catch (Exception $e){

                            }
                        } 
                        if($get_record["path"] != null)
                            if( file_exists(FCPATH . $get_record["path"] != null) )
                                unlink(FCPATH . $get_record["path"]);   
                    }
                    $this->Common_model->delete($this->_fix.$this->_table,["id" => $get_record["id"]]);
                }
            }
            $data["status"] = "success";
        }
        die(json_encode($data));
    }
    public function actions(){
        $data = ["new_node" => null,"status" => "error","message" => null,"thumb" => null ,"post" => $this->input->post(),"record" => null];
        if($this->input->is_ajax_request()){
            $ids   = $this->input->post("data");
            $type   = $this->input->post("type");
            $folder = $this->input->post("folder");
            if($folder == 0 || $folder == null){
                $f = [
                  "id"           => 0,
                  "folder_id"    => 0,
                  "path_folder"  => "/",
                  "type"         => "folder",
                  "name"         => "root"
                ];
            }else{
                $f = $this->Common_model->get_record($this->_fix.$this->_table,["id" => $folder]);
            }
            if($f){
                $l = $this->Common_model->get_result_in($this->_fix.$this->_table,"id",$ids);
                if($l){
                    if($type == 1){
                        $config_file = $this->Common_model->get_result($this->_fix."config",["support" => "media_width_upload"]);
                        $ids = [];
                        foreach ($l as $key => $value) {
                          if($f["id"] != $value["id"]){
                            if($value["extension"] == "folder"){
                              $check_folder_exits = $this->Common_model->get_record($this->_fix.$this->_table,["name" => $value["name"],"folder_id" => $f["id"]]);
                              if($check_folder_exits != null){
                                $value["name"] =  $value["name"] .("(copy".uniqid().")");
                              }
                            }
                            $old_id = $value["id"];
                            $old_path_folder = $value["path_folder"];
                            unset($value["id"]);
                            $value["folder_id"]   = $f["id"];
                            $value["path_folder"] = $f["path_folder"] .$f["id"]. "/";
                            if($value["extension"] != "folder"){
                              if($config_file != null){
                                $url_frist = "";
                                $url_frist_ew = "";
                                foreach ($config_file as $key => $value_1) {
                                  if($url_frist != $value[$value_1["key_id"]]){
                                    $name      = uniqid().".".$value["extension"];
                                    $file      = $value[$value_1["key_id"]];
                                    $url = explode('/', $file);
                                    array_pop($url);
                                    $url = implode('/', $url);
                                    $oldname   = basename($file).PHP_EOL;
                                    $newfile   = $url."/".$name;
                                    copy(FCPATH.$file, FCPATH.$newfile);
                                    $url_frist = $file;
                                    $url_frist_ew = $newfile;
                                    $value[$value_1["key_id"]] = $newfile;
                                  } else{
                                    $value[$value_1["key_id"]] = $url_frist_ew;
                                  }
                                }
                              }
                            }
                            $newid = $this->Common_model->add($this->_fix.$this->_table,$value);
                            $ids [] = $newid;
                            if($value["extension"] == "folder"){
                                $folder_new = $value;
                                $folder_new["id"]       = $newid;
                                $folder_new["isParent"] = true;
                                $folder_new["icon"]     = skin_url("images/folder_open.png");
                                $folder_new["iconOpen"] = skin_url("images/folder_open.png");
                                $folder_new["iconClose"] = skin_url("images/folder_close.png");
                                $data["new_node"][] = $folder_new;
                                $this->db->from($this->_fix.$this->_table);
                                $this->db->like("path_folder",$old_path_folder);
                                $list_new = $this->db->get()->result_array();
                                if($list_new != null){
                                    $this->copymedia($list_new,$old_id,$newid,$value ["path_folder"],$config_file);
                                }
                            }
                          }     
                        }
                    }elseif($type == 2){
                        $ids = [];
                        foreach ($l as $key => $value) { 
                            if($value["folder_id"] != $f["id"] && $f["id"] != $value["id"]){
                                $old_id = $value["id"];
                                $ids [] = $old_id;
                                unset($value["id"]);
                                $old_path_folder = $value["path_folder"];
                                $value["folder_id"]   = $f["id"];
                                $value["path_folder"] = $f["path_folder"] .$f["id"]. "/";
                                if($value["extension"] == "folder"){
                                  $check_folder_exits = $this->Common_model->get_record($this->_fix.$this->_table,["name" => $value["name"],"folder_id" => $f["id"]]);
                                  if($check_folder_exits != null){
                                    $value["name"] =  $value["name"] .("(cut".uniqid().")");
                                  }
                                }
                                $this->Common_model->update($this->_fix.$this->_table,$value,["id" => $old_id]);
                                if($value["extension"] == "folder"){
                                    $sql = "update ".$this->_fix.$this->_table." set path_folder = REPLACE(path_folder,'".$old_path_folder."','".$value["path_folder"]."') where path_folder like('%".$old_path_folder."%')";
                                    $query = $this->db->query( $sql );
                                    $folder_new = $value;
                                    $folder_new["id"] = $old_id;
                                    $folder_new["isParent"] = true;
                                    $folder_new["icon"]     = skin_url("images/folder_open.png");
                                    $folder_new["iconOpen"] = skin_url("images/folder_open.png");
                                    $folder_new["iconClose"] = skin_url("images/folder_close.png");
                                    $data["new_node"][] = $folder_new;

                                }
                            }      
                        }
                    } 
                    $sizeData = $this->Common_model->get_result($this->_fix."config",["support" => "file_size"]);
                    $html = "";
                    $this->load->model("Medias_model");
                    if($ids != null){
                        $l = $this->Medias_model->get_in($ids);
                        foreach ($l as $key => $value) {
                            $stringicon = "";
                            $sizestring = "";
                            if($value["extension"] != "folder"){
                                foreach ($sizeData as $key_1 => $value_1) {
                                    if( ((int)$value_1["value"]) < $value["size"]){
                                        $sizestring = "(" .round(($value["size"] / ((int)$value_1["value"]) ),2) .  $value_1["key_id"] .")";
                                    }
                                }
                            }
                            if($value["icon"] == null && $value["icon"] == ""){
                                $stringicon = '<img class="thumb-media" src="'.base_url( $value["thumb"]).'">';
                            }else{
                                $stringicon = '<i class="thumb-media '.$value["icon"].'" ></i>';
                            }
                            $html .='<div class="col-md-2 item-colums">
                            <div id="contaner-item" data-type="'. $value["type_name"].'" class="'. $value["type_name"].'" data-id="'. $value["id"].'" data-typeid="'. $value["type_id"].'">
                              <div class="action" data-id="'. $value["id"].'" data-type="'. $value["type_id"].'" data-type-name="'. $value["type_name"].'">
                                <a href="javascript:;" id="select-media"><i class="fa fa-square-o" aria-hidden="true"></i></a>
                                <a href="javascript:;" id="delete-media"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                <a href="javascript:;" id="edit-media"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                              </div>
                              <div class="bg-info">
                                <p>'.$value["name"].' '. $sizestring.'</p>
                              </div>
                              '.$stringicon.'
                            </div>
                            </div>';
                        }
                    }
                    $data["response"] = $html;
                    $data["status"] = "success";    
                }
            }
            
        }
        die(json_encode($data));
    }
  	private function saveflie($file, $config = null){
  		$data_return            = ["status" => false];
  		$data_file              = [];
      $path_parts             = pathinfo($_FILES["file"]["name"]);
      $data_file["name"]      = $_FILES["file"]["name"];
      $extension              = $path_parts['extension'];
  		$data_file["extension"] = strtolower($extension);
  		$data_file["size"]      = $_FILES["file"]["size"];
  		$name = uniqid().".".strtolower($extension);
          if (!is_dir($config['upload_path'] )) {
              mkdir($config['upload_path'] , 0777, TRUE);
          }
          $pathsave  = $config["upload_path"];
          $config_file_allow_upload = $this->Common_model->get_record($this->_fix."config",["support" => "file_allow_upload"]);
          if($config_file_allow_upload){
              $string_allow = $config_file_allow_upload["value"];
              $arg_allow    = explode("/",$string_allow );
              $set_allow_not_null = array_diff($arg_allow ,[""]);
              $string_allo_new = implode("|", $set_allow_not_null);
              $config['allowed_types']  = $string_allo_new;
          }
          $config['file_ext_tolower']  = TRUE;
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
              $config_file = $this->Common_model->get_result($this->_fix."config",["support" => "media_width_upload"]);
              if($data["is_image"]){
              	$this->load->library('image_lib');
              	$full_path = $data["full_path"];
              	$w = $data["image_width"];
              	$h = $data["image_height"];
                  if($config_file != null){
                      foreach ($config_file as $key => $value) {
                          $new_path = $config['upload_path'] . "/" . $value["key_id"];
                          if (!is_dir( $new_path)) {
                              mkdir($new_path, 0777, TRUE);
                          }
                          if(( (int) $value["value"] ) < $w){
                              $ratio_image = $this->ratio_image($w ,$h,( (int) $value["value"] ),0);
                              $config['width']  = $value["value"];
                              $config['height'] = $ratio_image["height"];
                              $config['source_image']   = $full_path;
                              $config['new_image']      = $new_path ."/". $data['file_name'];
                              $config['maintain_ratio'] = FALSE;
                              $config['quality'] = 100;
                              $this->image_lib->clear();
                              $this->image_lib->initialize($config);
                              $data_resize = $this->image_lib->resize();
                              $data_file[$value["key_id"]] = $pathsave . "/" . $value["key_id"] ."/". $data['file_name'];
                          }else{
                              $data_file[$value["key_id"]] = $pathsave . "/" . $data['file_name'];
                          }
                      }
                  } 
                  $this->image_lib->clear();           	
              } else{
                  foreach ($config_file as $key => $value) {
                      $data_file[$value["key_id"]] = $pathsave . "/" . $data['file_name'];
                  }
              }
              $data_return["response"] = $data_file;         
          }
          $data_return["config"] = $config;

          return $data_return;
  	}
    private function resizeImage ($source_image = null,$name = null,$path = null){
        list($w, $h) = getimagesize($source_image);
        $data_return = ["status" => "error","response" => null];
        $data_file   = [];
        $this->load->library('image_lib');
        $config_file = $this->Common_model->get_result($this->_fix."config",["support" => "media_width_upload"]);
        if($config_file != null){
            foreach ($config_file as $key => $value) {
                $new_path = FCPATH . "/". $path . "/";
                if (!is_dir( $new_path)) {
                    mkdir($new_path, 0777, TRUE);
                }
                $new_path = $new_path . $value["key_id"];
                if (!is_dir( $new_path)) {
                    mkdir($new_path, 0777, TRUE);
                }
                if(( (int) $value["value"] ) < $w){
                    $ratio_image = $this->ratio_image($w ,$h,( (int) $value["value"] ),0);
                    $config['width']  = $value["value"];
                    $config['height'] = $ratio_image["height"];
                    $config['source_image']   = $source_image;
                    $config['new_image']      = $new_path ."/". $name;
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = 100;
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config);
                    $data_resize = $this->image_lib->resize();
                    $data_file[$value["key_id"]] = $path . $value["key_id"] ."/". $name;
                }else{
                    $data_file[$value["key_id"]] = $path . $name;
                }
                $data_return["response"] = $data_file;
                $data_return["status"]   = "success";
            }
        } 
        $this->image_lib->clear();
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
  	private function gen_slug_name_file($str){
  		$a = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă","ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề" , "ế", "ệ", "ể", "ễ", "ì", "í", "ị", "ỉ", "ĩ", "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ" , "ờ", "ớ", "ợ", "ở", "ỡ", "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ", "ỳ", "ý", "ỵ", "ỷ", "ỹ", "đ", "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă" , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ", "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ", "Ì", "Í", "Ị", "Ỉ", "Ĩ", "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ" , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ", "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ", "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ", "Đ", " ","ö","ü"); 
  		$b = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a" , "a", "a", "a", "a", "a", "a", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "i", "i", "i", "i", "i", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o " , "o", "o", "o", "o", "o", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "y", "y", "y", "y", "y", "d", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A " , "A", "A", "A", "A", "A", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "I", "I", "I", "I", "I", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O " , "O", "O", "O", "O", "O", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "Y", "Y", "Y", "Y", "Y", "D", "-","o","u");
  		return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
  	}
  	public function __destruct(){
  		if(!$this->input->is_ajax_request())
  			$this->load->view("block/footer");
  	}
    public $_new_array  = [];
    private function copymedia($data = null ,$root = 0, $new_root = 0,$new_path = null,$config_file = null){
        $new_data = [];
        $old_follder = [];
        if($data != null){
            foreach ($data as $key => $value) {
                if($value["folder_id"] == $root){
                    $new_data [] = $value;
                    unset($data[$key]);
                }
            }
        }
        if($new_data != null){
            foreach ($new_data as $key => $value) {
                $old_id = $value["id"];
                $old_path_folder = $value ["path_folder"];
                unset($value["id"]);
                $value ["folder_id"]   = $new_root;
                $value ["path_folder"] = $new_path;
                if( $value["extension"] != "folder") {
                  if($config_file != null){
                    $url_frist = "";
                    $url_frist_ew = "";
                    foreach ($config_file as $key => $value_1) {
                      if($url_frist != $value[$value_1["key_id"]]){
                        $name      = uniqid().".".$value["extension"];
                        $file      = $value[$value_1["key_id"]];
                        $url = explode('/', $file);
                        array_pop($url);
                        $url = implode('/', $url);
                        $oldname   = basename($file).PHP_EOL;
                        $newfile   = $url."/".$name;
                        copy(FCPATH.$file, FCPATH.$newfile);
                        $url_frist = $file;
                        $url_frist_ew = $newfile;
                        $value[$value_1["key_id"]] = $newfile;
                      } else{
                        $value[$value_1["key_id"]] = $url_frist_ew;
                      }
                    }
                  }
                }
                $newid = $this->Common_model->add($this->_fix.$this->_table,$value);
                if($value["extension"] == "folder"){
                  $this->copymedia($data,$old_id,$newid,$value["path_folder"],$config_file);
                }
            }
        }
    }
    private function cutmedia($data = null ,$root = 0, $new_root = 0,$new_path = null,$config_file = null){
        $new_data = [];
        $old_follder = [];
        if($data != null){
            foreach ($data as $key => $value) {
                if($value["folder_id"] == $root){
                    $new_data [] = $value;
                    unset($data[$key]);
                }
            }
        }
        if($new_data != null){
            foreach ($new_data as $key => $value) {
                $old_id = $value["id"];
                $old_path_folder = $value ["path_folder"];
                unset($value["id"]);
                $value ["folder_id"]   = $new_root;
                $value ["path_folder"] = $new_path;
                $newid = $this->Common_model->update($this->_fix.$this->_table,$value,["id" => $value["id"]]);
                if($value["extension"] == "folder"){
                  $this->cutmedia($data,$old_id,$newid,$value["path_folder"],$config_file);
                }
            }
        }
    }
}
