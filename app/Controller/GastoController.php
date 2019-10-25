<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Gasto;
use Mini\Model\TipoGasto;
use Mini\Libs\Utils;

class GastoController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        $listaGastos = array();
        if (isset($_POST["submit_gasto"])) {

            $gasto = new Gasto();

            $parametros = array(
                'data_inicial' => $_POST['dataIni'],
                'data_final' => $_POST['dataFim'],
                'id_conta' => $_SESSION['LOGIN']->id_conta,
                'id_tipo_gasto' => $_POST['tipoGasto'],
                'local' => $_POST['local']
            );

            $listaGastos = $gasto->getAll($parametros, true);
        }

        require APP . 'view/gasto/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
