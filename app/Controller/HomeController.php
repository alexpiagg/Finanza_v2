<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

class HomeController
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function index()
    {
        session_start();
        if (!isset($_SESSION['LOGIN']))
        {
            header('location: ' . URL . 'login');
        }
        
        $login = $_SESSION['LOGIN'];
        $nome = $this->texto($login);

        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/sidebar.php';
        require APP . 'view/_templates/footer.php';
    }

    public function texto($login){
        $nomeCompleto = $login->nome_completo;
                
        $primeiroNome = explode(' ', $nomeCompleto, 2);
        $primeiroNome = $primeiroNome[0];
        
        return $primeiroNome;
    }
}
