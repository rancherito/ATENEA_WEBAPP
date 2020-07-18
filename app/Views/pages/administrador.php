<style>
	#content-body{
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}

</style>
<h2 class="white-text c opm">Dashboard</h2>
<br>
<div class="container opm">

	<div class="row dashbox-container">
		<?php for($i = 0; $i< 12; $i++): ?>
			<div class="col m6 l3">
				<div class="dashbox">
					<i class="fal fa-box"></i>
					<div class="dashbox-info">
						<h4 class="dashbox-title">Acceso <?= ($i + 1) ?></h4>
						<div class="dashbox-description">
							Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</div>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>
</div>
