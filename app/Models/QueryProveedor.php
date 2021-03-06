<?php namespace App\Models;

class QueryProveedor
{
	public function Proveedor_Recuperar($id = '')
	{
		$sql = "
		EXEC [dbo].[spu_Proveedores_Recuperar]
		@Id_proveedores = '$id'
		";
		return query_database($sql);
	}
	public function Proveedor_Salvar($Id_proveedores, $Nombre, $Descripcion, $Telefono, $email, $calificacion)
	{
		$sql = "
		EXEC [dbo].[spu_Proveedores_Guardar]
		@Id_proveedores = '$Id_proveedores',
		@Nombre = '$Nombre',
		@Descripcion = '$Descripcion',
		@Telefono = '$Telefono',
		@email = '$email',
		@calificacion = '$calificacion'
		";
		return query_database($sql);
	}
	public function StockPorProveedor_Salvar($IdProveedor, $IdProducto, $Id_almacen, $Stock)
	{
		$sql = "
		EXEC [dbo].[spu_StockPorProveedor_Guardar]
		@IdProveedor = '$IdProveedor',
		@IdProducto = '$IdProducto',
		@Id_almacen = '$Id_almacen',
		@Stock = '$Stock'
		";
		query_database($sql);
	}
}
