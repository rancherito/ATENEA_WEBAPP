<?php namespace App\Controllers;

class Utils extends BaseController
{
	public function close_session()
	{
		$_SESSION['ateneaapp'] = [];
		header('Location: '. base_url());
		exit;
	}
	public function void()
	{
		echo $this->layout_view('admin', 'pages/void');
	}
}
