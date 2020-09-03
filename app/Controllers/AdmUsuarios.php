<?php namespace App\Controllers;
use App\Models\QueryUsuarios;
class AdmUsuarios extends BaseController
{
	public function Usuarios_Listar()
	{
		echo $this->layout_view('admin', 'pages/adm_usuarios');
	}
	public function serv_Usuario_Listar()
	{
		$_usuario = new QueryUsuarios();
		$_V = [
			'dni' => '',
			'cargo' => '',
			'usuario' => ''
		];
		$_V = array_merge($_V, $_POST);
		$res = $_usuario->Usuarios_Listar($_V['dni'], $_V['cargo'], $_V['usuario']);
		return $this->response->setJSON($res);
	}
}
