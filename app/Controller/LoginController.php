<?php

namespace Mini\Controller;

use Mini\Model\Login;

class LoginController
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function index()
    {        
        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/login/index.php';
    }

    public function logon()
    {
        $login = new Login();
        if (isset($_POST["submit_login"])) 
        {            
            $logado = $login->validarLogin($_POST['usuario'], md5($_POST['senha']));
        }
        
        if (!$logado)
        {
            header('location: ' . URL . 'login');
        }
        else
        {
            session_start();
            $_SESSION["LOGIN"] = $logado;
            
            header('location: ' . URL . 'home');
        }
        
    }

    public function logout(){
        session_start();
        $_SESSION = array();
        
        header('location: ' . URL . 'login');
    }
}
