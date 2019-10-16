<!DOCTYPE html>
<html lang="pt-br">

<body>
    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Cadastro de Categorias </h3>
                <div class="row">

                    <?php
                      //echo $aviso 
                    ?>

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" action="<?php echo URL; ?>categoria/edit/" method="POST">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label class="col-sm-1 col-sm-1 control-label">Descrição:</label>
                                        <div class="col-sm-10">
                                            <input type="text" maxlength="100" value="<?php echo $retornoTipoGastos['tipo'] ?>" name="descricao" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-1 col-sm-1 control-label">Excluído?</label>
                                        <div class="col-sm-10">
                                            <input class="new-checkbox" type="checkbox" name="excluido" <?php echo ($retornoTipoGastos['excluido'] == null || $retornoTipoGastos['excluido'] == "0" ? "" : "checked") ?>>
                                        </div>
                                    </div>

                                </div>

                                <input type='submit' value='Salvar' class='btn btn-success' name="submit_editcategoria">
                                <input type="button" onclick="location.href = <?php echo URL; ?>'categoria' class="btn btn-danger" value="Voltar">
                            </form>
                        </section>
                    </section>

                </div>
                <!--row-->
            </section>
            <!--/wrapper-->

        </section>
        <!--MAIN CONTENT-->

    </section>
</body>

</html>