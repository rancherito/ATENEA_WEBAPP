<?php namespace App\Controllers;
use App\Models\QueryProductos;
use App\Models\QueryUsuarios;
class AdmVentas extends BaseController
{
	public function index()
	{

		echo $this->layout_view('admin', 'pages/adm_ventas');
	}
	public function serv_Ventas_Salvar()
	{
		$_usuarios = new  QueryUsuarios();
		$_productos = new  QueryProductos();

		$cliente = $_POST['cliente'];
		$detalles = $_POST['detalles'];
		$_usuarios->Usuarios_Salvar($cliente['dni'], $cliente['ruc'], $cliente['nombre'], $cliente['apellidos'], 4, $cliente['dni'], '', $Usuario['telefono'], $Usuario['email'], 1);
		$id_venta = $_productos->Venta_Salvar('-1',$cliente['dni'],'',0,1);
		//DetalleVenta_Salvar($IdProducto, $DescuentoItem, $Unidades, $IdVenta, $local)
		foreach ($detalles as $key => $producto) {
			$_productos->DetalleVenta_Salvar($producto['id'], 0, $producto['unidades'], $id_venta['id_venta'], $producto['id_almacen']);
		}
		return $this->response->setJSON($id_venta);
	}
	public function Ventas_ImprimirBoleta()
	{
		$id_venta = $_POST['id_venta'];
		$_ventas = new QueryProductos();
		$data = [
			'detalles' => $_ventas->DetalleVenta_Recuperar($id_venta),
			'venta' => $_ventas->Venta_Recuperar($id_venta)[0]
		];
		return view('pages/adm_boleta', $data);
	}

}
