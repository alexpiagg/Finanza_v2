        <section id="container" >
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">

                    <h3><i class="fa fa-angle-right"></i> Cadastro Gasto </h3>
                    <div class="row">
                        
                        <!--main content start-->
                        <!--<section id="main-content">-->
                        <section class="col-md-12">
                            <section class="wrapper">
                                
                                <form class="form-horizontal style-form" action="<?php echo URL . $acao; ?>" method="POST">
                                    <div class="form-group">

                                        <legend>  </legend>
                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Data:</label>
                                            <div class="col-sm-2">
                                                <input type="date" value="<?php if(isset($retorno)) echo $retorno->data ?>" class="form-control" name="data" required>                                            
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Local:</label>
                                            <div class="col-sm-7">                                            
                                                <input type="text" maxlength="100" value="<?php if(isset($retorno)) echo  $retorno->local ?>" name="local" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Valor (R$):</label>
                                            <div class="col-sm-2">
                                                <input type="text" id="valor" value="<?php if(isset($retorno)) echo number_format($retorno->valor, 2, ',', '.') ?>" name="valor" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Categoria:</label>
                                            <div class="col-sm-2">
                                                <select name="tipoGasto" class="form-control">

                                                    <option value="0" name="tipoGasto"> Selecione: </option>

                                                        <?php
                                                            foreach ($listaTipoGastos as $tipo) {
                                                                $sel = "";

                                                                if (isset($retorno) && $tipo->id == $retorno->id_categoria_gasto)
                                                                    $sel = "selected";
                                                        ?>

                                                    <option value = <?php  echo $tipo->id  ?> name="tipo" <?php  echo $sel; ?>> <?php echo $tipo->tipo; ?> </option>
                                                    <?php  } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">                                        
                                            <label class="col-sm-1 col-sm-1 control-label">Cartão de Crédito?</label>
                                            <div class="col-sm-10">
                                                
                                                <input class="new-checkbox" type="checkbox" name="cartao_credito" <?php if(isset($checked)) echo $checked ?> >
                                            </div>                                            
                                        </div>
                                    </div>

                                    <input type='submit' value='Salvar' class='btn btn-success' name="submit_editgasto">
                                    <input type="button" onclick="location.href=' <?php echo URL .'gasto'; ?>' " class="btn btn-danger" value="Voltar" />
                                    <input type="hidden" name="id" value="<?php if(isset($retorno)) echo $retorno->id; ?>" />
                                </form>
                            </section>
                        </section>

                    </div><!--row-->
                </section><!--wrapper -->

            </section><!--MAIN CONTENT-->

        </section> 