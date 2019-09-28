<section id="container" >
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="assets/css/timeline.css" rel="stylesheet">


<h4>
<?php 

    echo "Seu Saldo em ". date('d-m-Y') . ": <b> R$ 100,00</b>"; 

?>
</h4>
</h4>

<ul class="timeline">

<?php

    $idx = 0;
    foreach ($retorno as $time){
        $tipo  = $time->tipo;
        $local = $time->descricao;
        $data  = $time->data;
        $valor = $time->valor;
        $box   = "";
        
        $seta = "fa-circle";
        if ($tipo == "RECEITA"){
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
                            <h4> ' . $tipo . ' </h4>                        
                        </div>
                        <div class="timeline-body">
                            <p>' 
                                .
                            '</p>
                            
                        </div>
                        <div class="timeline-footer">
                            <p class="text-right"></p>
                        </div>
                    </div>
                </li>';

    }
?>
    

    <li class="clearfix no-float"></li>
</ul>

        </section>
    </section>
    <!--main content end-->
</section>