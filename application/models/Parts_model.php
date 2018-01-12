<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parts_model extends CI_Model {
	public $_fix   = "ewd_";
	public $_table = "parts";
    function __construct() {
        parent::__construct();
    }
    public function get ($offset,$limit){
    	$this->db->from($this->_fix.$this->_table . " AS tbl1");
    	$this->db->select("tbl1.*,tbl2.path,tbl2.name AS name_path");
    	$this->db->join($this->_fix."medias AS tbl2","tbl1.path_html = tbl2.id","LEFT");
    	$this->db->limit($limit,$offset);
    	return $this->db->get()->result_array();
    }
}