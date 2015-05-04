<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* clase del controlador api
*/
class Api extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuarios_model');
		$this->load->model('Todo_model');
		$this->load->model('Note_model');
	}

	/**
	 * funcion que permite manejar las sesiones de usuario
	 * @return [type] [description]
	 */
	private function requiredLogin()
	{
		if($this->session->userdata('id_usuario') == false)
		{
			//$this->logout();
			$this->output->set_output(json_encode([
				'result' => false, 
				'Error' => 'Usted no se encuentra autorizado']));
			
			return  false;
		}
	}

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	public function login()
	{

		$login = $this->input->post('usuario');

		$password = $this->input->post('password');
		
		$dataPost = array('login' => $login,
						  'password' => hash('sha256', $password . SALT),);

		$result = $this->Usuarios_model->get($dataPost);

		$this->output->set_content_type('application_json');

		if($result)
		{
			$this->session->set_userdata(['id_usuario' => $result[0]['id_usuario']]);
			$this->output->set_output(json_encode(['result' => true]));
			return false;
		}

		$this->output->set_output(json_encode(['result' => false]));
		
		//$userSession = $this->session->all_userdata('id_usuario');
		//print_r($userSession);
	}

	/**
	 * validaciones de campos del formulario registrar
	 * @return [type] [description]
	 */
	private function validaciones(){
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|nin_length[5]|max_length[16]|is_unique[usuarios.login]');
		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]|matches[confirm_password]');
	}

	/**
	 * funcion para registrar usuarios
	 * @return [type] [description]
	 */
	public function registrar()
	{
        $this->validaciones();

        if($this->form_validation->run() == false)
        {
        	$this->output->set_content_type('application_json');
        	
        	$this->output->set_output(json_encode(['result' => false, "data" => $this->form_validation->error_array()]));
        	
        	return false;
        }
        else
        {
        	$login = $this->input->post('usuario');
	        $email = $this->input->post('correo');
	        $password = $this->input->post('password');
	        $confirm_password = $this->input->post('confirm_password');

	        $data = array('login' => $login,
	        			  'password' => hash('sha256', $password . SALT),
	        			  'email' => $email,);

	        $userid = $this->Usuarios_model->insert($data);
	        
	        $this->output->set_content_type('application_json');

			if($userid)
			{
				$this->session->set_userdata(['id_usuario' => $userid]);
				$this->output->set_output(json_encode(['result' => true]));
				return false;
			}

			$this->output->set_output(json_encode([
				'result' => false, 
				'data' => 'El usuario no pudo ser creado']));
        }   
	}

/********** funciones del crud de todos*****************/
	/**
	 * [create_todo description]
	 * @return [type] [description]
	 */
	public function create_todo()
	{
		$this->requiredLogin();

		$this->form_validation->set_rules('content', 'Content', 'required|max_length[255]');

		if ($this->form_validation->run() == false) {
			$this->output->set_output(json_encode([
				'result' => false, 
				'error' => $this->form_validation->error_array()
			]));

			return false;
		}
		else{
			$data = array(
				'user_id' => $this->session->userdata('id_usuario'),
				'content' => $this->input->post('content'),);

			$result = $this->Todo_model->insertar($data);

			if($result){
				//refrescar cambios
				$query = $this->db->get_where('todo', ['todo_id' => $this->db->insert_id()]);

				$this->output->set_output(json_encode(['result' => true, 'data' => $query->result()]));
				return false;
			}

			$this->output->set_output(json_encode([
				'result' => false,
				'error' => 'No se pudo insertar el item'
			]));
		}
	}

	/**
	 * [get_todo description]
	 * @return [type] [description]
	 */
	public function get_todo()
	{

		$this->requiredLogin();

		$id = $this->session->userdata('id_usuario');
		
		$result = $this->Todo_model->get_todos($id);

		$this->output->set_output(json_encode($result));
	}

	/**
	 * [update_todo description]
	 * @return [type] [description]
	 */
	public function update_todo()
	{
		$this->requiredLogin();

		$id = $this->input->post('todo_id');
		$completed = $this->input->post('completed');

		$data = array('todo_id' => $id,'completed' => $completed,);

		$rst = $this->Todo_model->actualizar($data);

		if($rst)
		{
			$this->output->set_output(json_encode(['result' => true]));
			return false;
		}

		$this->output->set_output(json_encode([
			'result' => false,
			'message' => 'No se puede actualizar el Item.'
		]));

		return false;	
	}

	/**
	 * [delete_todo description]
	 * @return [type] [description]
	 */
	public function delete_todo()
	{
		$this->requiredLogin();
		
		$id = $this->input->post('todo_id');
		
		$userid = $this->session->userdata('id_usuario');
		
		$data = array('todo_id' => $id, 
					  'user_id' => $userid,);

		$rst = $this->Todo_model->borrar($data);

		if($rst){
			$this->output->set_output(json_encode(['result' => true]));
			return false;
		}

		$this->output->set_output(json_encode([
			'result' => false,
			'message' => 'No se puede borrar el Item.'
		]));

		return false;	
	}

