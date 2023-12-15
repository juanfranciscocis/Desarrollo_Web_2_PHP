<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista de compras con el patron MVC</title>
	<link rel="stylesheet" href="../libs/bootstrap.css">
	<link rel="stylesheet" href="./stylesheets/list.css">
	<script src="../libs/bootstrap.js"></script>

</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<a href="index.php" class="btn-success pull-left">Inicio</a>
						<h2 class="pull-left">Lista de compras</h2>
						<a href="view/insert.php" class="btn-success pull-right">Agregar Elemento</a>
					</div>
					<?php
						if ($result -> num_rows>0){
							echo "<table class='table table-bordered table-striped'>";
								echo "<thead>";
								echo "<tr>";
									echo "<th>#</th>";
									echo "<th>Articulo</th>";
									echo "<th>Categoria</th>";
									echo "<th>Acciones</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									while ($row = mysqli_fetch_array($result)){
										echo "<tr>";
											echo "<td>" . $row['id_articulo'] . "</td>";
											echo "<td>" . $row['nombre'] . "</td>";
											echo "<td>" . $row['categoria'] . "</td>";
											echo "<td>";
												echo "<a href= 'index.php?action=update&id=" . $row['id_articulo'] . "' title='Actualizar Registro' >📝</a>";
												echo "<a href= 'index.php?action=delete&id=" . $row['id_articulo'] . "' title='Eliminar Registro' >🗑️</a>";
											echo "</td>";
										echo "</tr>";
									}
								echo "</tbody>";
							echo "</table>";

						}else{
							echo "<p class='lead'>No se encontraron registros.</p>";
						}

					?>
				</div>
			</div>
		</div>

	</div>





</body>
</html>