<?php

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Model\ContaPagar;
use Mini\Libs\Utils;

class ContaPagarController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $totalConta = 0;
        $despesas = 0;
        $totalDespesas = 0;
        $saldo = 0;

        $retornoProjecaoGasto = array();
        if (isset($_POST["submit_contapagar"])) {

            $contaPagar = new ContaPagar();

            $retornoProjecaoGasto = $contaPagar->getByFilter($_POST['descricao'], $_SESSION['LOGIN']->id_conta);

            foreach($retornoProjecaoGasto as $row){
                $despesas += $row->valor * $row->quantidade;
            }

            $totalConta = $_SESSION['LOGIN']->valor;
            $totalDespesas = $despesas;            
        }

        $saldo = $totalConta - $totalDespesas;

        require APP . 'view/contaPagar/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($contaPagarId = 0)
    {

        if ($contaPagarId > 0) {

            $acao = "contaPagar/update/";

            $contaPagar = new ContaPagar();

            $retorno = $contaPagar->getById($contaPagarId);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                require APP . 'view/_templates/heade.php';
                require APP . 'view/_templates/header.php';
                require APP . 'view/_templates/sidebar.php';

                require APP . 'view/contaPagar/edit.php';

                require APP . 'view/_templates/footer.php';
            }
            
        } else {

            $acao = "contaPagar/insert/";

            require APP . 'view/_templates/heade.php';
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/sidebar.php';

            require APP . 'view/contaPagar/edit.php';
            require APP . 'view/_templates/footer.php';

        }                  
    }

    
    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcontapagar"])) {

            $contaPagar = new ContaPagar();

            //Removendo os pontos
            $valor = trim($_POST['valor']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            
            $dataVencto = $_POST['data_vencto'] != '' ? $_POST['data_vencto'] : null;

            $salvo = $contaPagar->insert($_POST['descricao'], $valor, $_POST['quantidade'], $dataVencto,  $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcontapagar"])) {

            $contaPagar = new ContaPagar();            

            //Removendo os pontos
            $valor = trim($_POST['valor']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            $dataVencto = $_POST['data_vencto'] != '' ? $_POST['data_vencto'] : null;
            
            $salvo = $contaPagar->update($_POST['id'], $_POST['descricao'], $valor, $_POST['quantidade'], $dataVencto,  $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($contaPagar_id)
    {
        if (isset($contaPagar_id)) {

            $contaPagar = new ContaPagar();

            $salvo = $contaPagar->delete($contaPagar_id);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

}
