<?php

/**
 * Classe ClientesController
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;

class SobreController extends Controller
{
    /**
     * Action: index
     */
    public function index()
    {
        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';                       
        require APP . 'view/_templates/sidebar.php';
        
        require APP . 'view/sobre/index.php';        
    }

}
