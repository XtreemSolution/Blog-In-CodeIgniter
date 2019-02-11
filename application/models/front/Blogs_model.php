<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Blogs_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->table = 'tbl_blogs';
	}

	function getAllRecords(){ 
		$this->db->select('tbl_blogs.*');
		$this->db->where('tbl_blogs.status', 'Active');
		$this->db->order_by('tbl_blogs.add_date','desc');			
		$query = $this->db->get($this->table);					
		$result = $query->result();
		return $result;
    }

    function addNewRecord($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
}   