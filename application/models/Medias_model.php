<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medias_model extends CI_Model {
	public $_fix   = "ewd_";
	public $_table = "medias";
    function __construct() {
        parent::__construct();
    }
    function get($offset = 0, $limit = 50,$folder = 0,$member_id = -1,$keyword = -1 ,$order = -1){
    	$this->db->select("tbl1.* , tbl2.icon, tbl2.name AS type_name");
    	$this->db->from($this->_fix.$this->_table . " AS tbl1");
    	$this->db->join($this->_fix."media_type AS tbl2","tbl2.id = tbl1.type_id");
    	$this->db->where("tbl1.folder_id",$folder);
    	if($member_id != -1){
    		$this->db->where("tbl1.member_id",$folder);
    	}
    	if($keyword != -1){
    		$this->db->like("tbl1.name",$keyword);
    	}
    	$this->db->limit($limit,$offset);
    	if($order != -1){

    	}else{
    		$this->db->order_by("tbl1.id","DESC");
    	}
    	return $this->db->get()->result_array();
    }
}
