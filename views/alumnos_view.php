<div class="text-center align-items-center" id="cargando">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>
</div>
<div id="content" class="d-none">
    <div id="insert_success" class="alert alert-success mb-3 d-none" role="alert">
        El alumno <span id="alumno_agregado"></span> fue agregagado exitosamente.
    </div>
    <div id="update_success" class="alert alert-primary mb-3 d-none"  role="alert">
        El alumno <span id="alumno_actualizado"></span> fue actualizado exitosamente.
    </div>
    <div id="delete_success" class="alert alert-danger mb-3 d-none"  role="alert">
        El alumno <span id="alumno_eliminado"></span> fue eliminado exitosamente.
    </div>
    <div class="row mb-5">
        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#agregar_alumno">Agregar alumno</button>
    </div>
    <div class="row form-group">
        <input type="text" class="form-control" id="buscar_codigo" name="buscar_codigo" maxlength="5" minlength="5" placeholder="Buscar alumno a partir de su codigo..." onkeyup="buscarAlumno(this.value)">
    </div>
    <div class="row">
        <div class="col table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Codigo Alumno</th>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="datosAlumnos" onchange="verAlumnos()">
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="agregar_alumno" tabindex="-1" role="dialog" aria-labelledby="agregar_alumno" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar alumno</h5>
            <button type="button" class="close close-m" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" id="agregar">
            <div class="modal-body">
                <div class="form-group">
                <label for="agregar_nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="agregar_nombre" name="agregar_nombre">
                </div>
                <div class="form-group">
                <label for="agregar_apellidos">Apellido(s)</label>
                <input type="text" class="form-control" id="agregar_apellidos" name="agregar_apellidos">
                </div>
                <div class="form-group">
                <label for="agregar_fechaNac">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="agregar_fechaNac" name="agregar_fechaNac">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="close-m btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="agregarAlumno()">Guardar</button>
            </div>
        </form>
        </div>
    </div>
    </div>
    <div id="editar_modal">

    </div>
    <div id="eliminar_modal">

    </div>
