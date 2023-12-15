<?php

// Path: EJEMPLO_MVC/view/update.php
	require '../model/articulo.php';
	session_start();
	$articuloObj =  isset($_SESSION['articuloObj']) ? unserialize($_SESSION['articuloObj']) : new Articulo();

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Nuevo Articulo</title>
	<link rel="stylesheet" href="../libs/bootstrap.css">
	<link rel="stylesheet" href="./stylesheets/insert.css">
	<script src="../libs/bootstrap.js"></script>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h2>Agregar Nuevo Articulo</h2>
					</div>
					<p>Llena el formulario para agregar un nuevo articulo</p>
					<form action="../index.php?act=add" method="post">
						<div class="form-group">
							<label for="nombre">Nombre del Articulo</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="categoria">Categoria</label>
							<input type="text" name="categoria" id="categoria" class="form-control" required="required">
						</div>
						<input type="submit" value="Guardar" class="btn btn-success" name="addbtn">
						<a href="../index.php" class="btn btn-default">Cancelar</a>
					</form>
				</div>
			</div>
		</div>

	</div>

</body>
</html>