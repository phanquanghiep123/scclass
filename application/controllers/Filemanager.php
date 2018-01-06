<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filemanager extends CI_Controller {
  	public $_fix   = "ewd_";
  	public $_table = "parts";
  	public $_view  = "parts";
    public $_data  = [];
     public function get (){
        $data = ["status" => "no","message" => null,"thumb" => null,"response" => null,"post" =>$this->input->post() ,"record" => null];
        if($this->input->is_ajax_request()){
            $id       = $this->input->post("id");
            $type     = $this->input->post("type");
            $keyword  = $this->input->post("keyword") ? $this->input->post("keyword") : -1;
            $order    = $this->input->post("keyword") ? $this->input->post("order") : -1;
            $offset   = $this->input->post("offset") ? $this->input->post("offset") : 0;
            $limit    = 50;
            $html     = "";
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
                        if($value["extension"] == "folder"){
                          $value["isParent"] = true;
                          $value["icon"]     = skin_url("images/folder_open.png");
                          $value["iconOpen"] = skin_url("images/folder_open.png");
                          $value["iconClose"]= skin_url("images/folder_close.png");
                          $data["record"][] = $value;
                        }
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
}
