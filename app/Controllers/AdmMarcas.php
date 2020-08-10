<?php namespace App\Controllers;
use App\Models\QueryProductos;
class AdmMarcas extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_marcas');
	}
	public function serv_Marcas_Recuperar()
	{
		$_V =  ['id' => ''];
		$_V = array_merge($_V, $_GET);
		$Productos = new QueryProductos();
		$res = $Productos->MarcaProductos_Recuperar($_V['id']);
		return $this->response->setJSON($res);
	}
	public function serv_Marca_Salvar()
	{
		//print_r($_POST);
		$Productos = new QueryProductos();
		$res = $Productos->MarcaProductos_Salvar($_POST['id'], $_POST['nombre']);
		$img = $_POST['image'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);

		if (!empty($res[0]['KeyItem'])) {
			$key = $res[0]['KeyItem'];
			$file = "public/images/brands/$key.png";
			file_put_contents($file, $data);
		}
		


	}
}
