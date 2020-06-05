<section id="container" >
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<h4>
<?php 

    echo "Hoje é: ". date('d-m-Y'); 

?>
</h4>
</h4>

<ul class="timeline">

<?php

    $this->geraHome();
    
?>
    

    <li class="clearfix no-float"></li>
</ul>

        </section>
    </section>
    <!--main content end-->
</section>

