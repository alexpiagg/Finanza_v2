<?php

namespace Mini\Model;

use Mini\Core\Model;

class Gasto extends Model
{

  function getTimeline($dataInicial, $dataFinal, $idConta)
  {

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

  function getRelPorCategoria($dataInicial, $dataFinal, $tipoGasto, $idConta)
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
                  AND g.id_conta = :idConta 
                ";

    $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal, ':idConta' => $idConta);
    
    if ($tipoGasto > 0) {
      $sql .= " AND g.id_tipo_gasto = :idTipoGasto ";
      $parameters[':idTipoGasto'] =  $tipoGasto;
    }

    $query = $this->db->prepare($sql);    
    $query->execute($parameters);

    return $query->fetchAll();
  }

  /*
     * Retorna os gastos totais por categoria
     */
  public function getGastosAgrupados($dataInicial, $dataFinal, $tipoGasto, $idConta)
  {

    $sql = "SELECT 
                  tg.tipo,
                  tg.id,
                  SUM(g.valor) total
              FROM gasto g
              JOIN tipo_gasto tg ON tg.id = g.id_tipo_gasto
              WHERE g.data >= :dataInicial
                    AND g.data <= :dataFinal
                    AND g.id_conta = :idConta
                    
               ";

    $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal, ':idConta' => $idConta);

    if ($tipoGasto > 0) {
      $sql .= " AND g.id_tipo_gasto = :idTipoGasto ";
      $parameters[':idTipoGasto'] =  $tipoGasto;
    }

    $sql .= " GROUP BY tg.id ";

    $query = $this->db->prepare($sql);
    $query->execute($parameters);

    return $query->fetchAll();
  }
}
