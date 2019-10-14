<?php

/**
 * Classe RptPorCategoriaController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;
use Mini\Model\TipoGasto;
use Mini\Libs\Utils;
use Mini\Core\Controller;

class RelatoriosController extends Controller
{
    
    public function index()
    {
        
    }

    public function porCategoria()
    {        
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
        require APP . 'view/_templates/footer.php';
    }

    public function porCategoriaGrafico()
    {        
        $listaAnos = Utils::listarAnos();
        $listaMeses = Utils::listarMeses();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        if (isset($_POST["submit_porcategoriagrafico"])) {
            $gasto = new Gasto();
           
            $dataIni = $_POST['listaAno'] . '-' . $_POST['listaMes'] . '-' . '01';
            $dataFim = $_POST['listaAno'] . '-'. $_POST['listaMes'] . '-' . date('t', strtotime($dataIni));
        
            $retornoTotais = $gasto->getGastosAgrupados($dataIni, $dataFim, 0, $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoriaGrafico.php';
        require APP . 'view/_templates/footer.php';
    }

    public function porMes()
    {
        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';
        
        $listaMeses = Utils::listarMeses();

        if (isset($_POST["submit_pormes"])) {

            $gasto = new Gasto();

            $retornoDados = $gasto->getGastosPorMeses($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porMes.php';
        require APP . 'view/_templates/footer.php';
    }

    public function filterArrayByValue($dados, $mes){        
        return Utils::filterArrayByValue($dados, 'mes', $mes);
    }
}
