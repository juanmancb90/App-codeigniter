/*javascript template*/

/**
 * crear un objeto que representa la clase template render de vistas
 */
var Template = function() {
	//constructor
	this.__construct = function() {
		console.log("template creado");
	};

	//-----------------------------------------metodos
	/**
	 * [todo description]
	 * @param  {[type]} obj [description]
	 * @return {[type]}     [description]
	 */
	this.todo = function(obj){
		var output = '';
		if (obj.completed == 1) {
			output += '<div class="list-group-item todo_complete" id="todo_'+obj.todo_id+'">';
		}
		else{
			output += '<div class="list-group-item" id="todo_'+obj.todo_id+'">';
		}
		output += '<span> </span>';
		output += '<span>'+obj.content+'</span>';
		output += '<span class="options">';
		var data_completed = (obj.completed == 1) ? 0 : 1;
		var data_completed_text = (obj.completed == 1) ? '<span class="glyphicon glyphicon-share-alt"></span>' : '<span class="glyphicon glyphicon-ok"></span>';
		output += '<a data-id="'+obj.todo_id+'" data-completed="'+data_completed+'" class="todo_update" href="api/update_todo">'+data_completed_text+'</a>';
		
		output += '<a data-id="'+obj.todo_id+'" class="todo_delete" href="api/delete_todo"><span class="glyphicon glyphicon-remove"></span></a>';
		output += '</span>';
		output += '</div>';

		return output;
	};

	/**
	 * [todo description]
	 * @param  {[type]} obj [description]
	 * @return {[type]}     [description]
	 */
	this.nota = function(obj){
		var output = '';
		output += '<div class="list-group-item" id="note_'+obj.note_id+'">';
		output += '<strong>Titulo: </strong><a id="note_title_'+obj.note_id+'" class="note_toggle" data-id="'+obj.note_id+'" href="#">'+obj.title+'</a>';
		output += '<div id="note_content_'+obj.note_id+'" class="hide">'+obj.content+'</div>';
		output += '<a data-id="'+obj.note_id+'" class="note_delete" href="api/delete_nota"><span class="glyphicon glyphicon-remove pull-right"></span></a>';
		output += '<a data-id="'+obj.note_id+'" class="note_update_display" href="#"><span class="glyphicon glyphicon-share-alt pull-right"></span></a>';
		output += '<div id="note_edit_container_'+obj.note_id+'" class="note_container"></div>';
		output += '</div>';

		return output;
	};

	this.note_edit = function(note_id){
		var output = '';
		output += '<form class="form-inline note_edit_form" role="form" method="POST" action="api/update_nota">';
		
		output += '<div class="form-group">';
		output += '<input type="hidden" id="note_id" name="note_id" value="'+note_id+'" />';
		output += '<input type="text" id="title" class="form-control" name="title">';
		output += '</div>';
		
		output += '<div class="form-group">';
		output += '<textarea id="content" name="content" class="form-control" row="1"></textarea>';
		output += '</div>';
		
		output += '<div class="form-group">';
		output += '<input type="submit" class="btn btn-primary btn-xs note_edit_save" value="Guardar" />';
		output += '<input type="button" class="btn btn-danger btn-xs note_edit_cancel" value="Cancelar" />';
		output += '</div>';
		output += '</form>';

		return	output;
	};

	this.__construct();
};