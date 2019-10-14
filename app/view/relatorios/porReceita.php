<!DOCTYPE html>
<html lang="pt-br">

<body>
    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Relatórios > Por Receitas </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>relatorios/porReceita/" method="POST">
                                <div class="form-group">

                                    <legend> Filtros: </legend>
                                    <div class="col-sm-4">
                                        <label>Data Início:</label>
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataIni" included>

                                    </div>

                                    <div class="col-sm-4">
                                        <label>Data Fim:</label>
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataFim">

                                    </div>

                                    <div class="col-sm-4">
                                        <label>Descrição:</label>
                                        <input type="text" class="form-control" value="" name="descricao">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_porreceita">
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

                            $id = 0;
                            $totalGeral = 0;

                            if (!empty($retornoDados)) {

                                //Preenche o efeito de accordion, para cada categoria
                                echo '<div id="accordion">';

                                foreach ($listaMeses as $mes => $nome) {

                                    //Filtra os dados o mês atual do loop
                                    $dadosMes = $this->filterArrayByValue($retornoDados, $mes);

                                    if ($dadosMes == null) {
                                        continue;
                                    }

                                    $total = array_sum(array_column($dadosMes, 'valor'));

                                    echo "<h3>" . $nome . " (R$ " . number_format($total, 2, ',', '.') . ") </h3>
                                                    <div>
                                                    <p>";

                                    //Inicio - Cabeçalho da table de detalhes
                                    echo '<table class="table table-bordered table-striped table-condensed cf table-hover">
                                                                    <thead class="cf">
                                                                    <tr>
                                                                        <th>Data</th>
                                                                        <th>Descrição</th>
                                                                        <th class="numeric">Valor (R$)</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>';

                                    //Imprimindo o detalhes de gastos
                                    foreach ($retornoDados as $row) {
                                        if ($row['mes'] == $mes) {
                                            echo '<tr>  
                                                                        <td data-title="Company">' . date_format(date_create($row['data']), 'd/m/Y') . '</td>                                                                      
                                                                        <td data-title="Company">' . $row["descricao"] . '</td>
                                                                        <td class="numeric" data-title="Price">' . number_format($row["valor"], 2, ',', '.') . '</td>
                                                                  </tr>';
                                        }
                                    }

                                    //Fim - Cabeçalho da table de detalhes
                                    echo '</tbody>
                                                        </table>';
                                    echo "</p>
                                                </div>";
                                }
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