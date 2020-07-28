<?php namespace App\Controllers;
use App\Models\QueryProductos;
class AdmProductos extends BaseController
{
	public function index()
	{
		$Productos = new QueryProductos();
		$data = [
			'marcas' => $Productos->MarcaProductos_Recuperar(),
			'categorias' => $Productos->CategoriaProductos_Recuperar(),
		];
		return $this->layout_view('admin', 'pages/adm_productos', $data);
	}
	public function serv_Productos_Listar()
	{
		$_V =  [
			'id_producto' => '',
			'Categoria' => '',
			'marca' => '',
			'nombre' => '',
			'descripcion' => '',
			'estado' => ''
		];
		$_V = array_merge($_V, $_POST);
		$Productos = new QueryProductos();
		$res = $Productos->Productos_Listar($_V['id_producto'], $_V['Categoria'], $_V['marca'], $_V['nombre'], $_V['descripcion'], $_V['estado']);

		return $this->response->setJSON($res);
	}
}
