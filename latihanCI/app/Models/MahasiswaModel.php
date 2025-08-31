<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['nim', 'nama', 'umur'];

    public function getMahasiswa($id = false){
        return ($id === false) ? $this->findAll() : $this->find($id);
    }

    public function searchByName($keyword){
        return $this->like('nama', $keyword)->findAll();
    }

    public function saveMahasiswa($mhs){
        $input =  $this->db->table( $this->table);
        return $input->insert($mhs);
    }

    public function editMahasiswa($data,$id){
        $edit = $this->db->table($this->table);
        $edit->where('id', $id);
        return $edit->update($data);
    }

}