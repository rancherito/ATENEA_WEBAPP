<?php namespace App\Controllers;
class AdmMarcas extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_marcas');
	}
}
