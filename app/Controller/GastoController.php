<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Conta;
use Mini\Model\Gasto;
use Mini\Model\CategoriaGasto;
use Mini\Libs\Utils;

class GastoController extends Controller
{

    public $msgTela;

    public function index()
    {
        Utils::writerHeader();

        $tipoGasto = new CategoriaGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        $listaGastos = array();
        if (isset($_POST["submit_gasto"])) {
            
            $this->manterFiltros($_POST['dataIni'], $_POST['dataFim']);

            $gasto = new Gasto();

            $parametros = array(
                'data_inicial' => $_POST['dataIni'],
                'data_final' => $_POST['dataFim'],
                'id_conta' => $_SESSION['LOGIN']->id_conta,
                'id_categoria_gasto' => $_POST['tipoGasto'],
                'local' => $_POST['local'],
                'produto_adquirido' => $_POST['produto_adquirido']
            );

            $listaGastos = $gasto->getAll($parametros, true);
        }

        require APP . 'view/gasto/index.php';
        
        Utils::writerFooter();
    }

    public function edit($gasto_id = 0)
    {
        $tipoGasto = new CategoriaGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        if ($gasto_id > 0) {

            $acao = "gasto/update/";

            $tipoGasto = new CategoriaGasto();
            $listaTipoGastos = $tipoGasto->getAll();
            
            $gasto = new Gasto();
            $retorno = $gasto->getById($gasto_id);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                Utils::writerHeader();

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

            //Pegando o valor anterior, para contabilizar o saldo
            $objAjusteSaldo = $gasto->getById($_POST["id"]);

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
                                    $cartaoCredito,
                                    nl2br($_POST['produto_adquirido']));

            $this->ajustarSaldo("U", $objAjusteSaldo->valor, $valorGasto);

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

            //Pegando o valor anterior, para contabilizar o saldo
            $objAjusteSaldo = $gasto->getById($gasto_id);

            $salvo = $gasto->delete($gasto_id);

            $this->ajustarSaldo("D", $objAjusteSaldo->valor, 0);

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
                                    $cartaoCredito,
                                    nl2br($_POST['produto_adquirido']));
            
            $this->ajustarSaldo("I", 0, $valorGasto);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

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
            $valorNovoSaldo = $valorConta - $valorNovo;
        }
        else if ($tipo == "U")
        {            
            $valorNovoSaldo = ($valorConta + $valorAnterior) - $valorNovo;
        }
        else if ($tipo == "D")
        {
            $valorNovoSaldo = ($valorConta + $valorAnterior);
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
