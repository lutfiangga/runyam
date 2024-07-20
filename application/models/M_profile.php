<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_profile extends CI_Model
{
    private $table = 'user';
    private $pk = 'id_user';

    public function getById($id)
    {
        return $this->db->get_where($this->table, array($this->pk => $id))->row();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function edit($id)
    {
        return $this->db->get_where($this->table, array($this->pk => $id))->row();
    }

    public function update($id, $data)
    {
        $this->db->where($this->pk, $id);
        $this->db->update($this->table, $data);
    }
}
