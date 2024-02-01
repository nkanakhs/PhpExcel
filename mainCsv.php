<?php

require 'CsvProcessor.php';

class mainCsv {

    public $name;

    public $obj;

    public function __construct()
    {   
    
        $this->obj =  new CsvProcessor();
        $this->obj->readfiles();
        $this->name = readline("Please enter the name of the person you are looking:");
        $this->obj->SearchForName($this->name);
        
    }
    
}

$run = new mainCsv();

?>