<?php
// incluimos los controladores 
require_once 'controllers/routes.controller.php';
require_once 'controllers/clientes.controller.php';
require_once 'controllers/login.controller.php';
require_once 'connection.php'; // Asegúrate de que la ruta sea correcta


//incluimos los modelos
require_once 'models/clientes.model.php';

require_once './utf8_convert.php';

// Crear una instancia de la clase Connection
$routes = new RoutesController();

// Conectar a la base de datos
$routes->startRoutes();

?>
