<?php

namespace Mini\Core;

use Mini\Libs\Utils;

class Controller
{
    
    /**
     * Sempre que o modelo for criado, abra uma conexão com o banco de dados.
     */
    function __construct()
    {
        Utils::isLogged();
    }
}