</div>
<script>

    $(function(){

        cargando();

    });

    function cargando(){
        verAlumnos().then(()=>{
            $("#cargando").addClass("d-none");
            $("#content").removeClass("d-none");
        })
    }

    async function verAlumnos(){
        $("#datosAlumnos").empty();
        $("#editar_modal").empty();
        $("#eliminar_modal").empty();
        $.ajax({
            url: 'controllers/alumnos_controller/ver_alumnos_controller.php',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                for(var i = 0; i < response.length; i++){
                    $("#datosAlumnos").append(" <tr><td>"+response[i].id+"</td><td>"+response[i].nombre + " " + response[i].apellidos+"</td><td>"+response[i].fechaNac+"</td><td><div class='btn-group' role='group'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_alumno"+response[i].id+"'>Editar</button><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar_alumno"+response[i].id+"'>Eliminar</button></div></td></tr>");
                    $("#editar_modal").append("<div class='modal fade' id='editar_alumno"+response[i].id+"' tabindex='-1' role='dialog' aria-labelledby='editar_alumno'aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>Editar alumno</h5><button type='button' class='close close-m' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><input type='hidden' id='codigo_alumno"+response[i].id+"' name='codigo_alumno' value='"+response[i].id+"'><div class='form-group'><label for='editar_nombre'>Nombre(s)</label><input type='text' class='form-control' id='editar_nombre"+response[i].id+"' name='editar_nombre' value='"+response[i].nombre+"'></div><div class='form-group'><label for='editar_apellidos'>Apellido(s)</label><input type='text' class='form-control' id='editar_apellidos"+response[i].id+"' name='editar_apellidos'  value='"+response[i].apellidos+"'></div><div class='form-group'><label for='editar_fechaNac'>Fecha de Nacimiento</label><input type='date' class='form-control' id='editar_fechaNac"+response[i].id+"' name='editar_fechaNac' value='"+response[i].fechaNac+"'></div></div><div class='modal-footer'><button type='button' class='close-m btn btn-secondary' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-success' onclick='editarAlumno("+ response[i].id +")'>Guardar</button></div></div></div></div>");
                    $("#eliminar_modal").append(" <div class='modal fade' id='eliminar_alumno"+response[i].id+"' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'> <div class='modal-dialog' role='document'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title' id='staticBackdropLabel'>¿Estas seguro de que quieres eliminar al alumno con el codigo "+ response[i].id +"?</h5><button type='button' class='close close-m' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button> </div> <div class='modal-body'><input type='hidden' value='"+response[i].id+"' id='codigo_eliminar"+response[i].id+"'>Este sera eliminara de manera permanente.</div> <div class='modal-footer'><button type='button' class='btn btn-info' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-danger' onclick='eliminarAlumno("+response[i].id+")'>Eliminar</button></div> </div> </div> </div>");
                }
            },
            error: function(error){
                console.log(error);
            }
        });
    };

    function agregarAlumno(){
        var nombre = $("#agregar_nombre").val();
        var apellidos = $("#agregar_apellidos").val();
        var fechaNac = $("#agregar_fechaNac").val();
        $.ajax({
          type: "POST",
          url: "controllers/alumnos_controller/insertar_alumno_controller.php",
          data: { nombre : nombre, apellidos : apellidos, fechaNac : fechaNac },
          success: function(response) {
            $('.close-m').trigger('click');
            $('body').removeClass('modal-open'); 
            $('.modal-backdrop').remove();
            var nombre_completo = nombre + " " + apellidos;
            $("#alumno_agregado").text(nombre_completo);
            setTimeout(()=>{
                $("#insert_success").addClass("d-block");
            },0)
            setTimeout(()=>{
                $("#insert_success").removeClass("d-block");
            },3000)
            cargando();
          }
        });
    }

    function buscarAlumno(codigo){
        var codigoAlumno = codigo;
        if(codigoAlumno == ''){
            cargando();
        } else {
            $.ajax({
                type: 'POST',
                url: 'controllers/alumnos_controller/buscar_alumno_controller.php',
                dataType: 'JSON',
                data: { id: codigoAlumno },
                success: function(response) {
                    console.log(response);
                    $("#datosAlumnos").empty();
                    $("#editar_modal").empty();
                    $("#eliminar_modal").empty();
                    for(var i = 0; i < response.length; i++){
                    $("#datosAlumnos").append(" <tr><td>"+response[i].id+"</td><td>"+response[i].nombre + " " + response[i].apellidos+"</td><td>"+response[i].fechaNac+"</td><td><div class='btn-group' role='group'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editar_alumno"+response[i].id+"'>Editar</button><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar_alumno"+response[i].id+"'>Eliminar</button></div></td></tr>");
                    $("#editar_modal").append("<div class='modal fade' id='editar_alumno"+response[i].id+"' tabindex='-1' role='dialog' aria-labelledby='editar_alumno'aria-hidden='true'><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><h5 class='modal-title'>Editar alumno</h5><button type='button' class='close close-m' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><input type='hidden' id='codigo_alumno"+response[i].id+"' name='codigo_alumno' value='"+response[i].id+"'><div class='form-group'><label for='editar_nombre'>Nombre(s)</label><input type='text' class='form-control' id='editar_nombre"+response[i].id+"' name='editar_nombre' value='"+response[i].nombre+"'></div><div class='form-group'><label for='editar_apellidos'>Apellido(s)</label><input type='text' class='form-control' id='editar_apellidos"+response[i].id+"' name='editar_apellidos'  value='"+response[i].apellidos+"'></div><div class='form-group'><label for='editar_fechaNac'>Fecha de Nacimiento</label><input type='date' class='form-control' id='editar_fechaNac"+response[i].id+"' name='editar_fechaNac' value='"+response[i].fechaNac+"'></div></div><div class='modal-footer'><button type='button' class='close-m btn btn-secondary' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-success' onclick='editarAlumno("+ response[i].id +")'>Guardar</button></div></div></div></div>");
                    $("#eliminar_modal").append("<div class='modal fade' id='eliminar_alumno"+response[i].id+"' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content'><div class='modal-header'><h5 class='modal-title' id='staticBackdropLabel'>¿Estas seguro de que quieres eliminar al alumno con el codigo "+ response[i].id +"</h5><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div><div class='modal-body'><input type='hidden' value='"+response[i].id+"' id='codigo_eliminar"+response[i].id+"'>Este sera eliminara de manera permanente.</div><div class='modal-footer'><button type='button' class='btn btn-info close-m' data-dismiss='modal'>Cerrar</button><button type='button' class='btn btn-danger' onclick='eliminarAlumno("+response[i].id+")'>Eliminar</button></div></div></div></div>");
                }
                },
                error: function(error){
                    console.log("error");
                    console.log(error);
                }
            });
        }

    }

    function editarAlumno(id_arg){
        
        var idCodigo = Number($("#codigo_alumno"+id_arg+"").val());
        var nombre = $("#editar_nombre"+id_arg+"").val();
        var apellidos = $("#editar_apellidos"+id_arg+"").val();
        var fechaNac = $("#editar_fechaNac"+id_arg+"").val();
        $.ajax({
            type: 'POST',
            url: "controllers/alumnos_controller/actualizar_alumno_controller.php",
            data: { id : idCodigo, nombre : nombre, apellidos : apellidos, fechaNac : fechaNac },
            success: function(response){
                $('.close-m').trigger('click');
                $('body').removeClass('modal-open'); 
                $('.modal-backdrop').remove();
                var nombre_completo = nombre + " " + apellidos;
                $("#alumno_actualizado").text(nombre_completo);
                setTimeout(()=>{
                    $("#update_success").addClass("d-block");
                },0)
                setTimeout(()=>{
                    $("#update_success").removeClass("d-block");
                },3000)
                cargando();
            },
            error: function(error){
                console.log(error);
            }
        })
    }
    function eliminarAlumno(id_arg){
        var idCodigo= Number($("#codigo_eliminar"+id_arg+"").val());
        var nombre = $("#editar_nombre"+id_arg+"").val();
        var apellidos = $("#editar_apellidos"+id_arg+"").val();
        $.ajax({
            type: 'POST',
            url: "controllers/alumnos_controller/eliminar_alumno_controller.php",
            data: { id : idCodigo},
            success: function(response){
                $('.close-m').trigger('click');
                $('body').removeClass('modal-open'); 
                $('.modal-backdrop').remove();
                var nombre_completo = nombre + " " + apellidos;
                $("#alumno_eliminado").text(nombre_completo);
                setTimeout(()=>{
                    $("#delete_success").addClass("d-block");
                },0)
                setTimeout(()=>{
                    $("#delete_success").removeClass("d-block");
                },3000)
                cargando();
            },
            error: function(error){
                console.log(error);
            }
        })
    }
</script>