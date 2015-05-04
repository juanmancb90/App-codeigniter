<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* clase crud
*/
class CRUD_model extends CI_Model
{
	protected $_tabla = null;
	protected $_primary_key = null;
	
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * funcion para consutar  datos del usuario 
	 * @param   $[id] [login del usuario]
	 * @return [type] [description]
	 */
	public function get($id = null, $order_by = null)
	{
		
		if (is_array($id))
		{
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);
			}	
		}
		
		if(is_numeric($id)){
			$this->db->where($this->_primary_key, $id); 
		}
	
		$q = $this->db->get($this->_tabla);
		
		return $q->result_array();
	}

	/**
	 * funcion para insertar datos
	 * @param data
	 * @return [type] [description]
	 */
	public function insert($data)
	{
		$this->db->insert($this->_tabla, $data);

		return $this->db->insert_id();
	}

	/**
	 * funcion para actualizar datos
	 * @return [type] [description]
	 */
	public function update($data, $id)
	{

		if(is_numeric($id))
		{
			$this->db->where($_primary_key, $id);	
		}
		elseif(is_array($id))
		{
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);	
			}
		}
		else{
			die('El metodo update() requiere un parametro');
		}
		
		$this->db->update($this->_tabla, $data);

		return $this->db->affected_rows();
	}

	/**
	 * funcion para eliminar  datos
	 * @return [type] [description]
	 */
	public function delete($id)
	{

		if(is_numeric($id))
		{
			$this->db->where($this->_primary_key, $id);
		}
		elseif(is_array($id))
		{
			foreach ($id as $key => $value) {
				$this->db->where($key, $value);
			}	
		}
		else
		{
			die('El metodo delete() requiere un parametro de entrada');
		}
		
		$q = $this->db->delete($this->_tabla);

		return $q->affected_rows();
	}

	/**
	 * [insertUpdate description]
	 * @return [type] [description]
	 */
	public function insertUpdate($data, $id = false){

		if(!$id){
			die('El metodo insertUpdate() requiere un parametro adicional');
		}

		$this->db->select($this->_primary_key);
		$this->db->where($this->_primary_key, $id);
		$q = $this->db->get($this->_tabla);
		$result = $this->db->num_rows();

		if($result == 0){
			return $this->update($data, $id);
		}
	
		return $this->insert($data);
	}
}

/*end file crud_model.php*/