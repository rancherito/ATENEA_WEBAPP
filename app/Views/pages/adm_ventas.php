<style media="screen">
	.search{
		padding: 0 16px !important;
		margin: 0 !important;
		height: 42px !important;
	}
</style>
<div id="app" class="fill p-32">
	<div class="row">
		<div class="col m8">hola</div>
		<div class="col m4 block">
			<input type="text" class="search" placeholder="BUSQUE UN PRODUCTO">
			<div class="space-32"></div>
			<div id="content-productos-elegir">
				<div class="card-panel" v-for="n in 2">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	new Vue({
		el: '#app'
	})
</script>
