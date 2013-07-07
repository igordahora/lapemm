<?php

/**
 * @Table = token
 */
class Token {

    /**
     * @Serial
     * @Colmap = ide_token
     */
    private $id;

    /**
     * @Colmap = des_token
     * @Persistence (type=texto,NotNull=true)
     */
    private $token;

    /**
     * @Colmap = data_validade
     * @Persistence (type=texto,NotNull=true)
     */
    private $dataValidade;

    /**
     * @Colmap = des_senha_autenticacao
     * @Persistence (type=senha,NotNull=true,MinSize=8,MaxSize=18,size=32)
     */
    private $senhaAutenticacao;

    /**
     * @Colmap = tentativas
     * @Persistence (type=inteiro)
     */
    private $tentativas;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDataValidade() {
        return $this->dataValidade;
    }

    public function setDataValidade($dataValidade) {
        $this->dataValidade = $dataValidade;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function getSenhaAutenticacao() {
        return $this->senhaAutenticacao;
    }

    public function setSenhaAutenticacao($senhaAutenticacao) {
        $this->senhaAutenticacao = $senhaAutenticacao;
    }

    public function getTentativas() {
        return $this->tentativas;
    }

    public function setTentativas($tentativas) {
        $this->tentativas = $tentativas;
    }

}

?>