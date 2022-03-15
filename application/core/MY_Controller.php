<?php

class MY_Controller Extends CI_Controller
{
    public $layout = array('header'=> 'layouts/header','top_navbar'=>'layouts/top_navbar','custom_css'=>'layouts/custom_css','custom_js'=>'layouts/custom_js','footer'=> 'layouts/footer','main'=> 'errors/cli/error_404.php');

    public function __construct()
    {
             
        parent::__construct();
         
    }
    
}