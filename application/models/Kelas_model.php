<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas_model extends CI_Model
{

    public $table = 'kelas';
    public $id = 'idkelas';
    public $order = 'DESC';
    private $_batchImport;

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('kelas', $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('idkelas', $q);
        $this->db->or_like('kelas', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idkelas', $q);
        $this->db->or_like('kelas', $q);
        $this->db->or_like('jumlah', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function setBatchImport($batchImport)
    {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        $data = $this->_batchImport;
        $this->db->insert_batch($this->table, $data);
    }

    // Get settings data all
    public function settings_data_all()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->get('settings')->result();
    }

    // Get settings data by id
    public function settings_data_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('settings')->row();
    }
}

/* End of file Kelas_model.php */
/* Location: ./application/models/Kelas_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-09-28 16:38:47 */
/* http://harviacode.com */
