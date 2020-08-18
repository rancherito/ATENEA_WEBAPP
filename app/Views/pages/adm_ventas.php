<style media="screen">
	#app{
		display: flex;
	}
	#colright{
		width: calc(100% - 600px)
	}
	#colleft{
		padding: 32px;
		width: 600px;
	}
	.search{
		padding: 0 16px !important;
		margin: 0 !important;
		height: 42px !important;
	}
	#content-productos-elegir{
		height: calc(100% - 82px);
		position: relative;
		overflow: auto;
	}
	
</style>
<div id="app" class="fill">
		<div id="colright">hola</div>
		<div id="colleft">
			<input type="text" class="search" placeholder="BUSQUE UN PRODUCTO" v-model="searchItem">
			<div class="space-32"></div>
			<div ref="content-elegir" id="content-productos-elegir">
				<div class="">
					<div class="card-panel f-b" v-for="n in productos">
						<div class="">
							{{updatecur()}}
							<div class="title-4">{{n.Nombre}}</div>
							<span>{{n.Descripcion}}</span>
							<div style="color: var(--primary)">ALMACEN: {{n.Nombre_Almacen}}</div>
							<div style="color: var(--secondary)">STOCK: {{n.Stock}}</div>
						</div>
						<div class="">
							<span class="btn">
								<i class="fal fa-plus"></i>
							</span>
						</div>
					</div>
				</div>


			</div>
		</div>
</div>

<script type="text/javascript">
	let ps = null
	new Vue({
		el: '#app',
		data: {
			searchItem: '',
			productos: []
		},
		created: function () {
			this.loadItems()
		},
		mounted: function () {
			//console.log();
			new SimpleBar( this.$refs['content-elegir'], {autoHide: false});
			//ps = new PerfectScrollbar(this.$refs['content-elegir']);

		},
		watch: {
			searchItem: function (val) {
			},
			productos: function () {
				//ps.update()
			}
		},
		methods: {
			updatecur: function () {
				//ps.update()
			},
			loadItems: function () {
				$.post('<?= base_url()?>/servicios/almacen/stock/listar', {}, data => {
					this.productos = data
				})
			}
		}
	})
</script>
