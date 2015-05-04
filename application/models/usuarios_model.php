<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* clase modelo de la BD
*/
class Usuarios_model extends CRUD_model
{
	protected $_tabla = 'usuarios';
	protected $_primary_key = 'id_usuario';

	public function __construct(){
		parent::__construct();
	}
}


/* end file usuarios_model.php*/