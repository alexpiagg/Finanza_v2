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
}
