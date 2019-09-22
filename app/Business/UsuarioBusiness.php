<?php

class UsuarioBusiness {

    function getAll($usuario){
        $model = new UsuarioModel();
        return $model->getAll($usuario);        
    }
    
    function getId($usuario){
        $model = new UsuarioModel();
        return $model->getId($usuario);
    }

    public function salvar($model){
        try{
            $salvar = new UsuarioModel();        
            $salvar->salvar($model);
        
            MessagesUtil::getMessage("green", "<b>Sucesso!</b> Dados salvos! :)");
        }
        catch (Exception $ex){
            MessagesUtil::getMessage("red", "<b>Erro!</b> Dados não foram salvos! :(");
        }
    }

    function validarLogin($usuarioVO){
        $model = new UsuarioModel();
        
        $retornoUsuario = $model->validarLogin($usuarioVO);

        if ($retornoUsuario != null) {

            if ($retornoUsuario['senha'] != $usuarioVO->senha) {
                return null;
            }
            
            //Retornando a conta vinculada ao usuario
            $contaVO = new ContaVO();
            $contaVO->id_usuario = $retornoUsuario['id_usuario'];
        }
    
        return $retornoUsuario;
    }

    function validarUsuarioExistente($usuario) {
        $usuarioExiste = new UsuarioVO();
        $usuarioExiste->email = $usuario->email;

        $retorno = $this->getAll($usuarioExiste);

        if ($retorno != null){
            return true;
        }

        return false;
    }
}
