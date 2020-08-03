<?php namespace App\Controllers;
use App\Models\QueryProveedor;
class AdmProveedores extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_proveedores');
	}

	public function serv_Proveedores_Recuperar()
	{
		$_V = [
			'id' => ''
		];
		$_V = array_merge($_V, $_POST);
		$Proveedor = new QueryProveedor();
		$res = $Proveedor->Proveedor_Recuperar($_V['id']);
		return $this->response->setJSON($res);
	}
	public function serv_Proveedores_Salvar()
	{
		$Proveedor = new QueryProveedor();
		$Proveedor->Proveedor_Salvar($_POST['key'], $_POST['nombre'], $_POST['descripcion'], $_POST['telefono'], $_POST['email'], $_POST['calificacion']);
	}

}
