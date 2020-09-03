<style media="screen">

</style>
<div id="app" class="module opacity-0" :class="{'opacity-1': isLoadModule}">
	<main-search namemodule="Stock Productos" notadd @search="onsearch">
		<div v-for="almacen in almacenes" class="row" v-if="almacen.check">
			<div class="col s12">
				<h4>{{almacen.Nombre}}</h4>
			</div>
			<div class="col l12 xl6" v-for="producto in agrupacion_productos[almacen.Nombre]">
				<div class="stockproducto waves-effect waves" @click="transferir(producto)">
					<div class="stockproducto-wrap-image">
						<img src="<?= base_url() ?>/public/images/products/default.svg">
					</div>
					<div class="stockproducto-wrap-description">
						<div class="">
							<h4>{{producto.Nombre}}</h4>
							{{producto.Descripcion}}
						</div>
						<div class="stockproducto-info r">
							<span>{{producto.Nombre_Categoria}}</span> <span>STOCK <b>{{producto.Stock}}</b></span>
						</div>

					</div>
				</div>
			</div>
		</div>

	</main-search>
	<Soption>
		<div class="f-c fill" v-if="!isOpenForm">
			<div class="w100">
				<div class="c open-module">
					<div class="space-32"></div>
					<i class="fal fa-dolly icon-pres c"></i>
					<p>Filtre la operacion de consulta por <b class="black-text">ALMACENES</b> , sera mas sencillo visualizar lo que esta buscando</p>
					<br>
				</div>
				<div id="c-list" class="open-module">
					<list-filter
					v-for="almacen in almacenes"
					:name="almacen.Nombre"
					:check="almacen.check"
					@changecheck="almacen.check = $event">
					</list-filter>
				</div>
			</div>

		</div>
		<div class="f-c fill" v-show="isOpenForm">
			<div class="opm">
				<div class="c ">
					<i class="fal fa-exchange icon-pres c"></i>
					<p>Proceso de transferencia de stock de almacenes</p>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="ingrese categoria" type="text"readonly v-model="form_nombre">
						<label>NOMBRE</label>
					</div>
					<div class="input-field col s12">
						<input placeholder="ingrese categoria" type="text" readonly v-model="form_descripcion">
						<label>DESCRIPCION</label>
					</div>
					<div class="input-field col s8">
						<input placeholder="ingrese categoria" type="text" readonly v-model="form_almacen_origen">
						<label>ALAMCEN</label>
					</div>
					<div class="input-field col s4">
						<input type="text" readonly v-model="form_origen">
						<label>STOCK</label>
					</div>
					<div class="input-field col s12">
						<label>ALMACEN A TRANSFERIR</label>
						<select class="" name="" v-model="form_almacen">
							<option value="" disabled>SELECCIONE ALMACEN</option>
							<option value="" v-for="almacen in almacenes" :value="almacen.Id_LocalesEmpresa" :disabled="almacen.disabled" :class="{'hide': almacen.disabled}">{{almacen.Nombre}}</option>
						</select>
					</div>
					<div class="input-field col s8">
						UNIDADES A TRANSFERIR
					</div>
					<div class="input-field col s4">
						<input ref="in_cantidad" v-model.number="form_unidades" maxlength="3">
						<label>UNIDADES</label>
					</div>
				</div>
				<br>
				<div class="r">
					<a class="btn bg-white" @click="isOpenForm = false; currentItem = null">
						<i class="fal fa-times left" ></i>CERRAR
					</a>
					<a class="btn waves-effect waves-light" @click="saveItem">
						<i class="fal fa-save left"></i>SALVAR
					</a>
				</div>
			</div>
		</div>
	</Soption>
</div>

<script type="text/javascript">
	let almacenes = <?= json_encode($almacenes) ?>;
	almacenes.map(function (e) { e.disabled = false; e.check = true })

	new Vue({
		el: '#app',
		created: function () {
			this.loadItems()
		},
		mounted: function () {
			this.isLoadModule = true;
			Inputmask("numeric", { allowMinus: false, allowPlus: false}).mask(this.$refs.in_cantidad)
		},
		methods: {
			orderItem: function (productos, search) {
				for (var producto of productos) {
					let flag_descripcion = JaroWrinker(search.toLowerCase(), producto.Descripcion.toLowerCase())
					let flag_nombre = JaroWrinker(search.toLowerCase(), producto.Nombre.toLowerCase())
					producto.order = flag_descripcion > flag_nombre ? flag_descripcion : flag_nombre;
				}
				productos.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
			},
			onsearch: function (search) {
				//console.log(search);
				for (var almacen in this.agrupacion_productos) this.orderItem(this.agrupacion_productos[almacen], search)
			},
			transferir: function (producto) {
				this.form_unidades = 0
				this.isOpenForm = true
				this.form_almacen = ''
				//ASIGNANDO
				this.form_nombre = producto.Nombre
				this.form_descripcion = producto.Descripcion
				this.currentItem = producto
				this.form_origen = producto.Stock
				this.form_almacen_origen = producto.Nombre_Almacen
				for (var item of almacenes) item.disabled = item.Id_LocalesEmpresa == producto.IdAlmacen

			},
			loadItems: function () {
				$.post('<?= base_url() ?>/servicios/almacen/stock/listar', {}, data => {
					//console.log(data);
					let agrupacion_almacenes = {}

					for (var producto of data) {
						if (agrupacion_almacenes[producto.Nombre_Almacen] == undefined) agrupacion_almacenes[producto.Nombre_Almacen] = []
						agrupacion_almacenes[producto.Nombre_Almacen].push(producto)
					}
					console.log(agrupacion_almacenes);
					this.agrupacion_productos = agrupacion_almacenes
				})
			},
			saveItem: function () {

				if (this.currentItem && this.form_almacen && this.form_unidades <= this.currentItem.Stock && this.form_unidades > 0) {
					let values = {
						id_producto: this.currentItem.IdProducto,
						id_almacen_origen: this.currentItem.IdAlmacen,
						id_alamcen_destino: this.form_almacen,
						unidades: this.form_unidades
					}
					console.log(values);
					$.post('<?= base_url() ?>/servicios/almacen/stock/transferir', values, data => {
						this.currentItem = null
						this.isOpenForm = false
						this.loadItems()
						M.toast({html: 'STOCK TRANSFERIDO', classes: 'bg-primary'});
					})
				}
				else M.toast({html: 'DATOS FALTANTES O TRANSFERENCIA INCORRECTA', classes: 'bg-alert'});

			}
		},
		data: {
			search_producto: '',
			isLoadModule: false,
			agrupacion_productos: {},
			isOpenForm: false,
			form_nombre: '',
			form_descripcion: '',
			form_almacen: '',
			form_unidades: 0,
			form_origen: '',
			form_almacen_origen: '',
			currentItem: null,
			almacenes: almacenes
		}
	})
</script>
