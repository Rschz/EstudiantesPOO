<?php
require_once('./../layout/Layout.php');
require_once('./EstudianteService.php');
require_once('./Estudiante.php');

$layout = new Layout();
$servicios = new EstudianteService();

$layout->PrintTopPage();

//Editar
$student = isset($_GET['id']) ? $servicios->GetById($_GET['id']) : '';


//Agrega o edita el estudiante
if (isset($_POST['id'])) {
	if ($_POST['id'] == 0) {
		$lastId = $servicios->GetLastId();
		$student = new Estudiante(
			++$lastId,
			$_POST['nombre'],
			$_POST['apellido'],
			isset($_POST['isActive']) ? $_POST['isActive'] : "no",
			$_POST['carrera'],
			[],
			'imagen.jpg'
	
		);
	
		$servicios->Add($student);
		
	}else{
		$student = new Estudiante(
			$_POST['id'],
			$_POST['nombre'],
			$_POST['apellido'],
			isset($_POST['isActive']) ? $_POST['isActive'] : "no",
			$_POST['carrera'],
			[],
			'imagen.jpg'
	
		);
	
		$servicios->Update($student);
	}

	header("Location:./../index.php");
	exit();
}

?>


<div class="container mb-5">
	<h2 class="text-center"><?= $layout->PAGE_TITLE; ?></h2>
	<form action="estudianteForm.php" method="post">
	<input type="hidden" name="id" value="<?=isset($_GET['id'])? $_GET['id']: 0;?>">
		<div class="form-group">
			<label for="nombre">Nombre *</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
						</svg>
					</div>
				</div>
				<input id="nombre" name="nombre" placeholder="Escribir aquí..." type="text" required="required" class="form-control" value="<?= !empty($student)? $student->Nombre : ''; ?>" />
			</div>
		</div>
		<div class="form-group">
			<label for="apellido">Apellido *</label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
						</svg>
					</div>
				</div>
				<input id="apellido" name="apellido" placeholder="Escribir aquí..." type="text" class="form-control" required="required" value="<?= !empty($student)? $student->Apellido : ''; ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="carrera">Carrera *</label>
			<div>
			<select id="carrera" name="carrera" class="custom-select" required="required">
						<option value="" <?=empty($student->Carrera) ? "selected" : "";?> disabled>Seleccione una carrera...</option>
						<option value="Redes" <?=(!empty($student) && $student->Carrera == 'Redes') ? ' selected': '';?>>Redes</option>
						<option value="Software" <?=(!empty($student) && $student->Carrera == 'Software') ? ' selected': '';?>>Software</option>
						<option value="Multimedia" <?=(!empty($student) && $student->Carrera == 'Multimedia') ? ' selected': '';?>>Multimedia</option>
						<option value="Mecatronica" <?=(!empty($student) && $student->Carrera == 'Mecatronica') ? ' selected': '';?>>Mecatronica</option>
						<option value="Seguridad informática" <?=(!empty($student) && $student->Carrera == 'Seguridad informática') ? ' selected': '';?>>Seguridad informática</option>
					</select>
			</div>
		</div>
		<div class="form-group">
			<div>
				<div class="custom-control custom-checkbox custom-control-inline">
					<input name="isActive" id="isActive_0" type="checkbox" class="custom-control-input" value="si" <?=(!empty($student) && $student->Status == 'si') ? ' checked': '';?>>
					<label for="isActive_0" class="custom-control-label">Esta activo</label>
				</div>
			</div>
		</div>
		<div class="form-group text-center">
			<button type="submit" class="btn btn-primary"><?= isset($_GET['id']) ? "Guardar cambios" : "Agregar"; ?></button>

			<a class="btn btn-danger" href=".." role="button"><?= isset($_GET['id']) ? "Cancelar" : "Volver"; ?></a>

		</div>
	</form>
</div>

<?php $layout->PrintBottomPage(); ?>