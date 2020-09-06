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
			'categoria' => '',
			'marca' => '',
			'nombre' => '',
			'estado' => '',
			'limit' => ''
		];
		$_V = array_merge($_V, $_POST);
		$_V['nombre'] = str_replace(' ', '', $_V['nombre']);

		$nombre = '%';
		for ($i=0; $i < strlen($_V['nombre']); $i++) $nombre .= $_V['nombre'][$i] . '%';

		$Productos = new QueryProductos();
		$res = $Productos->Productos_Listar($_V['id_producto'], $_V['categoria'], $_V['marca'], $nombre, $_V['estado'], $_V['limit']);

		return $this->response->setJSON($res);
	}
	public function serv_Productos_Salvar()
	{
		$Productos = new QueryProductos();
		$res = $Productos->Productos_Guardar($_POST['key'], $_POST['nombre'], $_POST['descripcion'], $_POST['categoria'], $_POST['marca'],$_POST['precio'], '', $_POST['estado']);
		$img = $_POST['image'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		print_r(json_encode($res));
		if (!empty($res[0]['KeyItem'])) {
			$key = $res[0]['KeyItem'];
			$file = "public/images/products/$key.png";
			file_put_contents($file, $data);
		}
	}
}
