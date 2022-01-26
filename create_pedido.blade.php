@extends('adminlte::page')
@section('content')
<style>
    .table td{
        padding: 5px;
    }
    @media(max-width: 640px){
        div.scroll_horizontal {
            width: 100%;
            overflow: auto;
            padding: 8px;
        }
        .select2-container--default{
            width: 100%!important;
        }
    }
    .select2-container--default{
        width: 50%;
    }
</style>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <div class="container-fluid">
        @php 
            $hoy = date("Y-m-d H:i:s"); 
            //dd($hoy);
            $hoy = explode(" ", $hoy);
        
        @endphp

            <div class="card">
                <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('') }}</h3>
                            <a class="btn btn-primary" href="{{route('cliente.pedidos')}}"> Regresar</a>
                        </div>
                </div>
                <div class="card-body">
                    <form id="form_proforma" action="{{route('cliente.insertProforma')}}">
                        {{ csrf_field() }}
                        @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        @endif
                        <input type="hidden" name="contador" id="contador" value="1">
                        <input type="hidden" name="tiempo" id="tiempo" value="{{$hoy[1]}}" >
                        <div class="input-group">
                            <div class="col-6 mb-3">
                                <label class="form-control-label" for="cedula">{{ __('Cliente ') }}</label>
                                <select name="nombre_apellidos" id="nombre_apellidos" class="form-control select2" required onchange="buscar();" >
                                    
                                </select>
                            </div>
                            <input type="hidden" id="codigocliente" value="">
                            <input type="hidden" id="cont" value="">
                            <div class="col-6 mb-3">
                                <label class="form-control-label" for="input-name">{{ __('Empresa') }}</label>
                                <select class="form-control form-control-alternative" name="empresa" id="empresas">
                                </select>
                              
                            </div>
                        </div>
                        <div class="input-group">
                            
                        
                            <div class=" col-6 mb-3">
                                <label class="form-control-label" for="input-name">Imagen del Producto</label>
                                <div class="col-md-8">
                                    <img src="{{asset('public')}}/producto.jpg"  width="60%" height="80%"  style="vertical-align:middle" id="img_prod">
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class=" col-md-6 form-group">
                                    <label class="form-control-label" for="cedula">{{ __('N¡ã de Proforma') }}</label>
                                    <input type="hidden" name="numero_proforma" value="{{ $proforma }}">
                                    @php
                                        $aux = explode("-", $proforma);
                                        //dd($aux);
                                    @endphp
                                    <input type="text"  id="numero_proforma" name="numero_proforma1" class="form-control form-control-alternative" value="{{ $aux[1] }} "  required readonly autofocus>

                               
                        </div>
                        <div class="col-md-12 form-group">
                                    <label class="form-control-label" for="cedula">{{ __('Productos ') }}</label>
                                    <select name="productos[]" id="productos" class="js-data-example-ajax form-control select2 col-md-8" required onchange="cambia_imagen();" >
                                        <option value="">Seleccione...</option>
                                        @foreach ($productos as $p)
                                            <option value="{{$p->Codigo}}">{{$p->NombreProducto}} / {{$p->Procedencia}} </option>
                                        @endforeach
                                       
                                    </select>

                                    <button class="btn btn-primary" type="button" onclick="add_producto();"><span class="fa fa-plus"></span></button>
                                   
                        </div>

                        <div class="form-group scroll_horizontal">
                            <table class="table" id="tableprod">
                                <thead>
                                    <tr>
                                        <th width="3%">N</th>
                                        <th width="10%">Codigo</th>
                                        <th width="35%">Producto</th>
                                        <th width="15%">Ref.</th>
                                        <th width="10%">Precio</th>
                                        <th width="10%">Disp.</th>
                                        <th width="8%">Cantidad</th>
                                        <th width="15%">Subtotal</th>
                                        <th width="15%">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="agregar">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 form-group " style="text-align: end">
                            <label style="margin-right: 15px " class="form-control-label">Subtotal 0% </label> <input name="subtotal" id="subtotal" style="width:15%" readonly value="0.00" type="text"> <br>
                            <label style="margin-right: 15px " class="form-control-label">Subtotal 12% </label><input name="iva" id="iva" style="width:15%" value="0.00" readonly type="text"><br>
                            <label style="margin-right: 15px " class="form-control-label">Subtotal </label><input name="subtotal_total" id="subtotal_total" style="width:15%" value="0.00" readonly type="text"><br>
                            <label style="margin-right: 15px " class="form-control-label">Iva </label><input name="porct_iva" id="porct_iva" style="width:15%" value="0.00" readonly type="text"><br>
                            <label style="margin-right: 15px " class="form-control-label">Total </label><input name="total" id="total" style="width:15%" readonly type="text" value="0.00" >
                        </div>

                        <!--div class="col-md-4 ">
                            <label class="form-control-label">{{ __('M¨¦todo ') }}</label><br>
                            <select class="form-control" name="metodo" id="metodo">
                                <option>Seleccione</option>
                                <option>Efectivo</option>
                                <option>Cheque</option>
                                <option>Transferencia</option>
                            </select>
                        </div-->
                        <div class="col-md-4">
                            <label class="form-control-label">{{ __('Notas ') }}</label><br>
                            <textarea name="observacion" cols="2" class="form-control"></textarea>
                        </div>
                       
                    
                        <div class="col-md-12" style="text-align: center">
                            <button onclick="validar(event)" class="btn btn-primary" id="btn_guardar_pro">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>

    </div>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        $('.select2').select2({
            tags: false,
         }); 
         
         $('#nombre_apellidos').select2({
            ajax:{
                type: 'GET',
                url: "{{route('cliente.autocomplete')}}",
                dataType: 'json',
                delay: 300,
                data: function(params){
                    return {
                        term:params.term
                    }
                },
                processResults: function(data){
                    var results =  [];
                    $.each(data, function(index, item){
                       results.push({
                           id: item.id,
                           text:item.value+' - '+item.id
                       });
                    });
                    return {results};
                },
                cache: true,
                
            }, 
            placeholder: 'Ingrese el nombre',
            minimumInputLength:4
            
        }); 
     
         $('#productos').select2({
            ajax: {
                url: `{{route("cliente.buscarproductoajax")}}`,
                dataType: 'json',
                data: function (params) {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }
                    return query;
                },
                processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data
                        };
                },
                cache: true,
            }
        });

      
       


        function add_producto(){
            var data = $("#productos").val();
            var nom_produc = $("#nom_prod").val();
            var selc = $('option:selected', '#productos').html();
            var contador = document.getElementById("contador").value;
            var htmlTable = $('#agregar').html();
            let cont =document.getElementById('cont').value;
            $.ajax({
         
            type: 'post',
            url:"{{route('cliente.buscar_producto')}}",
            headers:{'X-CSRF-TOKEN':$('input[name=_token]').val()},
            datatype: 'json',
            data:  $("#form_proforma").serialize(),
            success: function(data){
                if(isNaN(data.Stock)||data.Stock==0){
                    alertas('error', 'Error', 'No hay disponibilidad del producto');
                }else{
                    let tieneIva = "";
                    let calcula_iva = 0;
                    if(data.FlagIva == 1){
                        tieneIva = "*"
                        calcula_iva = 1;
                    }
                    var midiv = `
                            <tr> 
                                <td> ${contador} </td> 
                                <td> <input readonly class="form-control" type="text" name="idproducto[]" value="${data.CodigoProducto}" > </td> 
                                <td style="display:flex"> <input class="form-control" type="text" name="producto${contador}" value="${data.NombreProducto}"> <p style="font-size:25px;margin-top: 6px;">${tieneIva}</p></td>  
                                <td>
                                <input type="text" class="form-control" name="referencia${contador}" readonly value="${data.Procedencia}">
                                </td>
                                <td> 
                                <select data-iva="${calcula_iva}" id="precio_producto${contador}" onchange="calcular();calcular_subtotal(${contador})" class="precios form-control" name="precios[]"> 
                                    <option value="${parseFloat(data.PrecioUnitario).toFixed(2)}"> ${parseFloat(data.PrecioUnitario).toFixed(2)} </option> 
                                    <option value="${parseFloat(data.PrecioEmpresarial).toFixed(2)}"> ${parseFloat(data.PrecioEmpresarial).toFixed(2)} </option> 
                                </select>
                                </td>  
                                 
                                <td><input disabled class="form-control" type="text" name="stock${contador}" value="${parseInt(data.Stock)}" ></td>
                                <td><input type="number" value="0" class="cantidades form-control" name="cantidad[]" onchange="calcular(); calcular_subtotal(${contador});" id="cantidad${contador}"></td>
                                <td><input readonly data-iva-tiene="${calcula_iva}" style="width: 100%;" type="text" class="form-control total_item" name="subtotal_item[]" id="subtotal${contador}" value="0.00"></td>

                                <td><button class="btn btn-danger"  type="button" onclick ="deleteRow(this)" ><i class="far fa-trash-alt"></i></button> </td> 
                            </tr>
                            `;
                    contador++;
                    document.getElementById("contador").value = contador;
                    $('#agregar').append(midiv);
                }
                



                },
            error: function(data){
                    
                    
                }
            })
           
        }

        function calcular_subtotal (id){
            let subtotal = document.getElementById("subtotal"+id);
            let precio = document.getElementById("precio_producto"+id);
            let cantidad = document.getElementById("cantidad"+id).value;
            
            let iva = precio.getAttribute("data-iva");
            let total =0;

            if(iva == 1){
                total = (precio.value * cantidad) + (precio.value * cantidad * 0.12);
                subtotal.value =  parseFloat(total).toFixed(3);
            }else{
                total = (precio.value * cantidad);
                subtotal.value =  parseFloat(total).toFixed(3);
            }
            calcular();
          
        }

        function calcular(){
            let total_item = document.querySelectorAll('.total_item');

            let subtotal0 = 0;
            let subtotal12 = 0;
            let tiene_iva = 0;
            
            let porct_iva = "";
            let subtotal_total = "";

            for(let i = 0; i < total_item.length; i++){
                tiene_iva =0;
                tiene_iva =total_item[i].getAttribute('data-iva-tiene');
                if(tiene_iva == 1){
                    subtotal12 += parseFloat(total_item[i].value);
                }else{
                    subtotal0 += parseFloat(total_item[i].value);
                }
            }
            
            
            porct_iva = subtotal12 * 0.12;
            subtotal12 = subtotal12 - porct_iva;
            
            
            document.getElementById('subtotal').value = parseFloat(subtotal0).toFixed(3);
            document.getElementById('iva').value = parseFloat(subtotal12).toFixed(3);
            
            document.getElementById('porct_iva').value = parseFloat(porct_iva).toFixed(3);
            document.getElementById('subtotal_total').value = parseFloat(parseFloat(subtotal12) + parseFloat(subtotal0)).toFixed(3);
            
            document.getElementById('total').value = parseFloat(parseFloat(subtotal12) + parseFloat(subtotal0 + parseFloat(porct_iva))).toFixed(3);
            //calcular();
        }

        function _calcular(){
            //iva es 12 
            //subtotal 0
            let precios = document.querySelectorAll(".precios");
            let cantidades = document.querySelectorAll(".cantidades");
            let subtotal = 0;
            let iva = 0;
            let total = 0;
            for(var i = 0; i < precios.length; i ++){
                subtotal = (precios[i].value * cantidades[i].value) + subtotal;
            }
            iva = subtotal * 0.12;
            total = iva + subtotal;
            document.getElementById('subtotal').value = parseFloat(subtotal).toFixed(2);
            document.getElementById('iva').value = parseFloat(iva).toFixed(2) ;
            document.getElementById('total').value = parseFloat(total).toFixed(2) ;
        }

        function buscar(){
        var codigo = $('#nombre_apellidos').val();
        let codigocliente = document.getElementById("codigocliente");
        $.ajax({
            type: 'get',
            url: "{{ route('cliente.buscarcliente')}}",
            data : {
                'codigo': codigo
            },

            success: function(data){
                if(data=='no'){
                    $('#cliente').val('');
                    $('#empresa').val('');
                    $('#latitud').val('');
                    $('#longitud').val('');
                    codigocliente.value="";

                }else{
                    $('#cliente').val(data[0]);
                  //  $('#empresa').val(data.Empresa);
                    $('#latitud').val(data[2]);
                    $('#longitud').val(data[3]);
                    codigocliente.value = data[4];
                    /*$('#cliente').val(data.ApellidosNombres);
                    $('#empresa').val(data.Empresa);
                    $('#latitud').val(data.latitud);
                    $('#longitud').val(data.longitud);*/
                    var x = document.getElementById("empresas");
                    x.remove(0);
                    if(data[1]!=null){
                      var option = document.createElement("option");
                      option.text = data[1];
                      x.add(option);
                    }else{
                      var option = document.createElement("option");
                      option.text = "No tiene empresa";
                      x.add(option);
                    }



                }
            }
        });
        }
   
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        calcular();
    }
    function alertas (icon, title, text){
        Swal.fire({
            icon: `${icon}`,
            title: `${title}`,
            text: `${text}`,
        })
    }

    function validar(e){
        e.preventDefault();
        let codigoCliente = document.getElementById('codigocliente').value;
        let cantidades = document.querySelectorAll(".cantidades");
        let validar = true;
        if(codigoCliente==""){
            alertas('error', 'Error', 'Debe seleccionar un cliente');
            validar= false;
        }else if(cantidades.length==0){
            alertas('error', 'Error', 'Debe agregar un producto');
            validar= false;
        }else{
            for(var i = 0; i < cantidades.length; i ++){
                if(cantidades[i].value <= 0 || cantidades[i].value == "" ){
                    alertas('error','Error', "Cantidades Incorrectas");
                    validar= false;
                }
                break;
            }
        }
       if(validar){
           $("#btn_guardar_pro").attr("disabled", true);
           let numero_proforma = document.getElementById('numero_proforma').value;
           let codigocliente = document.getElementById('codigocliente').value;
            let total = document.getElementById('total').value;
            let iva = document.getElementById('iva').value;
            let subtotal = document.getElementById('subtotal').value;
            let cantidades = document.getElementById('cantidades');
           $.ajax({
            type: 'post',
            url: "{{ route('cliente.insertProforma')}}",
            headers: {
                //'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                'X-CSRF-TOKEN': $("input[name=_token]").val()
            },
            data : $("#form_proforma").serialize()/*{
                'codigocliente': codigocliente,
                'numero_proforma':numero_proforma,
                'total':total,
                'iva':iva,
                'subtotal': subtotal
            }*/,
            success: function(data){
               if(data.respuesta=="si"){
                    alertas('success','Exito', data.text)
                    setTimeout(location.reload(), 250000)
                }else{
                    alertas('error','Error', data.text)
                    //setTimeout(location.reload(), 3500)
                }
            }
        });
       }
    }
     function cambia_imagen(){
         
        var codigop = $('#productos').val();
    
        $.ajax({
            type: 'get',
            url: "{{ route('cliente.buscarproductoimagen')}}",
            data : {
                'codigop': codigop
            },

            success: function(data){
                $("#img_prod").attr("src", data.Imagen);    
            }
        });
         
     }
    </script>
@endsection
