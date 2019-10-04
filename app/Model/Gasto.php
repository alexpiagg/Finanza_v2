<?php

namespace Mini\Model;

use Mini\Core\Model;

class Gasto extends Model
{
    
    function getTimeline($dataInicial, $dataFinal, $idConta){
        
        $sql = "SELECT 
                    r.data,
                    r.descricao,
                    r.valor,
                    'RECEITA' tipo,
                    r.id
                FROM receita r
                WHERE r.data >= :dataInicial
                  AND r.data <= :dataFinal
                  AND r.id_conta = :idConta
                
                UNION
                
                SELECT 
                    g.data,
                    g.local,
                    g.valor,
                    t.tipo,
                    g.id
                FROM gasto g
                JOIN tipo_gasto t ON t.id = g.id_tipo_gasto
                WHERE g.data >= :dataInicial
                  AND g.data <= :dataFinal
                  AND g.id_conta = :idConta
                ORDER BY
                    DATA DESC,                    
                    ID DESC ";

        $query = $this->db->prepare($sql);

        $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal, ':idConta' => $idConta);

        $query->execute($parameters);
        
        return $query->fetchAll();
    }

    function getRptPorCategoria()
    {
        $sql = "SELECT
                    g.id,
                    g.local,
                    g.data,
                    g.valor,
                    g.id_tipo_gasto,
                    g.cartao_credito
                FROM gasto g 
                WHERE g.data >= :dataInicial  
                  AND g.data <= :dataFinal 
                  AND g.id_tipo_gasto != 0
                  AND g.id_conta = 1";

        $dataInicial = "2019-01-01";
        $dataFinal = "2019-01-30";

        $query = $this->db->prepare($sql);

        $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    /*
     * Retorna os gastos totais por categoria
     */
    public function getGastosAgrupados(){

      $sql = "SELECT 
                  tg.tipo,
                  tg.id,
                  SUM(g.valor) total
              FROM gasto g
              JOIN tipo_gasto tg ON tg.id = g.id_tipo_gasto
              WHERE g.data >= :dataInicial
                    AND g.data <= :dataFinal
                    AND g.id_conta = 1 
                    AND g.id_tipo_gasto != 0
              GROUP BY tg.id ";

$dataInicial = "2019-01-01";
$dataFinal = "2019-01-30";

        $query = $this->db->prepare($sql);

        $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal);

        $query->execute($parameters);

        return $query->fetchAll();
  }
}
