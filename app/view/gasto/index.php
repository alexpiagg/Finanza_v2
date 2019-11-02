<!DOCTYPE html>
<html lang="pt-br">

<body>
    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Lista de Gastos </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" method="post" action="gasto">

                                <div class="form-group">
                                    <?php if (isset($this->msgTela)) {
                                        echo $this->msgTela;
                                    } ?>

                                    <legend> Filtros: </legend>

                                    <div class="col-sm-4">
                                        <label>Data Início: </label>
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataIni" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Data Fim:</label>
                                        <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataFim" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Categoria:</label>
                                        <select name="tipoGasto" class="form-control">
                                            <option value="0"> Selecione: </option>
                                            <?php
                                            foreach ($listaTipoGastos as $tipo) {
                                                echo '<option value=' . $tipo->id . ' name="tipoGasto">' . $tipo->tipo . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <label class="">Descrição:</label>
                                        <input type="text" class="form-control" name="local">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_gasto">
                                    </div>
                                </div>

                                <legend></legend>

                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <input type="button" onclick="location.href=' <?php echo URL . 'gasto/edit'; ?>' " class="btn btn-success" value="Novo" />
                                    </div>
                                </div>

                            </form>

                        </section>
                    </section>

                    <div class="col-md-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Gastos </h4>
                            <hr>

                            <div>
                                <p>
                                    <table class="table table-bordered table-striped table-condensed cf table-hover">
                                        <thead class="cf">
                                            <tr>
                                                <th>Data</th>
                                                <th>Local</th>
                                                <th class="numeric">Valor (R$)</th>
                                                <th class="hidden-phone">C. Crédito?</th>
                                                <th class="numeric">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($listaGastos as $gasto) { ?>

                                                <tr>
                                                    <td data-title='Code'> <?php echo date_format(date_create($gasto->data), 'd/m/Y') ?> </td>
                                                    <td data-title='Company'> <?php echo $gasto->local ?> </td>
                                                    <td class='numeric' data-title='Price'> <?php echo number_format($gasto->valor, 2, ',', '.') ?> </td>
                                                    <td class='hidden-phone'> <?php echo ($gasto->cartao_credito == 0 ? "Não" : "Sim") ?> </td>
                                                    <td>
                                                        <a title="Editar" class="btn btn-primary btn-xs" href='<?php echo URL . 'gasto/edit/' .  $gasto->id; ?>' role="button"><i class='fa fa-pencil'></i></a>

                                                        <a title="Excluir" id="deletar" class="btn btn-danger btn-xs" href='<?php echo URL . 'gasto/delete/' .  $gasto->id; ?>' role="button"><i class='fa fa-trash-o'></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </p>
                            </div>
                            </tbody>
                            </table>

                        </div>
                        <!--content-panel-->
                    </div>
                    <!--col-md-12 -->
                </div>
                <!--row -->
            </section>
            <!--wrapper-->

        </section>
        <!--MAIN CONTENT -->

    </section>
</body>

</html>