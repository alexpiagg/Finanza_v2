<?php

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Model\ProjecaoGasto;

class ProjecaoGastoController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $totalConta = 0;
        $totalDespesas = 0;
        $saldo = 0;

        $retornoProjecaoGasto = array();
        if (isset($_POST["submit_projecaogasto"])) {

            $projecaoGasto = new ProjecaoGasto();

            $retornoProjecaoGasto = $projecaoGasto->getByFilter($_POST['descricao'], $_SESSION['LOGIN']->id_conta);

            foreach($retornoProjecaoGasto as $row){
                $despesas += $row->valor * $row->quantidade;
            }

            $totalConta = $_SESSION['LOGIN']->valor;
            $totalDespesas = $despesas;            
        }

        $saldo = $totalConta - $totalDespesas;

        require APP . 'view/projecaoGasto/index.php';
        require APP . 'view/_templates/footer.php';
    }

}
