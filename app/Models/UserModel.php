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

    function datatable($column, $start, $length, $order_column, $order_dir, $search_value, $additional_where = '')
    {
        $builder = $this->db->table($this->table);

        $sql = "SELECT ";
        $sql .= implode(", ", array_column($column, 'data'));
        $sql .= " FROM " . $this->table . " ";
        $sql .= "WHERE role != 'Admin' ";

        if (!empty($additional_where)) {
            $sql .= "AND " . $additional_where . " ";
        }

        if (!empty($search_value)) {
            $sql .= "AND (";
            $search_conditions = [];
            foreach ($column as $kolom) {
                $search_conditions[] = $kolom["data"] . " LIKE '%" . $search_value . "%'";
            }
            $sql .= implode(" OR ", $search_conditions);
            $sql .= ")";
        }

        $sql .= " ORDER BY " . $column[$order_column]["data"] . " " . $order_dir . " ";
        $sql .= " LIMIT " . $start . ", " . $length;

        $execute = $this->db->query($sql);
        return $execute->getResultArray();
    }

    function datatable_total()
    {
        $builder = $this->db->table($this->table);
        $builder->selectCount('idUser');
        $query = $builder->get();
        return intval($query->getResultArray()[0]["idUser"]);
    }
}
