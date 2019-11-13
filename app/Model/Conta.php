<?php

namespace Mini\Model;

use Exception;
use Mini\Core\Model;

class Conta extends Model
{

    public function getId($id_conta) {       

        $sql = "SELECT
                    c.id,
                    c.conta,
                    c.id_usuario,
                    c.valor
                FROM conta c
                WHERE c.id = :idConta ";
       
        $parameters = array(':idConta' => $id_conta);
        
        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();       
    }

    public function update($id, $valorConta, $idUsuario)
    {
        $sql = "UPDATE conta SET id = :id, valor = :valorConta, id_usuario = :id_usuario
                WHERE id = :id ";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':valorConta' => $valorConta, ':id_usuario' => $idUsuario);

        return $this->save($query, $parameters);
    }
}
