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

        $listaMeses = array();
        for ($ano = 1999; $ano <= 2025; $ano++ )
        {
            array_push($listaMeses, $ano);
        }

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
    public static function getMessageSave($sucesso, $texto){        
        if ($sucesso)
        {
            return $message = "<div class='alert alert-success'> $texto </div>";
        }
        else
        {
            return $message = "<div class='alert alert-danger'> $texto </div>";
        }
    }

    public static function writerHeader(){
        require APP . 'view/_templates/heade.php';
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/sidebar.php';
    }

    public static function writerFooter(){
        require APP . 'view/_templates/footer.php';
    }
}
