/*javascript event*/

/**
 * crear un objeto que representa la clase eventos
 */
var Event = function() {
	//constructor
	this.__construct = function() {
		console.log("Event creado");
		Result = new Result();

		//llamar funciones
		crear_todo();
		crear_nota();
		update_todo();
		update_nota_display();
		update_nota();
		toogle_nota();
		delete_todo();
		delete_nota();
	};

	//-----------------------------------------metodos
	/**
	 * [crear_todo description]
	 * @return {[type]} [description]
	 */
	var crear_todo = function() {
		$('#crear_todo').submit(function (evt) {
			evt.preventDefault();
			var d_url = $(this).attr('action');
			var dataFrm = $(this).serialize();

			$.ajax({
				url: d_url,
				type: 'POST',
				dataType: 'json',
				data: dataFrm,
				error: function(error){
					alert('Error peticion ajax');
					console.log(error.toString());
				},
				success: function(rst){
					if(rst.result == true){
						Result.success('Item registrado exitosamente');
						var output = Template.todo(rst.data[0]);
						$('#list_todo').append(output);
						$('#content').val('');
						$('textarea').val('');
					}
					else{
						Result.error(rst.error);
					}
				} 
			});
		});
	};

	/**
	 * [update_todo description]
	 * @return {[type]} [description]
	 */
	var update_todo = function() {
		$('body').on('click', '.todo_update', function (evt) {
			evt.preventDefault();
			var durl = $(this).attr('href');
			var self = $(this);
			var dataPost = {
				todo_id: $(this).attr('data-id'),
				completed: $(this).attr('data-completed'),
			};

			$.ajax({
				url: durl,
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				error: function(error){
					alert('Error petición ajax');
					console.log(error.toString());		
				},
				success: function(rst){
					if(rst.result == true){
						Result.success('El Item  ha sido actualizado');
						if(dataPost.completed == 1)
						{
							$('#todo_' + dataPost.todo_id).addClass('todo_complete');
							self.html('<span class="glyphicon glyphicon-share-alt"></span>');
							self.attr('data-completed', 0);
						}
						else{
							$('#todo_' + dataPost.todo_id).removeClass('todo_complete');
							self.html('<span class="glyphicon glyphicon-ok"></span>');
							self.attr('data-completed', 1);
						}	
					}
					else{
						Result.error(rst.message);
					}
				}
			});
		});
	};

	/**
	 * [delete_todo description]
	 * @return {[type]} [description]
	 */
	var delete_todo = function() {
		$('body').on('click', '.todo_delete', function (evt){
			evt.preventDefault();
			var durl = $(this).attr('href');
			var dataPost = {'todo_id': $(this).attr('data-id')};

			if(confirm('Estás seguro que deseas elmininar el item?')){
				$.ajax({
					url: durl,
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					error: function(error){
						alert('Error petición ajax');
						console.log(error.toString());
					},
					success: function(rst){
						if(rst.result == true){
							Result.success('Item eliminado');
							$('#todo_' + dataPost.todo_id).remove();
						}
						else{
							Result.error(rst.msg)
						}
					}
				});
			}
			else
			{
				return false;
			}
			
		});
	};

	/**
	 * [crear_todo description]
	 * @return {[type]} [description]
	 */
	var crear_nota = function() {
		$('#crear_nota').submit(function (evt) {
			evt.preventDefault();
			var d_url = $(this).attr('action');
			var dataFrm = $(this).serialize();

			$.ajax({
				url: d_url,
				type: 'POST',
				dataType: 'json',
				data: dataFrm,
				error: function(error){
					alert('Error peticion ajax');
					console.log(error.toString());
				},
				success: function(rst){
					if(rst.result == true){
						Result.success('Item registrado exitosamente');  
						var output = Template.nota(rst.data[0]);
						$('#list_note').append(output);
						$('#title').val('');
						$('#title').val('');
					}
					else{
						Result.error(rst.error);
					}
				} 
			});	
		});
	};

	/**
	 * [update_nota description]
	 * @return {[type]} [description]
	 */
	var update_nota = function() {

		$('body').on('submit', '.note_edit_form', function (evt) {
			evt.preventDefault();
			var durl = $(this).attr('action');
			var self = $(this); 
			var postData = {note_id: $(this).find('#note_id').val(),
							title: $(this).find("#title").val(),
							content: $(this).find("#content").val(),
			};
			
			$.ajax({
				url: durl,
				type: 'POST',
				dataType: 'json',
				data: postData,
				error: function(error){
					alert('Error petición ajax');
					console.log(error.toString());
				},
				success: function(rst){
					if(rst.result == true){
						Result.success('Nota actualizada exitosamente');
						$('#note_title_' + postData.note_id).html(postData.title);
						$('#note_content_' + postData.note_id).html(postData.content);
						self.remove();
					}
					else{
						Result.error(rst.message);
					}
				},
			});	
		});
	};

	/**
	 * [update_nota description]
	 * @return {[type]} [description]
	 */
	var update_nota_display = function() {
		$('body').on('click', '.note_update_display', function (evt) {
			evt.preventDefault();
			var note_id = $(this).data('id');
			var output = Template.note_edit(note_id);
			$('#note_edit_container_'+ note_id).html(output);

			//mostrar datos para actualizar
			var title = $('#note_title_'+note_id).html();
			var content = $('#note_content_'+note_id).html();

			$('#note_edit_container_'+ note_id).find('#title').val(title);
			$('#note_edit_container_'+ note_id).find('#content').val(content);
			
		});

		$('body').on('click', '.note_edit_cancel', function (evt) {
			evt.preventDefault();
			$(this).parents('.note_container').hide();
		});
	};

	/**
	 * [delete_nota description]
	 * @return {[type]} [description]
	 */
	var delete_nota = function() {
		$('body').on('click', '.note_delete', function (evt) {
			evt.preventDefault();
			var durl = $(this).attr('href');
			var self = $(this).parent('div');
			var dataPost = {'note_id': $(this).attr('data-id')};

			if(confirm('Estás seguro que deseas eliminar la nota?'))
			{
				$.ajax({
					url: durl,
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					error: function(error){
						alert('Error petición ajax');
						console.log(error.toString());
					},
					success: function(rst){
						if(rst.result == true){
							Result.success('Item eliminado');
							self.remove();
						}
						else{
							Result.error(rst.msg)
						}
					}
				});
			}
			else
			{
				return false;
			}
		});
	};

	var toogle_nota = function(){
		$('body').on('click', '.note_toggle', function (evt){
			evt.preventDefault();
			var note_id = $(this).data('id');
			$('#note_content_'+ note_id).toggleClass('hide')
		});
	};

	this.__construct();
};