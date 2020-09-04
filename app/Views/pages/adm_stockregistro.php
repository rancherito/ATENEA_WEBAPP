<script src="<?= base_url() ?>/public/js/vuecomponents/components.js" charset="utf-8"></script>
<style media="screen">
	#filter_form{
		width: 400px;
	}
</style>
<div id="app" class="fill f-c">
	<div style="max-width:400px" class="c" v-show="!onOpenRegistro">
		<i class="fal fa-box icon-pres c"></i>
		<div class="space-32"></div>
		<h2>REGISTRO DE LOTES</h2>
		<span>puede filtrarlo por marcas y categorias</span>
		<div class="space-32"></div>
		<div class="row" id="filter_form">
			<div class="col m12" style="padding-bottom: 16px">
				<searchbox :dataset="listItems" :on_select="onSelectList" :on_change="onChangeIn"></searchbox>
			</div>
			<div class="col m6">
				<select v-model="marca">
					<option value="" selected>Todas las Marcas</option>
					<?php foreach ($marcas as $key => $marca): ?>
						<option value="<?= $marca['Id_marcaProducto'] ?>"><?= $marca['Nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col m6">
				<select v-model="categoria">
					<option value="" selected>Todas las Categoria</option>
					<?php foreach ($categorias as $key => $categoria): ?>
						<option value="<?= $categoria['Id_categoriaProducto'] ?>"><?= $categoria['Nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div style="width:400px" class="c _hide" :class="{'_show': onOpenRegistro}">
		<i class="fal fa-plus icon-pres c"></i>
		<div class="space-32"></div>
		<h2>REGISTRO DE LOTES</h2>
		<div class="space-32"></div>
		<div class="row">
			<div class="input-field col s12">
				<input placeholder="ingrese categoria" type="text" readonly v-model="form_nombre">
				<label class="active">PRODUCTO</label>
			</div>
			<div class="input-field col s12">
				<label>PROVEEDOR</label>
				<select v-model.number="form_proveedor">
					<option value="" disabled="disabled" selected="selected">Seleccione proveedor</option>
					<?php foreach ($proveedores as $key => $proveedor): ?>
						<option value="<?= $proveedor['Id_proveedores'] ?>"><?= $proveedor['Nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="input-field col s12">
				<label>ALMACEN</label>
				<select v-model.number="form_almacen">
					<option value="" disabled="disabled" selected="selected">Seleccione almacen</option>
					<?php foreach ($almacenes as $key => $almacen): ?>
						<option value="<?= $almacen['Id_LocalesEmpresa'] ?>"><?= $almacen['Nombre'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="input-field col s8">STOCK</div>
			<div class="input-field col s4">
				<input ref="form_cantidad" id="form_cantidad" placeholder="ingrese cantidad" type="text" v-model.number="form_cantidad" maxlength="4">
				<label class="active">CANTIDAD</label>
			</div>
		</div>
		<div class="r">
			<button type="button" name="button" class="btn-flat" @click="clear">
				<i class="fal fa-long-arrow-left left"></i>
				ATRAS
			</button>
			<button type="button" name="button" class="btn" @click="salvarItem">
				<i class="fal fa-save left"></i>
				SALVAR
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">

let app = new Vue({
		el: '#app',
		data: {
			listItems: [],
			marca: '',
			categoria: '',
			onOpenRegistro: false,
			form_nombre: '',
			form_proveedor: '',
			form_almacen: '',
			form_cantidad: 0,
			form_producto: ''
		},
		mounted: function () {
			Inputmask("numeric").mask(this.$refs.form_cantidad)
		},
		methods: {
			clear: function () {
				this.form_nombre = ''
				this.form_proveedor = ''
				this.form_producto = ''
				this.form_almacen = ''
				this.form_cantidad = 0
				this.onOpenRegistro = false
			},
			salvarItem: function () {
				if (this.form_proveedor && this.form_almacen && this.form_cantidad != 0) {
					let values = {
						id_proveedor: this.form_proveedor,
						id_producto: this.form_producto,
						id_almacen: this.form_almacen,
						stock: this.form_cantidad
					}
					$.post('<?= base_url() ?>/servicios/almacen/stock/salvar', values, e =>{
						M.toast({html: 'NUEVO LOTE SALVADO', classes: 'bg-primary'});
						this.clear()
					})
				}
				else {
					M.toast({html: 'SE ENCONTRO CAMPOS INCORRECTOS', classes: 'bg-alert'});
				}
			},
			onChangeIn: function (val) {

				if (val.length) {
					let values = {marca: this.marca, categoria: this.categoria, nombre: val, limit: 10};
					$.post('<?= base_url()?>/servicios/productos/listar', values, productos => {
						let list = []
						for (var p of productos) list.push({value: p.Id_Producto, text: p.Nombre+ ' - '+ p.Descripcion})
						this.listItems = list;
					})
				}
			},
			onSelectList: function (val) {
				this.form_nombre = val.text
				this.form_producto = val.value
				this.onOpenRegistro = true
			}
		}
	})
	$(document).ready(function() {
	});

</script>
