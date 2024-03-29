<?php

class Layout
{

    public $PAGE_TITLE;
    public $CURRENT_PAGE;
    public $Direct;
    function __construct()
    {
        $this->PageConf();
        $this->rootDir = '/ITLA C32020/EstudiantesPOO';
    }

    private function PageConf()
    {
        switch (basename($_SERVER["SCRIPT_NAME"])) {
            case "estudianteForm.php":
                $this->CURRENT_PAGE = "Formulario de Estudiante";
                $this->PAGE_TITLE = "Agregar estudiante";
                break;
            default:
                $this->CURRENT_PAGE = "Index";
                $this->PAGE_TITLE = "Estudiantes";
        }
    }

    public function PrintTopPage()
    {

        $topPage =
            <<<EOF
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$this->PAGE_TITLE}</title>
        
        <link rel="stylesheet" type="text/css" href="{$this->rootDir}/assets/css/bootstrap.min.css?v=3.4.2">
        <link rel="stylesheet" type="text/css" href="{$this->rootDir}/assets/css/style.css?v=3.4.2">
        </head>
        <body>
            <header>
                <div class="jumbotron">
                    <h1>Gestion de Estudiantes</h1>
                </div>
            </header>
        EOF;

        echo $topPage;
    }


    public function PrintBottomPage()
    {

        $cDate = date("Y");

        $bottomPage =
            <<<EOF
            <footer class="footer bg-light">
                <div class="text-center py-3">
                    &copy; {$cDate}
                </div>
            </footer>
        </body>
    </html>
    EOF;

        echo $bottomPage;
    }
}
