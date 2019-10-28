<?php

namespace Mini\Model;

use Mini\Core\Model;
use PDO;

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

  /*
     * Retorna a soma por categoria, agrupado por meses
     */
  public function getGastosPorMeses($dataInicial, $dataFinal, $tipoGasto, $idConta)
  {

    $sql = "SELECT	
                  MONTH(G.data) mes,
                  TG.tipo,
                  SUM(valor) total
              FROM gasto G
              JOIN tipo_gasto TG ON TG.id = G.id_tipo_gasto
              WHERE DATA >= :dataInicial
                AND DATA <= :dataFinal
                AND G.id_conta = :idConta ";

    $parameters = array(':dataInicial' => $dataInicial, ':dataFinal' => $dataFinal, ':idConta' => $idConta);

    if ($tipoGasto > 0) {
      $sql .= " AND g.id_tipo_gasto = :idTipoGasto ";
      $parameters[':idTipoGasto'] =  $tipoGasto;
    }

    $sql = $sql . " GROUP BY 
                          TG.TIPO,
                          MONTH(G.data) ";

    $query = $this->db->prepare($sql);
    $query->execute($parameters);

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }
  

  public function getById($id, $id_conta) {

    $sql = "SELECT
              g.id,
              g.local,
              g.data,
              g.valor,
              g.id_tipo_gasto,
              g.cartao_credito
          FROM gasto g
          WHERE g.id = :id 
            AND g.id_conta = :id_conta ";

    $parameters = array(':id' => $id, ':id_conta' => $id_conta);

    $query = $this->db->prepare($sql);

    $query->execute($parameters);

    return $query->fetch();
  }

  public function getAll($filtros, $isObject = false)
  {

    $sql = "SELECT
                  g.id,
                  g.local,
                  g.data,
                  g.valor,
                  g.id_tipo_gasto,
                  g.cartao_credito
              FROM gasto g
              WHERE 1 = 1 ";


    if (isset($filtros['data_inicial'])) {

      $sql .= " AND g.data >= :dataInicial ";
      $parameters[':dataInicial'] =  $filtros['data_inicial'];

    }

    if (isset($filtros['data_final'])) {

      $sql .= " AND g.data <= :dataFinal ";
      $parameters[':dataFinal'] =  $filtros['data_final'];

    }

    if (isset($filtros['id_conta'])) {

      $sql .= " AND g.id_conta >= :idConta ";
      $parameters[':idConta'] = $filtros['id_conta'];

    }
     
    if (isset($filtros['id_tipo_gasto']) && $filtros['id_tipo_gasto'] > 0) {

      $sql .= " AND g.id_tipo_gasto = :id_tipo_gasto ";
      $parameters[':id_tipo_gasto'] =  $filtros['id_tipo_gasto'];

    }

    if (isset($filtros['local']) && $filtros['local'] != null) {

      $sql .=  " AND g.local LIKE :local ";
      $parameters[':local'] = '%' . $filtros['local'] . '%';

    }

    $query = $this->db->prepare($sql);
    $query->execute($parameters);

    if ($isObject){
      return $query->fetchAll();
    }
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function update($id, $data, $local, $valor, $id_tipo_gasto, $id_conta, $cartao_credito)
  {
      $sql = "UPDATE gasto SET  data = :data, 
                                local = :local, 
                                valor = :valor, 
                                id_tipo_gasto = :id_tipo_gasto, 
                                id_conta = :id_conta, 
                                cartao_credito = :cartao_credito 
              WHERE id = :id ";

      $query = $this->db->prepare($sql);
      
      $parameters = array(':id' => $id, 
                          ':data' => $data,
                          ':local' => $local,
                          ':valor' => $valor,
                          ':id_tipo_gasto' => $id_tipo_gasto,
                          ':id_conta' => $id_conta,
                          ':cartao_credito' => $cartao_credito                        
      );

      if ($query->execute($parameters)){
          return true;
      }
      else{
          return false;
      }
  }

  public function insert($data, $local, $valor, $id_tipo_gasto, $id_conta, $cartao_credito)
  {
      $sql = " INSERT INTO gasto 
                (
                  data,
                  local,
                  valor,
                  id_tipo_gasto,
                  id_conta,
                  cartao_credito
                )  
                VALUES 
                (
                  :data, 
                  :local, 
                  :valor, 
                  :id_tipo_gasto, 
                  :id_conta, 
                  :cartao_credito 
                ) ";

      $query = $this->db->prepare($sql);
      
      $parameters = array(':data' => $data,
                          ':local' => $local,
                          ':valor' => $valor,
                          ':id_tipo_gasto' => $id_tipo_gasto,
                          ':id_conta' => $id_conta,
                          ':cartao_credito' => $cartao_credito                        
      );
      
      if ($query->execute($parameters)){
          return true;
      }
      else{
          return false;
      }
  }

  public function delete($id)
    {
      
        $sql = " DELETE FROM gasto WHERE id = :id ";
        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id);

        if ($query->execute($parameters)){
            return true;
        }
        else{
            return false;
        }
    }
}
