    <section id="container">
    
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Relatórios > Por Categoria de Gastos</h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>relatorios/porCategoria/" method="POST">
                                <div class="form-group">

                                    <legend> Filtros: </legend>
                                    
                                    <div class="col-sm-4">
                                        <label>Data Início: </label>
                                        <input type="date" class="form-control" value=<?php echo isset($_SESSION["filtro_data_ini"]) ? $_SESSION["filtro_data_ini"] : date('Y-m-d'); ?> name="dataIni" required>

                                    </div>

                                    <div class="col-sm-4">
                                        <label>Data Fim:</label>
                                        <input type="date" class="form-control" value=<?php echo isset($_SESSION["filtro_data_fim"]) ? $_SESSION["filtro_data_fim"] : date('Y-m-d'); ?> name="dataFim">
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Categoria:</label>
                                        <select name="tipoGasto" class="form-control">
                                            <option value="0" name="tipoGasto"> Selecione: </option>                                           

                                            <?php foreach ($listaTipoGastos as $tipo) { ?>                                                
                                                    <option value= <?php echo $tipo->id ?> name="tipo"> <?php echo $tipo->tipo; ?> </option>;
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_porcategoria" >
                                        <input type="button" onclick="location.href=' <?php echo URL .'relatorios/limpar/1'; ?>' " class="btn btn-primary" value="Limpar" />
                                    </div>
                                </div>

                                <legend></legend>
                            </form>
                        </section>
                    </section>
                    <div class="col-md-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Resultados </h4>
                            <hr>

                        <?php

                            if (isset($retornoTotais) && count($retornoTotais) > 0) 
                            {

                                $id = 0;
                                $totalGeral = 0;
                        ?>
                                    <!-- /Preenche o efeito de accordion, para cada categoria -->
                                    <div id="accordion">

                                    <?php 
                                    foreach ($retornoTotais as $valor) 
                                    {
                                        ++$id;

                                        $totalGeral += $valor->total;
                                    ?>
                                        <h3> 
                                            <?php 
                                                echo $id  . "- " . $valor->tipo  ?> (R$ <?php echo number_format($valor->total, 2, ',', '.') ?> ) </h3>
                                            
                                            <div>
                                            <p>

                                        <!-- Inicio - Cabeçalho da table de detalhes -->
                                        <table class="table table-bordered table-striped table-condensed cf table-hover">
                                            <thead class="cf">
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Local</th>
                                                    <th class="numeric">Valor (R$)</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                        
                                        <?php foreach ($retornoDetalhe as $row) 
                                        {
                                                if ($row->id_categoria_gasto == $valor->id) 
                                                {
                                        ?>
                                                    <tr>
                                                        <td data-title="Code"> <?php echo date_format(date_create($row->data), 'd/m/Y') ?> </td>
                                                        <td data-title="Company"> <?php echo $row->local ?> </td>
                                                        <td class="numeric" data-title="Price"> <?php echo number_format($row->valor, 2, ',', '.') ?> </td>
                                                    </tr> 
                                        
                                                <?php 
                                                }                                                
                                        }  
                                        ?>

                                        <!-- Fim - Cabeçalho da table de detalhes -->
                                        </tbody>
                                        </table>

                                        </p>
                                            </div>
                                    <?php 
                                    }   
                                    ?>

                                    <h3> Total Geral:  </h3>
                                        <div>
                                            <p>
                                                R$ <?php echo number_format($totalGeral, 2, ',', '.') ?>
                                            </p>
                                        </div>
                                    </div>

                            <?php 
                            }
                            else 
                            { 
                                echo '0 Registro(s)';
                            }  
                            ?>

                        </div>
                        <!--/content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- row -->
            </section>
            <!--/wrapper -->

        </section><!-- /MAIN CONTENT -->
    </section>
