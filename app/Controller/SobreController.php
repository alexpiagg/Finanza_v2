<?php

/**
 * Classe ClientesController
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Libs\Utils;

class SobreController extends Controller
{
    /**
     * Action: index
     */
    public function index()
    {
        // Carregar a view home
        Utils::writerHeader();
        
        require APP . 'view/sobre/index.php';
        
        require APP . 'view/_templates/footer.php';
    }

}
