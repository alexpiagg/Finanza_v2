<?php

namespace Mini\Model;

use Exception;
use Mini\Core\Model;

class CategoriaGasto extends Model
{
    public function getAll()
    {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    IFNULL(T.excluido, 0) excluido,
                    T.id_usuario 
                FROM categoria_gasto T ";

        $query = $this->db->prepare($sql);

        $query->execute();

        return $query->fetchAll();
    }

    public function getByFilter($tipo, $excluido, $id_usuario)
    {

        $sql = "SELECT 
                    T.id, 
                    T.tipo,
                    IFNULL(T.excluido, 0) excluido,
                    T.id_usuario 
                FROM categoria_gasto T 
                WHERE T.id_usuario = :id_usuario";

        $parameters = array(':id_usuario' => $id_usuario);

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
                    T.id_usuario 
                FROM categoria_gasto T 
                WHERE T.id = :id ";

        $parameters = array(':id' => $id);

        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();
    }

    public function update($id, $tipo, $excluido, $id_usuario)
    {
        $sql = "UPDATE categoria_gasto SET tipo = :tipo, excluido = :excluido, id_usuario = :id_usuario WHERE id = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':tipo' => $tipo, ':excluido' => $excluido, ':id_usuario' => $id_usuario);

        return $this->save($query, $parameters);
    }

    public function delete($id)
    {
        $sql = " DELETE FROM categoria_gasto  WHERE id = :id ";
        $query = $this->db->prepare($sql);

        $parameters = array(':id' => $id);

        return $this->save($query, $parameters);
    }

    public function insert($tipo, $excluido, $id_usuario)
    {
        $sql = " INSERT INTO categoria_gasto (tipo, excluido, id_usuario)  VALUES (:tipo, :excluido, :id_usuario) ";
        $query = $this->db->prepare($sql);

        $parameters = array(':tipo' => $tipo, ':excluido' => $excluido, ':id_usuario' => $id_usuario);

        return $this->save($query, $parameters);
    }
}
