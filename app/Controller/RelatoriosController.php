<?php

/**
 * Classe RptPorCategoriaController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;

class RelatoriosController
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

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $retornoDetalhe = null;
        $retornoTotais = null;

        if (true){
            $gasto = new Gasto();
            $retornoDetalhe = $gasto->getRptPorCategoria();

            $retornoTotais = $gasto->getGastosAgrupados();
        }

        require APP . 'view/relatorios/index.php';
    }

    public function edit()
    {        
        // session_start();
        // if (!isset($_SESSION['LOGIN']))
        // {
        //     header('location: ' . URL . 'login');
        // }
        
        // $retornoDetalhe = null;
        // $retornoTotais = null;

        // if (true){
        //     $gasto = new Gasto();
        //     $retornoDetalhe = $gasto->getRptPorCategoria();

        //     $retornoTotais = $gasto->getGastosAgrupados();
        // }
        
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        require APP . 'view/relatorios/edit.php';
    }
}
