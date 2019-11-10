<?php

namespace Mini\Model;

use Mini\Core\Model;
use PDO;

class Receita extends Model
{
    /*
     * Retorna a soma das receitas, agrupado por meses
     */
    public function getReceitasPorMeses($dataInicial, $dataFinal, $descricao, $idConta)
    {

        $sql = "SELECT	
                    MONTH(R.data) mes,
                    R.data,
                    R.descricao,
                    R.valor
                FROM receita R
                WHERE DATA >= :dataInicial
                AND DATA <= :dataFinal
                AND R.id_conta = :idConta ";

        $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal, ':idConta' => $idConta);

        if ($descricao != null) {
            $sql .=  " AND R.descricao LIKE :descricao ";
            $parameters[':descricao'] = '%' . $descricao . '%';
        }

        $sql = $sql . " ORDER BY     
                            R.data ";

        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByFilter($filtros)
    {

        $sql = "SELECT 
                r.id,
                r.descricao,
                r.data,
                r.valor,
                r.id_conta
            FROM receita r 
            WHERE 1 = 1 ";


        if (isset($filtros['data_inicial'])) {

            $sql .= " AND r.data >= :data_inicial ";
            $parameters[':data_inicial'] =  $filtros['data_inicial'];

        }

        if (isset($filtros['data_final'])) {

            $sql .= " AND r.data <= :data_final ";
            $parameters[':data_final'] =  $filtros['data_final'];

        }

        if (isset($filtros['id_conta'])) {

            $sql .= " AND r.id_conta = :id_conta ";
            $parameters[':id_conta'] =  $filtros['id_conta'];

        }

        if (isset($filtros['descricao']) && $filtros['descricao'] != null) {

            $sql .= " AND r.descricao LIKE :descricao ";
            $parameters[':descricao'] = '%' . $filtros['descricao'] . '%';

        }

        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        return $query->fetchAll();
    }


    public function getById($id)
    {

        $sql = "SELECT 
                r.id,
                r.descricao,
                r.data,
                r.valor,
                r.id_conta
            FROM receita r 
            WHERE r.id = :id ";

        $parameters = array(':id' => $id);

        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        return $query->fetch();
    }


    public function update($filtros)
    {
        $sql = "UPDATE receita SET  descricao = :descricao,
                                    valor = :valor,
                                    data = :data,
                                    id_conta = :id_conta
              WHERE id = :id ";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':id'           =>  $filtros['id'],
            ':descricao'    =>  $filtros['descricao'],
            ':valor'        =>  $filtros['valor'],
            ':data'         =>  $filtros['data'],
            ':id_conta'     =>  $filtros['id_conta']
        );

        if ($query->execute($parameters)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($filtros)
    {        
        $sql = " INSERT INTO receita 
                (
                  descricao,
                  valor,
                  data,
                  id_conta
                )  
                VALUES 
                (
                  :descricao,
                  :valor,
                  :data,
                  :id_conta
                ) ";

        $query = $this->db->prepare($sql);

        $parameters = array(
            ':descricao'    => $filtros['descricao'],
            ':valor'        => $filtros['valor'],
            ':data'         => $filtros['data'],
            ':id_conta'     => $filtros['id_conta'],
        );

        if ($query->execute($parameters)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {

        $sql = " DELETE FROM receita WHERE id = :id ";
        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id);

        if ($query->execute($parameters)) {
            return true;
        } else {
            return false;
        }
    }
}
