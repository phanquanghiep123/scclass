<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blocks_model extends CI_Model {
	public $_fix   = "ewd_";
    public $_table = "blocks";
    function __construct() {
        parent::__construct();
    }
   
}