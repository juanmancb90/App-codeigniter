<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * clase del controlador home 
 */
class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * funcior para cargar el index
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->load->view('home/inc/header_view');
		$this->load->view('home/home_view');
		$this->load->view('home/inc/footer_view');
	}

	/**
	 * funcion que carga la vista registrar usuario
	 * @return [view [registrar_view]
	 */
	public function registrar()
	{
		$this->load->view('home/inc/header_view');
		$this->load->view('home/registrar_view');
		$this->load->view('home/inc/footer_view');
	}

}

/* fin file home.php*/
