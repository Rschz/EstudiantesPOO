<?php
require_once('EstudianteService.php');

class Estudiante
{
    public $Id;
    public $Nombre;
    public $Apellido;
    public $Status;
    public $Carrera;
    public $MateriasFav;
    public $FotoPerfil;

    public function __construct($id = null, $nombre, $apellido, $status, $carrera, $materiasFav, $fotoPerfil)
    {
        
        if ($id == null) {
            $this->Id = 1;
        } else {
            $this->Id = $id;
        }
        
        $this->Nombre = $nombre;
        $this->Apellido = $apellido;
        $this->Status = $status;
        $this->Carrera = $carrera;
        $this->MateriasFav = $materiasFav;
        $this->FotoPerfil = $fotoPerfil;
    }
}
