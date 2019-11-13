    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Lista de Receitas </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>receita" method="POST">

                                <?php if (isset($this->msgTela)) {
                                    echo $this->msgTela;
                                } ?>

                                <div class="form-group">

                                    <legend> Filtros: </legend>

                                    <div class="col-sm-3">
                                        <label>Data Início:
                                            <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataIni" required>
                                        </label>
                                    </div>

                                    <div class="col-sm-3">
                                        <label>Data Fim:
                                            <input type="date" class="form-control" value=<?php echo date("Y-m-d") ?> name="dataFim" required>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label>Descrição:</label>
                                        <input type="text" class="form-control" name="descricao">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">                                        
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_receita">
                                    </div>
                                </div>

                                <input type="button" onclick="location.href=' <?php echo URL .'receita/edit'; ?>' " class="btn btn-success" value="Novo" />
                            </form>
                        </section>
                    </section>
                    <div class="col-md-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Resultados </h4>
                            <hr>

                            <div>
                                <p>

                                    <table class="table table-bordered table-striped table-condensed cf table-hover">
                                        <thead class="cf">
                                            <tr>
                                                <th>Data</th>
                                                <th>descricao</th>
                                                <th class="numeric">Valor (R$)</th>
                                                <th class="numeric">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($retorno as $row) { ?>

                                                <tr>
                                                    <td data-title='Code'> <?php echo date_format(date_create($row->data), 'd/m/Y'); ?> </td>
                                                    <td data-title='Company'> <?php echo $row->descricao; ?> </td>
                                                    <td class='numeric' data-title='Price'> <?php echo number_format($row->valor, 2, ',', '.'); ?> </td>
                                                    <td>

                                                        <a title="Editar" class="btn btn-primary btn-xs" href='<?php echo URL . 'receita/edit/' .  $row->id; ?>' role="button"><i class='fa fa-pencil'></i></a>
                                                        <a title="Excluir" id="deletar" class="btn btn-danger btn-xs" href='<?php echo URL . 'receita/delete/' .  $row->id; ?>' role="button"><i class='fa fa-trash-o'></i></a>
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
                        <!--content-panel -->
                    </div>
                    <!--col-md-12 -->
                </div><!-- row -->
            </section>
            <!--wrapper -->

        </section>
        <!--MAIN CONTENT-->

    </section>
