<link rel="stylesheet" href="<?= base_url()?>/public/styles/admin-module.css">
<?php color_modulo('var(--bg-sky)') ?>
<div id="divider-main" >
	<!--BUSCARDOR DEL MODULO, PROVEIDO POR HELPERS PHP-->
	<?= search_admin([
		'placeholder' => 'BUSCAR PRODUCTO',
		'title' => 'Gestion productos'
	])?>
	<!--CONTENEDOR DE ITEMS-->

			<table class="table-items open-module">
				<tr>
					<th class="table-index">#</th>
					<th>NOMBRE</th>
					<th>DESCRIPCION</th>
					<th class="c">CATEGORIA</th>
					<th class="c">MARCA</th>
					<th class="c">F. REGISTRO</th>
					<th class="c">ESTADO</th>
					<th style="width: 1px"></th>
				</tr>
				<tbody>
					<?php for ($i = 0; $i < 10; $i++): ?>
						<tr>
							<td class="table-index"><?= ($i+1) ?></td>
							<td>NOMBRE DE PRODUCTO</td>
							<td>DESCRIPCION LIGERA DEL PRODUCTO</td>
							<td class="c">CATEGORIA DEL PRODUCTO</td>
							<td class="c">MARCA DEL PRODUCTO</td>
							<td class="c">##/##/####</td>
							<td class="c">Estado</td>
							<td class="row-menu">
								<i class="fal fa-ellipsis-v table-menu" data-target='dmenu<?= ($i+1) ?>'></i>
								<ul id='dmenu<?= ($i+1) ?>' class='dropdown-content'>
								    <li><a><i class="fal fa-edit"></i> MODIFICAR</a></li>
								    <li><a><i class="fal fa-trash-alt"></i> ELIMINAR</a></li>
								 </ul>
							</td>
						</tr>
					<?php endfor; ?>

				</tbody>
			</table>
</div>
<div id="divider-option" class="">
	<div class="r open-module" id="c-options">
		<i class="fal fa-sort-size-up"></i>
		<i class="fal fa-search"></i>
		<i class="fal fa-check-square"></i>
	</div>
	<div id="c-list" class="open-module">
		<?php for ($i = 0; $i < 10; $i++): ?>
			<div>
				CATEGORIA PRODUCTO <?= ($i + 1) ?>
				<label>
					<input type="checkbox" class="filled-in">
					<span></span>
				</label>
			</div>
		<?php endfor; ?>
	</div>
</div>

<script type="text/javascript">
$('.table-menu').dropdown(
	{
		alignment: 'right',
		constrainWidth: false,
		coverTrigger: false,
		closeOnClick: false
	}
);
</script>
