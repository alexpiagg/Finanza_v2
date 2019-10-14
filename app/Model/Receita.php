<?php

namespace Mini\Model;

use Mini\Core\Model;
use PDO;

class Receita extends Model
{
     /*
     * Retorna a soma das receitas, agrupado por meses
     */
    public function getReceitasPorMeses($dataInicial, $dataFinal, $descricao, $idConta){
        
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

        if ($descricao != null){
            $sql .=  " AND R.descricao LIKE :descricao ";
            $parameters[':descricao'] = '%' . $descricao . '%';
        }

        $sql = $sql . " ORDER BY     
                            R.data ";

        $query = $this->db->prepare($sql);
        $query->execute($parameters);
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
