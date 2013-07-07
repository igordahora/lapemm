<?php

/**
 * @author Igor da Hora <igordahora@gmail.com>
 * Class de criação de paginação
 */
class TPaginacaoHelper {

    private $_totalRegistros; // total de registros
    private $_resultadoPorPagina; // total de resultados por pagina
    private $_numeroDePaginas; // numero de paginas
    private $_inicio; // Primeira linha a ser mostrada
    private $_paginaAtual;
    private $_linkPage; //array de links

    public function __construct($totalRegistros, $pagina = null) {
        $this->setResultadoPorPagina(LIMIT);
        $this->_totalRegistros = $totalRegistros;
        $this->_numeroDePaginas = ceil($totalRegistros / $this->_resultadoPorPagina);
        $this->_paginaAtual = ($pagina != null) ? $pagina : 0;
        $this->_inicio = ($pagina != null) ? $this->_paginaAtual * $this->_resultadoPorPagina : 0;
    }

    private function setResultadoPorPagina($nResulatados) {
        $this->_resultadoPorPagina = $nResulatados;
    }

    public function getInicio() {
        return $this->_inicio;
    }

    #pegar o controller que estar sendo usado

    private function getCurrentController() {
        global $start;
        return $start->_controller;
    }

    #pegar o action que estar sendo usado

    private function getCurrentAction() {
        global $start;
        return $start->_action;
    }

    public function getPaginacao() {
        
        $pagina = ($this->_paginaAtual > 5) ? ($this->_paginaAtual - 5): 0 ;
        for ($i = 0; $i <= 9; $i++) {
            $this->addPage($pagina);
            $pagina++;
        }

        $html = "<div style='margin-top:20px;'>";

        if ($this->_numeroDePaginas > 1) {

            #exibir link para pagina anterior
            if ($this->_paginaAtual > 0) {
                $nPage = $this->_paginaAtual - 1;
                $html.= "<div style='float: left;padding:5px;'>
                            <a href='" . PATH_URL . 'index.php?' . "{$this->getCurrentController()}/{$this->getCurrentAction()}/page/{$nPage}'>Anterior</a>
                        </div>";
            }

            #listar link das paginas
            foreach ($this->_linkPage as $value) {
                $html.= $value;
            }

            #exibir link para proxima pagina
            if ($this->_paginaAtual < ($this->_numeroDePaginas - 1) && $this->_paginaAtual >= 0) {
                $nPage = $this->_paginaAtual + 1;
                $html.= "<div style='float: left;padding:5px;'>
                            <a href='" . PATH_URL . 'index.php?' . "{$this->getCurrentController()}/{$this->getCurrentAction()}/page/{$nPage}'>Proxima</a>
                        </div>";
            }
        }

        $numeroDaPagina = ($this->_numeroDePaginas == 0) ? 1 : $this->_numeroDePaginas - 1;
        $html.= "<div style='float: right;padding:5px;'>Pagina {$this->_paginaAtual} de {$numeroDaPagina}</div>";
        $html.= "<div id='clear'></div>";

        $html.= "</div>";

        return $html;
    }

    private function addPage($nPage) {

        #estilo para ser aplicado na pagina atual
        $style = ($this->_paginaAtual == $nPage) ? "style='color: white;background: #004000;padding:5px;'" : "";
        
        #add o link da pagina ao array linkPage[]
        $this->_linkPage[] = "<div  style='float: left; padding:5px;'>
                                    <a href='" . PATH_URL . 'index.php?' . "{$this->getCurrentController()}/{$this->getCurrentAction()}/page/{$nPage}' {$style}>$nPage</a>
                                </div>";
    }

}

?>