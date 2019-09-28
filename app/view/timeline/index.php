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

    echo "Seu Saldo em ". date('d-m-Y') . ": <b> R$ ". $saldoConta ."</b>"; 

?>
</h4>
</h4>

<ul class="timeline">

<?php

    $this->geraTimeline($retornoView);
    
?>
    

    <li class="clearfix no-float"></li>
</ul>

        </section>
    </section>
    <!--main content end-->
</section>