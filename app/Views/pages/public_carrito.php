<style>
  #unatable{
    
  }
  table.highlight>tbody>tr:hover{
    background: white
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
<div class="white">
  <div class="container">
    <table id="unatable" class="responsive-table highlight centered">
                <thead>
                  <tr>
                    <th class="product-image">Imagen</th>
                    <th class="product-name">Producto</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remover</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="product-image">
                      <img src="public/images/celular.jpg" alt="Image" >
                    </td>
                    <td class="product-name">
                      <h2 class="h5 text-black">Smartphone</h2>
                    </td>
                    <td>$49.00</td>
                    <td class="c">
                      <div class="input-number">
                        <button class="btn btn-mas"> <i class="fal fa-minus"></i> </button>
                        <input type="text" class="c" value="1"> 
                        <button class="btn btn-menos"> <i class="fal fa-plus"></i> </button>
                      </div>
                        
                    </td>
                    <td>$49.00</td>
                    <td><a href="#" class="btn"><i class="fal fa-trash-alt"></i> </a></td>
                  </tr>

                  
                </tbody>
              </table>
  </div>
</div>
<div class="container">
        
              
              <br>
              <div class="row">
                <div clas="col s3">
                    <button class="btn">Borrar Todo</button>
                </div>
                
                <div clas="col s3">
                    <button class="btn">Comprar</button>
                </div>
                
              </div>
            
        </div>

















<!--<div class=container>
    <a> UN COLABORADOR MODIFICO ALGO </a>
</div>
<div id="cualquiercosa">
    <div v-for="n in milista">
        <a class="btn">
            {{n}}
        </a>
    </div>
    
</div>

<script>
    new Vue({
        el: '#cualquiercosa',
        data: {
            milista: ['peras', 'manzana', 'uva']
        }
    })

</script>-->