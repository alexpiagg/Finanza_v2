<?php

namespace Mini\Controller;

use Mini\Model\Conta;
use Mini\Core\Controller;
use Mini\Libs\Utils;

class ContaController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $conta = new Conta();
        $retorno = $conta->getId($_SESSION['LOGIN']->id_conta);

        require APP . 'view/conta/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function update()
    {

        if (isset($_POST["submit_conta"])) {

            $conta = new Conta();
            
            //Removendo os pontos
            $valorConta = trim($_POST['valor']);
            $valorConta = str_replace(".", "", $valorConta);
            $valorConta = str_replace(",", ".", $valorConta);

            $salvo = $conta->update($_SESSION['LOGIN']->id_conta, $valorConta, $_SESSION['LOGIN']->id_usuario);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $_SESSION['LOGIN']->valor = $valorConta;

            $this->msgTela = Utils::getMessageSave($salvo, $texto);

            $this->index();            
        }      
    }

    public function contabilizar($valor)
    {
        $conta = new Conta();
        $conta->update($_SESSION['LOGIN']->id_conta, $valor, $_SESSION['LOGIN']->id_usuario);
    }

}