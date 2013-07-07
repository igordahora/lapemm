<?php

/**
 * Class responsavel por montar o head da pagina
 *
 * @author igor
 */
class THeadHelper {

    private $title;
    private $icon;
    private $metaTag;
    private $css;
    private $javaScript;

    public function __construct() {
        $this->metaTag = array();
        $this->css = array();
        $this->javaScript = array();
    }

    /**
     * Definir titulo da pagina
     * @param type $title
     */
    public function setTitle($title) {
        $this->title = "<title>{$title}</title>";
    }

    /**
     * Definir o icone da pagina
     * @param type $location
     */
    public function setIcon($location) {
        $this->icon = "<link rel='shortcut icon' href='{$location}' type='image/x-icon' />";
    }

    /**
     * Verifia se meta já existe se não existir adicionar a metatag
     * @param type $meta
     */
    private function setMetaTag($meta) {
        if (!in_array($meta, $this->metaTag)) {
            $this->metaTag[] = $meta;
        }
    }

    /**
     * Adiciona meta tag keywords ao head - no caso de mais de uma palavra colocar virgula
     * @param type $keywords
     */
    public function addMetaKeyWords($keywords) {
        $this->setMetaTag("<META NAME='Keywords' CONTENT='{$keywords}'>");
    }

    /**
     * Adiciona meta tag description ao head
     * @param type $description
     */
    public function addMetaDescription($description) {
        $this->setMetaTag("<META NAME='Description' CONTENT='{$description}'>");
    }

    /**
     * Adiciona meta tag author ao head 
     * @param type $author
     */
    public function addMetaAuthor($author) {
        $this->setMetaTag("<META NAME='Author' CONTENT='{$author}'>");
    }

    /**
     * Adiciona meta tag language ao head
     * @param type $language
     */
    public function addMetaLanguage($language) {
        $this->setMetaTag("<meta http-equiv='content-language' content='{$language}'>");
    }

    /**
     * Adicionar CSS
     * @param type $location
     * @param type $priority
     */
    public function addCss($location, $priority = false) {

        $flag = ($priority == true) ? true : $priority;
        $css = "<link rel='stylesheet' type='text/css' href='{$location}' />";

        if ($flag) {
            if (!in_array($css, $this->css)) {
                array_unshift($this->css, $css);
            }
        } elseif (!$flag) {
            if (!in_array($css, $this->css)) {
                $this->css[] = $css;
            }
        }
    }

    /**
     * Adicionar JavaScrip
     * @param type $location
     * @param type $priority
     */
    public function addJavaScript($location, $priority = false) {

        # define a priority
        $flag = ($priority == true) ? true : $priority;
        $js = "<script language='javascript' src='{$location}'></script>";

        if ($flag) {
            if (!in_array($js, $this->javaScript)) {
                array_unshift($this->javaScript, $js);
            }
        } elseif (!$flag) {
            if (!in_array($js, $this->javaScript)) {
                $this->javaScript[] = $js;
            }
        }
    }

    public function getHead() {

        $head = "<head>";

        if ($this->title != null) {
            $head .= $this->title;
        }

        if ($this->icon != null) {
            $head .= $this->icon;
        }

        if (count($this->metaTag) != 0) {
            foreach ($this->metaTag as $metaTag) {
                $head .= $metaTag;
            }
        }

        if (count($this->css) != 0) {
            foreach ($this->css as $css) {
                $head .= $css;
            }
        }

        if (count($this->javaScript) != 0) {
            foreach ($this->javaScript as $js) {
                $head .= $js;
            }
        }
        
        $head .= "</head>";

        return $head;
    }

}

?>
