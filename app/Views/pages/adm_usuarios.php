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
	<main-search notadd namemodule="Lista de usuarios">
		 <table class="white" v-if="totalusers">
		 	<thead>
		 		<tr>
					<th>NOMBRE COMPLETO</th>
					<th class="c">USUARIO</th>
					<th class="c">DNI</th>
					<th class="c">RUC</th>
					<th class="c">CELULAR</th>
					<th class="c">EMAIL</th>
		 		</tr>
		 	</thead>
			<tbody>
				<tr v-for="(usuario, i) in usuarios" v-if="usuario.show">
					<td>{{usuario.Nombres}} {{usuario.Apellidos}}</td>
					<td class="c">{{usuario.Usuario}}</td>
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
	</main-search>
	<Soption>
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
	</Soption>

</div>
<script>
new Vue({
	el: '#app',
	data: {
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

		this.onLoad = true
	},
	methods: {
		loadData: function () {
			$.post('<?= base_url()?>/servicios/usuarios/listar', {}, res => {

				this.usuarios = res;
				this.filter_cargo = 4

			})
		}
	}
});
</script>
