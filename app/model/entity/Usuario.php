<?php

/**
 * @Table = usuario
 */
class Usuario {

    /**
     * @Serial
     * @Colmap = ide_usuario
     */
    private $id;

    /**
     * @Serial
     * @Colmap = nom_usuario
     * @Persistence (type=texto,NotNull=true,MaxSize=80)
     */
    private $nome;

    /**
     * @Colmap = email
     * @Persistence (type=email,NotNull=true,MaxSize=120)
     */
    private $email;

    /**
     * @Colmap = des_senha
     * @Persistence (type=senha,NotNull=true,MinSize=8,MaxSize=18,size=32)
     */
    private $senha;

    /**
     * @Colmap = avatar
     * @Persistence (type=texto,MaxSize=115)
     */
    private $avatar;

    /**
     * @Colmap = ide_perfil
     * @Relationship (objeto=Perfil,type=OneToOne)
     * @Persistence (type=inteiro)
     */
    private $perfil;

    /**
     * @Colmap = num_acessos
     */
    private $acessos;

    /**
     * @Colmap = try_logon
     */
    private $tryLogon;

    /**
     * @Colmap = dat_try_logon
     * @Persistence (type=inteiro)
     */
    private $dataTryLogon;

    /**
     * @Colmap = dat_ultimo_acesso
     * @Persistence (type=inteiro)
     */
    private $dataUltimoAcesso;

    /**
     * @Colmap = ide_usuario_criador
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $idUsuarioCriador;

    /**
     * @Colmap = dat_criacao
     * @Persistence (type=inteiro,NotNull=true)
     */
    private $dataCriacao;

    /**
     * @Colmap = ide_usuario_atualizador
     * @Persistence (type=inteiro)
     */
    private $idUsuarioAtualizador;

    /**
     * @Colmap = dat_atualizacao
     * @Persistence (type=inteiro)
     */
    private $dataAtualizacao;

    /**
     * @Colmap = des_status
     * @Persistence (type=texto,size=1)
     */
    private $status;
    
    private $security;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function getPerfil() {
        return $this->perfil;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getAcessos() {
        return $this->acessos;
    }

    public function setAcessos($acessos) {
        $this->acessos = $acessos;
    }

    public function getTryLogon() {
        return $this->tryLogon;
    }

    public function setTryLogon($tryLogon) {
        $this->tryLogon = $tryLogon;
    }

    public function getDataTryLogon() {
        return $this->dataTryLogon;
    }

    public function setDataTryLogon($dataTryLogon) {
        $this->dataTryLogon = $dataTryLogon;
    }

    public function getDataUltimoAcesso() {
        return $this->dataUltimoAcesso;
    }

    public function setDataUltimoAcesso($dataUltimoAcesso) {
        $this->dataUltimoAcesso = $dataUltimoAcesso;
    }

    public function getIdUsuarioCriador() {
        return $this->idUsuarioCriador;
    }

    public function setIdUsuarioCriador($idUsuarioCriador) {
        $this->idUsuarioCriador = $idUsuarioCriador;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function setDataCriacao($dataCriacao) {
        $this->dataCriacao = $dataCriacao;
    }

    public function getIdUsuarioAtualizador() {
        return $this->idUsuarioAtualizador;
    }

    public function setIdUsuarioAtualizador($idUsuarioAtualizador) {
        $this->idUsuarioAtualizador = $idUsuarioAtualizador;
    }

    public function getDataAtualizacao() {
        return $this->dataAtualizacao;
    }

    public function setDataAtualizacao($dataAtualizacao) {
        $this->dataAtualizacao = $dataAtualizacao;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getSecurity() {
        return $this->security;
    }

    public function setSecurity($security) {
        $this->security = $security;
    }

}

?>
