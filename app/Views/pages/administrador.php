<style>
	#content-body{
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}

</style>
<div id="app" class="opacity-0" :class="{'opacity-1': isLoad}">
	<h2 class="c opm">Dashboard</h2>
	<br>
	<div class="container opm">

		<div class="row dashbox-container">
			<div class="col m6 l3" v-for="access in listAccess">
				<a class="dashbox" :href="access.link">
					<i class="fal" :class="[access.icon ? access.icon : 'fa-box']"></i>
					<div class="dashbox-info">
						<h4 class="dashbox-title">{{access.name}}</h4>
						<div class="dashbox-description">
							{{access.description}}
						</div>
					</div>
				</a>
			</div>

		</div>
	</div>
</div>

<script>
	new Vue({
		el: '#app',
		data: {
			isLoad: false,
			listAccess: [
				{name: 'Ventas', description: 'Modulo de verificacion de pedidos y registro de ventas', link: '<?= base_url()?>/administrator/ventas', icon: 'fa-shopping-cart'},
				{name: 'Productos', description: 'Modulo de consulta de productos, registro y modificación', link: '<?= base_url()?>/administrator/productos', icon: 'fa-store'},
				{name: 'Stock', description: 'Consulte el stock de productos de sus almacenes', link: '<?= base_url()?>/administrator/almacen/stock/consulta', icon: 'fa-hand-holding-box'},
				{name: 'Categorias', description: 'Modulo de consulta de categorias, registro y modificación', link: '<?= base_url()?>/administrator/categorias', icon: 'fa-ballot'},
				{name: 'Marcas', description: 'Modulo de consulta de marcas, registro y modificación', link: '<?= base_url()?>/administrator/marcas', icon: 'fa-tag'},
				{name: 'Proveedores', description: 'Modulo de consulta de proveedores, registro y modificación', link: '<?= base_url()?>/administrator/proveedores', icon: 'fa-shipping-fast'},
				{name: 'Agregar lote', description: 'Gestione de productos adquiridos a traves de sus proveedores', link: '<?= base_url()?>/administrator/almacen/stock/registro', icon: 'fa-box'}
			]
		},
		mounted: function () {
			this.isLoad = true
		}
	})
</script>
