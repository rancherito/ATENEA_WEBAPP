<?php namespace App\Models;


class QueryProductos
{
	public function DetalleVenta_Recuperar($IdVenta = '', $IdProducto = '')
	{
		$sql = "
		EXEC [dbo].[spu_DetalleVenta_Recuperar]
		@IdProducto  = '$IdProducto',
		@IdVenta  = '$IdVenta'
		";
		return query_database($sql);
	}
	public function Venta_Recuperar($Id_venta = '')
	{
		$sql = "
		EXEC [dbo].[spu_Venta_Recuperar]
		@Id_venta  = '$Id_venta'
		";
		return query_database($sql);
	}
	public function Venta_Salvar($Id_venta,$cliente_dni,$Descripcion,$Descuento,$Estado)
	{
		$sql = "
			EXEC [dbo].[spu_Venta_Guardar]
			@Id_venta = '$Id_venta',
			@cliente_dni = '$cliente_dni',
			@Descripcion = '$Descripcion',
			@Descuento = '$Descuento',
			@Estado = '$Estado'
		";
		$res = query_database($sql);
		if ($res) $res = $res[0];
		return $res;
	}

	public function DetalleVenta_Salvar($IdProducto, $DescuentoItem, $Unidades, $IdVenta, $local)
	{
		$sql = "
		EXEC [dbo].[spu_DetalleVenta_Guardar]
		@IdProducto = '$IdProducto',
		@DescuentoItem = '$DescuentoItem',
		@Unidades = '$Unidades',
		@IdVenta = '$IdVenta',
		@local = '$local'
		";
		query_database($sql);
	}
	public function StockProductos_Listar($IdProducto = '', $IdAlmacen = '', $Nombre = '', $Limit = '')
	{
		$sql = "
		EXEC [dbo].[spu_StockProductos_Listar_por]
		@IdProducto = '$IdProducto',
		@IdAlmacen = '$IdAlmacen',
		@Nombre  = '$Nombre',
		@Limit = '$Limit'
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
			$file = 'images/products/' . $v['Id_Producto'] .'.png';
			$list[$key]['ImageUrl'] = file_exists($file) ? base_url() . '/' . $file . '?v=' . rand() : base_url() . '/images/products/default.svg';
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
			$file = 'images/brands/' . $v['Id_marcaProducto'] .'.png';
			$list[$key]['ImageUrl'] = file_exists($file) ? base_url() . '/' . $file . '?v=' . rand() : base_url() . '/images/brands/default.svg';
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
		return query_database($sql);
	}
}
