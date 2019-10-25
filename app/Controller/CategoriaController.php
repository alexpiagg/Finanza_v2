<?php

namespace Mini\Controller;

use Mini\Model\TipoGasto;
use Mini\Core\Controller;
use Mini\Libs\Utils;

class CategoriaController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $listaCategorias = array();
        if (isset($_POST["submit_categoria"])) {

            $tipoGasto = new TipoGasto();

            $excluido = isset($_POST['excluido']) ? "1" : "0";

            $listaCategorias = $tipoGasto->getByFilter($_POST['tipo'], $excluido, $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/categoria/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($categoria_id = 0)
    {

        if ($categoria_id > 0) {

            $acao = "categoria/update/";

            $tipoGasto = new TipoGasto();

            $retorno = $tipoGasto->getById($categoria_id, $_SESSION['LOGIN']->id_conta);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                require APP . 'view/_templates/heade.php';
                require APP . 'view/_templates/header.php';
                require APP . 'view/_templates/sidebar.php';

                $checked = $retorno->excluido == 1 ? "checked" : "";

                require APP . 'view/categoria/edit.php';

                require APP . 'view/_templates/footer.php';
            }
            
        } else {

            $acao = "categoria/insert/";

            require APP . 'view/_templates/heade.php';
            require APP . 'view/_templates/header.php';
            require APP . 'view/_templates/sidebar.php';

            require APP . 'view/categoria/edit.php';
            require APP . 'view/_templates/footer.php';

            // redirecionar o usuário para a página de índice de categoria (pois não temos um categoria_id)
            //header('location: ' . URL . 'categoria/index');
        }                  
    }

    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcategoria"])) {

            $tipoGasto = new TipoGasto();

            $excluido =  isset($_POST['excluido']) ? "1" : "0";
            $salvo = $tipoGasto->insert($_POST["tipo"],  $excluido, $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcategoria"])) {

            $tipoGasto = new TipoGasto();

            $excluido =  isset($_POST['excluido']) ? "1" : "0";
            $salvo = $tipoGasto->update($_POST["id"], $_POST["tipo"],  $excluido, $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($categoria_id)
    {
        if (isset($categoria_id)) {

            $tipoGasto = new TipoGasto();

            $salvo = $tipoGasto->delete($categoria_id);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir, categoria em uso! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }
}
