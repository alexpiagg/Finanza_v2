<?php

namespace Mini\Controller;

use Mini\Model\TipoGasto;
use Mini\Core\Controller;

class CategoriaController extends Controller
{
    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';
        
        $listaCategorias = array();
        if (isset($_POST["submit_categoria"])) {

            $tipoGasto = new TipoGasto();

            $excluido = isset($_POST['excluido']) ? "1" : "0";
            $listaCategorias = $tipoGasto->getByFilter($_POST['tipo'], isset($_POST['excluido']), $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/categoria/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function edit($categoria_id = 0){
        
        if (isset($categoria_id)) {
        
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

                $checked = $retorno->excluido == 0 || $retorno->excluido == null ? false : true;

                require APP . 'view/categoria/edit.php';

                require APP . 'view/_templates/footer.php';
            }
        } else {
            // redirecionar o usuário para a página de índice de categoria (pois não temos um categoria_id)
            header('location: ' . URL . 'categoria/index');
        }
    }
}
