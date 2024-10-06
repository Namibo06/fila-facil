<?php

namespace views;

class MainView{
    private $header;
    private $filename;
    private $footer;

    public function __construct($header="header",$filename,$footer="footer")
    {
        $this->header = $header;
        $this->filename = $filename;
        $this->footer = $footer;        
    }

    public function render($data = []){
        extract($data);
        include("pages/shared/".$this->header.".php");
        include("pages/templates/".$this->filename.".php");
        include("pages/shared/".$this->footer.".php");
    }
}