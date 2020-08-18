<style>

#imagen_central{
justify-content: center;

}
#imagen_central img{
    width: 300px;
}
.cuadro_detalle{
    margin:40px;
}
.input-number{
    display: flex;
  }
  .input-number input{
    padding: 8px !important;
    margin: 0px !important;
    height: 36px !important;
    width: 42px !important;
  }

</style>
<div class="container" style="display:block">
    <div class="cuadro_detalle">
    <div class="row ">
        <div id="imagen_central" class="col s6">
            
            <img src="public/images/celular.jpg" alt="">

        </div>
        <div class="col s6">
            <div>
                <h2 class="">Motorolara Edge+ </h2>
                    <p> Pantalla: 6.7", 1080 x 2340 pixels<br>
                        Procesador: Snapdragon 865 2.84GHz<br>
                        RAM: 12GB<br>
                        Almacenamiento: 256GB<br>
                        Expansión: microSD<br>
                    </p>
                <h6>Precio:</h6><p>$50</p>
                <form action="#">
                <div class="row">
                    
                        <p>
                            <label>
                                <input type="radio" name="opcion"class="with-gap"/>
                                <span>Black</span>
                            </label>
                        </p>
                    
                    
                        <p>
                            <label>
                                <input type="radio" name="opcion"class="with-gap"/>
                                <span>White</span>
                            </label>
                        </p>
                    
                    
                        <p>
                            <label>
                                <input type="radio" name="opcion"class="with-gap"/>
                                <span>Electric Purpple</span>
                            </label>
                        </p>
                    
                
                </div>
                </form>
                <div class="input-number">
                    <button class="btn btn-mas"> <i class="fal fa-minus"></i> </button>
                    <input type="text" class="c" value="1"> 
                    <button class="btn btn-menos"> <i class="fal fa-plus"></i> </button>
                </div>
                <br>
                <div class="">
                    <button class="btn btn_agregar">Add to cart</button>
                </div>
            </div>
            
        </div>
    </div>
    </div>
</div>