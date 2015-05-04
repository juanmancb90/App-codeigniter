<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bootstrap/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/plugins/bootstrap.min.js"></script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dashboard/result.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dashboard/event.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dashboard/template.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>public/js/dashboard.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#usuarios').click(function(evt){
			evt.preventDefault();
			$('#contenedor').load("<?php echo base_url(); ?>dashboard/usuarios/");
		});
	});

	//iniciar la instancia de la clase dashboard
	$(function() {
			var dashboard = new Dashboard();
		});
	
	</script>
</head>
<body>	
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="jumbotron">
						<h1>Dashboard</h1>
					</div>
				</div>
			</div>
		</div>
	</header>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="navbar-header">
						<a class="navbar-brand">App-CRUD</a>
					</div>
					<div>
						<ul class="nav navbar-nav">
							<li class="active"><a href="<?php echo base_url();?>dashboard">Inicio</a></li>
							<li><a id="usuarios" href="#usuarios">Usuario</a></li>
							
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="<?php echo site_url('dashboard/logout'); ?>"><span class="glyphicon glyphicon-user"></span>Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<section id="contenedor">