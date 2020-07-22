<?php namespace App\Controllers;
class AdmController extends BaseController
{
	public function categorias()
	{
		echo $this->layout_view('admin', 'pages/adm_categorias');
	}
}
