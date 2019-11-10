<!DOCTYPE html>
<html lang="pt-br">

    <body>
        <section id="container" >

            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">

                    <h3><i class="fa fa-angle-right"></i> Conta </h3>
                    <div class="row">

                        <!--main content start-->
                        <!--<section id="main-content">-->
                        <section class="col-md-12">
                            <section class="wrapper">
                                <form class="form-horizontal style-form" action="<?php echo URL; ?>conta/update" method="POST">
                                
                                    <?php if (isset($this->msgTela)) { echo $this->msgTela; } ?>

                                    <div class="form-group">
                                        
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Nro. Conta:</label>
                                            <div class="col-sm-4">                                            
                                                <input type="contaid" value="<?php echo $retorno->id ?>" name="contaid" class="form-control" readOnly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Descrição:</label>
                                            <div class="col-sm-4">
                                                <input type="text" value="Conta Corrente - Finanza" class="form-control" name="conta" readOnly>                                            
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 col-sm-1 control-label">Valor (R$):</label>
                                            <div class="col-sm-2">                                            
                                                <input type="text" id="valor" value="<?php echo number_format($retorno->valor, 2, ',', '.') ?>" name="valor" class="form-control" required>
                                            </div>
                                        </div>

                                    </div>
                                    <input type="hidden" name="id" value= "<?php echo $retorno->id ?>" >
                                    
                                    <input type="submit" class="btn btn-success" value="Salvar" name="submit_conta" />

                                </form>
                            </section>
                        </section>

                    </div><!--row-->
                </section><!--/wrapper-->

            </section><!--MAIN CONTENT-->

        </section> 
    </body>    
    
</html>