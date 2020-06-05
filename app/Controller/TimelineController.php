<?php

namespace Mini\Controller;

use Mini\Model\Gasto;
use Mini\Model\Receita;
use Mini\Model\ContaPagar;
use Mini\Libs\Utils;

class TimelineController
{

    private $saldoConta;
    private $totalReceita;
    private $totalGasto;
    private $totalDespesas;
    private $listaTimeline;
    

    public function index()
    {
        require APP . 'view/timeline/index.php';
    }

    function totalizador(){
        //Variáveis iniciais
        $dataInicial = date('Y-m-d', strtotime('first day of this month'));
        $dataFinal = date('Y-m-d', strtotime('last day of this month'));
        $id_conta = $_SESSION['LOGIN']->id_conta;

        //Parâmetros para a query
        $parametros = array(
            'data_inicial' => $dataInicial,
            'data_final' => $dataFinal,
            'id_conta' => $id_conta
        );

        //Saldo conta corrente
        $login = $_SESSION['LOGIN'];
        $this->saldoConta = $login->valor;

        /**  GASTOS **/
        $gasto = new Gasto();

        $this->listaTimeline = $gasto->getTimeline($dataInicial, $dataFinal, 1);

        $retornoDados = $gasto->getAll($parametros);
        $this->totalGasto = array_sum(array_column($retornoDados, 'valor'));

        /**  RECEITAS **/
        $receita = new Receita();

        $retornoDados = $receita->getByFilter($parametros);
        $this->totalReceita = array_sum(array_column($retornoDados, 'valor'));


        /**  CONTA PAGAR **/
        $contaPagar = new ContaPagar();

        $listaContasPagar = $contaPagar->getByFilter(null, $_SESSION['LOGIN']->id_conta);

        foreach($listaContasPagar as $row){
            $this->totalDespesas += $row->valor * $row->quantidade;
        }
        
    }

    function geraHome()
    {
        $this->totalizador();
        $this->geraIndicadores();
        $this->geraTimeline();
    }

    function geraIndicadores(){

        echo 
        
        '   
            <div class="row mtbox">

                <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                    <div class="box1">
                        <span class="fa fa-plus-square"></span>
                        <h3>'. Utils::formatarMoeda($this->totalReceita) .'</h3>
                    </div>
                        <p>Receitas</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <span class="fa fa-minus-square"></span>
                        <h3>'. Utils::formatarMoeda($this->totalGasto) .'</h3>
                    </div>
                        <p>Gastos Efetuados</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <span class="fa fa-bank"></span>
                        <h3>'. Utils::formatarMoeda($this->saldoConta) .'</h3>
                    </div>
                        <p>Em conta</p>
                </div>
                <div class="col-md-2 col-sm-2 box0">
                    <div class="box1">
                        <span class="fa fa-calendar"></span>
                        <h3>'. Utils::formatarMoeda($this->totalDespesas) .'</h3>
                    </div>
                        <p>A Pagar</p>
                </div>    
            </div><!-- row mt --> '	;
    }

    function geraTimeline(){

        echo ' <div class="col-lg-8 col-md-offset-1 ds">
                <h2>        </h2>';

        if ($this->listaTimeline == null){
            return;
        }

        foreach ($this->listaTimeline as $detalhe){

            $icon = " fa fa-minus";
            if ($detalhe->tipo == "RECEITA") {
                $icon = " fa fa-plus";
            }

            echo '                                
                <div class="desc">
                    <div class="thumb">
                        <span class="badge bg-theme"><i class="' .$icon. '"></i></span>
                    </div>';
                   
            echo '<div class="details"> '
                            . '<p>' .  date( 'd-m-Y' , strtotime( $detalhe->data ) ) . '<br/>'
                            . '<a href="#"></a> R$ ' . Utils::formatarMoeda($detalhe->valor) . '<br/>'
                            .  $detalhe->tipo . ' - '
                            .  $detalhe->descricao . '<br/>'
                        . '</p>
                    </div>
                </div>  ';
        }

        echo '</div>';
        
    }
}
