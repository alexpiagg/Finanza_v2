<?php

/**
 * Classe HomeController
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Libs\Utils;

class HomeController extends Controller
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function index()
    {
        // Carregar a view home
        Utils::writerHeader();
        
        require APP . 'view/home/index.php';

        $timeline = new \Mini\Controller\TimelineController();
        $timeline->index();

        Utils::writerFooter();
    }

    
}
