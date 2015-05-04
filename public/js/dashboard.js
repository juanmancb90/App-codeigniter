/*javascript dashboard*/

//crear un objeto que representa la clase dashboard nucleo de la app
/*javascript dashboard*/

/**
 * clase dashboard 
 */
var Dashboard = function() {
	//var self = this;
	 
	//constructor
	this.__construct = function() {
		console.log("dashboard create");
		
		Template = new Template();
		Event = new Event();
		//Result = new Result();
		
		load_todo();	
		load_nota();
		
		/*test
		var data = {};
		data['todo_id'] = 1;
		data['content'] = "like a pro";
		console.log(Template.todo(data));*/
	};

	//-----------------------------------------metodos
	/**
	 * [load_todo description]
	 * @return {[type]} [description]
	 */
	var load_todo = function() {
		$.get('api/get_todo', function(rst){
			var output = '';

			for(var i = 0; i < rst.length; i++){
				output += Template.todo(rst[i]);
			}

			$('#list_todo').html(output);	
		}, 'json');
	};

	/**
	 * [load_nota description]
	 * @return {[type]} [description]
	 */
	var load_nota = function() {
		$.get('api/get_nota', function(rst){
			var output = '';

			for(var i = 0; i < rst.length; i++)
			{
				output += Template.nota(rst[i]);
			}

			$('#list_note').html(output);
		}, 'json');
	};

	this.__construct(); 
};