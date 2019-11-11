<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Conta;
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

    public function edit($gasto_id = 0)
    {
        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        if ($gasto_id > 0) {

            $acao = "gasto/update/";

            $tipoGasto = new TipoGasto();
            $listaTipoGastos = $tipoGasto->getAll();
            
            $gasto = new Gasto();
            $retorno = $gasto->getById($gasto_id, $_SESSION['LOGIN']->id_conta);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                require APP . 'view/_templates/heade.php';
                require APP . 'view/_templates/header.php';
                require APP . 'view/_templates/sidebar.php';

                $checked = $retorno->cartao_credito == 1 ? "checked" : "";

                require APP . 'view/gasto/edit.php';

                require APP . 'view/_templates/footer.php';
            }
            
        } else {

            $acao = "gasto/insert/";

            require APP . 'view/_templates/heade.php';
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/sidebar.php';

            require APP . 'view/gasto/edit.php';
            require APP . 'view/_templates/footer.php';
        }                  
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editgasto"])) {

            $gasto = new Gasto();

            $cartaoCredito =  isset($_POST['cartao_credito']) ? "1" : "0";

            //Removendo os pontos
            $valorGasto = trim($_POST['valor']);
            $valorGasto = str_replace(".", "", $valorGasto);
            $valorGasto = str_replace(",", ".", $valorGasto);
            

            $salvo = $gasto->update($_POST["id"], 
                                    $_POST["data"], 
                                    $_POST['local'], 
                                    $valorGasto, 
                                    $_POST['tipoGasto'], 
                                    $_SESSION['LOGIN']->id_conta, 
                                    $cartaoCredito);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($gasto_id)
    {
        if (isset($gasto_id)) {

            $gasto = new Gasto();

            $salvo = $gasto->delete($gasto_id);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir, categoria em uso! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editgasto"])) {

            $gasto = new Gasto();

            $cartaoCredito =  isset($_POST['cartao_credito']) ? "1" : "0";

            //Removendo os pontos
            $valorGasto = trim($_POST['valor']);
            $valorGasto = str_replace(".", "", $valorGasto);
            $valorGasto = str_replace(",", ".", $valorGasto);
            
            $salvo = $gasto->insert($_POST["data"],
                                    $_POST['local'],
                                    $valorGasto,
                                    $_POST['tipoGasto'],
                                    $_SESSION['LOGIN']->id_conta,
                                    $cartaoCredito);
            
            $this->ajustarSaldo("I", $valorGasto);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    private function ajustarSaldo($tipo, $valor)
    {
        $conta = new  Conta();
        $valorConta = $_SESSION['LOGIN']->valor;
        $valorNovo = 0;

        if ($tipo == "I")
        {
            $valorNovo = $valorConta - $valor;
        }
        else if ($tipo == "U")
        {
            
        }
        else if ($tipo == "D")
        {

        }
        
        $conta->update($_SESSION['LOGIN']->id_conta, $valorNovo, $_SESSION['LOGIN']->id_usuario);
        $_SESSION['LOGIN']->valor = $valorNovo;
    }
}
