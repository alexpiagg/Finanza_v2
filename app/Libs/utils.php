<?php

namespace Mini\Libs;

class Utils {
    
    public static function formatarMoeda($valor) {
        return number_format($valor, 2, ',', '.');
    }
    
    public static function listarMeses(){
        $listaMeses = array(
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        );

        return $listaMeses;
    }

    public static function isLogged(){
        session_start();
        if (!isset($_SESSION['LOGIN']))
        {
            header('location: ' . URL . 'login');
        }
    }

    public static function getPrimeiroNome($login)
    {
        $nomeCompleto = $login->nome_completo;
                
        $primeiroNome = explode(' ', $nomeCompleto, 2);
        $primeiroNome = $primeiroNome[0];
        
        return $primeiroNome;
    }

    public static function listarAnos(){
        $listaMeses = array(
            '1999',
            '2000',
            '2001',
            '2002',
            '2003',
            '2004',
            '2005',
            '2006',
            '2007',
            '2008',
            '2009',
            '2010',
            '2011',
            '2012',
            '2013',
            '2014',
            '2015',
            '2016',
            '2017',
            '2018',
            '2019',
            '2020',
            '2021',
            '2022'
        );

        return $listaMeses;
    }

    /*
    * Filtra o array pela chave e determinado valor
    */
    public static function filterArrayByValue($array, $index, $value){ 
    
        if(is_array($array) && count($array)>0)  
        { 
            foreach(array_keys($array) as $key){ 
                
                $temp[$key] = $array[$key][$index]; 
                
                if ($temp[$key] == $value){                                             
                    $newarray[$key] = $array[$key]; 
                } 
            } 
        }

        if (!isset($newarray)) {
            return null;
        }

        return $newarray;
    } 

    /*
    * Mensagem padronizadas
    */
    public static function getMessageSave($sucesso){
        $message = "";

        if ($sucesso){
            return $message = "<div class='alert alert-success'> Salvo com sucesso! </div>";
        }
        else{
            return $message = "<div class='alert alert-danger'> Erro ao salvar! </div>";
        }
    }
}
