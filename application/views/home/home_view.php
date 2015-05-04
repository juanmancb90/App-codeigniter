		<header>
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="jumbotron">
							<h1>Home Bienvenido</h1>
						</div>
					</div>
				</div>
			</div>	
		</header>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-xs-offset-2">
						<form id="loginFrm" class="form-horizontal" role="form" action="<?php echo site_url('api/login'); ?>" method="POST">
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="usuario">Usuario:</label>
						        <div class="col-xs-10">
						            <input type="text" class="form-control" name="usuario" placeholder="Ingrese usuario" />
						        </div>
						    </div>
						    <div class="form-group">
						        <label class="control-label col-xs-2" for="password">Password:</label>
						        <div class="col-xs-10">          
						            <input type="password" class="form-control" name="password" placeholder="Ingrese password" />
						        </div>
						    </div>
						    <div class="form-group">        
						       	<div class="col-xs-offset-2 col-xs-10">
						          	<input type="submit" class="btn btn-primary" value="Login" />
						          	<a href="<?=site_url('home/registrar')?>" class="btn btn-info">Registrarse</a>
						        </div>
						    </div>
				      	</form>
				      	
					</div>
				</div>
			</div>
		</section>   

