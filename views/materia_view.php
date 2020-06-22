<div class="text-center align-items-center mb-3" id="cargando_materia">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="content_materia">
    <div id="insert_success_materia" class="alert alert-success mb-3 d-none" role="alert">
        La materia <span id="materia_agregado"></span> fue agregada exitosamente.
    </div>
    <div id="update_success_materia" class="alert alert-primary mb-3 d-none"  role="alert">
        La materia <span id="materia_actualizado"></span> fue actualizada exitosamente.
    </div>
    <div id="delete_success_materia" class="alert alert-danger mb-3 d-none"  role="alert">
        La materia con el codigo <span id="materia_eliminado"></span> fue eliminada exitosamente.
    </div>
  <div class="row mb-5">
      <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#agregar_materia">Agregar materia</button>
  </div>
  <div class="row form-group">
      <input type="text" class="form-control" id="buscar_codigo_materia" name="buscar_codigo_materia" maxlength="5" minlength="5" placeholder="Buscar materia a partir de su codigo..." onkeyup="buscarMateria(this.value)">
  </div>
  <div class="row">
      <div class="col">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">Codigo Materia</th>
                      <th scope="col">Nombre de la Materia</th>
                      <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody id="datosMaterias">

              </tbody>
          </table>
      </div>
  </div>
  <div class="modal fade" id="agregar_materia" tabindex="-1" role="dialog" aria-labelledby="agregar_materia" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Agregar materia nueva</h5>
          <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
              <div class="form-group">
                <label for="agregar_nombre_materia">Nombre de la Materia</label>
                <input type="text" class="form-control" id="agregar_nombre_materia">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="agregarMateria()" data-dismiss="modal">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="editar_modal_materia">

  </div>
  <div id="eliminar_modal_materia">

  </div>
