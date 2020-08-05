<?php namespace App\Models;
class QueryInfraestructura
{
	public function LocalesEmpresa_Recuperar($id = '')
	{
		$sql = "
		EXEC [dbo].[spu_LocalesEmpresa_Recuperar]
		@Id_LocalesEmpresa int  = '$id'
		";
		return query_database($sql);
	}
	public function LocalesEmpresa_Listar($id = '', $nombre = '', $tipo = '')
	{
		$sql = "
		EXEC [dbo].[spu_LocalesEmpresa_Listar_por]
		@Id_LocalesEmpresa = '$id',
		@Nombre = '$nombre',
		@IdTipoLocal = '$tipo'
		";
		return query_database($sql);
	}
}
