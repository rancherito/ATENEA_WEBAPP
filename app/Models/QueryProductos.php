<?php namespace App\Models;


class QueryProductos
{
	public function Productos_Listar($Id_producto = '', $Categoria = '', $Marca = '', $Nombre = '', $Descripcion = '', $Estado = '')
	{

        $sql = "
			EXEC [dbo].[spu_Productos_Listar_por]
			@Id_producto = '$Id_producto',
			@Categoria = '$Categoria',
			@Marca = '$Marca',
			@Nombre = '$Nombre',
			@Descripcion = '$Descripcion',
			@Estado = '$Estado'
		";
        return query_database($sql);
    }
	public function CategoriaProductos_Recuperar($Categoria = '')
	{
		$sql = "
		EXEC [dbo].[spu_CategoriaProductos_Recuperar]
		@Id_categoriaProducto  = '$Categoria'
		";
		return query_database($sql);
	}
	public function MarcaProductos_Recuperar($Marca = '')
	{
		$sql = "
		EXEC [dbo].[spu_MarcaProductos_Recuperar]
		@Id_marcaProducto  = '$Marca'
		";
		return query_database($sql);
	}
	public function Productos_Guardar($Id_producto, $Nombre, $Descripcion, $Categoria, $Marca, $precio, $Imagen, $Estado)
	{
		$sql = "
			EXEC [dbo].[spu_Productos_Guardar]
			@Id_producto = '$Id_producto',
			@Nombre = '$Nombre',
			@Descripcion = '$Descripcion',
			@Categoria = '$Categoria',
			@Marca = '$Marca',
			@Imagen = '$Imagen',
			@Estado = '$Estado',
			@precio = '$precio'
		";
		query_database($sql);
	}
}
