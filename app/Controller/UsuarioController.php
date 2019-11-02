<?php

namespace Mini\Controller;

use Mini\Core\Controller;
use Mini\Model\Usuario;
use Mini\Libs\Utils;

class UsuarioController extends Controller
{

    public $msgTela;

    public function index()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $usuario = new Usuario();
        $retorno = $usuario->getId($_SESSION['LOGIN']->id_usuario);
        $checked = $retorno->excluido == 1 ? "checked" : "";

        require APP . 'view/usuario/index.php';
        require APP . 'view/_templates/footer.php';
    }

    public function update()
    {
        if (isset($_POST["submit_usuario"])) {
       
            $usuario = new Usuario();

            $excluido =  isset($_POST['excluido']) ? "1" : "0";
            $salvo = $usuario->update($_POST["id"], $_POST["nome_completo"],  $_POST["email"], $excluido, md5($_POST['senha']));

            $texto = $salvo ? "Salvo com sucesso :)" : "Ocorreu um erro ao salvar! :(";

            $this->msgTela = Utils::getMessageSave($salvo, $texto);
        }

        // redireciona para a pagina de index
        $this->index();

    }
}
