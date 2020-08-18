<?php namespace App\Controllers;
class Pages extends BaseController
{
	public function index()
	{
		echo $this->layout_view('modulos','start');
	}
	public function validar_acceso()
	{
		$_SESSION['ateneaapp'] = [];
		if (isset($_POST['user']) && isset($_POST['pass'])) {
			$_user = strtolower($_POST['user']);
			//$flag_pass = md5($_POST['pass']) == '202cb962ac59075b964b07152d234b70';
			switch ($_user) {
				case 'user':
					$data = [
						'user' => $_user,
						'pass' => '202cb962ac59075b964b07152d234b70',
						'type' => 'user'
					];
					$_SESSION['ateneaapp'] = $data;
					echo "U";
				break;
				case 'admin':
					$data = [
						'user' => $_user,
						'pass' => '202cb962ac59075b964b07152d234b70',
						'type' => 'administrador'
					];
					$_SESSION['ateneaapp'] = $data;
					echo "A";
				break;
				default: echo "0"; break;
			}
		}

	}
	public function administrator()
	{
		echo  $this->layout_view('admin','pages/administrador');
	}
	
	public function vercatalogo(){
		echo $this->layout_view('modulos','pages/public_catalogo');
	}

	public function carrito(){
		echo $this->layout_view('modulos','pages/public_carrito');
	}

	public function detalles(){
		echo $this->layout_view('modulos','pages/detalles');
	}

	public function venta(){
		echo $this->layout_view('modulos','pages/venta');
	}

}
