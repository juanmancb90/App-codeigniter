$(document).ready(function () {	
	$('#loginFrm').submit(function (e) {
		e.preventDefault();
		var dirUrl = $(this).attr('action');
		var postData = $(this).serialize();
		console.log(postData);
		
		$.ajax({
			url: dirUrl,
			type: 'POST',
			dataType: 'json',
			data: postData,
			error: function(error)
			{
                alert("Error petición ajax");
                console.log(error.toString());
            },
            success: function(value)
            {
                if(value.result == true)
                {
                    alert("Login exitoso");
                    window.location.href = 'dashboard';
                }
                else
                {
                	alert("Error: Login no valido");
                }
            }
		});
	});

	$("#error_div_frm").hide();
   

	$('#registrarFrm').submit(function (e) {
		e.preventDefault();
		var dirUrl = $(this).attr('action');
		var postData = $(this).serialize();
		console.log(postData);
		
		$.ajax({
			url: dirUrl,
			type: 'POST',
			dataType: 'json',
			data: postData,
			error: function(error)
			{
                alert("Error petición ajax");
                console.log(error.toString());
            },
            success: function(rst)
            {
                if(rst.result == true)
                {
                    alert("Registro exitoso");
                    $('#registrarFrm')[0].reset();  
                }
                else
                {
                	$('#error_div_frm').show();

                	var output = '<ul>';
                	for (var key in rst.data) {
                		var value = rst.data[key];
                		output += '<li>'+value+'<span class="glyphicon glyphicon-remove"></span>'+'</li>';
                	};
                	output += '</ul>';

                	$('#error_frm').html(output);
                }
            }
		});
	});

	


	/*
	function registrar(data, url){
		try
        {
            var datos = {};
            var durl = url;
			datos['login'] = data[0];
			datos['correo'] = data[1];
			
			if (data[2] == data[3]) {
				datos['password'] = data[2];
			}
			else{
				alert("Error: Los passwords deben ser iguales");
			}

            var jObject = JSON.stringify(datos);

            console.log(datos);
            console.log(durl);

            $.ajax({
                type: "POST",
                url: durl, 
                data: {jObject:  jObject},
                dataType: "json",
                error: function(error){
                    alert("Error petición ajax");
                    console.log(error.toString());
                },
                success: function(){
                    /*if(result.value == true){
                        mostrarMensaje(result.mensaje);
                    }
                    else{
                        mostrarMensaje(result.mensaje);
                    }
                }
            });
        }
        catch(ex){
            alert("Error: Ocurrio un error " + ex);
        }
	}

	$("#btnRegistrar").click(function (e) {
		var login = $.trim($("#usuario").val());
		var email = $.trim($("#correo").val());
		var pass = $.trim($("#password").val());
		var pass2 = $.trim($("#confirm_password").val());
		var url = $("#registrarFrm").attr('action');

		if(login != '' && pass != '' && pass2 != "" && email != ''){
			var data = [login, email, pass, pass2];
			registrar(data, url);
		}
		else{
			alert("Error: Los campos no pueden ser vacios");
		}
		
	})*/


});