</div>
<script>
      $(function(){

        cargandoMaterias();
            
      });
      
      function cargandoMaterias(){
        verMaterias().then(()=>{
            $("#cargando_materia").addClass("d-none");
            $("#content_materia").removeClass("d-none");
        })
      }

      async function verMaterias(){
        $("#datosMaterias").empty();
        $("#editar_modal_materia").empty();
        $("#eliminar_modal_materia").empty();
        $.ajax({
            url: 'controllers/materias_controller/ver_materia_controller.php',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                for(var i = 0; i < response.length; i++){
                    $("#datosMaterias").append("<tr></tr><td>"+response[i].id+"</td><td>"+response[i].nombre+"</td><td><div class='btn-group' role='group'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_materia"+response[i].id+"'>Editar</button><button type='button'class='btn btn-danger' data-toggle='modal' data-target='#eliminar_materia"+response[i].id+"'>Eliminar</button></div></td></tr>");
                    $("#editar_modal_materia").append("<div class='modal fade' id='editar_materia"+response[i].id+"' tabindex='-1' role='dialog' aria-labelledby='editar_materia' aria-hidden='true'> <div class='modal-dialog'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title'>Editar materia</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' id='codigo_materia_editar"+response[i].id+"' name='codigo_materia_editar"+response[i].id+"' value='"+response[i].id+"'> <div class='form-group'><label for='editar_nombre_editar'>Nombre de la materia</label><input type='text' class='form-control' id='editar_nombre_editar"+response[i].id+"' name='editar_nombre' value='"+response[i].nombre+"'></div> </div> <div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-primary close-m' onclick='editarMateria("+response[i].id+")'>Actualizar</button></div> </div> </div> </div>");
                    $("#eliminar_modal_materia").append("<div class='modal fade' id='eliminar_materia"+response[i].id+"' data-backdrop='static' tabindex='-1' role='dialog' aria-hidden='true'> <div class='modal-dialog' role='document'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title' >¿Estas seguro de que quieres eliminar la materia  <span id='nombre_eliminar_materia"+ response[i].nombre +"'>"+ response[i].nombre +"</span>?</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' value='"+response[i].id+"' id='codigo_eliminar_materia"+response[i].id+"'>Este sera eliminara de manera permanente.</div> <div class='modal-footer'><button type='button' class='btn btn-info' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-danger close-m' onclick='eliminarMateria("+response[i].id+")'>Eliminar</button></div> </div> </div> </div>");
                }
            },
            error: function(error){
                console.log(error);
            }
        });
      };

      function agregarMateria(){
        var nombre = $("#agregar_nombre_materia").val();
        $.ajax({
          type: "POST",
          url: "controllers/materias_controller/insertar_materia_controller.php",
          data: { nombre : nombre },
          success: function(response) {
            console.log(response);
            $('body').removeClass('modal-open'); 
            $('.modal-backdrop').remove();
            $("#materia_agregado").text(nombre);
            setTimeout(()=>{
                $("#insert_success_materia").addClass("d-block");
            },0)
            setTimeout(()=>{
                $("#insert_success_materia").removeClass("d-block");
            },3000)
            cargandoMaterias();
          },
          error: function(error){
            console.log(error);
          }
        });
    }

    function buscarMateria(codigo){
        var codigoMateria = codigo;
        if(codigoMateria == ''){
            cargandoMaterias();
        } else {
            $.ajax({
                type: 'POST',
                url: 'controllers/materias_controller/buscar_materia_controller.php',
                dataType: 'JSON',
                data: { id: codigoMateria },
                success: function(response) {
                    $("#datosMaterias").empty();
                    $("#editar_modal_materia").empty();
                    $("#eliminar_modal_materia").empty();
                    for(var i = 0; i < response.length; i++){
                        $("#datosMaterias").append("<tr></tr><td>"+response[i].id+"</td><td>"+response[i].nombre+"</td><td><div class='btn-group' role='group'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_materia"+response[i].id+"'>Editar</button><button type='button'class='btn btn-danger' data-toggle='modal' data-target='#eliminar_materia"+response[i].id+"'>Eliminar</button></div></td></tr>");
                        $("#editar_modal_materia").append("<div class='modal fade' id='editar_materia"+response[i].id+"' tabindex='-1' role='dialog' aria-labelledby='editar_materia' aria-hidden='true'> <div class='modal-dialog'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title'>Editar materia</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' id='codigo_materia_editar"+response[i].id+"' name='codigo_materia_editar"+response[i].id+"' value='"+response[i].id+"'> <div class='form-group'><label for='editar_nombre_editar'>Nombre de la materia</label><input type='text' class='form-control' id='editar_nombre_editar"+response[i].id+"' name='editar_nombre' value='"+response[i].nombre+"'></div> </div> <div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-primary close-m' onclick='editarMateria("+response[i].id+")'>Actualizar</button></div> </div> </div> </div>");
                        $("#eliminar_modal_materia").append("<div class='modal fade' id='eliminar_materia"+response[i].id+"' data-backdrop='static' tabindex='-1' role='dialog' aria-hidden='true'> <div class='modal-dialog' role='document'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title' >¿Estas seguro de que quieres eliminar la materia  <span id='nombre_eliminar_materia"+ response[i].nombre +"'>"+ response[i].nombre +"</span>?</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' value='"+response[i].id+"' id='codigo_eliminar_materia"+response[i].id+"'>Este sera eliminara de manera permanente.</div> <div class='modal-footer'><button type='button' class='btn btn-info' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-danger close-m' onclick='eliminarMateria("+response[i].id+")'>Eliminar</button></div> </div> </div> </div>");
                    }
                },
                error: function(error){
                    console.log("error");
                    console.log(error);
                }
            });
        }
    }
    function editarMateria(id_arg){
        
        var codigo_materia = Number($("#codigo_materia_editar"+id_arg+"").val());
        var nombre_materia = $("#editar_nombre_editar"+id_arg+"").val();

        $.ajax({
            type: 'POST',
            url: "controllers/materias_controller/actualizar_materia_controller.php",
            data: { id : codigo_materia, nombre : nombre_materia },
            success: function(response){
                $('body').removeClass('modal-open'); 
                $('.modal-backdrop').remove();
                $("#materia_actualizado").text(nombre_materia);
                setTimeout(()=>{
                    $("#update_success_materia").addClass("d-block");
                },0)
                setTimeout(()=>{
                    $("#update_success_materia").removeClass("d-block");
                },3000)
                cargandoMaterias();
            },
            error: function(error){
                console.log(error);
            }
        })
    }
    function eliminarMateria(id_arg){
        var codigo_materia= $("#codigo_eliminar_materia"+id_arg+"").val();
        console.log(codigo_materia);
        $.ajax({
            type: 'POST',
            url: "controllers/materias_controller/eliminar_materia_controller.php",
            data: { id : codigo_materia },
            success: function(response){
                $('body').removeClass('modal-open'); 
                $('.modal-backdrop').remove();
                $("#materia_eliminado").text(codigo_materia);
                setTimeout(()=>{
                    $("#delete_success_materia").addClass("d-block");
                },0)
                setTimeout(()=>{
                    $("#delete_success_materia").removeClass("d-block");
                },3000)
                cargandoMaterias();
            },
            error: function(error){
                console.log(error);
            }
        })
    }
</script>