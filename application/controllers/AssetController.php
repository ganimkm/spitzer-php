<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssetController extends MY_Controller {

	const VIEW_FOLDER = 'data';

	public function __construct()
    { 
        parent::__construct();

        $this->load->model('AssetModel');
    
    }
	
	public function index()
	{
		
		$data['assets'] = $this->AssetModel->get_assets();

		$data['custom_css'] = array('vendors/DataTables/datatables.min.css');
		$data['custom_js'] = array('vendors/DataTables/datatables.min.js');

		$this->layout['main'] = 'assets';
		$this->layouts->view('home',$this->layout,$data);

	}

	public function asset()
	{

		$asset_type = $this->uri->segment(2);
		$asset_id = $this->uri->segment(3);  

		$data['assets'] = $this->AssetModel->get_assets($asset_id);
		$data['monitor'] = $this->AssetModel->get_monitor($data['assets'][0]['name']);
		
		$data['custom_css'] = array('vendors/DataTables/datatables.min.css');
		$data['custom_js'] = array('vendors/DataTables/datatables.min.js');

		$this->layout['main'] = self::VIEW_FOLDER . '/' . $asset_type . '/view';
		$this->layouts->view('home',$this->layout,$data);

	}

	public function assets_snmp()
	{

		$data['assets'] = $this->AssetModel->get_snmp_assets();

		$data['custom_css'] = array('vendors/DataTables/datatables.min.css');
		$data['custom_js'] = array('vendors/DataTables/datatables.min.js');

		$this->layout['main'] = 'assets_snmp';
		$this->layouts->view('home',$this->layout,$data);

	}

}
