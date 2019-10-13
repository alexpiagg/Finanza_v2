<?php

/**
 * Classe RptPorCategoriaController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;
use Mini\Model\TipoGasto;
use Mini\Libs\Utils;

class RelatoriosController
{
    /**
     * PAGE: index
     * Este método lida com o que acontece quando você se move para http://localhost/projeto/home/index (que é a página padrão)
     */
    public function porCategoria()
    {        
        Utils::isLogged();

        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';
        
        if (isset($_POST["submit_porcategoria"])) {

            $gasto = new Gasto();

            $retornoDetalhe = $gasto->getRelPorCategoria($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
            $retornoTotais = $gasto->getGastosAgrupados($_POST['dataIni'], $_POST['dataFim'],  $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoria.php';
    }

    public function porCategoriaGrafico()
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

        require APP . 'view/relatorios/porCategoriaGrafico.php';
    }
}
