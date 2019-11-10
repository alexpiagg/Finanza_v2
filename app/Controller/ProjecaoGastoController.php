<?php

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Model\ProjecaoGasto;
use Mini\Libs\Utils;

class ProjecaoGastoController extends Controller
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

    public function edit($projecaoId = 0)
    {

        if ($projecaoId > 0) {

            $acao = "projecaoGasto/update/";

            $projecao = new ProjecaoGasto();

            $retorno = $projecao->getById($projecaoId, $_SESSION['LOGIN']->id_conta);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                require APP . 'view/_templates/heade.php';
                require APP . 'view/_templates/header.php';
                require APP . 'view/_templates/sidebar.php';

                require APP . 'view/projecaoGasto/edit.php';

                require APP . 'view/_templates/footer.php';
            }
            
        } else {

            $acao = "projecaoGasto/insert/";

            require APP . 'view/_templates/heade.php';
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/sidebar.php';

            require APP . 'view/projecaoGasto/edit.php';
            require APP . 'view/_templates/footer.php';

        }                  
    }

    
    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editprojecao"])) {

            $projecao = new ProjecaoGasto();

            //Removendo os pontos
            $valor = trim($_POST['valor']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            
            $dataVencto = $_POST['data_vencto'] != '' ? $_POST['data_vencto'] : null;

            $salvo = $projecao->insert($_POST['descricao'], $valor, $_POST['quantidade'], $dataVencto,  $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editprojecao"])) {

            $projecao = new ProjecaoGasto();            

            //Removendo os pontos
            $valor = trim($_POST['valor']);
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);

            $dataVencto = $_POST['data_vencto'] != '' ? $_POST['data_vencto'] : null;
            
            $salvo = $projecao->update($_POST['id'], $_POST['descricao'], $valor, $_POST['quantidade'], $dataVencto,  $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($projecao_id)
    {
        if (isset($projecao_id)) {

            $projecao = new ProjecaoGasto();

            $salvo = $projecao->delete($projecao_id);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

}
