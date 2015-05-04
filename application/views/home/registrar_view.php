		<header>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="jumbotron">
							<h1>Formulario de registro</h1>
						</div>
					</div>
				</div>
			</div>
		</header>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-danger" id="error_div_frm">
							<div class="panel-heading">Error</div>
							<div class="panel-body" id="error_frm"></div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xs-6 col-xs-offset-2">
						<form id="registrarFrm" class="form-horizontal" role="form" action="<?php echo site_url('api/registrar'); ?>" method="POST">
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="usuario">Usuario:</label>
						        <div class="col-xs-10">
						            <input type="text" class="form-control" name="usuario" placeholder="Ingrese su nombre de usuario" />
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="password">E-Mail:</label>
						        <div class="col-xs-10">          
						            <input type="email" class="form-control" name="correo" placeholder="Ingrese su correo" />
						    	</div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="password">Password:</label>
						        <div class="col-xs-10">          
						            <input type="password" class="form-control" name="password" placeholder="Ingrese un password" />
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="password">Confirme Password:</label>
						        <div class="col-xs-10">          
						            <input type="password" class="form-control" name="confirm_password" placeholder="Ingrese su password para confirmar">
						        </div>
						    </div>
						    <div class="form-group">        
						        <div class="col-xs-offset-2 col-xs-10">
						          	<input type="submit" class="btn btn-success" value="Registrarme" />
						          	<a href="<?=site_url('home')?>" class="btn btn-danger">Cancelar</a>
						        </div>
						    </div>
				      	</form>
					</div>	  
				</div>
			</div>
		</section>      
