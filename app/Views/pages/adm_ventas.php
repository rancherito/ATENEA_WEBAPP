<style media="screen">
	#app{
		display: flex;
	}
	#colright{
		width: calc(100% - 600px);
		padding: 32px;
		margin-right: -32px;
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
	.addproductcar{
		display: inline-flex;
	}
	.addproductcar input{
		padding: 0 8px !important;
		margin: 0px !important;
		height: 36px !important;
		width: 56px !important;
		margin-right: 2px !important;

	}
</style>
<div id="app" class="fill">
		<div id="colright">
			<h3>VENTAS</h3>
			<div class="space-32"></div>
			<div class="row">
				<div class="input-field col s4">
		          <input placeholder="ingrese nombre" type="text" trim="form_nombre">
		          <label for="first_name">NOMBRES</label>
		        </div>
				<div class="input-field col s8">
		          <input placeholder="ingrese nombre" type="text" trim="form_nombre">
		          <label for="first_name">APELLIDOS</label>
		        </div>
				<div class="input-field col s4">
		          <input placeholder="ingrese nombre" type="text" trim="form_nombre">
		          <label for="first_name">DNI</label>
		        </div>
				<div class="input-field col s4">
		          <input placeholder="ingrese nombre" type="text" trim="form_nombre">
		          <label for="first_name">RUC</label>
		        </div>
				<div class="input-field col s4">
		          <input placeholder="ingrese nombre" type="text" trim="form_nombre">
		          <label for="first_name">TELEFONO</label>
		        </div>
			</div>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
		<div id="colleft">
			<input type="text" class="search" placeholder="BUSQUE UN PRODUCTO" v-model="searchItem">
			<div class="space-32"></div>
			<div ref="content-elegir" id="content-productos-elegir">
				<div class="">
					<product-car
						v-for="n in productos"
						:nombre="n.Nombre"
						:descripcion="n.Descripcion"
						:almacen="n.Nombre_Almacen"
						:stock="n.Stock"
						:data="n"
						:onadd="addproduct"
					>
					</product-car>
				</div>
			</div>
		</div>
</div>

<script type="text/javascript">
	Vue.component('product-car',{
		'template': `
			<div class="card-panel f-b">
				<div class="">
					<div class="title-4">{{nombre}}</div>
					<span>{{descripcion}}</span>
					<div style="color: var(--primary)">ALMACEN: {{almacen}}</div>
					<div style="color: var(--secondary)">STOCK: {{calc_stock}}</div>
				</div>
				<div class="addproductcar">
					<input maxlength="2" placeholder="unid." ref="input" type="text" v-model.number="stock_add">
					<span @click="addcar" ref="tooltip" class="btn ttaddcar" data-position="bottom" data-tooltip="Añadir al carro">
						<i class="fal fa-shopping-basket"></i>
					</span>
				</div>
			</div>
		`,
		props: ['nombre', 'almacen', 'stock', 'data', 'descripcion', 'onadd'],
		data: function () {
			return {
				stock_add: 0,
				rest_stock: 0
			}
		},
		computed: {
			calc_stock: function () {
				return this.stock - this.rest_stock
			}
		},
		mounted: function () {
			M.Tooltip.init(this.$refs.tooltip);
			Inputmask("numeric", {
				allowMinus: false,
				allowPlus: false,
				min: 0,
			}).mask(this.$refs.input)
		},
		methods: {
			addcar: function () {
				if (typeof this.onadd == 'function') {
					if (this.stock_add > 0 && this.stock_add <= this.calc_stock) {
						this.onadd(this.data, this.stock_add)
						this.rest_stock += this.stock_add;
					}
					else M.toast({html: 'UNIDADES FUERA DE RANGO', classes: 'bg-alert'});
				}
			}
		}
	})
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
			this.$nextTick(function () {

			});

		},
		updated: function () {
		  this.$nextTick(function () {

		  })
	  	},
		methods: {
			addproduct: function (data, unidades) {
				console.log(unidades);
				console.log(data);
			},
			loadItems: function () {
				$.post('<?= base_url()?>/servicios/almacen/stock/listar', {}, data => {
					this.productos = data

				})
			}
		}
	})
</script>
