<?php

namespace Mini\Model;

use Mini\Core\Model;

class ContaPagar extends Model
{


    public function getByFilter($descricao, $id_conta)
    {

        $sql = "SELECT
                    pg.id,
                    pg.descricao,
                    pg.valor,
                    pg.quantidade,
                    pg.id_conta,
                    pg.data_vencto
                FROM conta_pagar pg
                WHERE pg.id_conta = :id_conta";

        $parameters = array(':id_conta' => $id_conta);

        if ($descricao != '') {
            $sql .=  " AND pg.descricao LIKE :descricao ";
            $parameters[':descricao'] = '%' . $descricao . '%';
        }

        $sql .= " ORDER BY 
                    pg.descricao ";

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getById($idProjecao)
    {

        $sql = "SELECT 
                    pg.id,
                    pg.descricao,
                    pg.valor,
                    pg.quantidade,                    
                    pg.id_conta,
                    pg.data_vencto
                FROM conta_pagar pg 
                WHERE pg.id = :id_projecao ";

        $parameters = array(':id_projecao' => $idProjecao);

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }


    public function update($id, $descricao, $valor, $quantidade, $data_vencto, $id_conta)
    {
        $sql = "UPDATE conta_pagar SET  descricao = :descricao,
                                        valor = :valor,
                                        quantidade = :quantidade,
                                        data_vencto = :data_vencto,
                                        id_conta = :id_conta
              WHERE id = :id ";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':id' => $id,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':quantidade' => $quantidade,
            ':data_vencto' => $data_vencto,
            ':id_conta' => $id_conta
        );

        return $this->save($query, $parameters);
    }

    public function insert($descricao, $valor, $quantidade, $data_vencto, $id_conta)
    {
        $sql = " INSERT INTO conta_pagar 
                (
                  descricao,
                  valor,
                  quantidade,                  
                  data_vencto,
                  id_conta
                )  
                VALUES 
                (
                  :descricao,
                  :valor,
                  :quantidade,                  
                  :data_vencto,
                  :id_conta
                ) ";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':quantidade' => $quantidade,
            ':data_vencto' => $data_vencto,
            ':id_conta' => $id_conta,
        );

        return $this->save($query, $parameters);
    }

    public function delete($id)
    {

        $sql = " DELETE FROM conta_pagar WHERE id = :id ";
        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id);

        return $this->save($query, $parameters);
    }
}
