<?php

class FileHelper {
    
    protected $path = 'upload/';
    protected $file;
    protected $fileName;
    protected $fileTmpName;
    
    public function setPath($path){
        $this->path = $path;
    }
    
    public function setFile($file) {
        $this->file = $file;
        $this->setFileName();
        $this->setFileTmpName();
    }

    public function setFileName() {
        $this->fileName = $this->file['name'];
    }

    public function setFileTmpName() {
        $this->fileTmpName = $this->file['tmp_name'];
    }

    public function upload(){
        if(move_uploaded_file($this->fileTmpName, $_SERVER['DOCUMENT_ROOT'] . $this->path .$this->fileName)){
            return true;
        }else{
            return false;
        }
    }
    
    public function carregarImagemTemporaria(){
        
    }
    
}

?>
