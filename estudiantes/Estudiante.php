<?php
require_once('EstudianteService.php');

class Estudiante extends EstudianteService
{
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Status;
    public $Carrera;
    public $MateriasFav;
    public $FotoPerfil;

    public function __construct($id, $nombre, $apellido, $status, $carrera, $materiasFav, $fotoPerfil)
    {
        $this->Id = $id;
        $this->Nombre = $nombre;
        $this->Apellido = $apellido;
        $this->Status = $status;
        $this->Carrera = $carrera;
        $this->MateriasFav = $materiasFav;
        $this->FotoPerfil = $fotoPerfil;
    }
}
