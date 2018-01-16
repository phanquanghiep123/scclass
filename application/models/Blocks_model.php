<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blocks_model extends CI_Model {
	public $_fix   = "ewd_";
    public $_table = "blocks";
    function __construct() {
        parent::__construct();
    }
    public function get_part_by_id($id)
    {
    	$this->db->select("tbl1.*,tbl2.ncolum,tbl2.id AS block_part_id");
    	$this->db->from($this->_fix."parts AS tbl1");
    	$this->db->join($this->_fix."theme_sections_block_part AS tbl2","tbl2.part_id = tbl1.id");
    	$this->db->join($this->_fix.$this->_table." AS tbl3","tbl3.id = tbl2.block_id");
    	$this->db->where([ "tbl2.block_id" => $id ]);
    	return $this->db->get()->result_array();
    }
   
}