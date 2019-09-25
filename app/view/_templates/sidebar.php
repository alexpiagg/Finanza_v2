<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <!--
            <p class="centered"><a href="index.php"><img src="assets/img/dollar_sign.jpg" class="img-rounded" width="60"></a></p>
            -->
            
            <?php       
                $nomeCompleto = $login->nome_completo;
                
                $primeiroNome = explode(' ', $nomeCompleto, 2);
                $primeiroNome = $primeiroNome[0];
                echo "<h5 class='centered'> Olá, " . $primeiroNome . "</h5>";
            ?>

            <!--Principal-->
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-cogs"></i>
                    <span>Relatórios</span>
                </a>
                <ul class="sub">
                    <li><a  href="frmRelPorCategoria.php">Por Categoria</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="frmRelPorCategoriaGrafico.php">Por Categoria - Gráfico</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="frmRelPorMes.php">Por Mês</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="frmRelPorReceita.php">Por Receita</a></li>
                </ul>
                <ul class="sub">
                    <li><a  href="frmRelPorTotais.php">Por Totais</a></li>
                </ul>                
            </li>

            <!--Cadastros-->
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-list-alt"></i>
                    <span>Cadastros</span>
                </a>
                    <ul class="sub">
                        <li><a  href="frmListarTipoGastos.php">Categorias</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a  href="frmCadContas.php?acao=UPDATE">Conta</a></li>
                    </ul>                    
                    <ul class="sub">
                        <li><a  href="frmListarGastos.php">Despesas</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a  href="frmCadUsuarios.php">Perfil</a></li>
                    </ul>                    
                    <ul class="sub">
                        <li><a  href="frmListarProjecaoGastos.php">Projeção Despesas</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a  href="frmListarReceitas.php">Receitas</a></li>
                    </ul>                    
            </li>

            <!--Ferrament   as-->
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-wrench"></i>
                    <span>Ferramentas</span>
                </a>
                    <ul class="sub">
                        <li><a  href="frmImportarGastos.php">Importar Gastos</a></li>
                    </ul>
            </li>            
            
            <!--Sobre-->
            <li class="sub-menu">
                <a href="javascript:;" >
                    <i class="fa fa-hand-o-right"></i>
                    <span>Help</span>
                </a>
                    <ul class="sub">
                        <li><a  href="frmSobre.php">Sobre</a></li>
                    </ul>
            </li>         
            
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->