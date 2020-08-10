<?php namespace App\Controllers;
use App\Models\QueryProductos;
class AdmCategorias extends BaseController
{
	public function categorias()
	{
		echo $this->layout_view('admin', 'pages/adm_categorias');
	}
	public function serv_Categorias_Recuperar()
	{
		$_V =  ['id' => ''];
		$_V = array_merge($_V, $_GET);
		$Productos = new QueryProductos();
		$res = $Productos->CategoriaProductos_Recuperar($_V['id']);
		return $this->response->setJSON($res);
	}
	public function serv_Categorias_Salvar()
	{
		$Productos = new QueryProductos();
		$res = $Productos->CategoriaProductos_Salvar($_POST['id'], $_POST['nombre']);
	}

}
