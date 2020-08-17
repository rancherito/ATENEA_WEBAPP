<?php namespace App\Models;


class QueryProductos
{
	public function StockProductos_Listar($IdProducto = '', $IdAlmacen = '')
	{
		$sql = "
		EXEC [dbo].[spu_StockProductos_Listar_por]
		@IdProducto = '$IdProducto',
		@IdAlmacen = '$IdAlmacen'
		";
		return query_database($sql);
	}
	public function StockProductos_Transferir($id_producto, $id_almacen_origen, $id_alamcen_destino, $unidades)
	{
		$sql = "
		EXEC [dbo].[spu_StockProductos_Transferir]
		@id_producto = '$id_producto',
		@id_almacen_origen = '$id_almacen_origen',
		@id_alamcen_destino = '$id_alamcen_destino',
		@unidades = '$unidades'
		";
		return query_database($sql);
	}
	public function Productos_Listar($Id_producto = '', $Categoria = '', $Marca = '', $Nombre = '', $Estado = '', $limit)
	{
        $sql = "
			EXEC [dbo].[spu_Productos_Listar_por]
			@Id_producto = '$Id_producto',
			@Categoria = '$Categoria',
			@Marca = '$Marca',
			@Nombre = '$Nombre',
			@Estado = '$Estado',
			@Limit = '$limit'
		";
        $list = query_database($sql);
		foreach ($list as $key => $v) {
			$file = 'public/images/products/' . $v['Id_marcaProducto'] .'.png';
			$list[$key]['ImageUrl'] = file_exists($file) ? base_url() . '/' . $file . '?v=' . rand() : base_url() . '/public/images/products/default.svg';
		}
		return $list;
    }
	public function CategoriaProductos_Recuperar($Categoria = '')
	{
		$sql = "
		EXEC [dbo].[spu_CategoriaProductos_Recuperar]
		@Id_categoriaProducto  = '$Categoria'
		";
		return query_database($sql);
	}
	public function CategoriaProductos_Salvar($id, $nombre)
	{
		$sql = "
		EXEC [dbo].[spu_CategoriaProductos_Guardar]
		@Id_categoriaProducto = '$id',
		@Nombre = '$nombre'
		";
		query_database($sql);
	}
	public function MarcaProductos_Recuperar($Marca = '')
	{
		$sql = "
		EXEC [dbo].[spu_MarcaProductos_Recuperar]
		@Id_marcaProducto  = '$Marca'
		";
		$list = query_database($sql);

		foreach ($list as $key => $v) {
			$file = 'public/images/brands/' . $v['Id_marcaProducto'] .'.png';
			$list[$key]['ImageUrl'] = file_exists($file) ? base_url() . '/' . $file . '?v=' . rand() : base_url() . '/public/images/brands/default.svg';
		}
		return $list;
	}
	public function MarcaProductos_Salvar($id, $nombre){
		$sql = "
		EXEC [dbo].[spu_MarcaProductos_Guardar]
		@Id_marcaProducto = '$id',
		@Nombre = '$nombre'
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
