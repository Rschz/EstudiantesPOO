<?php
require_once("IService.php");

class EstudianteService implements IService
{
    private $CookieTime;
    private $CookieName;

    public function __construct()
    {
        $this->CookieTime = time() + 60*60*24*30;
        $this->CookieName = "estudiante";
    }

    public function GetAll()
    {
        $cookieValue = isset($_COOKIE['estudiante']) ? json_decode($_COOKIE['estudiante']) : array() ;
        return $cookieValue;
    }
    public function GetById($id)
    {

    }
    public function Add($obj)
    {
        $newId = end($this->GetAll())["id"] + 1;
        $obj->id = $newId;
        setcookie($this->CookieName, $obj, $this->CookieTime, "/");
    }
    public function Update($id, $obj)
    {
    }
    public function Delete($id)
    {
    }
}
