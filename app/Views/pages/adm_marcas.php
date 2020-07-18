
<?php color_modulo('var(--bg-teal)') ?>
<style media="screen">
.row{
	margin-left: -11px;
	margin-right: -11px;
}
</style>
<div id="divider-main">
	<!--BUSCARDOR DEL MODULO, PROVEIDO POR HELPERS PHP-->
	<?php search_admin([
		'placeholder' => 'BUSCAR MARCA',
		'title' => 'Gestion de Marcas'
		])?>
		<!--CONTENEDOR DE ITEMS-->

		<table class="table-items open-module">
			<thead>
				<tr>
					<th class="table-index">#</th>
					<th style="width: 200px">NOMBRE</th>
					<th>DESCRIPCION</th>
					<th class="c" style="width: 100px">ESTADO</th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i = 0; $i < 10; $i++): ?>
					<tr>
						<td class="table-index"><?= ($i+1) ?></td>
						<td>NOMBRE DE MARCA #<?= ($i+1) ?></td>
						<td>DESCRIPCION LIGERA DE LA MARCA #<?= ($i+1) ?></td>
						<td class="c f-c">
							<div class="switch">
								<label>
									<input type="checkbox" disabled  <?= rand() % 2 ? '' : 'checked'?>>
									<span class="lever"></span>
								</label>
							</div>
						</td>
					</tr>
				<?php endfor; ?>

			</tbody>
		</table>
	</div>
	<div id="divider-option" class="f-c">
		<div id="message" class="f-c open-module">
			<i class="fal fa-comment-alt-smile icon-pres"></i>
			<br>
			<span class="c white-text">Gestiona las marcas de tu productos, te ayudara a tener mas orden en la busqueda de productos</span>
		</div>

	</div>

	<script type="text/javascript">
	const rows = $('.table-items tbody tr');
	const message = $('#message')
	const divider_option = $('#divider-option')
	let c_marca = {};
	c_marca.form = $(`
		<form class="opm">
			<div class="c white-text">
				<i class="fal fa-pen icon-pres c"></i>
				<p>Proceso de modificacion. Modifica una marca si estas seguro del proceso.</p>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="Placeholder" id="in_nombre" type="text">
					<label for="first_name">NOMBRE</label>
				</div>
				<div class="input-field col s12">
					<textarea id="in_descripcion" class="materialize-textarea"></textarea>
					<label for="textarea1">DESCRIPCION</label>
				</div>
				<div class="col s12 f-b">
					<span class="white-text">DESACTIVAR / ACTIVAR</span>
					<div class="switch">
						<label>
							<input type="checkbox" id="ck_estado">
							<span class="lever"></span>
						</label>
					</div>
				</div>
			</div>
			<br>
			<div class="r">
				<a class="btn bg-white">
					<i class="fal fa-times"></i>
				</a>
				<button class="btn waves-effect waves-light">
					<i class="fal fa-save"></i>
				</button>
			</div>
		</form>
		`)
		c_marca.nombre = c_marca.form.find('#in_nombre')
		c_marca.descripcion = c_marca.form.find('#in_descripcion')
		c_marca.estado = c_marca.form.find('#ck_estado')
		c_marca.cancelar = c_marca.form.find('a')
		c_marca.submit = c_marca.form.find('button')



		c_marca.form.submit( e => {
			e.preventDefault();
			console.log(656565);
		})
		c_marca.cancelar.click( e =>{
			divider_option.find('>*').detach()
			divider_option.append(message)
		})


		rows.click( e => {

			const target = $(e.currentTarget);
			const nombre = target.find('td:nth-child(2)').text();
			const descripcion = target.find('td:nth-child(3)').text();
			const estado = target.find('input').is(':checked');

			c_marca.nombre.val(nombre)
			c_marca.descripcion.val(descripcion)
			c_marca.estado.prop('checked', estado)

			divider_option.find('>*').detach()
			divider_option.append(c_marca.form)
		})
	</script>
