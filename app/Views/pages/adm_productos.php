<script src="<?= base_url()?>/public/libs/inputmask/inputmask.min.js" charset="utf-8"></script>
<style media="screen">
.hide{
	display: none;
}
#app{
	width: 100%;
	display: flex
}
.wrapp-card-productos{
	padding-top: 32px;
	margin: 0 -5px;
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}
.card-producto{
	background: white;
	height: 180px;
	width: 340px;
	margin: 5px;
	display: inline-flex;
	border-radius: 3px;
	overflow: hidden;
}
.card-producto > div:nth-child(1){
	width: 140px;
}
.card-producto > div:nth-child(2){
	background: #f7f7f7;
	width: calc(100% - 140px);
	padding: 16px;
	font-size: .9rem;
	display: flex;
	justify-content: space-between;
	flex-direction: column;
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
}
.card-producto-estado-activo{
	background: var(--bg-lima)
}
</style>
<div id="app" v-show="onShowApp">
	<div id="divider-main">
		<!--BUSCARDOR DEL MODULO-->
		<div id='barsearch'>
			<div id='content-barsearch'>
				<input id='search' class='searchinput' placeholder="BUSCAR PRODUCTOS">
				<a id='add-item' class='f-c' @click="addProducto"><i class='fal fa-plus'></i></a>
			</div>
			<h2 class='white-text'>GESTION PRODUCTOS</h2>
		</div>
		<!--CONTENEDOR DE ITEMS-->
	<div class="wrapp-card-productos">
		<div v-for="(producto , index) in productos" class="card-producto" @click="editProducto(producto)">
			<div class="f-c">
				<img src="<?= base_url()?>/public/images/avatar_producto.svg" alt="">
			</div>
			<div>
				<div>
					<div class="card-producto-estado" :class="{'card-producto-estado-activo': producto.Estado}"></div>
					<b>{{producto.Nombre}} - {{ producto.Marca_Nombre }}</b>
					<p>{{ producto.Descripcion }}</p>
				</div>
				<div style="display: flex; justify-content: center;; align-items: center">
					<div class="card-producto-categoria">{{ producto.Categoria_Nombre }}</div>
				</div>

			</div>
		</div>
	</div>

	</div>
	<div id="divider-option">
		<div class="tab-in-divider" v-show="!onOpenCrud">
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
							<input type="checkbox" class="filled-in" v-model="categoria.check" @change="checkCategorias($event)">
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
		<div v-show="onOpenCrud" class="fill f-c">
			<div class="opm">
				<div class="c white-text">
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
						<input  id="in_precio" type="text" placeholder="ingrese descripcion"  v-model="form_precio"></input>
						<label>PRECIO</label>
					</div>
					<div class="col s12 f-b">
						<span class="white-text">DESACTIVAR / ACTIVAR</span>
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
	</div>
</div>


<script type="text/javascript">

let categorias = <?= json_encode($categorias) ?>; categorias = categorias.map(v => {v.check = !0; return v})
let marcas = <?= json_encode($marcas) ?>; marcas = marcas.map(v => {v.check = !0; return v})
new Vue({
	el: '#app',
	created: function () {
		this.getProductos()
		this.onShowApp = !0;
	},
	data: {
		productos : [],
		categorias: categorias,
		marcas: marcas,
		onOpenCrud: false,
		onShowApp: true,
		message_edit: 'Proceso de modificacion. Modifica una categoria si estas seguro del proceso.',
		message_new: 'Formulario de registro de productos. El registro de productos nuevos es posible aun cuando no haya stock del productos en almacen.',
		onNewProducto: true,
		form_nombre: '',
		form_descripcion: '',
		form_categoria: '',
		form_marca: '',
		form_estado: true,
		form_key: -1,
		form_precio: 0
	},
	methods: {
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
				M.toast({html: 'SALVANDO PRODUCTO', classes: 'bg-white'});
				$.post('<?= base_url()?>/dadmin/productos/salvar', values, e => {
					M.toast({html: 'PRODUCTO SALVADO', classes: 'bg-primary'});
					this.getProductos()
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
		editProducto: function (producto) {
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
		getProductos: function () {
			$.post('<?= base_url()?>/dadmin/productos/listar',{marca: this.getListCheckedMarcas(), categoria: this.getListCheckedCategorias()},productos => {
				this.productos = productos;
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

new SimpleBar($('#divider-main')[0],{ autoHide: false });
Inputmask("(99){+|1}.00", {
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
   }).mask($('#in_precio')[0]);
$('.tabs').tabs();
</script>
