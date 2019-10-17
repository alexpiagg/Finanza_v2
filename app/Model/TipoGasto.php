<?php

namespace Mini\Model;

use Mini\Core\Model;

class TipoGasto extends Model
{
    public function getAll() {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    T.excluido,
                    T.id_conta 
                FROM tipo_gasto T ";
       
        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getByFilter($tipo, $excluido, $id_conta) {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    T.excluido,
                    T.id_conta 
                FROM tipo_gasto T 
                WHERE T.id_conta = :idConta";
       
       $parameters = array(':idConta' => $id_conta);
                   
       if ($tipo != '') {
            $sql .=  " AND T.tipo LIKE :tipo ";
            $parameters[':tipo'] = '%' . $tipo . '%';
        }

        if (isset($excluido)) {
            $sql .=  " AND IFNULL(T.excluido, '') = :excluido ";
            $parameters[':excluido'] = $excluido;
        }

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getById($id, $id_conta) {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    T.excluido,
                    T.id_conta 
                FROM tipo_gasto T 
                WHERE T.id = :id
                  AND T.id_conta = :idConta";
       
        $parameters = array(':id' => $id, ':idConta' => $id_conta);
                   
        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }
}
