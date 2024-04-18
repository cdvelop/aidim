<script>
  function CargarMaquinas(dato) {
    $("#cargarMaquinas").load('ajax/cargarMaquinas.php?idArea='+dato);
  }
  $(document).ready(function() {
      $("#tipo_inspeccion").change(function() {
        var tipo = $("#tipo_inspeccion").val();
        if(tipo == 'Mecanica') {
          $( "#cargar_operadores" ).load( "ajax/BuscarOperadores.php?tipo=2" );
        }
        else
        {
          $( "#cargar_operadores" ).load( "ajax/BuscarOperadores.php?tipo=4" );
        }
      });
  });
</script>


<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Generar Inspección</small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i> <a href="index.php?s=<?php echo $_GET['s']; ?>"> Generar Inspección</a>
            </li>
	          </ol>
            <?php
            /// recuperar datos 
            if(isset($_POST['action']) == 'Crear Inspeccion') {
                $area = $m->scape($_POST['area']);
                $maquina = $m->scape($_POST['id_maquina']);
                $equipo = $m->scape($_POST['equipo']);
                $operador = $m->scape($_POST['operador']);
                $fecha_inicio = $m->scape($_POST['fecha_inicio']);
                $fecha_termino = $m->scape($_POST['fecha_termino']);
                $status = $m->scape($_POST['status']);
                if($m->crear_inspeccion($area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino,$status)){
                  ?>
                  <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">X</button>
                   La inspección se ha añadido correctamente.
                  </div>
                  <?php
                }
              }
            ?>
             <div class="panel panel-default">
              <div class="panel-heading">Generar Inspección</div>
              <div class="panel-body">
                <form action="" method="POST"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Area</label>
                  <select name="area" class="form-control alert-success" onChange="CargarMaquinas(this.value)">
                    <?php echo $m->get_area(); ?>
                  </select>
                </div>
                <div class="form-group">
                <div id="cargarMaquinas"></div>
                </div>  
                <div id="equipos"></div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Tipo de Inspección</label>
                  <select name="tipo_inspeccion" id="tipo_inspeccion" class="form-control alert-info">
                  <option value="">Seleccionar..</option>
                   <option value="Mecanica">Mecanica</option>
                   <option value="Electrica">Electrica</option>
                  </select>
                </div>
                <div id="cargar_operadores"></div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha de Inicio</label>
                  <input id="fecha_inicio" name="fecha_inicio" class="form-control" type="text" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Fecha de Termino</label>
                 <input id="fecha_termino" name="fecha_termino" class="form-control" type="text" required>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Estado de la inspección</label>
                <select name="status" class="form-control">
                  <option value="Habilitado">Habilitado</option>
                  <option value="Desabilitado">Desabilitado</option>
                </select>
              </div>
                <button type="submit" name="action" class="btn btn-success">Crear Inspeccion</button>
              </form>
              <script type="text/javascript">
              function charge_equipos(id) {
                $('#equipos').load('pages/mantenedores/listar_equipos.php?id_maquina='+id);
              }
              $('#fecha_inicio').datetimepicker();
              $('#fecha_termino').datetimepicker();
              </script>
              </div>
            </div>
        </div>
    </div>