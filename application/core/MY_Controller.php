<?php
	class MY_Controller extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			
			if (!$this->ion_auth->logged_in()) {
				redirect('auth/login');
			} 
			
		}
	}
?>

    