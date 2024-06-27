<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 't_user';
    protected $primaryKey       = 'idUser';
    protected $returnType       = 'object';
    protected $allowedFields    = ['namaLengkap', 'email', 'password', 'role', 'fotoProfil', 'statusAkun'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';

    function search($where = NULL)
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy('idUser', 'DESC');
        if ($where != NULL) {
            $query = $builder->getWhere($where);
        } else {
            $query = $builder->get();
        }
        return $query->getResultObject();
    }
}
