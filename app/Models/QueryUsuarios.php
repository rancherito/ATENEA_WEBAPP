<?php namespace App\Models;

class QueryUsuarios{
	public function Usuarios_Salvar($DNI, $Nombres, $Apellidos, $Cargo, $Usuario, $Clave, $telefono, $email)
	{
		$sql = "
		EXEC [dbo].[spu_Usuarios_Guardar]
		@DNI = '$DNI',
		@Nombres = '$Nombres',
		@Apellidos = '$Apellidos',
		@Cargo = '$Cargo',
		@Usuario = '$Usuario',
		@Clave = '$Clave',
		@telefono = '$telefono',
		@email = '$email'
		";
		query_database($sql);
	}
}
