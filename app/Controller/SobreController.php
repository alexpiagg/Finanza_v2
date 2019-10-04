<?php

/**
 * Classe ClientesController
 *
 */

namespace Mini\Controller;

use Mini\Libs\Utils;

class SobreController
{
    /**
     * Action: index
     */
    public function index()
    {
        session_start();
        if (!isset($_SESSION['LOGIN']))
        {
            header('location: ' . URL . 'login');
        }

        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';                       
        require APP . 'view/_templates/sidebar.php';
        
        require APP . 'view/sobre/index.php';        
    }

}
