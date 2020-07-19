<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="<?= base_url() ?>/public/libs/JaroWrinker/JaroWrinker.js"></script>
<?php color_modulo('var(--bg-teal)') ?>
<style media="screen">
.row{
	margin-left: -11px;
	margin-right: -11px;
}
.state{
	height: 20px;
	width: 20px;
	background: var(--bg-lima);
	border-radius: 50%;
}
.state-off{
	background: gray;
}
</style>
<div id="divider-main">
	<!--BUSCARDOR DEL MODULO, PROVEIDO POR HELPERS PHP-->
	<div id='barsearch'>
		<div id='content-barsearch'>
			<input id='search' class='searchinput' placeholder="BUSCAR MARCA">
			<a id='add-item' class='f-c'><i class='fal fa-plus'></i></a>
		</div>
		<h2 class='white-text'>GESTION MARCA</h2>
	</div>
	<script>

	</script>
	<!--CONTENEDOR DE ITEMS-->

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
<div id="divider-option" class="f-c">
	<crudmarca></crudmarca>
	<div class="f-c open-module" v-if="message">
		<i class="fal fa-comment-alt-smile icon-pres"></i>
		<br>
		<span class="c white-text">Gestiona las marcas de tu productos, te ayudara a tener mas orden en la busqueda de productos</span>
	</div>

</div>
<script type="text/template" id="crudmarca">
	<div class="opm" v-if="$parent.show_crudmarca">
		<div class="c white-text">
			<i class="fal icon-pres c" :class="{'fa-pen' : $parent.mode_edit, 'fa-plus' : !$parent.mode_edit}"></i>
			<p>{{$parent.crud_message}}</p>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input placeholder="ingrese marca" id="in_nombre" type="text" v-model="$parent.f_nombre">
				<label for="first_name">NOMBRE</label>
			</div>
			<div class="input-field col s12">
				<textarea id="in_descripcion" class="materialize-textarea" v-model="$parent.f_descripcion"></textarea>
				<label for="textarea1">DESCRIPCION</label>
			</div>
			<div class="col s12 f-b">
				<span class="white-text">DESACTIVAR / ACTIVAR</span>
				<div class="switch">
					<label>
						<input type="checkbox" id="ck_estado" v-model="$parent.f_estado">
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
</script>

<script type="text/javascript">
const add_item = $('#add-item')
const search = $('#search')
const message_edit = 'Proceso de modificacion. Modifica una marca si estas seguro del proceso.';
const message_new = 'Crean una marca para la gestion de y organizacion de productos.'
let crudmarca = Vue.component('crudmarca', {
	template: '#crudmarca',
	methods: {
		close: function () {
			app_controll.message = true
			app_controll.show_crudmarca = false
		},
		save: function () {
			if (app_controll.f_nombre.length >= 3 && app_controll.f_descripcion.length >= 3) {
				app_list_marcas.add(app_controll.id_item, app_controll.f_nombre, app_controll.f_descripcion, app_controll.f_estado);
			}
			else {
				console.log('campos vacios');
			}
		}
	}
})


let app_controll = new Vue({
	el: '#divider-option',
	data: {
		show_crudmarca: false,
		message: true,
		crud_message: '',
		mode_edit: true,
		f_nombre: '',
		f_descripcion: '',
		f_estado: 1,
		id_item: -1,
	},
	methods: {
		clear: function () {
			app_controll.id_item = -1
			app_controll.f_nombre = ''
			app_controll.f_descripcion = ''
			app_controll.f_estado = 1
		}
	}
})
let app_list_marcas = new Vue({
	el: '#app_list_marcas',
	data: {
		marcas: [
			{Marca_nombre: 'MARCA 01', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'MARCA 02', descripcion: 'Descripcion de la marca', estado: 1},
			{Marca_nombre: 'MARCA 03', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'OSTER', descripcion: 'Descripcion de la marca', estado: 0},
			{Marca_nombre: 'PHILIPS', descripcion: 'Descripcion de la marca', estado: 0}
		]
	},
	methods:{
		add: function (id, nombre, descripcion, estado) {
			console.log(id);
			if (id < 0) {
				this.marcas.push({Marca_nombre: nombre.toUpperCase(), descripcion: descripcion.toUpperCase(), estado: estado, Id_marca: 45})
				app_controll.message = true
				app_controll.show_crudmarca = false
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
			app_controll.clear()
			app_controll.id_item = id
			app_controll.show_crudmarca = true
			app_controll.message = false
			app_controll.crud_message = message_edit
			app_controll.mode_edit = true

			app_controll.f_nombre = item.Marca_nombre
			app_controll.f_descripcion = item.descripcion
			app_controll.f_estado = item.estado

		}
	}
})

add_item.click( e => {
	app_controll.clear()
	app_controll.show_crudmarca = true
	app_controll.message = false
	app_controll.crud_message = message_new
	app_controll.mode_edit = false
})


search.keyup( e => {
	const flag = 'jamon';
	for (var i = 0; i < app_list_marcas.marcas.length; i++) {
		let marca = app_list_marcas.marcas[i]
		marca.order = JaroWrinker(search.val().toLowerCase(), marca.Marca_nombre.toLowerCase());
	}
	app_list_marcas.marcas.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
})
</script>
