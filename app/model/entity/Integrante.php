<?php

/**
 * @Table = integrante
 */
class Integrante {
    /**
     * @Serial
     * @Colmap = ide_integrante
     */
    private $id;

    /**
     * @Colmap = num_cpf
     * @Mask = cpf
     * @Persistence (type=cpf,NotNull=true,MaxSize=11)
     */
    private $cpf;

    /**
     * @Colmap = nom_integrante
     * @Persistence (type=texto,NotNull=true,MaxSize=120)
     */
    private $nome;

    /**
     * @Colmap = dat_nascimnto
     * @Mask = data
     * @Persistence (type=data,size=8)
     */
    private $dataNascimento;

    /**
     * @Colmap = des_email
     * @Persistence (type=email,NotNull=true,MaxSize=120)
     */
    private $email;

    /**
     * @Colmap = des_lattes
     * @Persistence (type=texto,MaxSize=150)
     */
    private $lattes;

    /**
     * @Colmap = ide_titulacao
     * @Persistence (type=inteiro)
     * @Relationship (objeto=Titulacao,type=OneToOne)
     */
    private $titulacao;

    /**
     * @Colmap = nom_foto
     * @Persistence (type=texto,MaxSize=115)
     */
    private $foto;

    /**
     * @Colmap = des_telefone
     * @Mask = telefone
     * @Persistence (type=telefone)
     */
    private $numeroTelefone;

    /**
     * @Colmap = des_celular
     * @Mask = telefone
     * @Persistence (type=telefone)
     */
    private $numeroCelular;

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
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getLattes() {
        return $this->lattes;
    }

    public function setLattes($lattes) {
        $this->lattes = $lattes;
    }

    public function getTitulacao() {
        return $this->titulacao;
    }

    public function setTitulacao($titulacao) {
        $this->titulacao = $titulacao;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function getNumeroTelefone() {
        return $this->numeroTelefone;
    }

    public function setNumeroTelefone($numeroTelefone) {
        $this->numeroTelefone = $numeroTelefone;
    }

    public function getNumeroCelular() {
        return $this->numeroCelular;
    }

    public function setNumeroCelular($numeroCelular) {
        $this->numeroCelular = $numeroCelular;
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

}

?>
