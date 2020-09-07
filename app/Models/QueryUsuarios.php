<?php namespace App\Models;

class QueryUsuarios{
	public function Usuarios_Salvar($DNI, $ruc, $Nombres, $Apellidos, $Cargo, $Usuario, $Clave, $telefono, $email, $no_revocar = 0)
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
		@email = '$email',
		@ruc = '$ruc',
		@no_revocar = $no_revocar
		";
		query_database($sql);
	}
	public function Usuarios_Listar($DNI, $Cargo, $Usuario)
	{
		$sql = "
		EXEC [dbo].[spu_Usuarios_Listar_por]
		@DNI = '$DNI',
		@Cargo = '$Cargo',
		@Usuario = '$Usuario'
		";
		return query_database($sql);
	}
	public function Cargos_Recuperar($Id = '')
	{
		$sql = "
		EXEC [dbo].[spu_Cargo_Recuperar]
		@Id = '$Id'
		";
		return query_database($sql);
	}
	public function ValidarAcceso($user, $pass)
	{
		$sql = "SELECT TOP 1 * FROM Usuarios WHERE (DNI = '$user' OR Usuario = '$user') AND Clave = '$pass'";
		return query_database($sql);
	}
	public function Usuario_RecuperarBasico($dni)
	{
		$sql = "SELECT  DNI,Nombres,Apellidos,telefono,email,RUC FROM Usuarios where DNI = '$dni'";
		return query_database($sql);
	}
}
