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
			<?php for($i = 0; $i< 10; $i++): ?>
				<div class="col m6 l3">
					<div class="dashbox">
						<i class="fal fa-box"></i>
						<div class="dashbox-info">
							<h4 class="dashbox-title">Acceso <?= ($i + 1) ?></h4>
							<div class="dashbox-description">
								Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
							</div>
						</div>
					</div>
				</div>
			<?php endfor; ?>

		</div>
	</div>
</div>

<script>
	new Vue({
		el: '#app',
		data: {
			isLoad: false,
			listAccess: [
				{name: 'VENTAS', description: 'Modulo de verificacion de pedidos y registro de ventas', link: '<?= base_url()?>/administrator/ventas', icon: 'fa-shopping-cart'},
				{name: 'PRODUCTOS', description: 'Modulo de consulta de productos, registro y modificación', link: '<?= base_url()?>/administrator/productos', icon: 'fa-store'}
			]
		},
		mounted: function () {
			this.isLoad = true
		}
	})
</script>
