<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
* --------------------------------------------------------------------
* Router Setup
* --------------------------------------------------------------------
*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
* --------------------------------------------------------------------
* Route Definitions
* --------------------------------------------------------------------
*/

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
session_start();

$_APPVARS = $_SESSION['ateneaapp'];
$routes->get('/', 'Pages::index');
$routes->get('close', 'Utils::close_session');
$routes->add('validar_acceso', 'Pages::validar_acceso');


//SECCION ADMINISTRADOR
if ($_APPVARS['user'] == 'admin') {


	$routes->get('dadmin', 'Pages::dadmin');

	$routes->get('dadmin/productos', 'AdmProductos::index');
	$routes->post('dadmin/productos/listar', 'AdmProductos::serv_Productos_Listar');
	$routes->post('dadmin/productos/salvar', 'AdmProductos::serv_Productos_Salvar');

	$routes->get('dadmin/marcas', 'AdmMarcas::index');

	$routes->get('dadmin/proveedores', 'AdmProveedores::index');
	$routes->get('dadmin/proveedores/recuperar', 'AdmProveedores::serv_Proveedores_Recuperar');
	$routes->post('dadmin/proveedores/salvar', 'AdmProveedores::serv_Proveedores_Salvar');

	$routes->get('dadmin/almacen', 'AdmAlmacen::index');

	$routes->get('dadmin/reportes', 'Utils::void');

	$routes->get('dadmin/ventas', 'Utils::void');

	$routes->get('dadmin/categorias', 'AdmController::categorias');

}
/**resultados
* --------------------------------------------------------------------
* Additional Routing
* --------------------------------------------------------------------
*
* There will often be times that you need additional routing and you
* need to it be able to override any defaults in this file. Environment
* based routes is one such time. require() additional route files here
* to make that happen.
*
* You will have access to the $routes object within that file without
* needing to reload it.
*/
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
