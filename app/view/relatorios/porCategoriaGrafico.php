<section id="container">
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <form class="form-horizontal style-form" action="<?php echo URL; ?>relatorios/porCategoriaGrafico/" method="POST">
                <h3><i class="fa fa-angle-right"></i> Relatórios > Por Categoria - Gráfico </h3>
                <div class="row">
                    <div class="col-lg-9 main-chart">

                        <div class="form-group">
                            <div class="col-sm-6">

                                <label>Mês:</label>
                                <select name="listaMes" class="form-control">
                                    <?php
                                        foreach ($listaMeses as $idx => $nome) {
                                            echo '<option value=' .  $idx . ' name="mes">' . $nome . '</option>';
                                        }
                                    ?>
                                </select>

                            </div>

                            <div class="col-sm-6">
                                <label>Ano:</label>
                                <select name="listaAno" class="form-control">
                                    <?php

                                    foreach ($listaAnos as $item) {
                                        echo '<option value=' . $item . ' name="ano">' . $item . '</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-default" value="Buscar" name="submit_porcategoriagrafico">
                            </div>
                        </div>

                        <legend></legend>

                    </div>
                    <!--/grey-panel-->
                </div>
                <!--col-md-4-->

                <div class="row mt">
                    <!--CUSTOM CHART START -->
                    <div class="border-head">
                        <h3>CATEGORIAS</h3>
                    </div>

                    <div class="custom-bar-chart">
                        <ul class="y-axis">
                            <li><span>2.000</span></li>
                            <li><span>1.600</span></li>
                            <li><span>1.200</span></li>
                            <li><span>800</span></li>
                            <li><span>400</span></li>
                            <li><span>0</span></li>
                        </ul>

                        <?php

                        if (isset($retornoTotais)) {

                            foreach ($retornoTotais as $valor) {
                                $tipo               = substr($valor->tipo, 0, 4);
                                $valorFormatado     = number_format($valor->total, 2, ',', '.');
                                $valor2             = floatval($valor->total);
                                $percentual         = intval(($valor2 / 2000) * 100);
                        
                        ?>
                                <div class='bar'>
                                    <div class='title'> <?php echo $tipo . "." ?> </div>
                                    <div class='value tooltips' data-original-title=<?php echo $valorFormatado ?> data-toggle='tooltip' data-placement='top'><?php echo  $percentual ?>%</div>
                                </div>
                        <?php
                            }

                        } 
                        ?>                        
                        
                    </div>
                     <!--custom chart end-->
                </div><!-- /row -->
            </form>
        </section>
    </section>
    <!--main content end-->
</section>
