<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;

class HomeController extends Controller
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function index()
    {
        // Carregar a view home
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';
        
        require APP . 'view/home/index.php';

        $timeline = new \Mini\Controller\TimelineController();
        $timeline->index();

        require APP . 'view/_templates/footer.php';
    }

    
}
