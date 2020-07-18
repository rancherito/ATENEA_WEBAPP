<?php namespace App\Controllers;
class AdmProveedores extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_proveedores');
	}
}
