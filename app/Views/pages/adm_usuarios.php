<style media="screen">
	.radiogroup{
		background: white;
		margin: 1px 0;
		padding: 16px 8px;
		position: relative;
		display: block;
		cursor: pointer;
	}
</style>
<div id="app" class="module">
	<main-search notadd namemodule="Lista de usuarios">

	</main-search>
	<Soption>
		<div class="c"><i class="fal icon-pres c fa-user"></i> <p>Filtra los usuarios del sistema segun sus roles</p></div>
		<div class="space-32"></div>
		<div class="w100">
				<label class="radiogroup">
					<input name="group1" type="radio"  value="1" v-model="filter_cargo">
					<span>ADMINISTRADOR</span>
				</label>
				<label class="radiogroup">
					<input name="group1" type="radio" value="4" v-model="filter_cargo">
					<span>USUARIOS</span>
				</label>
				<label class="radiogroup">
					<input name="group1" type="radio" value="2" v-model="filter_cargo">
					<span>VENDEDOR</span>
				</label>
				<label class="radiogroup">
					<input name="group1" type="radio" name="group1" value="3"  v-model="filter_cargo">
					<span>ALMACENERO </span>
				</label>
		</div>
	</Soption>

</div>
<script>
new Vue({
	el: '#app',
	data: {
		filter_cargo: '4'
	}
});
</script>
