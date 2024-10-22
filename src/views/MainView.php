<?php

namespace views;

class MainView{
    private $header;
    private $filename;
    private $footer;

    public function __construct($filename,$header="header",$footer="footer")
    {
        $this->header = $header;
        $this->filename = $filename;
        $this->footer = $footer;        
    }

    public function render(array $data = []): void{
        extract($data);
        
        if (file_exists("src/views/shared/".$this->header.".php")) {
            include("src/views/shared/".$this->header.".php");
        }
        if (file_exists("src/views/shared/".$this->footer.".php")) {
            include("src/views/shared/".$this->footer.".php");
        }

        if (file_exists("src/views/templates/".$this->filename.".php")) {
            include("src/views/templates/".$this->filename.".php");
        } else {
            echo "Template não encontrado!";
        }
    }
}