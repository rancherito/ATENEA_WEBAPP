<style media="screen">
	
#botones_pago button{
	margin: 10px;
	
}
#r_pedido button{

	margin: 10px;
	
	

}
#btn_cupon{
	display: flex; 
	margin-bottom: 21px;
	background-color: red !important;
}

	
</style>





<div class="container">
   	<div class="row">
          <div class="col s6" style="display: block">
          	<div class="row card-panel">
          		<div class="col s12">
          			<h2>Informacion de Envío</h2>
          		</div>
          		
          		<div class="input-field col s6">
	          		<label for="nombre">Nombre:</label>	
	          		<input type="text" placeholder="Ingresa tu Nombre" id="nombre" class="validate" required>
          		</div>
          		<div class="input-field col s6">
	          		<input type="text" placeholder="Ingresa tu Apellido" id="Apellido" class="validate" required>
	          		<label for="Apellido">Apellido:</label>
          		</div>
          		<div class="input-field col s12">
          			<label for="pais">País</label>
	          		<select name="pais"  id="pais">
	          			<option value="1">Perú</option>
	          			<option value="2">Chile</option>
	          			<option value="2">Panama</option>
	          		</select>
          		</div>

          		<div class="input-field col s12">
          			<label for="direccion">Dirección:</label>
	          		<input type="text" placeholder="Ingresa tu Dirección" id="direccion" class="validate" required>
	          		
          		</div>
				
          		<div class="input-field col s12">
	          		<input type="text" placeholder="Apartamento,residencia,etc (opcional)">
          		</div>
				
				<div class="input-field col s6">
          			<label for="depa">Departamento:</label>
	          		<input type="text"  id="depa" class="validate" required>
          		</div>
          		
          		<div class="input-field col s6">
          			<label for="postal">Código Postal</label>
          			<input type="text" id="postal" class="validate" required name="">
          		</div>
          		<div class="input-field col s6">
          			<label for="email">Correo Electrónico</label>
          			<input type="text" id="emial" class="validate" required name="">
          		</div>
          		<div class="input-field col s6">
          			<label for="phone">Teléfono</label>
          			<input type="text" id="phone" placeholder="Número de Teléfono" class="validate" required name="">
          		</div>
          		<div class="input-field col s12">
          			<label for="mensaje">Notas</label>
          			<input type="text" id="mensaje" placeholder="Agregar mensaje a la compra" class="validate" required name="">
          		</div>
          		
          		<!-- <button class="btn" type="submit">Comprar</button> -->
          	</div>

          	
          </div>

          <div class="col s6" style="display: block">
          		<div class="row card-panel">
          			<div class="col s12">
          				<h2>Cupones</h2>
          			</div>
          			<div class="input-field col s9">
	          			<label for="cupon">Código promocional</label>
	          			<input type="text" placeholder="Ingresa tu Código promocional aquí" id="cupon" class="validate" name="">
          			</div>
          			<div class="col s3">
          				<button id="btn_cupon" class="btn">Aplicar</button>
          				
          			</div>

          		</div>
				<div class="row card-panel">
          			<div class="col s12">
          				<h2>Tu compra</h2>
          			</div>
          			<div class="input-field col s12">
	          			<table class="">
	          				<thead>
	          					<tr>
	          						<th>Producto</th>
	          						<th>Cantidad</th>
	          						<th>Tortal</th>
	          					</tr>
	          				</thead>
	          				<tbody>
	          					<tr>
	          						<td>Motorola Edge+</td>
	          						<td>1</td>
	          						<td>$1050</td>
	          					</tr>
	          					<tr>
	          						<td>Lavadora</td>
	          						<td>1</td>
	          						<td>$2500</td>
	          					</tr>
	          					<tr>
	          						<td>Total:</td>
	          						<td></td>
	          						<td>$3550</td>
	          					</tr>
	          					
	          				</tbody>
	          				
	          			</table>
          			</div>
          			<div id="botones_pago" class="input-field col s12">
          				<button class="btn red"><img src="images/visa.svg" width="50"></button>
          				<button class="btn"><img src="images/mastercard.svg" width="40"></button>
          				<button class="btn"><img src="images/pagoefectivo.svg" width="70"></button>
          				<button class="btn"><img src="images/dinnersclub.svg" width="50"></button>
          			</div>
          			<div id="r_pedido" class="input-field col s12"> 
          				<button class="btn-large blue-grey darken-3">Realizar Pedido</button>
          			</div>

          		</div>

          	</div>

     </div>
 </div>