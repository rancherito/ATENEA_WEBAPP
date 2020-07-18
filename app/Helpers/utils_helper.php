<?php
function movil() { return '600px'; }
function tablet() { return '992px'; }
function desktop() { return '1200px'; }

function get_image(string $ruta): string
{
	return 'assets/images/'.$ruta;
}

function generate_imageBase64($typeImage, $url, $nameVar_imageJs){
	$url_escudo = 'data:image/'.$typeImage.';base64,' . base64_encode(file_get_contents($url));
	echo "<script>let $nameVar_imageJs = new Image(); $nameVar_imageJs.src = '$url_escudo';</script>";
}

function color_modulo($bg)
{
	echo "
	<style>

		:root{
		}
	</style>

	";
}
function search_admin($vars = [])
{
	$default = [
		'placeholder' => 'buscar',
		'title' => 'Gestor modulo'
	];

	$vars = array_merge($default, $vars);
	echo "
	<div id='barsearch' class='open-module'>
		<div id='content-barsearch'>
			<label id='search' class='searchinput'></label>
			<a class='f-c'><i class='fal fa-plus'></i></a>
		</div>

		<h2 class='white-text'>$vars[title]</h2>
	</div>
	<script>
		const search = $('#search').focus();
		search.searchBox2();
		search.searchBox2_placeholder('$vars[placeholder]')

	</script>
	";
}

function loader_content(){
	$waiters = [];
	$waiters[] = '
	<div class="lds-grid" id="loader_content"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	';
	echo '
	<div class="sk-folding-cube" id="loader_content">
	<div class="sk-cube1 sk-cube"></div>
	<div class="sk-cube2 sk-cube"></div>
	<div class="sk-cube4 sk-cube"></div>
	<div class="sk-cube3 sk-cube"></div>
	</div>
	';
}
