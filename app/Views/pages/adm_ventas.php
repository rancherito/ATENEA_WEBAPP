<style media="screen">
#divider-option{
	width: 500px;
}
#divider-main{
	width: calc(100% - 500px)
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
		display: flex;
		background: var(--gray-light);
		padding: 16px;
		width: 100%;
		justify-content: space-between;
		align-items: center;
	}
	.addproductcar input{
		padding: 0 8px !important;
		margin: 0px !important;
		height: 36px !important;
		width: 56px !important;
		margin-right: 2px !important;

	}
	.product-car{
		background: white;
		margin-bottom: 16px
	}
	.product-car-description{
		padding: 16px;
	}
</style>
<div id="app" class="module opacity-0" :class="{'opacity-1': isLoad}">
		<main-search :cansearch="false" :namemodule="'REGISTRO DE VENTAS'">

			<form @submit.prevent="saveVenta">
				<div class="row">
					<div class="input-field col m12 l4">
			          <input ref="form_dni" required maxlength="12" minlength="8" placeholder="ingrese nombre" type="text" v-model.trim="form_dni">
			          <label>DNI*</label>
			        </div>
					<div class="input-field col m12 l8">
			          <input maxlength="13" minlength="11" placeholder="ingrese nombre" type="text" v-model.trim="form_ruc">
			          <label>RUC</label>
			        </div>
					<div class="input-field col m12 l4">
			          <input required placeholder="ingrese nombre" type="text" v-model.trim="form_nombre">
			          <label>NOMBRES*</label>
			        </div>
					<div class="input-field col m12 l8">
			          <input required placeholder="ingrese aprellidos" type="text" v-model.trim="form_apellidos">
			          <label>APELLIDOS*</label>
			        </div>

					<div class="input-field col m12 l4">
			          <input ref="form_telefono" placeholder="ingrese telefono" type="text" v-model.trim="form_telefono">
			          <label>TELEFONO</label>
			        </div>
					<div class="input-field col m12 l8">
			          <input ref="form_email" placeholder="ingrese email" type="text" v-model.trim="form_email">
			          <label>EMAIL</label>
			        </div>

				</div>
				<div class="r">
					<button class="btn waves-effect waves-light"><i class="left fal fa-shopping-cart"></i>SALVAR VENTA</button>
				</div>
			</form>
			<div class="space-32"></div>
			<h2>DETALLE VENTA</h2>
			<div class="space-32"></div>
			<table class="white" v-if="carrito.length">
				<thead>
					<tr>
						<th class="index">#</th>
						<th>NOMBRE</th>
						<th>DESCRIPCION</th>
						<th width="100">P. UNIT.</th>
						<th width="100">P. TOTAL</th>
						<th class="index">Unidades</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(producto, i) in carrito">
						<td>{{i+1}}</td>
						<td>{{producto.nombre}}</td>
						<td>{{producto.descripcion}}</td>
						<td class="c">{{producto.unidades}}</td>
						<td class="r">S/{{numeral(producto.precio_unitario).format('0.00')}}</td>
						<td class="r">S/{{numeral(producto.precio_total).format('0.00')}}</td>
					</tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><b>TOTAL</b> </td>
					<td class="c">S/{{numeral(form_total).format('0.00')}}</td>
				</tbody>

			</table>
			<div class="card-panel" v-if="carrito.length == 0">
				<div class="title-3 grey-text f-c" style="height: 100px">Ningun Producto cargado</div>
			</div>
		</main-search>
		<Soption>
			<input type="text" class="search" placeholder="BUSQUE UN PRODUCTO" v-model="searchItem">
			<div class="space-32"></div>
			<div ref="content-elegir" id="content-productos-elegir" class="w100">
				<div class="">
					<product-car
						v-for="n in productos"
						:nombre="n.Nombre"
						:descripcion="n.Descripcion"
						:almacen="n.Nombre_Almacen"
						:stock="n.Stock"
						:precio="n.PrecioRegular"
						:data="n"
						:onadd="addproduct"
					>
					</product-car>
				</div>
			</div>
		</Soption>

</div>

