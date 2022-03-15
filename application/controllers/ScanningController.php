<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScanningController extends MY_Controller {

	const VIEW_FOLDER = 'scanning';

	public function __construct()
    { 
        parent::__construct();

        $this->load->model('ScanningModel');
    
    }
	
	public function methods()
	{
	
		$data['custom_css'] = array();
		$data['custom_js'] = array();

		$this->layout['main'] = self::VIEW_FOLDER . '/methods';
		$this->layouts->view('home',$this->layout,$data);

	}

	public function credentials()
	{
	
		$data['custom_css'] = array('vendors/msdropdown/css/dd.css');
		$data['custom_js'] = array('vendors/msdropdown/js/jquery.dd.min.js');

		$this->layout['main'] = self::VIEW_FOLDER . '/credentials';
		$this->layouts->view('home',$this->layout,$data);

	}
}
