<?php

class RemessaHelper {

    public static function prepararCampo($dado, $tamanho, $tipo) {

        $campo = '';
        $comp = '';
        $campo.= $dado;

        if (strlen($dado) < $tamanho) {
            if ($tipo == 1) {
                for ($i = 0; $i < $tamanho - strlen($dado); $i++) {
                    $comp.=' ';
                }
                $campo.=$comp;
            } else if ($tipo == 0) {
                for ($i = 0; $i < $tamanho - strlen($dado); $i++) {
                    $comp.='0';
                }
                $campo = $comp . $campo;
            }
        } else {
            $campo = substr($campo, 0, $tamanho);
        }

        $campo = strtoupper($campo);
        return $campo;
    }

    public static function gerarRemessa() {
        
        $remessa = '';
        //---------------- >> HEADER <<-----------------------
        //Preenchimento -- Preencher com a constante "0000000"
        $remessa.= RemessaHelper::prepararCampo('', '7', 0);
        //Data_Remessa -- Formato (DDMMAAAA)
        $remessa.= date('dmY', time());
        //Nome_Arquivo -- Preencher com "MCIF460"
        $remessa.= RemessaHelper::prepararCampo('MCIF460', '8', 1);
        //C�digo_MCI -- C�digo MCI do Cliente no Banco
        $remessa.= RemessaHelper::prepararCampo('920517134', '9', 1);
        //N�mero_Processo -- N�mero do Processo
        $remessa.= RemessaHelper::prepararCampo('60967', '5', 1);




        //Sequencial_Remessa -- Sequencial da Remessa
        $remessa.= RemessaHelper::prepararCampo('00073', '5', 0);




        //Vers�o_Leiaute -- Vers�o do Leiaute - Preencher com informa��o fixa "04"
        $remessa.= '04';
        //Ag�ncia_Relacionamento -- Prefixo da Ag�ncia de Relacionamento
        $remessa.= RemessaHelper::prepararCampo('3832', '4', 1);
        //DV_Ag�ncia_Relacionamento -- DV do Prefixo da Ag�ncia de Relacionamento
        $remessa.= RemessaHelper::prepararCampo('6', '1', 1);
        //Conta -- Conta do Cliente
        $remessa.= RemessaHelper::prepararCampo('991012', '11', 0);
        //DV_Conta -- DV da Conta do Cliente
        $remessa.= RemessaHelper::prepararCampo('3', '1', 1);
        //Indicador_Envio_KIT -- Indicador de Envio do KIT - Preencher com informa��o fixa "1"
        $remessa.= '1';
        //Espa�os em Branco -- Preencher com ESPA�OS EM BRANCO
        $remessa.= RemessaHelper::prepararCampo('', '88', 1);
        //---------------- >> FIM DO HEADER <<-----------------------
        //CORTE---------------------------------------------------------------------------------------------
        $remessa.= "\n";

        //---------------- >> DETALHE <<-----------------------
        $detalhe = '';
        $seq = 1;
        for ($i = 0; $i < 10; $i++) {
            //Sequencial -- Sequencial
            $detalhe.= RemessaHelper::prepararCampo($seq, '5', 0);
            //Tipo_Detalhe -- Tipo do Detalhe - Preencher com a constante "01"
            $detalhe.= '01';

            //Tipo_Pessoa -- Tipo de Pessoa - VIDE TABELA
            $detalhe.= RemessaHelper::prepararCampo('3', '1', 1);
            //Tipo_CPF_CNPJ -- Tipo de CPF/CNPJ -Fixo "1" para CPF Pr�prio, ou "2" para CPF n�o Pr�prio, ou "3" para CNPJ
            $detalhe.= RemessaHelper::prepararCampo('3', '1', 1);


            //CPF/CNPJ -- CPF/CNPJ
            $detalhe.= RemessaHelper::prepararCampo("13832700000194", "14", 1);
            //Data_Nascimento -- Data de Nascimento - Formato (DDMMAAAA)
            $detalhe.= RemessaHelper::prepararCampo('28122006', '8', 1);
            //Nome_Cliente -- Nome do Cliente para quem a conta est� sendo aberta
            $detalhe.= RemessaHelper::prepararCampo('FMASALCOBACAPFMC', '60', 1);
            //Nome_Personalizado_Cliente -- Nome Personalizado do Cliente para quem a Conta est� sendo Aberta
            $detalhe.= RemessaHelper::prepararCampo('FMASALCOBACAPFMC', '25', 1);
            //Espa�os em Branco -- Preencher com ESPA�OS EM BRANCO
            $detalhe.= RemessaHelper::prepararCampo('', '1', 1);
            //Uso_Cliente -- "Espa�o de uso EXCLUSIVO do Cliente" --> Nosso Numero
            $detalhe.= RemessaHelper::prepararCampo('', '17', 1);
            //Ag�ncia_Cliente -- Prefixo da Ag�ncia onde a Conta est� sendo Aberta
            $detalhe.= RemessaHelper::prepararCampo('4492', '4', 1);
            //DV_Ag�ncia_Cliente -- DV do Prefixo da Ag�ncia onde a Conta est� sendo Aberta
            $detalhe.= RemessaHelper::prepararCampo('X', '1', 1);
            //Grupo_Setex -- Grupo Setex ao qual a Conta ser� Vinculada - Preencher com a constante "01"
            $detalhe.= "01";
            //DV_Grupo Setex -- DV do Grupo Setex ao qual a Conta ser� Vinculada - Preencher com a constante "9"
            $detalhe.= "9";
            //Natureza_Jur�dica -- Preencher com a constante "000"
            $detalhe.= "000";
            //C�digo_Repasse -- Tipo de Repasse - Fixo "01" para Volunt�rio/Conv�nio OU "02" para Autom�tico/Fundo a Fundo
            $detalhe.= RemessaHelper::prepararCampo('01', '2', 1);
            //C�digo_Programa -- C�digo do Programa - "Espa�o de uso EXCLUSIVO do Cliente"
            $detalhe.= RemessaHelper::prepararCampo('', '3', 1);
            //Entrada de Nova Linha
            $detalhe.= "\n";

            $seq++;
        }
        
        $remessa.= $detalhe;
        
        # limpar memoria
        unset($seq);
        unset($detalhe);
        
        //---------------- >> FIM DO DETALHE <<-----------------------
        //CORTE---------------------------------------------------------------------------------------------
        //---------------- >> TRAILER <<-----------------------

        $trailer = '';
        //Prenchimento -- Preencher com a constante "9999999"
        $trailer.= '9999999';
        //Prenchimento -- Toral de Clientes (registro de detalhe tipo 01)
        $trailer.= RemessaHelper::prepararCampo('20', '3', 0);
        //Quantidade_Registros -- Total de Registros (inclusive HEADER e TRAILER)
        $trailer.= RemessaHelper::prepararCampo('22', '9', 0);
        //Espa�os em Branco -- Preencher com ESPA�OS EM BRANCO
        $trailer.= RemessaHelper::prepararCampo('', '129', 1);

        $remessa.= $trailer;
        
        # limpar memoria
        unset($trailer);
        //---------------- >> FIM DO TRAILER <<-----------------------
        echo '<pre>';
        print_r($remessa);
    }

}

?>
