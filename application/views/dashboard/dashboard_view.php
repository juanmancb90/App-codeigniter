			<article>
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<div id="error" class="alert alert-danger ocultar"></div>
							<div id="mensaje" class="alert alert-success ocultar"></div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-xs-4" id="dashboard-todo">
							<form id="crear_todo" class="form-inline" method="POST" action="<?=site_url('api/create_todo')?>">
								<h3>Item</h3>
		
								<div class="form-group">
									<input type="text" id="content" name="content" class="form-control" placeholder="Crear un nuevo item todo" />
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Crear" />
								</div>
							</form>
							<br>
							<h4>Lista de Items</h4>
							<div id="list_todo" class="list-group">
								<span class="ajax-loader"></span>
							</div>
						</div>
						<div class="col-xs-8" id="dashboard-note">
							<form  id="crear_nota" method="POST" action="<?=site_url('api/create_nota')?>">
								<h3>Notas</h3>
								<div class="form-group">
									<label class="control-label" for="title">Título:</label>
									<input type="text" id="title" name="title" class="form-control" placeholder="Título de la nota" />
								</div>
								<div class="form-group">
									<label class="control-label" for="content">Descripción:</label>
									<textarea class="form-control" rows="2" name="content" placeholder="Ingrese la descripción"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" class="btn btn-success" value="Crear" />
								</div>
							</form>
							<p><h4>Lista de Notas</h4></p>					
							<div id="list_note" class="list-group">
								<span class="ajax-loader"></span>
							</div>
						</div>
					</div>
				</div>
			</article>
			<!--
			<div class="container">
			  <h2>Modal Example</h2>
		
			  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>


			  <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog">
			    
			
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Modal Header</h4>
			        </div>
			        <div class="modal-body">
			          <p>Some text in the modal.</p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			</div>	-->	
			
		