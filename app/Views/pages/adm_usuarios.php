<style media="screen">
	.radiogroup{
		background: white;
		margin: 1px 0;
		padding: 16px;
		position: relative;
		display: flex;
		cursor: pointer;
		justify-content: space-between;
	}
</style>
<div id="app" class="module opacity-0" :class="{'opacity-1': onLoad}">
	<main-module notadd namemodule="Lista de usuarios" @opencrud="crud = $event">
		 <table class="white" v-if="totalusers">
		 	<thead>
		 		<tr>
					<th class="c index">USUARIO</th>
					<th>CARGO</th>
					<th>NOMBRE COMPLETO</th>
					<th class="c index">DNI</th>
					<th class="c index">RUC</th>
					<th class="c">CELULAR</th>
					<th class="c index">EMAIL</th>
		 		</tr>
		 	</thead>
			<tbody>
				<tr v-for="(usuario, i) in usuarios" v-if="usuario.show">
					<td class="c">{{usuario.Usuario}}</td>
					<td>{{usuario.Cargo_nombre}}</td>
					<td>{{usuario.Nombres}} {{usuario.Apellidos}}</td>
					<td class="c">{{usuario.Usuario}}</td>
					<td class="c">{{usuario.RUC}}</td>
					<td class="c">{{usuario.telefono}}</td>
					<td class="c">{{usuario.email}}</td>
				</tr>
			</tbody>
		 </table>
		 <div class="card-panel" v-if="totalusers == 0">
			 <div class="title-3 grey-text f-c" style="height: 50px">Ningun usuario encontrado</div>
		 </div>
		 <template v-slot:filter>
			<div class="c"><i class="fal icon-pres c fa-user"></i> <p>Filtra los usuarios del sistema segun sus roles</p></div>
 			<div class="space-32"></div>
 			<div class="w100">
 				<label class="radiogroup" v-for="cargo in cargos">
 					<div>
 						<input name="group1" type="radio"  :value="cargo.Id" v-model.number="filter_cargo">
 						<span>{{cargo.Nombre}}</span>
 					</div>
 					<span class="badge" :class="{'bg-primary white-text': cargo.Registros}">{{cargo.Registros}}</span>
 				</label>
 			</div>
		 </template>
		 <template v-slot:crud>
			 <div class="c ">
				 <i class="fal icon-pres c white-text fa-plus"></i>
				 <div class="space-32"></div>
				 <div class="white-text">Formulario de registro de productos. El registro de productos nuevos es posible aun cuando no haya stock del productos en almacen.</div>
				 <div class="space-32"></div>
				 <form @submit.prenvent="submit" class="contrast">
					<div class="row">
						<div class="input-field col s6"><input v-model="form_nombres" required="required" placeholder="ingrese nombres" type="text"> <label class="active">NOMBRES*</label></div>
						<div class="input-field col s6"><input v-model="form_usuario" required="required" placeholder="ingrese usuario" type="text"> <label class="active">USUARIO*</label></div>
						<div class="input-field col s12"><input v-model="form_apellidos" required="required" placeholder="ingrese aprellidos" type="text"> <label class="active">APELLIDOS*</label></div>
						<div class="input-field col s6"><input v-model="form_dni" required="required" maxlength="12" minlength="8" type="text" inputmode="text" placeholder="ingrese DNI"> <label class="active">DNI*</label></div>
						<div class="input-field col s6"><input v-model="form_ruc" maxlength="13" minlength="11" placeholder="ingrese nombre" type="text"> <label class="active">RUC</label></div>
						<div class="input-field col s6"><input v-model="form_telefono" placeholder="ingrese telefono" type="text"> <label class="active">TELEFONO</label></div>
						<div class="input-field col s6"><input v-model="form_email" placeholder="ingrese email" type="text"> <label class="active">EMAIL</label></div>
						<div class="input-field col s12">
							<label class="active">CARGO</label>
							<select>
								<option value="" disabled selected>Elegir cargo</option>
								<option v-for="cargo in cargos" :value="cargo.Id">{{cargo.Nombre}}</option>
							</select>
						</div>
						<div class="col s6 f-b"><span class="white-text">{{form_isPassModify ? 'Desactivar modificar' : 'Activar modificar'}}</span> <div class="switch"><label><input v-model="form_isPassModify" type="checkbox" id="ck_estado"> <span class="lever"></span></label></div></div>
						<div class="input-field col s6"><input :disabled="!form_isPassModify" placeholder="ingrese contraseña" type="password"> <label class="active">CONTRASEÑA</label></div>
					</div>
					<div class="r">
						<a class="btn-flat" @click="crud(false)"><i class="fal fa-times left"></i>CERRAR</a>
						<a class="btn waves-effect waves-light"><i class="fal fa-save left"></i>SALVAR</a>
					</div>
				 </form>
			 </div>
		  </template>
	</main-module>

</div>
<script>
new Vue({
	el: '#app',
	data: {
		crud: null,
		form_isPassModify: false,
		filter_cargo: 0,
		onLoad: false,
		usuarios: [],
		totalusers: 0,
		cargos: <?= json_encode($cargos) ?>
	},
	watch: {
		filter_cargo: function (val) {
			this.usuarios.map(r => r.show = r.Cargo == val)
			this.totalusers = this.usuarios.reduce((p, c) => (c.show ? 1: 0) + p, 0);
		}
	},
	created: function () {
		this.loadData()
	},
	mounted: function () {
		//this.crud(true)
		this.onLoad = true
	},
	methods: {
		submit: function () {

		},
		loadData: function () {
			$.post('<?= base_url()?>/servicios/usuarios/listar', {}, res => {

				this.usuarios = res;
				this.filter_cargo = 4

			})
		}
	}
});
</script>
