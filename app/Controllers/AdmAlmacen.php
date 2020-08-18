<?php namespace App\Controllers;
use App\Models\QueryProductos;
use App\Models\QueryProveedor;
use App\Models\QueryInfraestructura;
class AdmAlmacen extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_almacen');
	}
	public function Stock_Registro()
	{
		$Productos = new QueryProductos();
		$Proveedores = new QueryProveedor();
		$Infraestructura = new QueryInfraestructura();
		$data = [
			'marcas' => $Productos->MarcaProductos_Recuperar(),
			'categorias' => $Productos->CategoriaProductos_Recuperar(),
			'proveedores' => $Proveedores->Proveedor_Recuperar(),
			'almacenes' => $Infraestructura->LocalesEmpresa_Listar('', '', '1')
		];
		return $this->layout_view('admin', 'pages/adm_stockregistro', $data);
	}

	public function Stock_Consulta()
	{
		$Productos = new QueryProductos();
		$Infraestructura = new QueryInfraestructura();
		$data = [
			'productos' => $Productos->StockProductos_Listar('', ''),
			'almacenes' => $Infraestructura->LocalesEmpresa_Listar('', '', '1')
		];
		echo $this->layout_view('admin', 'pages/adm_stockconsulta', $data);
	}
	public function serv_StockPorProveedor_Salvar()
	{
		$Proveedores = new QueryProveedor();
		$Proveedores->StockPorProveedor_Salvar($_POST['id_proveedor'], $_POST['id_producto'], $_POST['id_almacen'], $_POST['stock']);

	}
	public function serv_StockProductos_Listar()
	{
		$_v = [
			'id_almacen' => '',
			'id_producto' => '',
			'nombre' => '',
			'limit' => ''
		];
		$_v = array_merge($_v, $_POST);
		$Productos = new QueryProductos();
		$res = $Productos->StockProductos_Listar($_v['id_almacen'], $_v['id_producto'], $_v['nombre'], $_v['limit']);
		return $this->response->setJSON($res);
	}
	public function serv_StockProductos_Transferir()
	{
		$Productos = new QueryProductos();
		$Productos->StockProductos_Transferir($_POST['id_producto'], $_POST['id_almacen_origen'], $_POST['id_alamcen_destino'], $_POST['unidades']);
	}
}
