<?php
require_once("IService.php");

class EstudianteService implements IService
{
    private $CookieTime;
    private $CookieName;
    private $ValorBusqueda = 'todas';

    public function __construct()
    {
        $this->CookieTime = time() + 60 * 60 * 24 * 30;
        $this->CookieName = "estudiantes";
    }

    public function FiltrarEstudiantes($valorBusqueda)
    {
        $this->ValorBusqueda = $valorBusqueda;

        $cookieArrayObj = isset($_COOKIE[$this->CookieName]) && !empty($_COOKIE[$this->CookieName])
            ? json_decode($_COOKIE[$this->CookieName])
            : header('Location:index.php');

        $flt = array_filter($cookieArrayObj, function ($e) {
            return $e->Carrera == $this->ValorBusqueda;
        });

        return $flt;
    }

    public function GetLastId()
    {
        $lastId = !empty($this->GetAll()) ? end($this->GetAll())->Id : 0;
        return $lastId;
    }

    public function GetAll()
    {
        $cookieArrayObj = isset($_COOKIE[$this->CookieName]) && !empty($_COOKIE[$this->CookieName])
            ? json_decode($_COOKIE[$this->CookieName])
            : array();

        return $cookieArrayObj;
    }
    public function GetById($id)
    {
        $cookieArrayObj = json_decode($_COOKIE[$this->CookieName]);
        $index = array_search($id, array_column($cookieArrayObj, 'Id'));

        return $cookieArrayObj[$index];
    }
    public function Add($obj)
    {
        $cookieArrayObj =  isset($_COOKIE[$this->CookieName]) && !empty($_COOKIE[$this->CookieName])
            ? json_decode($_COOKIE[$this->CookieName])
            : array();
        array_push($cookieArrayObj, $obj);
        setcookie($this->CookieName, json_encode($cookieArrayObj), $this->CookieTime, "/");

        print_r($_COOKIE['estudiantes']);
    }
    public function Update($obj)
    {
        $cookieArrayObj = json_decode($_COOKIE[$this->CookieName]);
        $index = array_search($obj->Id, array_column($cookieArrayObj, 'Id'));
        $cookieArrayObj[$index] = $obj;
        setcookie($this->CookieName, json_encode($cookieArrayObj), $this->CookieTime, "/");
    }
    public function Delete($id)
    {
        $cookieArrayObj = json_decode($_COOKIE[$this->CookieName]);
        $index = array_search($id, array_column($cookieArrayObj, 'Id'));
        unset($cookieArrayObj[$index]);

        setcookie($this->CookieName, json_encode($cookieArrayObj), $this->CookieTime, "/");
        
    }
}
