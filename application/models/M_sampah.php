<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_sampah extends CI_Model
{
    //$table sebagai tabel yang digunakan, dengan pemanggilannya $this->table
    private $table = 'sampah';
    //$pk atau Primary Key yang digunakan, dengan pemanggilannya $this->pk
    private $pk = 'id_sampah';
    public function GetAll()
    {
        $this->db->order_by($this->pk, 'asc');
        return $this->db->get($this->table);
    }
    public function save($data)
    {
        return $this->db->insert($this->table, $data);
    }
    public function edit($id)
    {
        $this->db->where($this->pk, $id);
        return $this->db->get($this->table)->row_array();
    }
    public function update($id, $data)
    {
        $this->db->where($this->pk, $id);
        return $this->db->update($this->table, $data);
    }
    public function delete($data)
    {
        $this->db->where($data);
        return $this->db->delete($this->table);
    }
    public function getId($id_sampah)
    {
        $this->db->where('id_sampah', $id_sampah);
        $query = $this->db->get($this->table);
        return $query->row(); // Returns a single row result
    }

    public function getLastId()
    {
        $this->db->select_max($this->pk);
        $query = $this->db->get($this->table);
        $result = $query->row_array();

        return $result[$this->pk];
    }
    public function getTotal()
    {
        $this->db->select_sum('jumlah');
        $query = $this->db->get('sampah');
        return $query->row()->jumlah;
    }

    public function getTotalbyKategori()
    {
        $this->db->select('kategori, SUM(jumlah) as total_jumlah');
        $this->db->group_by('kategori');
        $query = $this->db->get('sampah');
        return $query->result();
    }

    public function getTotalByPeriode($start_date, $end_date)
    {
        $this->db->select_sum('jumlah');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $query = $this->db->get('sampah');
        return $query->row()->jumlah;
    }

    public function getTotalByKategoriPeriode($start_date, $end_date)
    {
        $this->db->select('kategori, SUM(jumlah) as total_jumlah');
        $this->db->where('tanggal >=', $start_date);
        $this->db->where('tanggal <=', $end_date);
        $this->db->group_by('kategori');
        $query = $this->db->get('sampah');
        return $query->result();
    }

    public function getSampah()
    {
        $this->db->select('tanggal, SUM(jumlah) as count');
        $this->db->where('tanggal >=', date('Y-m-d', strtotime('-1 week')));
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'asc');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

}
