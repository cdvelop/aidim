<script type="text/javascript">
      function search(id){
       if(id == 2) {
        $("#tipo_operador").load( "tipo_operador.php").show();
       }
       else {
        $("#tipo_operador").hide();
       }
    }
</script>
 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Usuario</small>
            </h1>
            <ol class="breadcrumb">
            <li>
           <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Usuario</a>
            </li>
        </ol>
        <div class="row">
        <div class="col-md-6">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3 class="panel-title">Agregar Usuario</h3>
          </div>
          <div class="panel-body">
            <?php
            if(isset($_POST['adduser']) == 'Agregar'){

                $rut = $m->scape($_POST['rut']);
                $nombre = $m->scape($_POST['nombre']);
                $apellidop = $m->scape($_POST['apellidop']);
                $apellidom = $m->scape($_POST['apellidom']);
                $password = $m->scape($_POST['password']);
                $fecha_nac = $m->scape($_POST['fecha_nac']);
                $email = $m->scape($_POST['email']);
                $fono = $m->scape($_POST['fono']);
                $rol_usuario = $m->scape($_POST['rol_usuario']);
                $especialidad = $m->scape($_POST['especialidad']);
                $status = $m->scape($_POST['status']);


                if(!$m->validar_rut($rut)) {
                  echo '<div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                          <strong>Error!</strong> El rut no es valido <a href="javascript:history.back()" class="alert-link">Volver</a>!.
                        </div>';
                  exit();
                }
                if($m->user_exist($rut)) {
                    echo '<div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                          <strong>Error!</strong> El usuario ingresado ya existe!.
                        </div>';
                }
                else 
                {
                if($m->add_user($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$fono,$rol_usuario,$especialidad,$status)){
                    echo '<div class="alert alert-dismissible alert-success">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                           El usuario <strong>'.$user.'</strong> ha sido añadido.
                        </div>';
                }
                else
                {
                    echo '<div class="alert alert-dismissible alert-danger">
                          <button type="button" class="close" data-dismiss="alert">X</button>
                          <strong>Error!</strong> Por favor contacta con un <a href="mailto:admin@admin.cl" class="alert-link">Administrador</a>
                        </div>';
                }
              }
            }
            ?>
            <form action="index.php?s=adduser" method="POST">
            <div class="form-group" id="msgrut">
              <label class="control-label sr-only" for="inputSuccess5">Rut</label>
              <input type="text" id="inputSuccess5" aria-describedby="inputSuccess5Status" class="form-control" name="rut" placeholder="11.111.111-1" onChange="this.value = this.value.replace( /^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')" onBlur="validaRut(this.value)">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
           <div class="form-group">
              <label for="exampleInputPassword1">Apellido Paterno</label>
              <input type="text" class="form-control" name="apellidop" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Apellido Materno</label>
              <input type="text" class="form-control" name="apellidom" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Fecha de Nacimiento</label>
              <input type="date" class="form-control" id="datetimepicker2" name="fecha_nac" placeholder="1990-02-15">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Telefono</label>
              <input type="text" class="form-control" name="fono" value="+56">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Rol del Usuario</label>
              <select name="rol_usuario" class="form-control" onchange="search(this.value)">
                <?php
                    echo $m->get_rol(); 
                ?> 
              </select>
            </div>
            <div class="form-group" id="tipo_operador">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Estado del Usuario</label>
              <select name="status" class="form-control">
                <option value="Habilitado">Habilitado</option>
                <option value="Desabilitado">Desabilitado</option>
              </select>
            </div>
            <input type="submit" name="adduser" class="btn btn-success" value="Agregar">
          </form> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  jQuery('#datetimepicker2').datetimepicker({
  timepicker:false,
  format:'d/m/Y'
});
</script>
<!-- /.row -->