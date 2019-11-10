    <section id="container">

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <h3><i class="fa fa-angle-right"></i> Usuário </h3>
                <div class="row">

                    <!--main content start-->
                    <!--<section id="main-content">-->
                    <section class="col-md-12">
                        <section class="wrapper">
                            <form class="form-horizontal style-form" id="form_usuario" action="<?php echo URL . "usuario/update"; ?>" method="POST">

                                <?php if (isset($this->msgTela)) { echo $this->msgTela; } ?>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label>Nome Completo:</label>
                                        <input type="text" value="<?php echo $retorno->nome_completo ?>" class="form-control" name="nome_completo" required>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label>e-mail:</label>
                                        <input type="email" value="<?php echo $retorno->email ?>" name="email" class="form-control" required>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label>Senha:</label>
                                        <input type="password" value="" name="senha" id="senha" class="form-control" required>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-6">
                                        <label>Confirmar Senha:</label>
                                        <input type="password" value="" name="senhaConfirma" id="senhaConfirma" class="form-control" required>
                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-sm-12">
                                        <label>Excluído?</label>
                                        <input class="new-checkbox" type="checkbox" name="excluido" <?php if (isset($checked)) echo $checked ?>>
                                    </div>
                                </div>

                                <input type='submit' value='Salvar' class='btn btn-success' name="submit_usuario" id="salvar_usuario">
                                <!-- <input type="button" onclick="location.href=' <?php echo URL . 'usuario'; ?>' " class="btn btn-danger" value="Voltar" /> -->
                                <input type="hidden" name="id" value="<?php echo $retorno->id; ?>" />

                            </form>
                        </section>


                    </section>


                </div>
                <!--row-->
            </section>
            <!--wrapper -->

        </section>
        <!--MAIN CONTENT-->

    </section>
