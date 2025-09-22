<?php
class EnlacesPagina
{
    public function enlacesPaginasModel($enlacesModel)
    {
        $validPages = ["inicio", "nosotros", "contactanos", "servicios", "login", "unauthorized", "studentsView"];

        if (in_array($enlacesModel, $validPages)) {
            // Usar versiones simples para las vistas principales
            if (in_array($enlacesModel, ["inicio", "nosotros", "contactanos", "servicios"])) {

                if ($enlacesModel == "contactanos") {
                    $module = getPath('view', "studentsView.php");
                } else {
                    $module = getPath('view', $enlacesModel . "_simple.php");
                }
            } else {
                $module = getPath('view', $enlacesModel . ".php");
            }
        } else {
            $module = getPath('view', "inicio_simple.php");
        }

        return $module;
    }
}
