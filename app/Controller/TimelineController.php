<?php

/**
 * Classe ProdutosController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;
use Mini\Libs\Utils;

class TimelineController
{

    public function index()
    {
        $dataInicial = date('Y-m-d', strtotime('first day of this month'));
        $dataFinal = date('Y-m-d', strtotime('last day of this month'));
        
        $gasto = new Gasto();
        
        $retornoView = $gasto->getTimeline($dataInicial, $dataFinal, 1);
        
        $login = $_SESSION['LOGIN'];
        $saldoConta = Utils::formatarMoeda($login->valor);

        require APP . 'view/timeline/index.php';
    }
   
    function geraTimeline($dados){
        $idx = 0;

        foreach ($dados as $time){
            $box   = "";
            
            $seta = "fa-circle";
            if ($time->tipo == "RECEITA"){
                $seta = "fa-plus";
            }

            //Determinando se a caixa da timeline ficará na esq. ou direita        
            if ($idx & 1) {
                $box = '<li>
                            <div class="timeline-badge">
                            <a><i class="fa ' . $seta . '" id=""></i></a>
                        </div>';    
            }
            else{
                $box = '<li class="timeline-inverted">
                        <div class="timeline-badge">
                            <a><i class="fa ' . $seta . ' invert" id=""></i></a>
                        </div>';           
            }

            $idx++;

            echo    $box .
                    '   <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4> ' . $time->tipo . ' </h4>                        
                            </div>
                            <div class="timeline-body">
                                <p>' 
                                    //. $time->descricao . ' ( R$ ' . $time->valor .' )' .
                                    . $time->descricao . ' ( R$ ' . Utils::formatarMoeda($time->valor) .' )' .
                                    
                                '</p>
                                
                            </div>
                            <div class="timeline-footer">
                                <p class="text-right">' . date_format(date_create($time->data), 'd/m/Y') . '</p>
                            </div>
                        </div>
                    </li>';

        }
    }
}
