/*javascript result*/

/**
 * clase result
 */
var Result = function() {
	//constructor
	this.__construct = function() {
		console.log("Result creado");
	};

	//-----------------------------------------metodos
	/**
	 * [success description]
	 * @param  {[type]} msg [description]
	 * @return {[type]}     [description]
	 */
	this.success = function(msg) {
		var dom = $("#mensaje");

		if(typeof msg === 'undefined'){
			dom.fadeIn('fast');
			dom.html("Undefined");
			dom.fadeOut(2000);
		}
		else
		{
			dom.fadeIn('fast');
			dom.html(msg);
			dom.fadeOut(2000);
		}
	};

	/**
	 * [error description]
	 * @param  {[type]} msg [description]
	 * @return {[type]}     [description]
	 */
	this.error = function(msg) {
		var dom = $('#error');
		var dombody = $('#error_body');

		if(typeof msg === 'undefined')
		{
			dom.fadeIn();
			dom.html("Error: Undefined");
			dom.fadeOut(1000);	
		}
		if(typeof msg === 'object'){
			var output = '<ul>';
			for(var key in msg)
			{
				output += '<li>'+msg[key]+'</li>';
			}
			output += '</ul>';

			dom.fadeIn();
			dom.html(output);
			dom.fadeOut(1000);
			
		}
		else{
			dom.fadeIn();
			dom.html(msg);
			dom.fadeOut(1000);
		}
	};

	this.__construct();
};