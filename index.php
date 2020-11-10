<?php
require_once('layout/Layout.php');
require_once('estudiantes/Estudiante.php');
require_once('estudiantes/EstudianteService.php');

// unset($_COOKIE['estudiantes']);
// setcookie('estudiantes', null, -1, '/'); 


$layout = new Layout();
$servicios = new EstudianteService();
$students = $servicios->GetAll();

//Elimina el Estudiante
if (isset($_GET['id'])) {
	$servicios->Delete($_GET['id']);
	header('Location:index.php');
}

//filtra los estudiantes
if (isset($_GET['flCarrera'])) {

	if ($_GET['flCarrera'] == "todas") {
		header('Location:index.php');
	}

	$flStudentList = $servicios->FiltrarEstudiantes($_GET['flCarrera']);
	$students = $flStudentList;
}

$layout->PrintTopPage();

?>

<div class="container">
<div class="d-flex mb-3 justify-content-between">
    <a class="btn btn-outline-primary" href="estudiantes/estudianteForm.php" role="button"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg> Agregar Nuevo</a>

    <form class="form-inline" action="index.php" method="get">
        <select id="flCarrera" name="flCarrera" class="custom-select" required="required">
            <option value="" <?= !isset($_GET['flCarrera']) ? "selected " : ""; ?> disabled>Carrera...</option>
            <option value="todas" >Todas</option>
            <option value="Redes" <?= (isset($_GET['flCarrera']) && $_GET['flCarrera'] == 'Redes') ? ' selected' : ''; ?>>Redes</option>
            <option value="Software" <?= (isset($_GET['flCarrera']) && $_GET['flCarrera'] == 'Software') ? ' selected' : ''; ?>>Software</option>
            <option value="Multimedia" <?= (isset($_GET['flCarrera']) && $_GET['flCarrera'] == 'Multimedia') ? ' selected' : ''; ?>>Multimedia</option>
            <option value="Mecatronica" <?= (isset($_GET['flCarrera']) && $_GET['flCarrera'] == 'Mecatronica') ? ' selected' : ''; ?>>Mecatronica</option>
            <option value="Seguridad informática" <?= (isset($_GET['flCarrera']) && $_GET['flCarrera'] == 'Seguridad informática') ? ' selected' : ''; ?>>Seguridad informática</option>
        </select>
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Filtrar</button>
    </form>
</div>
<table class="table table-borderless table-hover">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Carrera</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="contactos">
        <?php if (empty($students)) : ?>
            <tr>
                <td class="text-center" colspan="5">
                    <h5>NO HAY REGISTROS</h5>
                </td>
            </tr>

        <?php else : ?>
            <?php $i = 0;
            foreach ($students as $student) : ?>
                <tr class="border-bottom">
                    <td><?= $student->Nombre; ?></td>
                    <td><?= $student->Apellido; ?></td>
                    <td><?= $student->Carrera; ?></td>
                    <td><?= $student->Status; ?></td>
                    <td class="text-center">
                        <a href="estudiantes/estudianteForm.php?id=<?= $student->Id;; ?>" id="editar" name="btnEditar" class="btn btn-warning col-4">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                            </svg>
                        </a>
                        <a href="index.php?id=<?= $i; ?>" onclick="return confirm('¿Eliminar registro?');" id="eliminar" name="btnEliminar" class="btn btn-danger col-4 elim" title="Eliminar">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php $i++;
            endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php $layout->PrintBottomPage(); ?>
