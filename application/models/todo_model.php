<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* clase modelo de la BD
*/
class Todo_model extends CRUD_model
{
	protected $_tabla = 'todo';
	protected $_primary_key = 'todo_id';

	public function __construct(){
		parent::__construct();

	}

	/**
	 * [insertar description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function insertar($data){

		$result = $this->db->insert($this->_tabla, $data);

		return $result;
	}

	/**
	 * [get_todos description]
	 * @param  [type] $userid [description]
	 * @return [type]         [description]
	 */
	public function get_todos($userid){

		$this->db->where(['user_id' => $userid]);
		
		$query = $this->db->get($this->_tabla);

		$result = $query->result_array();

		return $result;
	}

	/**
	 * [borrar description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function borrar($data){

		$query = $this->db->delete($this->_tabla,['todo_id' => $data['todo_id'], 'user_id' => $data['user_id']]);
		return $query;
	}

	/**
	 * [actualizar description]
	 * @return [type] [description]
	 */
	public function actualizar($data){
		$this->db->where(['todo_id' => $data['todo_id']]);
		$this->db->update($this->_tabla, ['completed' => $data['completed']]);

		return $this->db->affected_rows();
	}

	public function get_by_name(){

	}

	public function get_by_id(){
		
	}
}