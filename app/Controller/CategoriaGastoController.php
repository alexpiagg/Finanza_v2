<?php

namespace Mini\Controller;

use Mini\Model\CategoriaGasto;
use Mini\Core\Controller;
use Mini\Libs\Utils;

class CategoriaGastoController extends Controller
{

    public $msgTela;

    public function index()
    {
        Utils::writerHeader();

        $listaCategorias = array();
        if (isset($_POST["submit_categoriagasto"])) {

            $categGasto = new CategoriaGasto();

            $excluido = isset($_POST['excluido']) ? "1" : "0";

            $listaCategorias = $categGasto->getByFilter($_POST['tipo'], $excluido, $_SESSION['LOGIN']->id_usuario);
        }

        require APP . 'view/categoriaGasto/index.php';
        
        Utils::writerFooter();
    }

    public function edit($categoria_id = 0)
    {

        if ($categoria_id > 0) {

            $acao = "categoriaGasto/update/";

            $categGasto = new CategoriaGasto();

            $retorno = $categGasto->getById($categoria_id);

            // Se a categoria não for encontrada, então ele teria retornado falso, e precisamos exibir a página de erro
            if ($retorno === false) {
                $page = new \Mini\Controller\ErrorController();
                $page->index();
            } else {

                Utils::writerHeader();

                $checked = $retorno->excluido == 1 ? "checked" : "";

                require APP . 'view/categoriaGasto/edit.php';

                Utils::writerFooter();
            }
            
        } else {

            $acao = "categoriaGasto/insert/";

            Utils::writerHeader();

            require APP . 'view/categoriaGasto/edit.php';
            
            Utils::writerFooter();
        }                  
    }

    public function insert()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcategoriagasto"])) {

            $categGasto = new CategoriaGasto();

            $excluido =  isset($_POST['excluido']) ? "1" : "0";
            $salvo = $categGasto->insert($_POST["tipo"],  $excluido, $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de listagem
        $this->index();
    }

    public function update()
    {
        // se tivermos dados POST para criar uma nova entrada do cliente
        if (isset($_POST["submit_editcategoriagasto"])) {

            $categGasto = new CategoriaGasto();

            $excluido =  isset($_POST['excluido']) ? "1" : "0";
            $salvo = $categGasto->update($_POST["id"], $_POST["tipo"],  $excluido, $_SESSION['LOGIN']->id_conta);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }

    public function delete($categoria_id)
    {
        if (isset($categoria_id)) {

            $categGasto = new CategoriaGasto();

            $salvo = $categGasto->delete($categoria_id);

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao excluir, categoria em uso! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

         // redireciona para a pagina de listagem
         $this->index();
    }
}
