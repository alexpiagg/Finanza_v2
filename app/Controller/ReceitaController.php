<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Receita;
use Mini\Model\Conta;
use Mini\Libs\Utils;

class ReceitaController extends Controller
{

    public $msgTela;

    public function index()
    {
        Utils::writerHeader();

        $retorno = array();
        
        if (isset($_POST["submit_receita"])) {

            $receita = new Receita();

            $this->manterFiltros($_POST['dataIni'], $_POST['dataFim']);
            
            $parametros = array(
                'data_inicial'  => $_POST["dataIni"],
                'data_final'    => $_POST["dataFim"],
                'descricao'     => $_POST["descricao"],
                'id_conta'      => $_SESSION['LOGIN']->id_conta
            );

            $retorno = $receita->getByFilter($parametros);
            
        }

        require APP . 'view/receita/index.php';
        
        Utils::writerFooter();
    }

    public function edit($receita_id = 0)
    {        
        if ($receita_id > 0) {

            $acao = "receita/update/";

            $receita = new Receita();
            $retorno = $receita->getById($receita_id);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();

            } else {

                Utils::writerHeader();

                $_SESSION['ValorAnterior'] = $retorno->valor;

                require APP . 'view/receita/edit.php';

                Utils::writerFooter();
            }
            
        } else {

            $acao = "receita/insert/";

            Utils::writerHeader();

            require APP . 'view/receita/edit.php';

            Utils::writerFooter();

        }                  
    }

    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editreceita"])) {

            $receita = new Receita();

            //Removendo os pontos
            $valorRecebido = trim($_POST['valor']);
            $valorRecebido = str_replace(".", "", $valorRecebido);
            $valorRecebido = str_replace(",", ".", $valorRecebido);

            $parametros = array(
                'data'          => $_POST["data"],
                'valor'         => $valorRecebido,
                'descricao'     => $_POST["descricao"],
                'id_conta'      => $_SESSION['LOGIN']->id_conta
            );

            $salvo = $receita->insert($parametros);

            $this->ajustarSaldo("I", 0, $valorRecebido);
            
            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editreceita"])) {

            $receita = new Receita();

            //Pegando o valor anterior, para contabilizar o saldo
            $objAjusteSaldo = $receita->getById($_POST["id"]);

            //Removendo os pontos
            $valorRecebido = trim($_POST['valor']);
            $valorRecebido = str_replace(".", "", $valorRecebido);
            $valorRecebido = str_replace(",", ".", $valorRecebido);

            $parametros = array(
                'id'            => $_POST["id"],
                'data'          => $_POST["data"],
                'valor'         => $valorRecebido,
                'descricao'     => $_POST["descricao"],
                'id_conta'      => $_SESSION['LOGIN']->id_conta
            );

            $salvo = $receita->update($parametros);

            $this->ajustarSaldo("U", $objAjusteSaldo->valor, $valorRecebido);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($receita_id)
    {
        if (isset($receita_id)) {

            $receita = new Receita();
            
            //Pegando o valor anterior, para contabilizar o saldo
            $objAjusteSaldo = $receita->getById($receita_id);

            $salvo = $receita->delete($receita_id);

            $this->ajustarSaldo("D", $objAjusteSaldo->valor, 0);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir, categoria em uso! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    private function ajustarSaldo($tipo, $valorAnterior, $valorNovo)
    {
        $conta = new  Conta();
        $valorConta = $_SESSION['LOGIN']->valor;
        $valorNovoSaldo = 0;

        if ($tipo == "I")
        {
            $valorNovoSaldo = $valorConta + $valorNovo;
        }
        else if ($tipo == "U")
        {            
            $valorNovoSaldo = ($valorConta - $valorAnterior) + $valorNovo;
        }
        else if ($tipo == "D")
        {
            $valorNovoSaldo = ($valorConta - $valorAnterior);
        }
        
        $conta->update($_SESSION['LOGIN']->id_conta, $valorNovoSaldo, $_SESSION['LOGIN']->id_usuario);
        $_SESSION['LOGIN']->valor = $valorNovoSaldo;
    }

    public function limpar()
    {
        $_SESSION['filtro_data_ini'] = null;
        $_SESSION['filtro_data_fim'] = null;
        $this->index();
    }

    private function manterFiltros($dtInicio, $dtFim){
        $_SESSION["filtro_data_ini"] = $dtInicio;
        $_SESSION["filtro_data_fim"] = $dtFim;
    }
}
