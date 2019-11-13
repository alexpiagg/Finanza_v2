    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Lista de Categorias </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>categoria" method="POST">
                            
                                <?php if (isset($this->msgTela)) { echo $this->msgTela; } ?>

                                <div class="form-group">

                                    <legend> Filtros: </legend>

                                    <div class="col-md-9">
                                        <label> Descrição: </label>
                                        <input type="text" class="form-control" name="tipo">
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label> Ver Excluídos? </label>
                                        <input class="new-checkbox" type="checkbox" name="excluido">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_categoria">
                                    </div>
                                </div>
                            </form>
                            
                            <input type="button" onclick="location.href=' <?php echo URL .'categoria/edit'; ?>' " class="btn btn-success" value="Novo" />

                        </section>
                    </section>

                    <div class="col-md-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Resultados </h4>
                            <hr>

                           
                            <div>
                            <p>

                            <!-- Inicio - Cabeçalho da table de detalhes -->
                            <table class="table table-bordered table-striped table-condensed cf table-hover">
                                    <thead class="cf">
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Excluído?</th>
                                            <th class="numeric">#</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                            <!-- Imprimindo categorias -->
                            <?php foreach ($listaCategorias as $categ) { ?>

                                <tr>
                                    <td data-title='Company'> 
                                        <?php echo $categ->tipo; ?> 
                                    </td>

                                    <td data-title='numeric'> 
                                        <?php echo ($categ->excluido == 1 ? 'Sim' : 'Não'); ?> 
                                    </td>

                                    <td>
                                        
                                        <a title="Editar" class="btn btn-primary" href='<?php echo URL . 'categoria/edit/' .  $categ->id; ?>' role="button"><i class='fa fa-pencil'></i></a>

                                        <a title="Excluir" id="deletar" class="btn btn-danger" href='<?php echo URL . 'categoria/delete/' .  $categ->id; ?>' role="button"><i class='fa fa-trash-o'></i></a>

                                    </td>
                                </tr>
                            <?php } ?>

                            <!-- Fim - Cabeçalho da table de detalhes -->
                            </tbody>
                            </table>
                            </p>
                            </div>

                            </tbody>
                            </table>
                            
                        </div>
                        <!--content-panel-->
                    </div>
                    <!--col-md-12-->
                </div>
                <!--row -->
            </section>
            <!--/wrapper -->

        </section>
        <!--MAIN CONTENT -->

    </section>
