<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

use Mini\Libs\Utils;

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
        
        // $login = $_SESSION['LOGIN'];

        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';

        $login = $_SESSION['LOGIN'];
        $nome = Utils::getPrimeiroNome($login);

        require APP . 'view/home/index.php';
        require APP . 'view/_templates/sidebar.php';

        $timeline = new \Mini\Controller\TimelineController();
        $timeline->index();

        require APP . 'view/_templates/footer.php';
    }

    
}
