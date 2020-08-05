<div id="app" class="module">
	<div id="divider-main">
		<div id="content-main">
			<div id='barsearch'>
				<div id='content-barsearch'>
					<input id='search' class='searchinput' placeholder="BUSCAR MARCA">
					<a id='add-item' class='f-c'><i class='fal fa-plus' @click="addItem"></i></a>
				</div>
				<h2 class='title-module'>GESTION MARCA</h2>
			</div>
			<div class="space-32"></div>

			<table class="table-items open-module">
				<thead>
					<tr>
						<th style="width: 200px">NOMBRE</th>
						<th>DESCRIPCION</th>
						<th class="c" style="width: 100px">ESTADO</th>
					</tr>
				</thead>
				<tbody id="app_list_marcas">
					<tr v-for="(marca, i) in marcas" @click="opencrud(i)">
						<td>{{marca.Marca_nombre}}</td>
						<td>{{marca.descripcion}}</td>
						<td class="c f-c">
							<div class="state" :class="{'state-off': !marca.estado}"></div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

	</div>
	<div id="divider-option" class="f-c">
		<div class="opm" v-show="show_crudmarca">
			<div class="c">
				<i class="fal icon-pres c" :class="{'fa-pen' : mode_edit, 'fa-plus' : !mode_edit}"></i>
				<p></p>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input placeholder="ingrese marca" id="in_nombre" type="text" v-model="f_nombre">
					<label for="first_name">NOMBRE</label>
				</div>
				<div class="input-field col s12">
					<input placeholder="ingrese descripcion" type="text" v-model="f_descripcion">
					<label for="textarea1">DESCRIPCION</label>
				</div>
				<div class="col s12 f-b">
					<span class="">DESACTIVAR / ACTIVAR</span>
					<div class="switch">
						<label>
							<input type="checkbox" id="ck_estado" v-model="f_estado">
							<span class="lever"></span>
						</label>
					</div>
				</div>
			</div>
			<br>
			<div class="r">
				<a class="btn bg-white" @click="close">
					<i class="fal fa-times left"></i>CERRAR
				</a>
				<a class="btn waves-effect waves-light" @click="save">
					<i class="fal fa-save left"></i>SALVAR
				</a>
			</div>
		</div>
		<div class="f-c open-module" v-if="message">
			<i class="fal fa-comment-alt-smile icon-pres"></i>
			<br>
			<span class="c ">Gestiona las marcas de tus productos, te ayudara a tener mas orden en la busqueda de productos</span>
		</div>

	</div>
	<script type="text/template" id="crudmarca">

	</script>
</div>
<script type="text/javascript">
const message_edit = 'Proceso de modificacion. Modifica una marca si estas seguro del proceso.';
const message_new = 'Crean una marca para la gestion de y organizacion de productos.'
let crudmarca = Vue.component('crudmarca', {
	template: '#crudmarca',
	methods: {

	}
})

let app_controll = new Vue({
	el: '#app',
	data: {
		show_crudmarca: false,
		message: true,
		crud_message: '',
		mode_edit: true,
		f_nombre: '',
		f_descripcion: '',
		f_estado: 1,
		id_item: -1,
		marcas: [
			{Marca_nombre: 'COCINA', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'REFRIGERACION', descripcion: 'Descripcion de la marca', estado: 1},
			{Marca_nombre: 'MULTIMEDIA', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'LAVANDERIA', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'LIMPIEZA', descripcion: 'Descripcion de la marca', estado: 0}
		]
	},
	methods:{
		close: function () {
			app_controll.message = true
			app_controll.show_crudmarca = false
		},
		save: function () {
			if (app_controll.f_nombre.length >= 3 && app_controll.f_descripcion.length >= 3) {
				app_controll.add(app_controll.id_item, app_controll.f_nombre, app_controll.f_descripcion, app_controll.f_estado);
			}
			else {
				console.log('campos vacios');
			}
		},
		addItem: function () {
			this.clear()
			this.show_crudmarca = true
			this.message = false
			this.crud_message = message_new
			this.mode_edit = false
		},
		clear: function () {
			this.id_item = -1
			this.f_nombre = ''
			this.f_descripcion = ''
			this.f_estado = 1
		},
		add: function (id, nombre, descripcion, estado) {
			console.log(id);
			if (id < 0) {
				this.marcas.push({Marca_nombre: nombre.toUpperCase(), descripcion: descripcion.toUpperCase(), estado: estado, Id_marca: 45})
				this.message = true
				this.show_crudmarca = false
			}
			else {
				console.log(id);
				this.marcas[id].Marca_nombre = nombre.toUpperCase()
				this.marcas[id].descripcion = descripcion.toUpperCase()
				this.marcas[id].estado = estado
				app_controll.message = true
				app_controll.show_crudmarca = false
			}
		},
		opencrud: function (id) {
			let item = this.marcas[id];
			this.clear()
			this.id_item = id
			this.show_crudmarca = true
			this.message = false
			this.crud_message = message_edit
			this.mode_edit = true

			this.f_nombre = item.Marca_nombre
			this.f_descripcion = item.descripcion
			this.f_estado = item.estado

		}
	}
})

const search = $('#search')
search.keyup( e => {
	console.log(5445);
	for (var i = 0; i < app_controll.marcas.length; i++) {
		let marca = app_controll.marcas[i]
		marca.order = JaroWrinker(search.val().toLowerCase(), marca.Marca_nombre.toLowerCase());
	}
	app_controll.marcas.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
})
</script>
