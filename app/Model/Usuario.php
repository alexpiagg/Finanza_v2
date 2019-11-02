<?php

namespace Mini\Model;

use Mini\Core\Model;

class Usuario extends Model {
   
    public function getId($id) {

        $sql = "SELECT 
             u.id,
             u.nome_completo,
             u.email,
             u.excluido,
             u.senha
         FROM usuario u
         WHERE u.id = :id ";

        $parameters = array(':id' => $id);
                        
        $query = $this->db->prepare($sql);

        $query->execute($parameters);

        return $query->fetch();

    }

    public function update($id, $nome_completo, $email, $excluido, $senha)
    {
        $sql = "UPDATE usuario SET nome_completo = :nome_completo, email = :email, excluido = :excluido, senha = :senha WHERE id = :id ";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':nome_completo' => $nome_completo, ':email' => $email, ':excluido' => $excluido, ':senha' => $senha);

        if ($query->execute($parameters)){
            return true;
        }
        else{
            return false;
        }
    }
  
}