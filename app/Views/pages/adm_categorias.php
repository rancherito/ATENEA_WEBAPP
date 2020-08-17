<div id="app" class="module opacity-0" :class="{'opacity-1': loaded}">
	<Smain @content="content = $event">
		<div class="container">
			<div id='barsearch'>
				<div id='content-barsearch'>
					<input id='search' placeholder="BUSCAR CATEGORIA" v-model="categoria">
					<a id='add-item' class='f-c waves-effect waves-light' @click="addItem"><i class='fal fa-plus'></i></a>
				</div>
				<h2 class='title-module'>Gestion Categorias</h2>
			</div>
			<div class="space-32"></div>
			<table class="table-items">
				<thead>
					<tr>
						<th style="width: 1px">#</th>
						<th>Nombre</th>
						<th class="c" style="width: 240px">Total Productos <br>
							<span style="font-size: .8rem; color: gray">(# Productos asociados a esta categoria)</span>
						</th>
					</tr>
				</thead>
				<tr v-for="(categoria, i) in categorias" @click="editItem(categoria)">
					<td>{{i+1}}</td>
					<td>{{categoria.Nombre}}</td>
					<td class="c">{{categoria.TotalProductos}}</td>
				</tr>
			</table>
		</div>
	</Smain>
	<Soption>
		<div class="f-c open-module" v-if="!isOpenCrud">
			<i class="fal fa-comment-alt-smile icon-pres"></i>
			<br>
			<span class="c ">Gestiona las marcas de tus productos, te ayudara a tener mas orden en la busqueda de productos</span>
		</div>
		<div class="open-module w100" v-show="isOpenCrud">
			<div class="c">
				<i class="fal icon-pres c" :class="{'fa-pen' : !isNewItem, 'fa-plus' : isNewItem}"></i>
				<p>{{isNewItem ? message_new : message_edit}}</p>
			</div>
			<div class="space-32"></div>
			<div class="row">
				<div class="input-field col s12">
		          <input placeholder="ingrese nombre" type="text" v-model.trim="form_nombre">
		          <label for="first_name">NOMBRE CATEGORIA</label>
		        </div>
			</div>
			<div class="r">
				<a class="btn bg-white" @click="isOpenCrud = false"><i class="fal fa-times left"></i>CERRAR</a>
				<a class="btn waves-effect waves-light" @click="saveItem"><i class="fal fa-save left"></i>SALVAR</a>
			</div>
		</div>
	</Soption>
</div>
<script type="text/javascript">
	new Vue({
		el: '#app',
		data: {
			message_edit: 'Proceso de modificacion. Modifica esta categoria si estas seguro del proceso.',
			message_new: 'Crean una categoria para la gestion y organizacion de productos.',
			loaded: false,
			categorias: [],
			content: null,
			isOpenCrud: false,
			isNewItem: true,
			categoria: '',
			form_nombre: '',
			form_key: -1
		},
		created: function () {
			this.loadItems()
		},
		mounted: function () {
			this.loaded = true
			new SimpleBar(this.content,{ autoHide: false });
		},
		watch: {
			categoria: function (val) {
				for (var categoria of this.categorias) categoria.order = JaroWrinker(val.toLowerCase(), categoria.Nombre.toLowerCase());
				this.categorias.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
			}
		},
		methods: {
			addItem: function () {
				this.isOpenCrud = true
				this.isNewItem = true
				this.form_nombre = ''
				this.form_key = -1
			},
			loadItems: function () {
				$.get('<?= base_url() ?>/servicios/categorias/recuperar', data =>{
					//console.log(data);
					this.categorias = data
					this.categoria = this.form_nombre
				})
			},
			editItem: function (item) {
				this.isOpenCrud = true
				this.isNewItem = false
				this.form_nombre = item.Nombre
				this.form_key = item.Id_categoriaProducto
			},
			saveItem: function () {
				if (this.form_nombre) {
					let values = {
						nombre: this.form_nombre.toUpperCase(),
						id: this.form_key
					}
					$.post('<?= base_url() ?>/servicios/categorias/salvar', values, data => {
						M.toast({html: 'CATEGIRIA SALVADA', classes: 'bg-primary'});
						this.loadItems()
						this.isOpenCrud = false
					})
				}
				else {
					M.toast({html: 'RELLENE LOS CAMPOS CORRECTAMENTE', classes: 'bg-alert'});
				}
			}
		}
	})
</script>
