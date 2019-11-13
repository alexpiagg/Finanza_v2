<?php

namespace Mini\Model;

use Exception;
use Mini\Core\Model;

class TipoGasto extends Model
{
    public function getAll()
    {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    IFNULL(T.excluido, 0) excluido,
                    T.id_conta 
                FROM tipo_gasto T ";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getByFilter($tipo, $excluido, $id_conta)
    {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    IFNULL(T.excluido, 0) excluido,
                    T.id_conta 
                FROM tipo_gasto T 
                WHERE T.id_conta = :idConta";

        $parameters = array(':idConta' => $id_conta);

        if ($tipo != '') {
            $sql .=  " AND T.tipo LIKE :tipo ";
            $parameters[':tipo'] = '%' . $tipo . '%';
        }

        if (isset($excluido)) {
            $sql .=  " AND IFNULL(T.excluido, 0) = :excluido ";

            $parameters[':excluido'] = $excluido;
        }

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetchAll();
    }

    public function getById($id)
    {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    T.excluido,
                    T.id_conta 
                FROM tipo_gasto T 
                WHERE T.id = :id ";

        $parameters = array(':id' => $id);

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function update($id, $tipo, $excluido, $id_conta)
    {
        $sql = "UPDATE tipo_gasto SET tipo = :tipo, excluido = :excluido, id_conta = :id_conta WHERE id = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':tipo' => $tipo, ':excluido' => $excluido, ':id_conta' => $id_conta);

        return $this->save($query, $parameters);
    }

    public function delete($id)
    {
        $sql = " DELETE FROM tipo_gasto  WHERE id = :id ";
        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id);

        return $this->save($query, $parameters);
    }

    public function insert($tipo, $excluido, $id_conta)
    {
        $sql = " INSERT INTO tipo_gasto (tipo, excluido, id_conta)  VALUES (:tipo, :excluido, :id_conta) ";
        $query = $this->db->prepare($sql);

        $parameters = array(':tipo' => $tipo, ':excluido' => $excluido, ':id_conta' => $id_conta);

        return $this->save($query, $parameters);
    }
}
