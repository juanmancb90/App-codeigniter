<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* clase del controlador test
*/
class Test extends CI_Controller
{
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuarios_model');
	}

	/*test function */
	/**
	 * funcion para consutar  datos
	 * @return [type] [description]
	 */
	public function get_test($userId)
	{
		$data = $this->Usuarios_model->get($userId);
		print_r($data);

		$this->output->enable_profiler();
	}

	/**
	 * funcion para insertar datos
	 * @return [type] [description]
	 */
	public function insert_test()
	{
		$data = array('login' => 'my user', 
					  'password' => '123',
					  'email' => 'correo@correo.com',);

		$result = $this->Usuarios_model->insert($data);

		print $result;
	}

	/**
	 * funcion para actualizar datos
	 * @return [type] [description]
	 */
	public function update_test()
	{
		$data = array('login' => 'funcionario',);
		$userId = 3;

		$result = $this->Usuarios_model->update($data, $userId);

		print $result;
	}

	/**
	 * funcion para eliminar  datos
	 * @return [type] [description]
	 */
	public function delete_test($userId)
	{
		$result = $this->Usuarios_model->delete($userId);

		print $result;
	}

	/**
	 * funcion test de funciones de la clase database class codeigniter
	 * @return [type] [description]
	 */
	public function test()
	{
		/*select*/
		//select con_id,con_nombre from contactos where ... order by con_id desc
		$this->db->select('id_usuario, login');
		$this->db->from('usuarios');
		//$this->db->where(['con_id' => 1]);
		$this->db->order_by('id_usuario ASC');
		$query = $this->db->get();

		//$this->db->select('con_id, con_nombre')->from('contactos')->where(['con-id' => 1s]);
		$query2 = $this->db->get_where('contactos', ['con_id' => 1]);

		print_r($query->result());
		echo '<br>';
		print_r($query2->result());
		
		/**insert**/
		$data = array('login' => 'usuario', 
					  'password' => '123',
					  'email' => 'usuario@gmail.com',);

		$this->db->insert('usuarios', $data);

		/**update*/
		$data = array('login' => 'admin',);
		$this->db->where(['id_usuario' => 2]);
		$this->db->update('usuarios', $data);

		/*delete*/
		$this->db->delete('usuarios', ['id_usuario' => 4]);
	}

	/**
	 * funcion para deodificar el algoritmo de encriptacion
	 * @return [string] [password]
	 */
	public function encode()
	{
		echo hash('sha256', '123' . SALT);
	}
}


/*end file test.php*/