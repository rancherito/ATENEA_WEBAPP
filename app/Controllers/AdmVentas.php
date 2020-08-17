<?php namespace App\Controllers;
use App\Models\QueryProductos;
use App\Models\QueryProveedor;
class AdmVentas extends BaseController
{
	public function index()
	{
		echo $this->layout_view('admin', 'pages/adm_ventas');
	}
}
