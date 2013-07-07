<?php

/**
 * @tutorial Classe responsavel por Converte e Calcular
 * datas no formato timestamp, data (dd/mm/aaaa) ou data (dd/mm/aaaa hh:mm:ss).
 * @package HELPERS
 * @author samuel
 */
class DataHelper {

    /**
     * @tutorial Verificar se o valor passado via parametro e um timestamp,
     *  converte para o formato de data formatada e retorna.
     * @param <timeStamp> $data
     * @param <inteiro> $retorno 
     * @return <data> (1)dataHora,(2)data,(3)dia,(4)mes,(5)ano,
     *                (6)dia na semana, (7) nome dia da semana,
     *                (8) nome do mes, (9) data extenso completa
     *                (0)default data
     */
    public static function timeStampParaData($data, $retorno = 0) {
        if (strlen($data) != 10)
            throw new Exception("A Data Informada não é um timestamp para a função");
        $data_unformat = $data;

        switch ($retorno) {
            case 1:
                $data_format = date('d/m/Y H:i:s', $data_unformat);
                break;
            case 2:
                $data_format = date('d/m/Y', $data_unformat);
                break;
            case 3:
                $data_format = date('d', $data_unformat);
                break;
            case 4:
                $data_format = date('m', $data_unformat);
                break;
            case 5:
                $data_format = date('Y', $data_unformat);
                break;
            case 6:
                $data_format = date('w', $data_unformat);
                break;
            case 7:
                $data_format = $this->diaSemanaExtenso(date('w', $data_unformat));
                break;
            case 8:
                $data_format = $this->mesExtenso(date('m', $data_unformat));
                break;
            case 9:
                $data_format = date('d', $data_unformat) . ' de ' . DataHelper::mesExtenso(date('m', $data_unformat)) . ' de ' . date('Y', $data_unformat);
                break;
            case 0:
                $data_format = date('d/m/Y', $data_unformat);
                break;
        }
        return $data_format;
    }

    /**
     * @tutorial Retorna o nome do dia da semana de acordo com posição.
     * Metodo utilizado pela metodo timeStampParaData
     * @access private
     * @param <inteiro> $dia
     * @return <string> dia por extenso
     * do dia passado
     */
    private static function diaSemanaExtenso($dia) {
        $diaExtenso = $dia;
        switch ($dia) {
            case 1:
                $diaExtenso = "Segunda - Feira";
                break;
            case 2:
                $diaExtenso = "Terça - Feira";
                break;
            case 3:
                $diaExtenso = "Quarta - Feira";
                break;
            case 4:
                $diaExtenso = "Quinta - Feira";
                break;
            case 5:
                $diaExtenso = "Sexta - Feira";
                break;
            case 6:
                $diaExtenso = "Sábado - Feira";
                break;
            case 7:
                $diaExtenso = "Domingo - Feira";
                break;
        }
        return $diaExtenso;
    }

    /**
     * @tutorial Retorna o nome do mês de acordo com o numero  passado.
     * Metodo utilizado pela metodo timeStampParaData
     * @access private
     * @param <inteiro> $mes
     * @return <string> Mes por Extenso
     */
    private static function mesExtenso($mes) {
        $mesExtenso = $mes;
        switch ($mes) {
            case 1:
                $mesExtenso = "Janeiro";
                break;
            case 2:
                $mesExtenso = "Fevereiro";
                break;
            case 3:
                $mesExtenso = "Março";
                break;
            case 4:
                $mesExtenso = "Abril";
                break;
            case 5:
                $mesExtenso = "Maio";
                break;
            case 6:
                $mesExtenso = "Junho";
                break;
            case 7:
                $mesExtenso = "Julho";
                break;
            case 8:
                $mesExtenso = "Agosto";
                break;
            case 9:
                $mesExtenso = "Setembro";
                break;
            case 10:
                $mesExtenso = "Outubro";
                break;
            case 11:
                $mesExtenso = "Novembro";
                break;
            case 12:
                $mesExtenso = "Dezembro";
                break;
        }
        return $mesExtenso;
    }

}

?>
