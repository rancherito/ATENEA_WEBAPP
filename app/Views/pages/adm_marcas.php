<div id="app" class="module opacity-0"  :class="{'opacity-1': loaded}">
	<main-search @search="search" @additem="addItem" namemodule="GESTION PRODUCTOS">
		<div class="row">
			<div class="col l6 s12 xl3" v-for="marca in marcas">
				<div class="waves-effect waves brandbox" @click="editItem(marca)">
					<div class="brandbox-logo">
						<img :src="marca.ImageUrl" alt="brand">
					</div>
					<span>{{marca.Nombre}}</span>
				</div>
			</div>
		</div>
	</main-search>
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
		          <label for="first_name">NOMBRE MARCA</label>
		        </div>
				<div class="input-field col s12">
		          <image-drop @get-image="form_image = $event" @get-imageurl="form_imageurl = $event"></image-drop>
		        </div>

			</div>
			<div class="r">
				<a class="btn-flat" @click="isOpenCrud = false"><i class="fal fa-times left"></i>CERRAR</a>
				<a class="btn waves-effect waves-light" @click="saveItem"><i class="fal fa-save left"></i>SALVAR</a>
			</div>

		</div>
	</Soption>
</div>
<script type="text/javascript">


	new Vue({
		el: '#app',
		data: {
			message_edit: 'Proceso de modificacion. Modifica una marca si estas seguro del proceso.',
			message_new: 'Crean una marca para la gestion y organizacion de productos.',
			loaded: false,
			marcas: [],
			content: null,
			isOpenCrud: false,
			isNewItem: true,
			form_image: null,
			form_imageurl: '',
			form_nombre: '',
			form_key: -1
		},
		created: function () {
			this.getItems()
		},
		mounted: function () {
			this.loaded = true
		},
		methods: {
			search: function (val) {
				for (var marca of this.marcas) marca.order = JaroWrinker(val.toLowerCase(), marca.Nombre.toLowerCase());
				this.marcas.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
			},
			addItem: function () {
				this.isOpenCrud = true;
				this.isNewItem = true
				this.form_image.src = '<?= base_url() ?>/images/brands/default.svg'
				this.form_nombre = ''
				this.form_key = -1
			},
			getItems: function () {
			   $.get('<?= base_url() ?>/servicios/marcas/recuperar', res => {
				   this.marcas = res
			   })
		   },
		   saveItem: function () {
		   		if (this.form_nombre && this.form_imageurl) {
		   			let values = {
						image: this.form_imageurl,
						nombre: this.form_nombre.toUpperCase(),
						id: this.form_key
					}
					$.post('<?= base_url() ?>/servicios/marcas/salvar', values, r => {
						this.getItems()
						this.isOpenCrud = false
					})
		   		}
		   },
		   editItem: function (item) {
		   		this.isOpenCrud = true;
				this.isNewItem = false
				this.form_nombre = item.Nombre
				this.form_image.src = item.ImageUrl
				this.form_key = item.Id_marcaProducto
		   }
		}
	})
</script>
