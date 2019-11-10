<?php

/**
 * Classe RptPorCategoriaController
 *
 */

namespace Mini\Controller;

use Mini\Model\Gasto;
use Mini\Model\TipoGasto;
use Mini\Model\Receita;
use Mini\Libs\Utils;
use Mini\Core\Controller;

class RelatoriosController extends Controller
{

    public function index()
    { }

    public function porCategoria()
    {
        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        if (isset($_POST["submit_porcategoria"])) {

            $gasto = new Gasto();

            $retornoDetalhe = $gasto->getRelPorCategoria($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
            $retornoTotais = $gasto->getGastosAgrupados($_POST['dataIni'], $_POST['dataFim'],  $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoria.php';
        require APP . 'view/_templates/footer.php';
    }

    public function porCategoriaGrafico()
    {
        $listaAnos = Utils::listarAnos();
        $listaMeses = Utils::listarMeses();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        if (isset($_POST["submit_porcategoriagrafico"])) {
            $gasto = new Gasto();

            $dataIni = $_POST['listaAno'] . '-' . $_POST['listaMes'] . '-' . '01';
            $dataFim = $_POST['listaAno'] . '-' . $_POST['listaMes'] . '-' . date('t', strtotime($dataIni));

            $retornoTotais = $gasto->getGastosAgrupados($dataIni, $dataFim, 0, $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoriaGrafico.php';
        require APP . 'view/_templates/footer.php';
    }

    public function porMes()
    {
        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $listaMeses = Utils::listarMeses();

        if (isset($_POST["submit_pormes"])) {

            $gasto = new Gasto();

            $retornoDados = $gasto->getGastosPorMeses($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porMes.php';
        require APP . 'view/_templates/footer.php';
    }

    public function porReceita()
    {
        $tipoGasto = new TipoGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        $listaMeses = Utils::listarMeses();

        if (isset($_POST["submit_porreceita"])) {

            $receita = new Receita();

            $retornoDados = $receita->getReceitasPorMeses($_POST['dataIni'], $_POST['dataFim'], $_POST['descricao'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porReceita.php';
        require APP . 'view/_templates/footer.php';
    }

    public function filterArrayByValue($dados, $mes)
    {
        return Utils::filterArrayByValue($dados, 'mes', $mes);
    }

    public function porTotais()
    {
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';

        //Total gasto mês Anterior
        $dataIni = date('Y-m-d', strtotime("first day of -1 month"));
        $dataFim = date('Y-m-d', strtotime("last day of -1 month"));
        
        $id_conta = $_SESSION['LOGIN']->id_conta;

        $parametros = array(
            'data_inicial' => $dataIni,
            'data_final' => $dataFim,
            'id_conta' => $id_conta
        );

        $gasto = new Gasto();

        $retornoDados = $gasto->getAll($parametros);
        $totalMesAnterior = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));

        //--------------------------------------------------------------------------------------

        //Total gasto mês Atual
        $dataIni = date('Y-m-d', strtotime('first day of this month'));
        $dataFim  = date('Y-m-d', strtotime('last day of this month'));

        $retornoDados = $gasto->getAll($parametros);
        $totalMesAtual = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));
        
        //--------------------------------------------------------------------------------------

        //Total gasto ano
        $dataIni = date('Y-01-01');;
        $dataFim  = date('Y-12-31');;

        $retornoDados = $gasto->getAll($parametros);
        $totalAno = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));

        //--------------------------------------------------------------------------------------

        //Total receita mês atual
        $receita = new Receita();
        $dataIni = date('Y-m-d', strtotime('first day of this month'));
        $dataFim  = date('Y-m-d', strtotime('last day of this month'));

        $parametros = array(
            'data_inicial' => $dataIni,
            'data_final' => $dataFim,
            'id_conta' => $id_conta
        );
        
        $retornoDados = $receita->getByFilter($parametros);
        $totalReceitaMesAtual = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));

        //--------------------------------------------------------------------------------------

        //Total receita ano
        $receita = new Receita();
        $dataIni = date('Y-01-01');
        $dataFim  = date('Y-12-31');

        $parametros = array(
            'data_inicial' => $dataIni,
            'data_final' => $dataFim,
            'id_conta' => $id_conta
        );

        $retornoDados = $receita->getByFilter($parametros);
        $totalReceitaAno = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));
        
        //--------------------------------------------------------------------------------------

        //Total na conta
        $totalConta = Utils::formatarMoeda($_SESSION['LOGIN']->valor);

        //--------------------------------------------------------------------------------------

        require APP . 'view/relatorios/porTotais.php';
        require APP . 'view/_templates/footer.php';
    }
}