<script type="text/javascript">
	Vue.component('product-car',{
		'template': `
			<div class="product-car">
				<div class="product-car-description">
					<div class="title-4">{{nombre}}</div>
					<span>{{descripcion}}</span>
					<div><span style="color: var(--primary)">UBICACION:</span> {{almacen}}</div>
					<div><span style="color: var(--secondary)">COSTO:</span> {{precio}} </div>
				</div>
				<div class="addproductcar">
					<div>UNIDADES [ {{calc_stock}} ]</div>
					<div style="display: inline-flex">
						<input v-on:keyup.enter="addcar" maxlength="2" placeholder="unid." ref="input" type="text" v-model.number="stock_add">
						<span @click="addcar" ref="tooltip" class="btn ttaddcar waves-effect waves-light" data-position="bottom" data-tooltip="Añadir al carro">
							<i class="fal fa-shopping-basket"></i>
						</span>
					</div>

				</div>
			</div>
		`,
		props: ['nombre', 'almacen', 'stock', 'data', 'descripcion', 'onadd', 'precio'],
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
			//
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
						this.stock_add = 0;
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
			productos: [],
			carrito: [],
			quitar_stock: [],
			isLoad: false,
			numeral: numeral,
			form_dni: '75258279',
			form_ruc: '',
			form_nombre: 'ADRIANO',
			form_apellidos: 'ROMEROZ AQUINO',
			form_telefono: '',
			form_email: ''
		},
		computed: {
			form_total: function () {
				let total = 0
				for (var producto of this.carrito) total += producto.precio_total
				return total
			}
		},
		watch: {
			searchItem: function (val) {
				for (var producto of this.productos) producto.order = JaroWrinker(val.toLowerCase(), producto.Nombre.toLowerCase())
				this.productos.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
				//console.log(val);
			}
		},
		created: function () {
			this.loadItems()
		},
		mounted: function () {
			Inputmask("email").mask(this.$refs.form_email);
			Inputmask( "999 999 999").mask(this.$refs.form_telefono);
			Inputmask( "9", {repeat: 12}).mask(this.$refs.form_dni);
			this.isLoad = true
			new SimpleBar( this.$refs['content-elegir']);
		},
		methods: {
			clear: function () {
				this.productos = []
				this.carrito = []
				this.quitar_stock = []
				this.form_dni = ''
				this.form_ruc = ''
				this.form_nombre = ''
				this.form_apellidos = ''
				this.form_telefono = ''
				this.form_email = ''
			},
			saveVenta: function () {
				if (
					(this.form_email == '' || v_email(this.form_email)) &&
					v_DNI(this.form_dni)
				) {
					if (this.quitar_stock.length) {
						const cliente = {
							dni: this.form_dni,
							ruc: this.form_ruc,
							nombre: this.form_nombre.toUpperCase(),
							apellidos: this.form_apellidos.toUpperCase(),
							telefono: this.form_telefono,
							email: this.form_email.toUpperCase()
						}

						const datos = {
							cliente: cliente,
							detalles: this.quitar_stock
						}
						$.post('<?= base_url() ?>/servicios/ventas/salvar', datos, res => {
							this.clear()
							this.loadItems()
							M.toast({html: 'Venta Registrada', classes: 'bg-primary'});
						})
					}
					else M.toast({html: 'Carro de venta vacio', classes: 'bg-alert'});
				}
				else M.toast({html: 'Datos cliente incorrectos', classes: 'bg-alert'});


			},
			addproduct: function (data, unidades) {
				//AGREGAR AL CARRO DE VENTAS
				let flag = false
				for (var producto of this.carrito)
					if (flag = producto.id == data.IdProducto) {
						producto.unidades += unidades;
						producto.precio_total = producto.unidades * data.PrecioRegular
					}
				if (!flag)
					this.carrito.push({
						id: data.IdProducto,
						nombre: data.Nombre,
						descripcion: data.Descripcion,
						unidades: unidades,
						precio_unitario: data.PrecioRegular,
						precio_total: data.PrecioRegular * unidades
					})


				//DESCONTAR STOCK
				let flag2 = false
				for (var producto of this.quitar_stock)
					if (flag2 = (producto.id == data.IdProducto && producto.id_almacen == data.IdAlmacen)) {
						producto.unidades += unidades;
					}
				if (!flag2)
					this.quitar_stock.push({
						id_almacen: data.IdAlmacen,
						id: data.IdProducto,
						unidades: unidades,
					})

			},
			loadItems: function () {
				$.post('<?= base_url()?>/servicios/almacen/stock/listar', {}, data => {
					this.productos = data
				})
			}
		}
	})
</script>
