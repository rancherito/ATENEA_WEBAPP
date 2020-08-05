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
	public function serv_StockPorProveedor_Salvar()
	{
		$Proveedores = new QueryProveedor();
		$Proveedores->StockPorProveedor_Salvar($_POST['id_proveedor'], $_POST['id_producto'], $_POST['id_almacen'], $_POST['stock']);
		
	}
}
