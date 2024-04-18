<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
        <h1 class="page-header">
            <small>Agregar Item </small>
            </h1>
            <ol class="breadcrumb">
            <li>
            <i class="fa fa-home"></i>  <a href="index.php">home</a>
            </li>
            <li class="active">
            <i class="fa fa-file"></i><a href="index.php?s=<?php echo $_GET['s']; ?>"> Agregar Item</a>
            </li>
           </ol> 
           <?php
           if(isset($_POST['Agregar']) == 'Agregar') {

                $itemname = $m->scape($_POST['itemname']);
                $status  = $m->scape($_POST['status']);

                if($m->add_item($itemname,$status)){
                  ?>
                  <div class="alert alert-dismissible alert-success">
                    <button type="button" class="close" data-dismiss="alert">&close;</button>
                   El item  <strong><?php echo $itemname; ?></strong> se ha añadido correctamente.
                  </div>
                  <?php
                }
           }
           ?>
           <div class="panel panel-default">
              <div class="panel-heading">Agregar Item</div>
              <div class="panel-body">
                <form  method="POST" action="">
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre del Item</label>
                <input type="text" name="itemname" class="form-control" id="exampleInputEmail1" placeholder="Ruido,Temp..." required>
              </div>               
              <div class="form-group">
                <label for="exampleInputPassword1">Estado del Item</label>
                <select name="status" class="form-control">
                    <option value="Habilitado">Habilitado</option>
                    <option value="Desabilitado">Desabilitado</option>
                </select>
              </div>
              <button type="submit" name="Agregar" class="btn btn-success">Agregar</button>
            </form>
              </div>
            </div>           
        </div>
    </div>