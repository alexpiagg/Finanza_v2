<!DOCTYPE html>
<html lang="pt-br">

<body>
    <section id="container">
    
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Relatórios > Por Categoria </h3>
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
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataIni" required>

                                    </div>

                                    <div class="col-sm-4">
                                        <label>Data Fim:</label>
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataFim">
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Categoria:</label>
                                        <select name="tipoGasto" class="form-control">
                                            <option value="0" name="tipoGasto"> Selecione: </option>
                                            <?php

                                                foreach ($listaTipoGastos as $tipo) {
                                                    echo '<option value=' . $tipo->id . ' name="tipo">' . $tipo->tipo . '</option>';
                                                }
                                            
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_porcategoria" >
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

                            if (isset($retornoTotais) && count($retornoTotais) > 0) {

                                $id = 0;
                                $totalGeral = 0;

                                    //Preenche o efeito de accordion, para cada categoria
                                    echo '<div id="accordion">';

                                    foreach ($retornoTotais as $valor) {
                                        ++$id;

                                        $totalGeral += $valor->total;
                                        echo "<h3>" . $id . "- " . $valor->tipo . " (R$    " . number_format($valor->total, 2, ',', '.') . ") </h3>
                                            <div>
                                            <p>";

                                        //Inicio - Cabeçalho da table de detalhes
                                        echo '  <table class="table table-bordered table-striped table-condensed cf table-hover">
                                                    <thead class="cf">
                                                        <tr>
                                                            <th>Data</th>
                                                            <th>Local</th>
                                                            <th class="numeric">Valor (R$)</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>';

                                        //Imprimindo o detalhes de gastos
                                        foreach ($retornoDetalhe as $row) {

                                            if ($row->id_tipo_gasto == $valor->id) {
                                                echo 
                                                    '   <tr>
                                                            <td data-title="Code">' . date_format(date_create($row->data), 'd/m/Y') . '</td>
                                                            <td data-title="Company">' . $row->local . '</td>
                                                            <td class="numeric" data-title="Price">' . number_format($row->valor, 2, ',', '.') . '</td>
                                                        </tr> ';
                                            }
                                        }

                                        //Fim - Cabeçalho da table de detalhes
                                        echo '  </tbody>
                                            </table>';

                                        echo "</p>
                                            </div>";
                                    }
                                    
                                    echo "<h3> Total Geral:  </h3>
                                                <div>
                                                <p>
                                                    R$ " . number_format($totalGeral, 2, ',', '.') . "
                                                </p>
                                                </div>";

                                    echo "</div>";

                            } else {
                                echo '0 Registro(s)';
                            }

                            echo "</tbody>";
                            echo "</table>";                            
                        ?>

                        </div>
                        <!--/content-panel -->
                    </div><!-- /col-md-12 -->
                </div><!-- row -->
            </section>
            <!--/wrapper -->

        </section><!-- /MAIN CONTENT -->
    </section>
</body>

</html>