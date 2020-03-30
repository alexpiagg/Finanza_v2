<?php

/**
 * Classe RptPorCategoriaController
 *
 */

namespace Mini\Controller;

use DateTime;
use Mini\Model\Gasto;
use Mini\Model\CategoriaGasto;
use Mini\Model\Receita;
use Mini\Libs\Utils;
use Mini\Core\Controller;

class RelatoriosController extends Controller
{

    public function index()
    { }

    public function porCategoria()
    {
        $tipoGasto = new CategoriaGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        Utils::writerHeader();

        if (isset($_POST["submit_porcategoria"])) {

            $this->manterFiltros($_POST['dataIni'], $_POST['dataFim']);
            
            $gasto = new Gasto();
            $retornoDetalhe = $gasto->getRelPorCategoria($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
            $retornoTotais = $gasto->getGastosAgrupados($_POST['dataIni'], $_POST['dataFim'],  $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoria.php';
        
        Utils::writerFooter();
    }

    public function porCategoriaGrafico()
    {
        $listaAnos = Utils::listarAnos();
        $listaMeses = Utils::listarMeses();

        Utils::writerHeader();

        if (isset($_POST["submit_porcategoriagrafico"])) {
            $gasto = new Gasto();

            $dataIni = $_POST['listaAno'] . '-' . $_POST['listaMes'] . '-' . '01';
            $dataFim = $_POST['listaAno'] . '-' . $_POST['listaMes'] . '-' . date('t', strtotime($dataIni));

            $retornoTotais = $gasto->getGastosAgrupados($dataIni, $dataFim, 0, $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porCategoriaGrafico.php';
        
        Utils::writerFooter();
    }

    public function porMes()
    {
        $tipoGasto = new CategoriaGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        Utils::writerHeader();

        $listaMeses = Utils::listarMeses();

        if (isset($_POST["submit_pormes"])) {

            $this->manterFiltros($_POST['dataIni'], $_POST['dataFim']);

            $gasto = new Gasto();

            $retornoDados = $gasto->getGastosPorMeses($_POST['dataIni'], $_POST['dataFim'], $_POST['tipoGasto'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porMes.php';
        
        Utils::writerFooter();
    }

    public function porReceita()
    {
        $tipoGasto = new CategoriaGasto();
        $listaTipoGastos = $tipoGasto->getAll();

        Utils::writerHeader();

        $listaMeses = Utils::listarMeses();

        if (isset($_POST["submit_porreceita"])) {

            $this->manterFiltros($_POST['dataIni'], $_POST['dataFim']);

            $receita = new Receita();

            $retornoDados = $receita->getReceitasPorMeses($_POST['dataIni'], $_POST['dataFim'], $_POST['descricao'], $_SESSION['LOGIN']->id_conta);
        }

        require APP . 'view/relatorios/porReceita.php';
        
        Utils::writerFooter();
    }

    public function filterArrayByValue($dados, $mes)
    {
        return Utils::filterArrayByValue($dados, 'mes', $mes);
    }

    public function porTotais()
    {
        Utils::writerHeader();

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

        $parametros = array(
            'data_inicial' => $dataIni,
            'data_final' => $dataFim,
            'id_conta' => $id_conta
        );

        $retornoDados = $gasto->getAll($parametros);
        $totalMesAtual = Utils::formatarMoeda(array_sum(array_column($retornoDados, 'valor')));
        
        //--------------------------------------------------------------------------------------

        //Total gasto ano
        $dataIni = date('Y-01-01');;
        $dataFim  = date('Y-12-31');;

        $parametros = array(
            'data_inicial' => $dataIni,
            'data_final' => $dataFim,
            'id_conta' => $id_conta
        );

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
      
        Utils::writerFooter();
    }

    public function limpar($tipo)
    {
        $_SESSION['filtro_data_ini'] = null;
        $_SESSION['filtro_data_fim'] = null;       

        switch ($tipo) {
            case 1:
                $this->porCategoria();
                break;
            case 2:
                $this->porMes();
                break;
            case 3:
                $this->porReceita();
                break;
        }
        
    }

    private function manterFiltros($dtInicio, $dtFim){
        $_SESSION["filtro_data_ini"] = $dtInicio;
        $_SESSION["filtro_data_fim"] = $dtFim;
    }
}
