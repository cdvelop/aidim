<?php
require('../config/mysql.php');
$m = new Mysql();
$especialidad = $_GET['tipo'];
?>
<div class="form-group">
<label for="exampleInputEmail1">Operador</label>
<select name="operador" class="form-control alert-danger">
<?php echo $m->get_operadores_especialidad($especialidad); ?>
</select>
</div>