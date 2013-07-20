<?php

class PublicacaoController extends TWin8 {

    private $logic;

    public function __construct() {
        parent::__construct();
        $this->logic = new PublicacaoLogic();
    }

    public function index() {
        $this->REDIRECT->goToAction('listar');
    }

    public function listar() {
        $this->addDados('toolbar', TWin8Helper::displayToolBar(array('novo')));
        $this->addDados("listPublicacao", $this->logic->listar(null, 'dataPublicacao', true));
        $this->TPageSecondary('lista');
    }

}

?>
