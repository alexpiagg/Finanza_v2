<?php

namespace Mini\Model;

use Mini\Core\Model;

class Login extends Model
{

    /*
     * Retorna um registro de usuarios para validar Login
     */
    public function validarLogin($email, $senha){

        $sql = "SELECT 
                    u.email,
                    u.senha,
                    u.nome_completo,
                    u.id id_usuario,
                    c.id id_conta,
                    c.conta,
                    c.valor
                FROM usuario u
                JOIN conta c ON c.id_usuario = u.id
                WHERE u.email = :e_mail
                  AND u.senha = :senha
                  AND ifnull(u.excluido, 0) = 0 ";
            
            $query = $this->db->prepare($sql);

            $parameters = array(':e_mail' => $email, ':senha' => $senha);
            
            $query->execute($parameters);
            
            return ($query->rowcount() > 0 ? $query->fetch() : false);
    }    
}
