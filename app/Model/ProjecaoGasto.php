<?php

namespace Mini\Model;

use Mini\Core\Model;

class ProjecaoGasto extends Model
{


    public function getByFilter($descricao, $id_conta)
    {

        $sql = "SELECT
                    pg.id,
                    descricao,
                    pg.valor,
                    pg.quantidade,
                    pg.id_conta,
                    pg.data_vencto
                FROM projecao_gasto pg
                WHERE pg.id_conta = :id_conta";

        $parameters = array(':id_conta' => $id_conta);

        if ($descricao != '') {
            $sql .=  " AND descricao LIKE :descricao ";
            $parameters[':descricao'] = '%' . $descricao . '%';
        }

        $sql .= " ORDER BY 
                    pg.descricao ";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }
}
