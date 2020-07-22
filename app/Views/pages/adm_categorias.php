<script src="<?= base_url() ?>/public/libs/JaroWrinker/JaroWrinker.js"></script>
<div id="divider-main">
	<!--BUSCARDOR DEL MODULO, PROVEIDO POR HELPERS PHP-->
	<div id='barsearch'>
		<div id='content-barsearch'>
			<input id='search' class='searchinput' placeholder="BUSCAR CATEGORIA">
			<a id='add-item' class='f-c'><i class='fal fa-plus'></i></a>
		</div>
		<h2 class='white-text'>GESTION CATEGORIA</h2>
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
		<tbody id="app_list_categorias">
			<tr v-for="(categoria, i) in categorias" @click="opencrud(i)">
				<td>{{categoria.Marca_nombre}}</td>
				<td>{{categoria.descripcion}}</td>
				<td class="c f-c">
					<div class="state" :class="{'state-off': !categoria.estado}"></div>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div id="divider-option" class="f-c">
	<crudcategoria></crudcategoria>
	<div class="f-c open-module" v-if="message">
		<i class="fal fa-comment-alt-smile icon-pres"></i>
		<br>
		<span class="c white-text">Gestiona las categorias de tu categorias, te ayudara a tener mas orden en la busqueda de categorias</span>
	</div>

</div>
<script type="text/template" id="crudcategoria">
	<div class="opm" v-if="$parent.show_crudcategoria">
		<div class="c white-text">
			<i class="fal icon-pres c" :class="{'fa-pen' : $parent.mode_edit, 'fa-plus' : !$parent.mode_edit}"></i>
			<p>{{$parent.crud_message}}</p>
		</div>
		<br>
		<div class="row">
			<div class="input-field col s12">
				<input placeholder="ingrese categoria" id="in_nombre" type="text" v-model="$parent.f_nombre">
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
const message_edit = 'Proceso de modificacion. Modifica una categoria si estas seguro del proceso.';
const message_new = 'Crean una categoria para la gestion de y organizacion de categorias.'
let crudcategoria = Vue.component('crudcategoria', {
	template: '#crudcategoria',
	methods: {
		close: function () {
			app_controll.message = true
			app_controll.show_crudcategoria = false
		},
		save: function () {
			if (app_controll.f_nombre.length >= 3 && app_controll.f_descripcion.length >= 3) {
				app_list_categorias.add(app_controll.id_item, app_controll.f_nombre, app_controll.f_descripcion, app_controll.f_estado);
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
		show_crudcategoria: false,
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
let app_list_categorias = new Vue({
	el: '#app_list_categorias',
	data: {
		categorias: [
			{Marca_nombre: 'COCINA', descripcion: 'Descripcion de la categoria', estado: 0},
			{Marca_nombre: 'REFRIGERACION', descripcion: 'Descripcion de la categoria', estado: 1},
			{Marca_nombre: 'MULTIMEDIA', descripcion: 'Descripcion de la categoria', estado: 0},
			{Marca_nombre: 'LAVANDERIA', descripcion: 'Descripcion de la categoria', estado: 0},
			{Marca_nombre: 'LIMPIEZA', descripcion: 'Descripcion de la categoria', estado: 0}
		]
	},
	methods:{
		add: function (id, nombre, descripcion, estado) {
			console.log(id);
			if (id < 0) {
				this.categorias.push({Marca_nombre: nombre.toUpperCase(), descripcion: descripcion.toUpperCase(), estado: estado, Id_categoria: 45})
				app_controll.message = true
				app_controll.show_crudcategoria = false
			}
			else {
				console.log(id);
				this.categorias[id].Marca_nombre = nombre.toUpperCase()
				this.categorias[id].descripcion = descripcion.toUpperCase()
				this.categorias[id].estado = estado
				app_controll.message = true
				app_controll.show_crudcategoria = false
			}
		},
		opencrud: function (id) {
			let item = this.categorias[id];
			app_controll.clear()
			app_controll.id_item = id
			app_controll.show_crudcategoria = true
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
	app_controll.show_crudcategoria = true
	app_controll.message = false
	app_controll.crud_message = message_new
	app_controll.mode_edit = false
})

search.keyup( e => {
	const flag = 'jamon';
	for (var i = 0; i < app_list_categorias.categorias.length; i++) {
		let categoria = app_list_categorias.categorias[i]
		categoria.order = JaroWrinker(search.val().toLowerCase(), categoria.Marca_nombre.toLowerCase());
	}
	app_list_categorias.categorias.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
})
</script>
