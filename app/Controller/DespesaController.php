<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Gasto;
use Mini\Model\TipoGasto;
use Mini\Libs\Utils;

class DespesaController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        $listaDespesas = array();
        if (isset($_POST["submit_despesa"])) {

            $gasto = new Gasto();

            $listaDespesas = $gasto->getAll($_POST['dataIni'], 
                $_POST['dataFim'], 
                $_SESSION['LOGIN']->id_conta, 
                $_POST['tipoGasto'], 
                $_POST['local'],
                true);

        }

        require APP . 'view/despesa/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
