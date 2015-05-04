<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$user_id = $this->session->userdata('id_usuario');
		
		if(!$user_id){
			$this->logout();
		}
	}

	/**
	 * cargar index
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->load->view('dashboard/inc/header_view');
		$this->load->view('dashboard/dashboard_view');
		$this->load->view('dashboard/inc/footer_view');
	}

	/**
	 * funcion para salir de la app
	 * @return [type] [description]
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function usuarios(){
		$this->load->view('dashboard/usuarios_view');
	}
}


/*End file dashboard.php*/