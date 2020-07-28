<style media="screen">
.hide{
	display: none;
}
#app{
	width: 100%;
	display: flex
}
</style>
<div id="app" v-show="showApp">
	<div id="divider-main">
		<!--BUSCARDOR DEL MODULO-->
		<div id='barsearch'>
			<div id='content-barsearch'>
				<input id='search' class='searchinput' placeholder="BUSCAR PRODUCTOS">
				<a id='add-item' class='f-c'><i class='fal fa-plus'></i></a>
			</div>
			<h2 class='white-text'>GESTION PRODUCTOS</h2>
		</div>
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
			</tr>
			<tbody>

				<tr v-for="(producto , index) in productos" :data-key="producto.Id_Producto">
					<td class="table-index">{{index + 1}}</td>
					<td>{{ producto.Nombre }}</td>
					<td>{{ producto.Descripcion }}</td>
					<td class="c">{{ producto.Categoria_Nombre }}</td>
					<td class="c">{{ producto.Marca_Nombre }}</td>
					<td class="c">{{ producto.FechaRegistro }}</td>
					<td class="f-c"><div class="state" :class="{'state-off': !producto.Estado}"></div></td>

				</tr>

			</tbody>
		</table>
	</div>
	<div id="divider-option">
		<div class="tab-in-divider" v-show="!onEditProducto">
			<ul id="tabs-swipe-demo" class="tabs tabs-fixed-width">
				<li class="tab col s3"><a href="#tab-categorias">CATEGORIAS</a></li>
				<li class="tab col s3"><a href="#tab-marcas">MARCAS</a></li>
			</ul>
			<div id="tab-categorias" class="wrapper-tab">
				<div class="c white-text open-module">
					<br>
					<br>
					<i class="fal fa-ballot icon-pres c"></i>
					<p>Filtre la operacion de consulta por <b class="black-text">CATEGORIAS</b> , sera mas sencillo visualizar lo que esta buscando</p>
					<br>
				</div>
				<div id="c-list" class="open-module">

					<div v-for="categoria in categorias" :data-key="categoria.Id_categoriaProducto">
						{{categoria.Nombre}}
						<label>
							<input type="checkbox" class="filled-in" v-model="categoria.check" @change="checkMarcas($event)">
							<span></span>
						</label>
					</div>
				</div>
			</div>
			<div id="tab-marcas"  class="wrapper-tab">
				<div class="c white-text open-module">
					<br>
					<br>
					<i class="fal fa-tag icon-pres c"></i>
					<p>Filtre la operacion de consulta por <b class="black-text">MARCAS</b> , sera mas sencillo visualizar lo que esta buscando</p>
					<br>
				</div>

				<div class="r" id="c-options">
					<!-- //TODO: AQUI FILTRO DE CATEGORIAS O MARCAS-->
				</div>
				<div id="c-list" class="open-module">

					<div v-for="marca in marcas" :data-key="marca.Id_marcaProducto">
						{{marca.Nombre}}
						<label>
							<input type="checkbox" class="filled-in" v-model="marca.check" @change="checkMarcas($event)">
							<span></span>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div v-show="onEditProducto">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</div>
</div>


<script type="text/javascript">

let categorias = <?= json_encode($categorias) ?>; categorias = categorias.map(v => {v.check = !0; return v})
let marcas = <?= json_encode($marcas) ?>; marcas = marcas.map(v => {v.check = !0; return v})
new Vue({
	el: '#app',
	created: function () {
		this.getProductos()
		this.showApp = !0;
	},
	data: {
		productos : [],
		categorias: categorias,
		marcas: marcas,
		onEditProducto: !0,
		showApp: true,
	},
	methods: {
		checkedvoid: function (check) {
			if (check == undefined) check = true;
			return check;
		},
		getProductos: function () {
			$.post('<?= base_url()?>/dadmin/productos/listar',{marca: this.getListCheckedMarcas()},productos => {
				this.productos = productos;
			})
		},
		checkMarcas: function(e) {
			this.getProductos()
		},
		getListCheckedMarcas: function () {
			let marcas_check = []
			for (var marca of this.marcas) if (marca.check) marcas_check.push(marca.Id_marcaProducto)
			return marcas_check.length ? marcas_check.toString() : '-1';
		}
	}
})

new SimpleBar($('#divider-main')[0],{ autoHide: false });
$('.tabs').tabs();
</script>
