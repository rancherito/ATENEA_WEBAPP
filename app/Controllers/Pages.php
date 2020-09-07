<?php namespace App\Controllers;
use App\Models\QueryUsuarios;
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
			$_pass = md5($_POST['pass']);
			$_usuarios = new QueryUsuarios();
			$res = $_usuarios->ValidarAcceso($_user, $_pass);

			if (!empty($res[0])) {
				$user = $res[0];

				switch ($user['Cargo']) {
					case 'user':
						$data = [
							'user' => $_user,
							'pass' => '202cb962ac59075b964b07152d234b70',
							'type' => 'user'
						];
						$_SESSION['ateneaapp'] = $data;
						echo "U";
					break;
					case 5:
						$data = [
							'user' => 'admin',
							'name' => $user['Nombres'].' '.$user['Apellidos'],
							'pass' => $user['Clave'],
							'type' => 'administrador'
						];
						$_SESSION['ateneaapp'] = $data;
						echo "A";
					break;
					default: echo "0"; break;
				}
			}
			//
			/**/
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