/********** funciones del crud de notas*****************/
	/**
	 * [get_nota description]
	 * @return [type] [description]
	 */
	public function get_nota()
	{

		$this->requiredLogin();

		$id = $this->session->userdata('id_usuario');
		
		$result = $this->Note_model->get_todos($id);

		$this->output->set_output(json_encode($result));
	}

	/**
	 * [create_nota description]
	 * @return [type] [description]
	 */
	public function create_nota()
	{
		$this->requiredLogin();

		//reglas de validacion
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[50]');
		$this->form_validation->set_rules('content', 'Content', 'required|max_length[500]');

		if ($this->form_validation->run() == false) {
			$this->output->set_output(json_encode([
				'result' => false, 
				'error' => $this->form_validation->error_array()
			]));

			return false;
		}
		else{
			$data = array(
				'user_id' => $this->session->userdata('id_usuario'),
				'title' => $this->input->post('title'),
				'content' => $this->input->post('content'),
			);

			$result = $this->Note_model->insertar($data);

			if($result){
				//refrescar cambios
				$query = $this->db->get_where('notes', ['note_id' => $this->db->insert_id()]);

				$this->output->set_output(json_encode(['result' => true, 'data' => $query->result()]));
				return false;
			}

			$this->output->set_output(json_encode([
				'result' => false,
				'error' => 'No se pudo insertar la nota'
			]));
		}

	}

	/**
	 * [update_nota description]
	 * @return [type] [description]
	 */
	public function update_nota()
	{
		$this->requiredLogin();

		$id = $this->input->post('note_id');
		$title = $this->input->post('title');
		$content = $this->input->post('content');

		$data = array('note_id' => $id, 'title' => $title, 'content' => $content,);

		$rst = $this->Note_model->actualizar($data);

		if($rst)
		{
			$this->output->set_output(json_encode(['result' => true]));
			return false;
		}

		$this->output->set_output(json_encode([
			'result' => false,
			'message' => 'No se puede actualizar el Item.'
		]));

		return false;	
	}

	/**
	 * [delete_nota description]
	 * @return [type] [description]
	 */
	public function delete_nota()
	{

		$this->requiredLogin();

		$id = $this->input->post('note_id');
		$userid = $this->session->userdata('id_usuario');
		
		$data = array('note_id' => $id, 
					  'user_id' => $userid,);

		$rst = $this->Note_model->borrar($data);

		if($rst){
			$this->output->set_output(json_encode(['result' => true]));
			return false;
		}

		$this->output->set_output(json_encode([
			'result' => false,
			'message' => 'No se puede borrar el Item.'
		]));

		return false;	
		
	}

	public function get_nota_id($id){
		if($id != null){
			$data = array('note_id' => $id,);
			$rst = $this->Note_model->get_nota_id($data);
			print_r($rst);
		}
		else{
			die("Error no recibio un parametros");
		}
	}

}


/*end file api.php*/
