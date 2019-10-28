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

    public function edit($gasto_id = 0)
    {

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

            // redirecionar o usuário para a página de índice de categoria (pois não temos um categoria_id)
            //header('location: ' . URL . 'categoria/index');
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
}
