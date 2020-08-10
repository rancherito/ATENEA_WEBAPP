<style media="screen">
.wrapp-card-productos{
	padding-top: 32px;
	margin: 0 -5px;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.card-producto{
	background: white;
	height: 380px;
	width: 240px;
	margin: 5px;
	border-radius: 3px;
	position: relative;
}
.card-producto .card-producto-image{
	width: 180px;
	height: 180px;
}
.card-producto > div:nth-child(2){
	z-index: 2;
	width: 100%;
	height: calc(100% - 180px);
	padding: 16px;
	font-size: .9rem;
	display: flex;
	justify-content: space-between;
	flex-direction: column;
	text-align: center;
}
.card-producto img{
	height: 100%;
	padding: 16px;
}
.card-producto b{

}
.card-producto-categoria{
	color: var(--orange);
	font-size: 1rem;
}
.card-producto-estado{
	height: 12px;
	width: 12px;
	float: right;
	border-radius: 50%;
	margin-left: 8px;
	background: gray;
	position: absolute;
	top: 16px;
	right: 16px;
}
.card-producto-estado-activo{
	background: var(--bg-lima)
}

</style>
<div id="app" class="module">
	<Smain @content="content = $event">
		<div id='barsearch'>
			<div id='content-barsearch'>
				<input id='search' class='searchinput' placeholder="BUSCAR PRODUCTOS" v-model="searchProducto">
				<a id='add-item' class='f-c waves-effect waves-light' @click="addProducto"><i class='fal fa-plus'></i></a>
			</div>
			<h2 class=''>GESTION PRODUCTOS</h2>
		</div>
		<!--CONTENEDOR DE ITEMS-->
		<div class="wrapp-card-productos">
			<table class="table-items">
				<thead>
					<tr>
						<th class="c" style="width: 1px">#</th>
						<th>NOMBRE</th>
						<th>DESCRIPCION</th>
						<th class="c">MARCA</th>
						<th class="c">CATEGORIA</th>
						<th class="c" style="width: 1px">ESTADO</th>
					</tr>
				</thead>
				<tbody id="app_list_categorias">
					<tr v-for="(producto , index) in productos" @click="editItem(producto)" >
						<td class="c">{{index}}</td>
						<td>{{producto.Nombre}}</td>
						<td>{{producto.Descripcion}}</td>
						<td class="c">{{producto.Marca_Nombre}}</td>
						<td class="c">{{producto.Categoria_Nombre}}</td>
						<td class="c f-c">
							<div class="state" :class="{'state-off': !producto.Estado}"></div>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
	</Smain>
	<Soption>
		<div class="tab-in-divider" v-show="!onOpenCrud">
			<ul ref="tabs" class="tabs tabs-fixed-width">
				<li class="tab col s3"><a href="#tab-categorias">CATEGORIAS</a></li>
				<li class="tab col s3"><a href="#tab-marcas">MARCAS</a></li>
			</ul>
			<div id="tab-categorias" class="wrapper-tab">
				<div class="c  open-module">
					<div class="space-32"></div>
					<i class="fal fa-ballot icon-pres c"></i>
					<p>Filtre la operacion de consulta por <b class="black-text">CATEGORIAS</b> , sera mas sencillo visualizar lo que esta buscando</p>
					<br>
				</div>
				<div class="c-options open-module">
					<input type="text" placeholder="buscar categoria" v-model="searchCategoria">
					<label>
						<input type="checkbox" class="filled-in" v-model="filter_categoria" ><span></span>
					</label>
				</div>
				<br>
				<div class="open-module">
					<list-filter v-for="(categoria, index) in categorias" :onchange="onChecked_categoria" :name="categoria.Nombre" :check="categoria.check" @changecheck="categoria.check = $event">
					</list-filter>
				</div>
			</div>
			<div id="tab-marcas"  class="wrapper-tab">
				<div class="c open-module">
					<div class="space-32"></div>
					<i class="fal fa-tag icon-pres c"></i>
					<p>Filtre la operacion de consulta por <b class="black-text">MARCAS</b> , sera mas sencillo visualizar lo que esta buscando</p>
					<br>
				</div>

				<div class="c-options open-module">
					<input type="text" placeholder="buscar categoria" v-model="searchMarca">
					<label>
						<input type="checkbox" class="filled-in" v-model="filter_marca">
						<span></span>
					</label>
				</div>
				<div id="c-list" class="open-module">
					<list-filter
					v-for="marca in marcas"
					:onchange="onChecked_categoria"
					:name="marca.Nombre"
					:check="marca.check"
					@changecheck="marca.check = $event"
					>
				</list-filter>
			</div>
		</div>
	</div>
	<div v-show="onOpenCrud" class="fill f-c">
		<div class="opm">
			<div class="c ">
				<i class="fal icon-pres c" :class="{'fa-pen' : !onNewProducto, 'fa-plus' : onNewProducto}"></i>
				<p>{{onNewProducto ? message_new : message_edit}}</p>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="ingrese categoria" type="text" v-model="form_nombre">
					<label>NOMBRE</label>
				</div>
				<div class="input-field col s12">
					<input  id="in_descripcion" type="text" placeholder="ingrese descripcion"  v-model="form_descripcion"></input>
					<label>DESCRIPCION</label>
				</div>
				<div class="input-field col s12">
					<label>CATEGORIA</label>
					<select v-model="form_categoria">
						<option value="" disabled selected>Seleccione categoria</option>
						<option v-for="categoria in categorias" :value="categoria.Id_categoriaProducto">{{categoria.Nombre}}</option>
					</select>
				</div>

				<div class="input-field col s12">
					<label>MARCA</label>
					<select v-model="form_marca">
						<option value="" disabled selected>Seleccione marca</option>
						<option v-for="marca in marcas" :value="marca.Id_marcaProducto">{{marca.Nombre}}</option>
					</select>
				</div>
				<div class="input-field col s12">
					<input ref="input_precio" type="text" placeholder="ingrese descripcion" v-model="form_precio"></input>
					<label>PRECIO</label>
				</div>
				<div class="col s12 f-b">
					<span class="">DESACTIVAR / ACTIVAR</span>
					<div class="switch">
						<label>
							<input type="checkbox" id="ck_estado"  v-model="form_estado">
							<span class="lever"></span>
						</label>
					</div>
				</div>
			</div>
			<br>
			<div class="r">
				<a class="btn bg-white" @click="onOpenCrud = false">
					<i class="fal fa-times left" ></i>CERRAR
				</a>
				<a class="btn waves-effect waves-light" @click="saveForm">
					<i class="fal fa-save left"></i>SALVAR
				</a>
			</div>
		</div>
	</div>


</Soption>
</div>


<script type="text/javascript">

let categorias = <?= json_encode($categorias) ?>; categorias = categorias.map(v => {v.check = !0; return v})
let marcas = <?= json_encode($marcas) ?>; marcas = marcas.map(v => {v.check = !0; return v})

let app = new Vue({
	el: '#app',
	created: function () {
		this.filter_categoria = true;
		this.filter_marca = true;
		this.getProductos()
	},
	data: {
		content: null,
		productos : [],
		categorias: categorias,
		marcas: marcas,
		onOpenCrud: false,
		message_edit: 'Proceso de modificacion. Modifica una categoria si estas seguro del proceso.',
		message_new: 'Formulario de registro de productos. El registro de productos nuevos es posible aun cuando no haya stock del productos en almacen.',
		onNewProducto: true,
		filter_categoria: false,
		filter_marca: false,
		form_nombre: '',
		form_descripcion: '',
		form_categoria: '',
		form_marca: '',
		form_estado: true,
		form_key: -1,
		form_precio: 0,
		searchProducto: '',
		searchCategoria: '',
		searchMarca: ''

	},
	mounted: function () {
		new SimpleBar(this.content, { autoHide: false })
		M.Tabs.init(this.$refs.tabs)
		Inputmask({
			mask: '(99){+|1}.00',
			positionCaretOnClick: "radixFocus",
			radixPoint: ".",
			_radixDance: true,
			numericInput: true,
			placeholder: "0",
			definitions: {
				"0": {
					validator: "[0-9\uFF11-\uFF19]"
				}
			}
		}).mask(this.$refs.input_precio)
	},
	watch: {
		filter_categoria: function (val) {
			for (var categoria of this.categorias) categoria.check = val
			this.getProductos();
		},
		filter_marca: function (val) {
			for (var marca of this.marcas) marca.check = val
			this.getProductos();
		},
		searchCategoria: function (val) {
			for (var categoria of this.categorias) categoria.order = JaroWrinker(val.toLowerCase(), categoria.Nombre.toLowerCase())
			this.categorias.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
		},
		searchMarca: function (val) {
			for (var marca of this.marcas) marca.order = JaroWrinker(val.toLowerCase(), marca.Nombre.toLowerCase())
			this.marcas.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
		},
		searchProducto: function (val) {
			for (var producto of this.productos) {
				let flag_descripcion = JaroWrinker(this.searchProducto.toLowerCase(), producto.Descripcion.toLowerCase())
				let flag_nombre = JaroWrinker(this.searchProducto.toLowerCase(), producto.Nombre.toLowerCase())
				producto.order = flag_descripcion > flag_nombre ? flag_descripcion : flag_nombre;
			}
			this.productos.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
		}
	},
	methods: {

		onChecked_categoria: function (data) {
			this.getProductos();
		},
		saveForm: function () {
			if (this.form_nombre.length > 2 && this.form_descripcion.length > 2 && this.form_categoria != '' && this.form_marca != '') {
				const values = {
					nombre: this.form_nombre.toUpperCase().trim(),
					descripcion: this.form_descripcion.toUpperCase().trim(),
					categoria: this.form_categoria,
					marca: this.form_marca,
					estado: this.form_estado ? 1 : 0,
					precio: this.form_precio,
					key: this.form_key
				}
				$.post('<?= base_url()?>/dadmin/productos/salvar', values, e => {
					M.toast({html: 'PRODUCTO SALVADO', classes: 'bg-primary'});

					this.getProductos(values.nombre)
					this.onOpenCrud = false

				})
			}
			else {
				M.toast({html: 'RELLENE LOS CAMPOS CORRECTAMENTE', classes: 'bg-alert'});
			}



		},
		clearForm: function () {
			this.form_nombre = ''
			this.form_descripcion = ''
			this.form_categoria = ''
			this.form_marca = ''
			this.form_estado = true
			this.onNewProducto = true
			this.form_precio = 0
			this.form_key = -1
		},
		editItem: function (producto) {
			this.onOpenCrud = true
			this.onNewProducto = false
			this.form_nombre = producto.Nombre
			this.form_descripcion = producto.Descripcion
			this.form_categoria = producto.Id_Categoria
			this.form_marca = producto.Id_Marca
			this.form_estado = producto.Estado
			this.form_precio = parseFloat(producto.PrecioRegular)
			this.form_key = producto.Id_Producto

		},
		addProducto: function () {
			this.onOpenCrud = true;
			this.clearForm()
		},
		getProductos: function (val) {
			$.post('<?= base_url()?>/dadmin/productos/listar',{marca: this.getListCheckedMarcas(), categoria: this.getListCheckedCategorias()},productos => {
				this.productos = productos;
				this.searchProducto = val ? val : ''
			})
		},

		checkMarcas: function(e) {
			this.getProductos()
		},
		checkCategorias: function(e) {
			this.getProductos()
		},
		getListCheckedMarcas: function () {
			let marcas_check = []
			for (var marca of this.marcas) if (marca.check) marcas_check.push(marca.Id_marcaProducto)
			return marcas_check.length ? ( marcas_check.length == this.marcas.length ? '' : marcas_check.toString()) : '-1';

		},
		getListCheckedCategorias: function () {
			let categorias_check = []
			for (var categoria of this.categorias) if (categoria.check) categorias_check.push(categoria.Id_categoriaProducto)
			return categorias_check.length ? ( categorias_check.length == this.categorias.length ? '' : categorias_check.toString()) : '-1';

		}
	}
})
$(document).ready(function() {
	/*;
	;
	;*/
});


</script>
