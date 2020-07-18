<?php namespace App\Controllers;
class AdmProductos extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_productos');
	}
}
