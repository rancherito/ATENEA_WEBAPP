<?php namespace App\Controllers;
class AdmUsuarios extends BaseController
{
	public function Usuarios_Listar()
	{
		echo $this->layout_view('admin', 'pages/adm_usuarios');
	}
}
