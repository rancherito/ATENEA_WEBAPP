<style media="screen">
	.count-calificacion > *{
	    width: 25px;
	    display: inline-flex;
		text-align: center;
	}
	.count-calificacion > * *{
			cursor: pointer;
			color: var(--primary)
	}
</style>

<div id="app" class="module">
	<main-search namemodule="GESTION PROVEEDORES" @search="orderItems" @additem="addItem">
		<table class="table-items open-module">
			<tr>
				<th class="table-index">#</th>
				<th>NOMBRE</th>
				<th>DESCRIPCION</th>
				<th class="c">TELEFONO</th>
				<th class="c">EMAIL</th>
				<th class="c">CALIFICACION</th>
			</tr>
			<tbody>
					<tr v-for="(proveedor, index) in proveedores" @click="editItem(proveedor)">
						<td class="table-index">{{index + 1}}</td>
						<td>{{proveedor.Nombre}}</td>
						<td>{{proveedor.Descripcion}}</td>
						<td class="c">{{proveedor.Telefono}}</td>
						<td class="c">{{proveedor.email}}</td>
						<td class="c">
							<i style="color: var(--primary)" v-for="n in 5" class="fa-star" :class="{'fal': proveedor.Calificacion < n, 'fas': proveedor.Calificacion >= n}"></i>
						</td>
					</tr>
			</tbody>
		</table>
	</main-search>
	<Soption>
		<div class="f-c" v-show="!isOpenForm">
			<i class="fal fa-comment-alt-smile icon-pres open-module" style="font-size: 4rem"></i>
			<br>
			<span class="c  open-module">Contacto, calificacion e informacion relevante de tus proveedores, organizalos para tener un control de tu flujo origen de productos</span>
		</div>
		<div v-show="isOpenForm" class="fill f-c">
			<div class="opm">
				<div class="c ">
					<i class="fal icon-pres c" :class="{'fa-pen' : !isNewItem, 'fa-plus' : isNewItem}"></i>
					<p>{{isNewItem ? message_new : message_edit}}</p>
				</div>
				<br>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="ingrese categoria" type="text" v-model="form_nombre">
						<label>NOMBRE</label>
					</div>
					<div class="input-field col s12">
						<input type="text" placeholder="ingrese descripcion"  v-model="form_descripcion"></input>
						<label>DESCRIPCION</label>
					</div>
					<div class="input-field col s12">
						<input type="text" placeholder="ingrese telefono"  v-model="form_telefono"></input>
						<label>TELEFONO</label>
					</div>

					<div class="input-field col s12">
						<input  id="in_email" type="text" placeholder="ingrese email"  v-model="form_email"></input>
						<label>EMAIL</label>
					</div>
					<div class="input-field col s12 f-b">
						CALIFICACION
						<div class="count-calificacion">
							<span v-for="n in 5">
								<i class="fa-star" :class="{'fal': form_calificacion < n, 'fas': form_calificacion >= n}" @click="form_calificacion = n"></i>
							</span>
						</div>
					</div>
				</div>
				<br>
				<div class="r">
					<a class="btn-flat" @click="isOpenForm = false">
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
	new Vue({
		el: '#app',
		data: {
			message_edit: 'Proceso de modificacion. Modifica un proveedor si estas seguro del proceso.',
			message_new: 'Formulario de registro de proveedores. Recuerde, si su proveedor es una empresa terciaria debe registrar antes las marcas de los productos proveidos por esta',
			proveedores: [],
			isOpenForm: false,
			isNewItem: true,
			form_nombre: '',
			form_descripcion: '',
			form_telefono: '',
			form_email: '',
			form_key: 0,
			form_calificacion: 0,
			onLoadProductos: true
		},
		methods: {
			orderItems: function (val) {
				for (var proveedor of this.proveedores) proveedor.order = JaroWrinker(val.toLowerCase().trim(), proveedor.Nombre.toLowerCase().trim())
				this.proveedores.sort((a, b) => parseFloat(b.order) - parseFloat(a.order));
			},
			clearForm: function () {
				this.form_key = 0
				this.form_nombre = ''
				this.form_descripcion = ''
				this.form_telefono = ''
				this.form_email = ''
				this.form_calificacion = 0
				this.isNewItem = true
			},
			saveForm: function () {

				if (this.form_nombre.length > 3 && (this.form_telefono.length == 9 || this.form_telefono.length == 11) ) {
					let values = {
						key: this.form_key,
						nombre: this.form_nombre.toUpperCase().trim(),
						descripcion: this.form_descripcion.toUpperCase().trim(),
						telefono: this.form_telefono.toUpperCase().trim(),
						email: this.form_email.toUpperCase().trim(),
						calificacion: this.form_calificacion
					}

					$.post('<?= base_url() ?>/servicios/proveedores/salvar', values, res => {
						M.toast({html: 'PRODUCTO SALVADO', classes: 'bg-primary'});
						this.loadItems()
						this.isOpenForm = false
					})
				}
				else {
					M.toast({html: 'RELLENE LOS CAMPOS CORRECTAMENTE', classes: 'bg-alert'});
				}
			},
			loadItems: function () {
				$.get( "<?= base_url()?>/servicios/proveedores/recuperar", res => {
				  this.proveedores = res
				});
			},
			addItem: function () {
				this.isOpenForm = true
				this.clearForm()
			},
			editItem: function (item) {
				this.clearForm()
				this.isOpenForm = true
				this.isNewItem = false
				this.form_key = item.Id_proveedores
				this.form_nombre = item.Nombre
				this.form_descripcion = item.Descripcion
				this.form_telefono = item.Telefono
				this.form_email = item.email
				this.form_calificacion = item.Calificacion
			}
		},
		created: function () {
			this.loadItems()
		}
	})
	$(document).ready(function() {
		new SimpleBar($('#content-main')[0],{ autoHide: false });
		Inputmask({ alias: "email"}).mask($('#in_email')[0]);
	});

</script>
