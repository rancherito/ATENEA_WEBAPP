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
$routes->add('vercatalogo', 'Pages::vercatalogo');
$routes->add('carrito','Pages::carrito');
$routes->add('detalles','Pages::detalles');
$routes->add('venta','Pages::venta');


//SECCION ADMINISTRADOR
if ($_APPVARS['user'] == 'admin') {

	//require 'Config/RoutesAdmin.php';
	$routes->get('administrator', 'Pages::administrator');

	$routes->get('administrator/productos', 'AdmProductos');
	$routes->post('servicios/productos/listar', 'AdmProductos::serv_Productos_Listar');
	$routes->post('servicios/productos/salvar', 'AdmProductos::serv_Productos_Salvar');


	$routes->get('administrator/marcas', 'AdmMarcas');
	$routes->get('servicios/marcas/recuperar', 'AdmMarcas::serv_Marcas_Recuperar');
	$routes->post('servicios/marcas/salvar', 'AdmMarcas::serv_Marca_Salvar');

	$routes->get('administrator/proveedores', 'AdmProveedores::index');
	$routes->get('servicios/proveedores/recuperar', 'AdmProveedores::serv_Proveedores_Recuperar');
	$routes->post('servicios/proveedores/salvar', 'AdmProveedores::serv_Proveedores_Salvar');


	$routes->get('administrator/almacen', 'AdmAlmacen');
	$routes->get('administrator/almacen/stock/consulta', 'AdmAlmacen::Stock_Consulta');
	$routes->get('administrator/almacen/stock/registro', 'AdmAlmacen::Stock_Registro');
	$routes->post('servicios/almacen/stock/salvar', 'AdmAlmacen::serv_StockPorProveedor_Salvar');
	$routes->post('servicios/almacen/stock/transferir', 'AdmAlmacen::serv_StockProductos_Transferir');
	$routes->post('servicios/almacen/stock/listar', 'AdmAlmacen::serv_StockProductos_Listar');

	$routes->get('administrator/usuarios', 'AdmUsuarios::Usuarios_Listar');
	$routes->post('servicios/usuarios/listar', 'AdmUsuarios::serv_Usuario_Listar');
	$routes->post('servicios/usuarios/recuperar_basico', 'AdmUsuarios::Usuario_RecuperarBasico');

	$routes->get('administrator/ventas', 'AdmVentas');
	$routes->post('administrator/ventas/imprimir', 'AdmVentas::Ventas_ImprimirBoleta');
	$routes->post('servicios/ventas/salvar', 'AdmVentas::serv_Ventas_Salvar');

	$routes->get('administrator/categorias', 'AdmCategorias::categorias');
	$routes->get('servicios/categorias/recuperar', 'AdmCategorias::serv_Categorias_Recuperar');
	$routes->post('servicios/categorias/salvar', 'AdmCategorias::serv_Categorias_Salvar');

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
