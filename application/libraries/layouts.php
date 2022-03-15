<?php 

class Layouts
{

  // hold codeigniter instance
	private $CI;

	// hold layout title
	private $layout_title = null;

	// hold description
	private $layout_description = null;

	// hold includes like css and js files
	private $includes = array(); 

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	// set layout title
	public function set_title($title)
	{
		$this->layout_title = $title;
	}

	// set layout description
	public function set_description($description)
	{
		$this->layout_description = $description;
	}

	// add includes like css and js
	public function add_include($path, $prepend_base_url = true)
	{
		if($prepend_base_url)
		{
			$this->CI->load->helper('url'); // just in case
			$this->includes[] = base_url() . $path;
		}
		else
		{
			$this->includes[] = $path;
		}

		return $this;
	}

	// print the includes
	public function print_includes()
	{
		$final_includes = '';

		foreach($this->includes as $include)
		{
			if (preg_match('/js$/', $include))
			{
				$final_includes .= '<script src="' . $include . '"></script>' . "\n\r";
			}
			elseif (preg_match('/css$/', $include))
			{
				$final_includes .= '<link href="' . $include . '" rel="stylesheet"/>' . "\n\r";
			}
		}

		return $final_includes;
	}

	// call the layouts view from the controller
	public function view($view_name, $layouts = array(), $params = array(), $default = true)
	{

		if (is_array($layouts) && count($layouts) >= 1)
		{

			foreach ($layouts as $layout_key => $layout)
			{

                $params[$layout_key] = $this->CI->load->view($layout, $params, true);

			}
                        
		}
               
		if ($default)
		{

			// set layout title
			$params['layout_title'] 	= $this->layout_title;

			// set layout description
			$params['layout_description']	= $this->layout_description;

			if($default == 'panel') {

			// Default header
			//$this->CI->load->view('layouts/header_panel', $params);

			// render view
			$this->CI->load->view($view_name, $params);
			
			// render footer
			//$this->CI->load->view('layouts/footer_panel');

			} else {

				// Default header
				//$this->CI->load->view('layouts/header_panel', $params);

				// render view
				$this->CI->load->view($view_name, $params);
				
				// render footer
				//$this->CI->load->view('layouts/footer_panel');

			}

		} 
		else 
		{

			// render view
			$this->CI->load->view($view_name, $params);

		}

	}

}

?>