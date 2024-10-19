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
        if($filename !== "login" && $filename !== "register"){
            include("pages/shared/".$this->header.".php");
            include("pages/shared/".$this->footer.".php"); 
        }

        include("pages/templates/".$this->filename.".php");
    }
}