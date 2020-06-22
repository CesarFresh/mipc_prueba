<div class="text-center align-items-center mb-3" id="cargando_calificaciones">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="content_calificaciones d-none">
    <div id="insert_success_calificacion" class="alert alert-success mb-3 d-none" role="alert">
        El alumno <span id="calificacion_agregado"></span> fue inscrito correctamente.
    </div>
    <div id="update_success_calificacion" class="alert alert-primary mb-3 d-none"  role="alert">
       El alumno <span id="calificacion_actualizado"></span> fue inscrito correctamente.
    </div>
    <div id="delete_success_calificacion" class="alert alert-danger mb-3 d-none"  role="alert">
        El alumno <span id="calificacion_eliminado"></span> ya no pertenece a la materia <span id="calificacion_eliminado_materia"></span>.
    </div>
  <div class="row">
      <div class="col table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">Codigo del Alumno</th>
                      <th scope="col">Nombre Completo del Alumno</th>
                      <th scope="col">Fecha de Nacimiento</th>
                      <th scope="col">Codigo de la Materia</th>
                      <th scope="col">Nombre de la Materia</th>
                      <th scope="col">Calificaciones</th>
                      <th scope="col">Acciones</th>
                  </tr>
              </thead>
              <tbody id="datosCalificaciones">

              </tbody>
          </table>
      </div>
  </div>
  <div id="editar_modal_calificaciones">

  </div>
  <div id="eliminar_modal_calificaciones">

  </div>
</div>
<script>

  $(function(){

    //cargandoCalificaciones();

  });

  function cargandoCalificaciones(){
    verCalificaciones().then(()=>{
      $("#cargando_calificaciones").addClass("d-none");
      $("#content_calificaciones").removeClass("d-none");
  })
  }

  async function verCalificaciones(){
  $("#datosCalificaciones").empty();
  $("#editar_modal_calificaciones").empty();
  $("#eliminar_modal_calificaciones").empty();
    $.ajax({
        url: 'controllers/calificaciones_controller/ver_calificaciones_controller.php',
        type: 'GET',
        dataType: 'JSON',
        success: function(response) {
            for(var i = 0; i < response.length; i++){
                $("#datosCalificaciones").append(" <tr> <td>"+response[i].codigo_alumno+"</td> <td>"+response[i].nombre_alumno+ " " + response[i].apellidos+"</td> <td>"+response[i].fecha_nac+"</td> <td>"+response[i].codigo_materia+"</td> <td>"+response[i].nombre_materia+"</td> <td>"+response[i].calificacion+"</td> <td> <div class='btn-group' role='group'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_calificacion"+response[i].id+"'>Editar</button><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar_calificacion"+response[i].id+"'>Eliminar</button></div> </td> </tr>");
                //$("#editar_modal_calificaciones").append("<div class='modal fade' id='editar_materia"+response[i].id+"' tabindex='-1' role='dialog' aria-labelledby='editar_materia' aria-hidden='true'> <div class='modal-dialog'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title'>Editar materia</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' id='codigo_materia_editar"+response[i].id+"' name='codigo_materia_editar"+response[i].id+"' value='"+response[i].id+"'> <div class='form-group'><label for='editar_nombre_editar'>Nombre de la materia</label><input type='text' class='form-control' id='editar_nombre_editar"+response[i].id+"' name='editar_nombre' value='"+response[i].nombre+"'></div> </div> <div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-primary close-m' onclick='editarMateria("+response[i].id+")'>Actualizar</button></div> </div> </div> </div>");
                //$("#eliminar_modal_calificaciones").append("<div class='modal fade' id='eliminar_materia"+response[i].id+"' data-backdrop='static' tabindex='-1' role='dialog' aria-hidden='true'> <div class='modal-dialog' role='document'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title' >¿Estas seguro de que quieres eliminar la materia  <span id='nombre_eliminar_materia"+ response[i].nombre +"'>"+ response[i].nombre +"</span>?</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' value='"+response[i].id+"' id='codigo_eliminar_materia"+response[i].id+"'>Este sera eliminara de manera permanente.</div> <div class='modal-footer'><button type='button' class='btn btn-info' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-danger close-m' onclick='eliminarMateria("+response[i].id+")'>Eliminar</button></div> </div> </div> </div>");
            }
        },
        error: function(error){
            console.log("error calis");
            console.log(error);
        }
    });
  };
</script>