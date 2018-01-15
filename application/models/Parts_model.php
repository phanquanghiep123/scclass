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

    function get_action_like($string) {
        $this->db->select('*');
        $this->db->from($this->_fix."actions AS tbl1");
        $this->db->join($this->_fix."part_action AS tbl2",
            "tbl1.id = tbl2.action_id AND tbl2.active = 1 AND tbl2.block_part_id = tbl1",
            "LEFT"
        );
        $this->db->like("support_key",$string);
        return $this->db->get()->result_array();
    }
}