<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    { 
        parent::__construct();

        $this->load->model('AssetModel');
    
    }
	
	public function index()
	{
		//$this->load->view('welcome_message');

		$data['assets'] = $this->AssetModel->get_assets();

		$data['custom_css'] = array('vendors/DataTables/datatables.min.css');
		$data['custom_js'] = array('vendors/DataTables/datatables.min.js');

		$this->layout['main'] = 'assets';
		$this->layouts->view('home',$this->layout,$data);

	}

	public function asset()
	{

		$asset_id = $this->uri->segment(2);  

		$data['assets'] = $this->AssetModel->get_assets($asset_id);
		
		$data['custom_css'] = array('vendors/DataTables/datatables.min.css');
		$data['custom_js'] = array('vendors/DataTables/datatables.min.js');

		$this->layout['main'] = 'asset_data';
		$this->layouts->view('home',$this->layout,$data);



	}

}
