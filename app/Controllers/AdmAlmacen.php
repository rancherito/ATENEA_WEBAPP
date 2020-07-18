<?php namespace App\Controllers;
class AdmAlmacen extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_almacen');
	}
}
