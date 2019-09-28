<?php

/**
 * Classe ProdutosController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;

class TimelineController
{

    public function index()
    {
        $dataInicial = date('Y-m-d', strtotime('first day of this month'));
        $dataFinal = date('Y-m-d', strtotime('last day of this month'));
        
        $gasto = new Gasto();
        $retorno = $gasto->getTimeline($dataInicial, $dataFinal, 1);

        require APP . 'view/timeline/index.php';
    }

}
