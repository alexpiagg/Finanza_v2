    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Lista de Contas a Pagar </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>contaPagar" method="POST">

                                <?php if (isset($this->msgTela)) {
                                    echo $this->msgTela;
                                } ?>

                                <div class="form-group">

                                    <legend> Filtros: </legend>

                                    <div class="col-md-12">
                                        <label> Descrição: </label>
                                        <input type="text" class="form-control" name="descricao">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-default" value="Buscar" name="submit_contapagar">
                                    </div>
                                </div>
                                <input type="hidden" name="buscar" value="buscar">
                            </form>

                            <a href='<?php echo URL .'contaPagar/edit'; ?>' class='botao-flutuante'>
                                <i style="margin-top:16px" class="fa fa-plus"></i>
                            </a>

                        </section>
                    </section>

                    <div class="col-md-12">
                        <div class="content-panel">
                            <h4><i class="fa fa-angle-right"></i> Resultados </h4>
                            <hr>


                            <div>
                                <p>

                                    <!--Inicio - Cabeçalho da table de detalhes-->
                                    <table class='table table-bordered table-striped table-condensed cf table-hover'>
                                        <thead class='cf'>
                                            <tr>
                                                <th>Descrição</th>
                                                <th>Data Vencto.</th>
                                                <th>Qtde.</th>
                                                <th>Valor</th>
                                                <th>Total</th>
                                                <th class="numeric">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($retornoProjecaoGasto as $retorno) { ?>

                                            
                                            <tr>
                                                <td data-title='Company'> <?php echo $retorno->descricao  ?>  </td>
                                                <td data-title='Code'> <?php if (isset($retorno->data_vencto)) echo date_format(date_create($retorno->data_vencto), 'd/m/Y'); ?> </td>
                                                <td data-title='numeric'> <?php echo $retorno->quantidade  ?> </td>
                                                <td data-title='numeric'> <?php echo number_format($retorno->valor, 2, ',', '.') ?> </td>
                                                <td data-title='numeric'> <?php echo number_format($retorno->valor * $retorno->quantidade, 2, ',', '.') ?> </td>
                                                <td>

                                                    <a title="Editar" class="btn btn-primary btn-xs" href='<?php echo URL . 'contaPagar/edit/' .  $retorno->id; ?>' role="button"><i class='fa fa-pencil'></i></a>

                                                    <a title="Excluir" id="deletar" class="btn btn-danger btn-xs" href='<?php echo URL . 'contaPagar/delete/' .  $retorno->id; ?>' role="button"><i class='fa fa-trash-o'></i></a>

                                                </td>
                                            </tr>
                                        
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </p>
                            </div>
                            </tbody>
                            </table>

                            <div class='row'>
                                <div class='col-sm-2'>
                                    <label class="col-sm-2">R$ Conta:</label>
                                    <input type='text' value= <?php if (isset($totalConta)) echo number_format($totalConta, 2, ',', '.'); ?> class='form-control' name='totalGeral' readonly>
                                </div>

                                <div class='col-sm-2'>
                                    <label class="col-sm-2">R$ Despesas</label>
                                    <input type='text' value= <?php if (isset($totalDespesas)) echo number_format($totalDespesas, 2, ',', '.'); ?> class='form-control' name='totalGeral' readonly>
                                </div>

                                <div class='col-sm-2'>
                                    <label class="col-sm-2">R$ Saldo</label>
                                    <input type='text' value= <?php if (isset($saldo)) echo number_format($saldo, 2, ',', '.'); ?> class='form-control' name='totalGeral' readonly>
                                </div>
                            </div>

                        </div>
                        <!--content-panel-->
                    </div>
                    <!--col-md-12 -->
                </div>
                <!--row -->
            </section>
            <!--wrapper-->

        </section><!-- /MAIN CONTENT -->

    </section>
