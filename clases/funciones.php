<?php
require('config/mysql.php');

class Logeo extends Mysql {

	public function Login($rut,$pass){

		$check = mysqli_query($this->conexion(), "SELECT * FROM users WHERE rut='".$rut."' and password=PASSWORD('".$pass."')");
		$row = mysqli_fetch_array($check,MYSQLI_ASSOC);

		if($row['status'] == 'Desabilitado') {
			return false;
			exit();
		}
		else {
		if($row['rut']) {
			$_SESSION['rut'] = $row['rut'];
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['rol_usuario'] = $row['rol_usuario'];

			return true;
		}
		
		else
		{
			return false;
		}
	  }
   }
}

class Mantenedores extends Mysql {


		public function validar_rut($rut)
			{
			    $rut = preg_replace('/[^k0-9]/i', '', $rut);
			    $dv  = substr($rut, -1);
			    $numero = substr($rut, 0, strlen($rut)-1);
			    $i = 2;
			    $suma = 0;
			    foreach(array_reverse(str_split($numero)) as $v)
			    {
			        if($i==8)
			            $i = 2;
			        $suma += $v * $i;
			        ++$i;
			    }
			    $dvr = 11 - ($suma % 11);
			    
			    if($dvr == 11)
			        $dvr = 0;
			    if($dvr == 10)
			        $dvr = 'K';
			    if($dvr == strtoupper($dv))
			        return true;
			    else
			        return false;
			}

		public function scape($post) {
				return mysqli_real_escape_string($this->conexion(),$post);
		}

		public function get_equipo_id($name) {
			$find = mysqli_query($this->conexion(),"SELECT * FROM equipo WHERE nombre_equipo = '".$name."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			
			return $row['id_equipo'];
		}

		public function get_name_rol($id_rol) {

				$find = mysqli_query($this->conexion(),"SELECT * FROM user_rol WHERE id_rol='".$id_rol."'");
				$row = mysqli_fetch_array($find,MYSQLI_ASSOC);

				if($row['id_rol'] == 1){

					$rol = '<span style="margin-top:5px;" class="label label-success col-md-10">'.$row['rol_name'].'</span>';
				}
				else if($row['id_rol'] == 2){

					$rol = '<span style="margin-top:5px;" class="label label-danger col-md-10">'.$row['rol_name'].'</span>';
				}
				else if($row['id_rol'] == 3){

					$rol = '<span style="margin-top:5px;" class="label label-warning col-md-10">'.$row['rol_name'].'</span>';
				}


				return $rol;
		}

		public function get_rol() {

			$find = mysqli_query($this->conexion(),"SELECT * FROM user_rol");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['id_rol'].'>'.$row['rol_name'].'</option>';
			}

			return $option;
		}

		public function get_rol_id($id) {

			$find = mysqli_query($this->conexion(),"SELECT * FROM user_rol WHERE id_rol='".$id."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['rol_name'];
		}

		public function user_exist($rut){

				$find = mysqli_query($this->conexion(),"SELECT nombre FROM users WHERE rut='".$rut."'");
				$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
				if($row['nombre']){
					return true;
				}
				else
				{
					return false;
				}
		}

		public function add_user($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$fono,$rol_usuario,$especialidad,$status) {

			$ins = mysqli_query($this->conexion(),"INSERT INTO users VALUES ('".$rut."','".$nombre."','".$apellidop."','".$apellidom."','".$fecha_nac."','".$email."','".$fono."',PASSWORD('".$password."'),'".$rol_usuario."','".$especialidad."','".$status."')");
			if($ins){
				return true;
			}
			else {
				return false;
			}
		}

		public function user_update($rut,$nombre,$apellidop,$apellidom,$password,$fecha_nac,$email,$fono,$rol_usuario,$status){
			$sql= mysqli_query($this->conexion(),"UPDATE users set rut='".$rut."',nombre='".$nombre."',apellido_paterno='".$apellidop."',apellido_materno='".$apellidom."', password=PASSWORD('".$password."'),fecha_nac='".$fecha_nac."',email='".$email."', telefono='".$fono."', rol_usuario='".$rol_usuario."',status='".$status."' WHERE rut='".$rut."' LIMIT 1");
			if($sql){
				return true;
			}
		}

		public function num_rows($table){

			$result = mysqli_query($this->conexion(),"SELECT * FROM ".$table." ");
			$total = $result->num_rows;

			return $total;
		}

		public function user_modify($status,$rut) {

			if($status == 1)
			{
				$status = 'Habilitado';
			}
			else
			{
				$status = 'Desabilitado';
			}

			$update = mysqli_query($this->conexion(), "UPDATE users set status = '".$status."' WHERE rut='".$rut."'");

			if($update) {
				return true;
			}
			else {
				return mysqli_error();
			}
			
		}

		public function status_name($status) {
			if($status == 'Habilitado'){
				$status = '<span style="margin-top:5px;" class="label label-success col-md-9">Habilitado</span>';
			}
			else {
				$status = '<span style="margin-top:5px;" class="label label-danger col-md-9">Desabilitado</span>';
			}
			return $status;
		}

		public function status_inspeccion($status) {
			if($status == 'No realizada'){
				$status = '<span style="margin-top:5px;" class="label label-danger col-md-9">No Realizada</span>';
			}
			else {
				$status = '<span style="margin-top:5px;" class="label label-success col-md-9">Realizada</span>';
			}
			return $status;
		}

		public function listar_especialidad() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM especialidad");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<option value="'.$rs['id_especialidad'].'">'.$rs['nombre_especialidad'].'</option>';
			}
			return '<select name="especialidad" class="form-control">'.$result.'</select>';
		}

		public function list_user($consulta) {

			$list = $consulta;

			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$row['rut'].'</td>';
				$result = $result.'<td>'.$row['nombre'].'</td>';
				$result = $result.'<td>'.$row['password'].'</td>';
				$result = $result.'<td>'.$this->get_name_rol($row['rol_usuario']).'</td>';
				$result = $result.'<td>'.$this->status_name($row['status']).'</td>';
				$result = $result.'<td><a class="btn btn-warning btn-xs" href="index.php?s=moduser&user=edit&id='.$row['rut'].'"><span title="Editar" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-danger btn-xs" title="Desabilitar" href="index.php?s=moduser&action=down&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-success btn-xs" title="Habilitar" href="index.php?s=moduser&action=up&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" title="Ver Detalles" href="modal.php?id='.$row['rut'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a></td></tr>';
			}

			return $result;
		}
				

		public function search_user($rut) {
			
			$list = mysqli_query($this->conexion(),"SELECT * FROM users WHERE rut='".$rut."' LIMIT 1");
			
			while($row=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$row['rut'].'</td>';
				$result = $result.'<td>'.$row['nombre'].'</td>';
				$result = $result.'<td>'.$row['password'].'</td>';
				$result = $result.'<td>'.$this->get_name_rol($row['rol_usuario']).'</td>';
				$result = $result.'<td>'.$this->status_name($row['status']).'</td>';
				$result = $result.'<td><a class="btn btn-warning btn-xs" href="index.php?s=moduser&user=edit&id='.$row['rut'].'"><span title="Editar" class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-danger btn-xs" title="Desabilitar" href="index.php?s=moduser&action=down&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-success btn-xs" title="Habilitar" href="index.php?s=moduser&action=up&id='.$row['rut'].'"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>&nbsp;<a class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal" title="Ver Detalles" href="modal.php?id='.$row['rut'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver</a></td></tr>';
			}

			return $result;
		}

		public function list_areas() {
			$list = mysqli_query($this->conexion(),"SELECT * FROM area");
			while($rs=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['area_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modarea&action=edit&id='.$rs['id_area'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modarea&action=down&id='.$rs['id_area'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modarea&action=up&id='.$rs['id_area'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';
			}
			return $result;
		}

		public function list_areas_nombre($nombre) {
			$list = mysqli_query($this->conexion(),"SELECT * FROM area WHERE nombre_area='".$nombre."'");
			while($rs=mysqli_fetch_array($list,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['area_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modarea&action=edit&id='.$rs['id_area'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modarea&action=down&id='.$rs['id_area'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modarea&action=up&id='.$rs['id_area'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';
			}
			if($result) {
				return $result;
			}
			else{
				return '<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Op!</strong> No se encontraron coincidencias.
					</div>';
			}
		}

		public function add_area($nombreArea) {
				$insert = mysqli_query($this->conexion(),"INSERT INTO area (nombre_area) VALUES('".$nombreArea."')");
				if($insert){
					return true;
				}
		}

		public function area_status($id_area,$action){
			if($action == 'down'){
				$status = 'Desabilitado';
			}
			else if($action == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE area set area_status='".$status."' WHERE id_area='".$id_area."' LIMIT 1");
			if($update){
				return true;
			}
		}

		public function update_area_name($id_area,$name_area) {
			$update = mysqli_query($this->conexion(),"UPDATE area set nombre_area='".$name_area."' WHERE id_area='".$id_area."' LIMIT 1");
			if($update) {
				return true;
			}
		}

		public function get_areas() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM area WHERE area_status ='Habilitado'");
			
			while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
				$result = $result.'<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>';
			}

			return $result;
		}

		public function get_maquinas() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM maquina INNER JOIN area ON maquina.codigo_area=area.id_area");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>1</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_maquina'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['maquina_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modmaquina&action=edit&id='.$rs['id_maquina'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modmaquina&action=down&id='.$rs['id_maquina'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modmaquina&action=up&id='.$rs['id_maquina'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';

			}

			return $result;
		}

		public function get_maquinas_nombre($nombreDeMaquina) {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM maquina INNER JOIN area ON maquina.codigo_area=area.id_area WHERE maquina.nombre_maquina = '".$nombreDeMaquina."'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>1</td>';
				$result = $result.'<td>'.$rs['nombre_area'].'</td>';
				$result = $result.'<td>'.$rs['nombre_maquina'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['maquina_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modmaquina&action=edit&id='.$rs['id_maquina'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modmaquina&action=down&id='.$rs['id_maquina'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modmaquina&action=up&id='.$rs['id_maquina'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td>';

			}
			if($result) {
				return $result;
			}
			else{
				return '<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Op!</strong> No se encontraron coincidencias.
					</div>';
			}
			
		}

		public function add_maquina($name,$areaId) {
			$insert = mysqli_query($this->conexion() ,"INSERT INTO maquina (codigo_area,nombre_maquina) VALUES ('".$areaId."','".$name."')");
			if($insert) {
				return true;
			}
		}

		public function set_status($table,$status,$columna,$id){
			if($status == 'down'){
				$status = 'Desabilitado';
			}
			else if($status == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE maquina set maquina_status='".$status."' WHERE id_maquina='".$id."' LIMIT 1");
			if($update){
				return true;
			}
			else {
				return mysqli_error();
			}
		}

		public function update_maquina($idarea,$id,$NombreMaquina) {
			$status = 'Habilitado';
			$insert = mysqli_query($this->conexion() ,"UPDATE maquina SET codigo_area='".$idarea."', nombre_maquina='".$NombreMaquina."' WHERE id_maquina='".$id."' LIMIT 1");
			if($insert) {
				return true;
			}
		}

		public function add_equipo($id_maquina,$NombreEquipo,$EstadoEquipo) {
			$insert = mysqli_query($this->conexion(), "INSERT INTO equipo (id_maquina,nombre_equipo,equipo_status) VALUES ('".$id_maquina."','".$NombreEquipo."','".$EstadoEquipo."')");
			if($insert){
				return true;
			}
		}

		public function listar_maquina() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM maquina WHERE maquina_status = 'Habilitado'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<option value="'.$rs['id_maquina'].'">'.$rs['nombre_maquina'].'</option>';;
			}
			return $result;
		}

		public function listar_equipos() {
			$find = mysqli_query($this->conexion() ,"SELECT * FROM equipo");
			while($rs=mysqli_fetch_array($find,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_equipo'].'</td>';
				$result = $result.'<td>'.$rs['nombre_equipo'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['equipo_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modequipo&action=edit&id='.$rs['id_equipo'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modequipo&action=down&id='.$rs['id_equipo'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modequipo&action=up&id='.$rs['id_equipo'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';

			}
			return $result;
		}

		public function listar_equipos_nombre($nombre) {
			$find = mysqli_query($this->conexion() ,"SELECT * FROM equipo WHERE nombre_equipo ='".$nombre."'");
			while($rs=mysqli_fetch_array($find,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_equipo'].'</td>';
				$result = $result.'<td>'.$rs['nombre_equipo'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['equipo_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modequipo&action=edit&id='.$rs['id_equipo'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modequipo&action=down&id='.$rs['id_equipo'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modequipo&action=up&id='.$rs['id_equipo'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';

			}
			if($result) {
				return $result;
			}
			else{
				return '<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Op!</strong> No se encontraron coincidencias.
					</div>';
			}
		}

		public function equipo_status($id_equipo,$action){
			if($action == 'down'){
				$status = 'Desabilitado';
			}
			else if($action == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE equipo set equipo_status='".$status."' WHERE id_equipo='".$id_equipo."' LIMIT 1");
			if($update){
				return true;
			}
		}

		public function update_equipo($EquipoId,$id_maquina,$name_equipo,$equipo_status) {
			$sql = mysqli_query($this->conexion(),"UPDATE equipo SET id_maquina='".$id_maquina."',nombre_equipo='".$name_equipo."', equipo_status='".$equipo_status."' WHERE id_equipo='".$EquipoId."' LIMIT 1");
			if($sql) {
				return true;
			}
		}

		public function add_item($itemname,$status) {
			$find_plantilla = mysqli_query($this->conexion(), "SELECT * FROM plantilla");
			$rs=mysqli_fetch_array($find_plantilla,MYSQLI_ASSOC);

			if(!$rs[$itemname]) {
				$alter_plantilla = mysqli_query($this->conexion(), "ALTER TABLE plantilla ADD COLUMN ".$itemname." varchar(100)");
				$alter_plantilla2 = mysqli_query($this->conexion(), "ALTER TABLE plantilla_revision ADD COLUMN ".$itemname." varchar(100)");
			}

			if($alter_plantilla) {
				$insert_item = mysqli_query($this->conexion(), "INSERT INTO item (name_item,item_status) VALUES ('".$itemname."','".$status."')");
				return true;
			}
		}

		public function listar_items() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM item");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_item'].'</td>';
				$result = $result.'<td>'.$rs['name_item'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['item_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=moditem&action=edit&id='.$rs['id_item'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=moditem&action=down&id='.$rs['id_item'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=moditem&action=up&id='.$rs['id_item'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';

			}
			return $result;
		}

		public function listar_items_nombre($nombreItem) {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM item WHERE name_item='".$nombreItem."'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<tr><td>'.$rs['id_item'].'</td>';
				$result = $result.'<td>'.$rs['name_item'].'</td>';
				$result = $result.'<td>'.$this->status_name($rs['item_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=moditem&action=edit&id='.$rs['id_item'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=moditem&action=down&id='.$rs['id_item'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=moditem&action=up&id='.$rs['id_item'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';

			}
			if($result) {
				return $result;
			}
			else{
				return '<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Op!</strong> No se encontraron coincidencias.
					</div>';
			}
		}

		public function item_status($id_item,$action){
			if($action == 'down'){
				$status = 'Desabilitado';
			}
			else if($action == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE item set item_status='".$status."' WHERE id_item='".$id_item."' LIMIT 1");
			if($update){
				return true;
			}
		}

		// total de columnas de plantillas

		public function total_num_plan() {
			$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla'");
			$sql1 = mysqli_query($this->conexion(),"SHOW COLUMNS FROM plantilla");
			$result = mysqli_fetch_array($sql,MYSQLI_ASSOC);
			$i=$result['TOTAL'];
			$x=0;
			
			$total = $result['TOTAL'] - 2;
			$resta = $total;
			

			while($result1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC)) {
				
				$i = ($i - 1);
				
				if($i >= 1 && $result1['Field'] != "id_plantilla") {
					$resultado = $resultado.''.$result1['Field'].',';
				}
				else if($result1['Field'] != "id_plantilla")
				{
					$resultado = $resultado.''.$result1['Field'].'';
				}
			  }
			
			return $resultado;
			
		}

		// total de columnas 

		public function total_columnas_plantilla() {

		$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla'");
		$result = mysqli_fetch_array($sql,MYSQLI_ASSOC);
		$total = $result['TOTAL'] - 2;
		return $total;
		}

		//// GUARDAR COLUMNAS EN UN ARRAY 

		 public function total_colum_array() {
			
			$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla'");
			$sql1 = mysqli_query($this->conexion(),"SHOW COLUMNS FROM plantilla");
			$result = mysqli_fetch_array($sql,MYSQLI_ASSOC);
			$i=$result['TOTAL'];
			$x=0;
			
			$total = $result['TOTAL'] - 2;
			$resta = $total;

			$columnas[] = array();
			

			while($result1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC)) {
				
				$i = ($i - 1);
				
				if($i >= 0 && $result1['Field'] != "id_plantilla" ) {
					$columnas[($total-$i-1)] = $result1['Field'];
				}
			  }
			
			return $columnas;
			
		}
		
		////// LISTAR EQUIPOS PARA PLANTILLAS
		public function get_name_equipo($id){
			$sql =mysqli_query($this->conexion(), "SELECT * FROM equipo WHERE id_equipo='".$id."'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			return $rs['nombre_equipo'];
		}
		public function get_id_equipo($nombre_equipo){
			$sql =mysqli_query($this->conexion(), "SELECT id_equipo FROM equipo WHERE nombre_equipo='".$nombre_equipo."'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			return $rs['id_equipo'];
		}
		public function get_type_falla($id){
			$sql =mysqli_query($this->conexion(), "SELECT * FROM tipo_falla WHERE id_tipo_falla='".$id."'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			$nombre = "";

			if($rs['nombre_tipo_falla'] == 'Emergencia'){
				$nombre = '<span style="margin-top:5px;" class="label label-warning col-md-10">Emergencia</span>';
			}
			else if($rs['nombre_tipo_falla'] == 'Urgente'){
				$nombre = '<span style="margin-top:5px;" class="label label-danger col-md-10">Urgente</span>';
			}
			else {
				$nombre = '<span style="margin-top:5px;" class="label label-info col-md-10">Planificada</span>';
			}

			return $nombre;
		}
		public function ListarEquipos() {
			$sql = mysqli_query($this->conexion(),"SELECT * FROM equipo WHERE equipo_status='Habilitado'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<option value="'.$rs['id_equipo'].'">'.$rs['nombre_equipo'].'</option>';
			}
			return $result;
		}

		/// LISTAR ITEMS

		public function ListarItems() {
			$sql = mysqli_query($this->conexion(),"SELECT * FROM item WHERE item_status='Habilitado'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<div class="col-md-2">
                   	 <input type="checkbox" name="'.$rs['name_item'].'""> '.$rs['name_item'].'</div>';
			}
			return $result;
		}

		public function ListarItems_edit($id_plantilla) {
			$sql = mysqli_query($this->conexion() ,"SELECT * FROM plantilla WHERE id_plantilla='".$id_plantilla."' and plantilla_status='Habilitado'");

                    while ($rs=mysqli_fetch_array($sql,MYSQLI_NUM)) {
                            for ($i=0; $i < $this->total_columnas_plantilla_revision(); $i++) { 
                            if($i >= 3){
                               $datos[] = $rs[$i];
                            }
                        }                        
                    }

                    /// GUARDAR LAS ULTIMAS COLUMNAS 
                    $total = $this->total_columnas_plantilla() - 3;

                    $col = mysqli_query($this->conexion(), "SHOW COLUMNS FROM plantilla");

                    while($rows=mysqli_fetch_array($col,MYSQLI_ASSOC)){
                            if($rows['Field'] != 'id_plantilla' && $rows['Field'] != 'id_equipo' && $rows['Field'] != 'plantilla_status') {
                              $columnas[] = $rows['Field'];
                            }
                    } 

                    $x=0;

                    foreach ($datos as $key => $value) {
                        if($value[0] == 'H'){
                           $result = $result.'<div class="col-md-2">
	                   	            <input type="checkbox" name="'.$columnas[$x].'"" checked> '.$columnas[$x].'</div>';
	                        }
	                        else
	                        {
	                         $result = $result.'<div class="col-md-2">
	                   	            <input type="checkbox" name="'.$columnas[$x].'""> '.$columnas[$x].'</div>';
	                        }
                        $x++;
                    }

                return $result;
		}

		// LISTAR PLANTILLAS 

		public function ListarPlantillas() {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM plantilla");
			$i=1;
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){

				$result = $result.'<tr><td>'.$i.'</td>';
				$result = $result.'<td>'.$this->get_name_equipo($rs['id_equipo']).'</td>';
				$result = $result.'<td>'.$this->status_name($rs['plantilla_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modplantilla&action=edit&id='.$rs['id_plantilla'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modplantilla&action=down&id='.$rs['id_plantilla'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modplantilla&action=up&id='.$rs['id_plantilla'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';
				$i++;
			}	
				
				return $result;
					
		}

		public function ListarPlantillas_equipo($nombreEquipo) {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM plantilla WHERE id_equipo='".$this->get_id_equipo($nombreEquipo)."'");
			$i=1;
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){

				$result = $result.'<tr><td>'.$i.'</td>';
				$result = $result.'<td>'.$this->get_name_equipo($rs['id_equipo']).'</td>';
				$result = $result.'<td>'.$this->status_name($rs['plantilla_status']).'</td>';
				$result = $result.'<td><a href="index.php?s=modplantilla&action=edit&id='.$rs['id_plantilla'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=modplantilla&action=down&id='.$rs['id_plantilla'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span> Dar de baja</a>&nbsp;<a href="index.php?s=modplantilla&action=up&id='.$rs['id_plantilla'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Dar de alta</a></td></tr>';
				$i++;
			}	
				
			if($result) {
				return $result;
			}
			else{
				return '<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Op!</strong> No se encontraron coincidencias.
					</div>';
			}
					
		}

		public function set_status_plantilla($table,$status,$columna,$id){
			if($status == 'down'){
				$status = 'Desabilitado';
			}
			else if($status == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE ".$table." set ".$columna."='".$status."' WHERE id_plantilla='".$id."' LIMIT 1");
			if($update){
				return true;
			}
			else {
				return mysqli_error();
			}
		}

		/// UPDATE DE PLANTILLA

		// total de columnas de plantillas

		public function total_num_plan_up() {
			$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla'");
			$sql1 = mysqli_query($this->conexion(),"SHOW COLUMNS FROM plantilla");
			$result = mysqli_fetch_array($sql,MYSQLI_ASSOC);
			$i=$result['TOTAL'];
			$x=0;
			
			$total = $result['TOTAL'] - 2;
			$resta = $total;
			

			while($result1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC)) {
				
				$i = ($i - 1);
				
				if($i >= 1 && $result1['Field'] != "id_plantilla") {
					$resultado = $resultado.'set'.$result1['Field'].',';
				}
				else if($result1['Field'] != "id_plantilla")
				{
					$resultado = $resultado.''.$result1['Field'].'';
				}
			  }
			
			return $resultado;
			
		}


		// AGREGAR PLANTILLA SEGUN ITEMS
		public function add_plantilla($result,$id_equipo,$plantilla_status) {

			/// CHECK

			$buscar = mysqli_query($this->conexion(), "SELECT id_plantilla FROM plantilla WHERE id_equipo = '".$this->get_id_equipo($id_equipo)."'");

			$row = mysqli_fetch_array($buscar,MYSQLI_ASSOC);

			if($row['id_plantilla']) {
				return false;
			}
			else
			{
			$sql = mysqli_query($this->conexion(), "INSERT INTO plantilla (".$this->total_num_plan().") VALUES (".$id_equipo.",'".$plantilla_status."',".$result.")");
			if($sql) {
				return true;
			}
			else
				echo mysqli_error();
			}
		}

		public function get_area() {
			$option = $option.'<option value="">Seleccionar..</option>';
			$find = mysqli_query($this->conexion(),"SELECT * FROM area");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['id_area'].'>'.$row['nombre_area'].'</option>';
			}

			return $option;
		}

		public function get_name_area($id_area) {
			$find = mysqli_query($this->conexion(),"SELECT nombre_area FROM area WHERE id_area='".$id_area."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['nombre_area'];
		}

		public function get_rol_name($id) {

			$find = mysqli_query($this->conexion(),"SELECT * FROM especialidad WHERE id_especialidad='".$id."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['nombre_especialidad'];
		}
		public function get_name_operadores($rut) {
			$find=mysqli_query($this->conexion(), "SELECT nombre,especialidad FROM users WHERE rut='".$rut."'");
			$rows=mysqli_fetch_array($find,MYSQLI_ASSOC);
			$especialidad = $this->get_rol_name($rows['especialidad']);
			return $rows['nombre'].'('.$especialidad.')';
		}

		public function get_operadores() {
			$find = mysqli_query($this->conexion(),"SELECT * FROM users WHERE rol_usuario=2");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['rut'].'>'.$row['nombre'].' '.$row['apellido_paterno'].' ('.$this->get_rol_name($row['especialidad']).')</option>';
			}
			return $option;
		}

	
		public function get_equipo() {
			$find = mysqli_query($this->conexion(),"SELECT * FROM equipo");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['id_equipo'].'>'.$row['nombre_equipo'].'</option>';
			}
			return $option;
		}

		public function get_maquina() {
			$find = mysqli_query($this->conexion(),"SELECT * FROM maquina");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['id_maquina'].'>'.$row['nombre_maquina'].'</option>';
			}
			return $option;
		}

		public function get_name_maquina($id_maquina) {
			$find = mysqli_query($this->conexion(),"SELECT nombre_maquina FROM maquina WHERE id_maquina='".$id_maquina."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['nombre_maquina'];
		}

		public function update_plantilla($result,$id_equipo,$plantilla_status,$id) {
			$delete = mysqli_query($this->conexion(), "DELETE FROM plantilla WHERE id_plantilla='".$id."' LIMIT 1");
			if($delete) {
				$sql = mysqli_query($this->conexion(), "INSERT INTO plantilla (".$this->total_num_plan().") VALUES (".$id_equipo.",'".$plantilla_status."',".$result.")");
				if($sql) {
					return true;
				 }
			 }		   			
		 }

		  public function crear_inspeccion($area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino,$status) {

		  	$sql = mysqli_query($this->conexion() ,"INSERT INTO inspeccion VALUES (null,".$area.",".$maquina.",".$equipo.",'".$operador."','".$fecha_inicio."','".$fecha_termino."','".$status."','No realizada')");
		 	if($sql) {
		 		return true;
		 	}
		 }

		 public function get_name($table,$column,$id,$assoc) {
		 	$sql = mysqli_query($this->conexion(), "SELECT * FROM ".$table." WHERE ".$column."='".$id."' LIMIT 1");
		 	$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);

		 	return $rs[$assoc];
		 }

		 public function Listar_Inspecciones() {
		 	$result = "";
		 	$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion");
		 	while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		 		$result = $result.'<tr><td>'.$this->get_name('area','id_area',$rs['id_area'],'nombre_area').'</td>';
		 		$result = $result.'<td>'.$this->get_name('maquina','id_maquina',$rs['id_maquina'],'nombre_maquina').'</td>';
		 		$result = $result.'<td>'.$this->get_name('equipo','id_equipo',$rs['id_equipo'],'nombre_equipo').'</td>';
		 		$result = $result.'<td>'.$this->get_name('users','rut',$rs['id_operador'],'nombre').'</td>';
		 		$result = $result.'<td align="center"><button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="Fecha de Inicio" data-content="'.$rs['fecha_inicio'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Fecha</button></td>';
		 		$result = $result.'<td align="center"><button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="Fecha de Termino" data-content="'.$rs['fecha_termino'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Fecha</button></td>';
		 		$result = $result.'<td >'.$this->status_name($rs['status_inspeccion']).'</td>';
		 		if($rs['status_general'] == 'No realizada'){
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		$result = $result.'<td><a href="index.php?s=listarinspecciones&action=edit&id='.$rs['id_inspeccion'].'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>&nbsp;<a href="index.php?s=listarinspecciones&action=down&id='.$rs['id_inspeccion'].'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>&nbsp;<a href="index.php?s=listarinspecciones&action=up&id='.$rs['id_inspeccion'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a></td></tr>';

		 	}
		 		return $result;
		 }

		 public function obtener_rol_con_rut($rut) {
		 	$sql = mysqli_query($this->conexion(), "SELECT nombre_especialidad FROM users INNER JOIN especialidad ON users.especialidad = especialidad.id_especialidad WHERE users.rut = '".$rut."' ");

		 	$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);

		 	return $rs['nombre_especialidad'];

		 }

		 public function Listar_Inspecciones_reporte($status) {

		 	if($status == 'No Realizadas'){
		 		$status = 'No realizada';
		 	}
		 	else if($status == 'Realizadas'){
		 		$status = 'Realizada';
		  	}

		 	$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE status_general='".$status."'");
		 	$result = "";
		 	while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		 		$result = $result.'<tr><td>'.$rs['id_inspeccion'].'</td>';
		 		$result = $result.'<td>'.$this->obtener_rol_con_rut($rs['id_operador']).'</td>';
		 		$result = $result.'<td>'.$this->get_name('area','id_area',$rs['id_area'],'nombre_area').'</td>';
		 		$result = $result.'<td>'.$this->get_name('maquina','id_maquina',$rs['id_maquina'],'nombre_maquina').'</td>';
		 		$result = $result.'<td>'.$this->get_name('equipo','id_equipo',$rs['id_equipo'],'nombre_equipo').'</td>';
		 		$result = $result.'<td>'.$this->get_name('users','rut',$rs['id_operador'],'nombre').'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_inicio'].'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_termino'].'</td>';
		 		$result = $result.'<td >'.$this->status_name($rs['status_inspeccion']).'</td>';
		 		if($rs['status_general'] == false){
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		$result = $result.'<td ><button class="btn btn-warning btn-xs" onClick="verInspeccion('.$rs['id_inspeccion'].')">Ver Reporte</button></td>';


		 	}
		 		return $result;
		 }

		 public function Listar_Inspecciones_reporte_filtro($status,$filtro,$area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino) {

		 	if($status == false or $status == ''){
		 		$status = 'No realizada';
		 	}
		 	else if($status == true){
		 		$status = 'Realizada';
		  	}

		  	if($fecha_inicio && $fecha_termino && $filtro) {

		  		if($filtro == 1) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_area = ".$area." AND fecha_inicio >= '".$fecha_inicio."' AND fecha_termino <= '".$fecha_termino."' AND status_general='".$status."'");
		  		}	
		  		else if($filtro == 2) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_maquina = ".$maquina." AND fecha_inicio >= '".$fecha_inicio."' AND fecha_termino <= '".$fecha_termino."' AND status_general='".$status."'");
		  		}	
		  		else if ($filtro == 3) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_equipo = ".$equipo." AND fecha_inicio >= '".$fecha_inicio."' AND fecha_termino <= '".$fecha_termino."' AND status_general='".$status."'");
		  		}  	
		  		else {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador = ".$operador." AND fecha_inicio >= '".$fecha_inicio."' AND fecha_termino <= '".$fecha_termino."' AND status_general='".$status."'");
		  		}
		 	}
		 	else if($fecha_inicio == false && $fecha_termino == false && $filtro) {

		 		if($filtro == 1) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_area = ".$area." AND status_general='".$status."'");
		  		}	
		  		else if($filtro == 2) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_maquina = ".$maquina." AND status_general='".$status."'");
		  		}	
		  		else if ($filtro == 3) {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_equipo = ".$equipo." AND status_general='".$status."'");
		  		}  	
		  		else {
		  			$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador = '".$operador."' AND status_general='".$status."'");
		  		}
		 	}

		 	else if($fecha_inicio && $fecha_termino && $filtro == '') {
		 		$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE fecha_inicio >= '".$fecha_inicio."' AND fecha_termino <= '".$fecha_termino."' AND status_general='".$status."'");
		 	}


		 	$result = "";


		 	while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		 		$result = $result.'<tr><td>'.$rs['id_inspeccion'].'</td>';
		 		$result = $result.'<td>'.$this->obtener_rol_con_rut($rs['id_operador']).'</td>';
		 		$result = $result.'<td>'.$this->get_name('area','id_area',$rs['id_area'],'nombre_area').'</td>';
		 		$result = $result.'<td>'.$this->get_name('maquina','id_maquina',$rs['id_maquina'],'nombre_maquina').'</td>';
		 		$result = $result.'<td>'.$this->get_name('equipo','id_equipo',$rs['id_equipo'],'nombre_equipo').'</td>';
		 		$result = $result.'<td>'.$this->get_name('users','rut',$rs['id_operador'],'nombre').'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_inicio'].'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_termino'].'</td>';
		 		$result = $result.'<td >'.$this->status_name($rs['status_inspeccion']).'</td>';
		 		if($rs['status_general'] == false){
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		$result = $result.'<td ><button class="btn btn-warning btn-xs" onClick="verInspeccion('.$rs['id_inspeccion'].')">Ver Reporte</button></td>';


		 	}
		 		if($result == false) {
		 			echo '<div class="alert alert-dismissible alert-warning">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  No se encontraron coincidencias en la busqueda.
						</div>';
		 		}
		 		else {
		 			return $result;
		 		}
		 		
		 }

		 public function Listar_Inspecciones_by_user($rut) {

		 	$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador='".$rut."' and status_inspeccion='Habilitado' and fecha_inicio >= CURDATE()");

		 	$sql2 = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador='".$rut."' and status_inspeccion='Habilitado'");

		 	$rows=mysqli_fetch_array($sql2,MYSQLI_ASSOC);

		 	/// BUSCAR PLANTILLA

		 	$find = mysqli_query($this->conexion(),"SELECT * FROM plantilla WHERE id_equipo=".$rows['id_equipo']."");
		 	$fetch = mysqli_fetch_array($find,MYSQLI_ASSOC);

		 	////// 
		 	$buscar_revision = mysqli_query($this->conexion(), "SELECT * FROM plantilla_revision WHERE id_operador='".$rut."' and id_equipo='".$rut."'");
		 	$reporte = "<table class='table'><tr><td>Temperatura</td><td>79</td></tr></table>";

		 	while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		 		$result = $result.'<tr><td>'.$this->get_name('area','id_area',$rs['id_area'],'nombre_area').'</td>';
		 		$result = $result.'<td>'.$this->get_name('maquina','id_maquina',$rs['id_maquina'],'nombre_maquina').'</td>';
		 		$result = $result.'<td>'.$this->get_name('equipo','id_equipo',$rs['id_equipo'],'nombre_equipo').'</td>';
		 		$result = $result.'<td>'.$this->get_name('users','rut',$rs['id_operador'],'nombre').'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_inicio'].'</td>';
		 		$result = $result.'<td align="center">'.$rs['fecha_termino'].'</td>';
		 		if($rs['status_general'] == 'No realizada'){
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		if($rs['status_general'] == 'No realizada') {
		 			$result = $result.'<td><a href="index.php?action=check&id_inspeccion='.$rs['id_inspeccion'].'&id_plantilla='.$fetch['id_plantilla'].'&id_equipo='.$rs['id_equipo'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Realizar Inspeccion</a></td></tr>';
		 		}
		 		else
		 		{	
		 			$tipo_inspeccion = 'ByUser';
		 			$result = $result.'<td ><button class="btn btn-warning btn-xs" onClick="verInspeccion('.$rs['id_inspeccion'].')">Ver Reporte</button></td></tr>';		 			
		 		}

		 	}
		 		return $result;
		 }

		 public function Listar_Inspecciones_by_fecha($rut,$fecha_inicio,$fecha_termino) {

		 	$sql = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador='".$rut."' and status_inspeccion='Habilitado' and fecha_inicio >= '".$fecha_inicio."' and fecha_termino <= '".$fecha_termino."'");
		 	$sql2 = mysqli_query($this->conexion() ,"SELECT * FROM inspeccion WHERE id_operador='".$rut."' and status_inspeccion='Habilitado'");
		 	$rows=mysqli_fetch_array($sql2,MYSQLI_ASSOC);

		 	/// BUSCAR PLANTILLA

		 	$find = mysqli_query($this->conexion(),"SELECT id_plantilla FROM plantilla WHERE id_equipo=".$rows['id_equipo']."");
		 	$fetch = mysqli_fetch_array($find,MYSQLI_ASSOC);

		 	////// 
		 	$buscar_revision = mysqli_query($this->conexion(), "SELECT * FROM plantilla_revision WHERE id_operador='".$rut."' and id_equipo='".$rut."'");
		 	$reporte = "<table class='table'><tr><td>Temperatura</td><td>79</td></tr></table>";

		 	while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
		 		$result = $result.'<tr><td>'.$this->get_name('area','id_area',$rs['id_area'],'nombre_area').'</td>';
		 		$result = $result.'<td>'.$this->get_name('maquina','id_maquina',$rs['id_maquina'],'nombre_maquina').'</td>';
		 		$result = $result.'<td>'.$this->get_name('equipo','id_equipo',$rs['id_equipo'],'nombre_equipo').'</td>';
		 		$result = $result.'<td>'.$this->get_name('users','rut',$rs['id_operador'],'nombre').'</td>';
		 		$result = $result.'<td align="center"><button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="Fecha de Inicio" data-content="'.$rs['fecha_inicio'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Fecha</button></td>';
		 		$result = $result.'<td align="center"><button type="button" class="btn btn-xs btn-danger" data-toggle="popover" title="Fecha de Termino" data-content="'.$rs['fecha_termino'].'"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Ver Fecha</button></td>';
		 		if($rs['status_general'] == 'No realizada'){
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td>'.$this->status_inspeccion($rs['status_general']).'</td>';
		 		}
		 		if($rs['status_general'] == 'No realizada') {
		 			$result = $result.'<td><a href="index.php?action=check&id_inspeccion='.$rs['id_inspeccion'].'&id_plantilla='.$fetch['id_plantilla'].'&id_equipo='.$rs['id_equipo'].'" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Realizar Inspeccion</a></td></tr>';
		 		}
		 		else
		 		{
		 			$result = $result.'<td ><button class="btn btn-warning btn-xs" onClick="verInspeccion('.$rs['id_inspeccion'].')">Ver Reporte</button></td></tr>';		 			
		 		}

		 	}
		 		return $result;
		 }

		 public function inspeccion_status($id_inspeccion,$action){
			if($action == 'down'){
				$status = 'Desabilitado';
			}
			else if($action == 'up'){
				$status = 'Habilitado';
			}
			$update = mysqli_query($this->conexion(),"UPDATE inspeccion set status_inspeccion='".$status."' WHERE id_inspeccion='".$id_inspeccion."' LIMIT 1");
			if($update){
				return true;
			}
		}

		 public function update_inspeccion($id,$area,$maquina,$equipo,$operador,$fecha_inicio,$fecha_termino,$status) {
		 		$sql = mysqli_query($this->conexion(), "UPDATE inspeccion SET id_maquina=".$maquina." ,id_area=".$area.", id_equipo=".$equipo.", id_operador='".$operador."', fecha_inicio='".$fecha_inicio."', fecha_termino='".$fecha_termino."', status_inspeccion='".$status."' WHERE id_inspeccion='".$id."' LIMIT 1");
		 		if($sql){
		 			return true;
		 		}
		 }

		 public function listar_tipo_falla() {
		 	$sql = mysqli_query($this->conexion(), "SELECT * FROM tipo_falla WHERE status_tipo_falla='Habilitado'");
		 	while ($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
		 		$result = $result.'<option value="'.$rs['id_tipo_falla'].'">'.$rs['nombre_tipo_falla'].'</option>';
		 	}
		 	return $result;
		 }

		 public function total_columnas_plantilla_revision() {
			$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			return $rs['TOTAL'];
			}

		 public function listar_fallas() {
		 	$sql = mysqli_query($this->conexion(), "SELECT * FROM falla");
		 	$i=1;
		 	$result = "";
		 	while ($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
		 		$result = $result.'<tr>';
		 		$result = $result.'<td>'.$i++.'</td>';
		 		$result = $result.'<td>'.$this->get_name_equipo($rs['id_equipo']).'</td>';
		 		$result = $result.'<td>'.$this->get_type_falla($rs['tipo_falla']).'</td>';
		 		$result = $result.'<td>'.$rs['fecha_falla'].'</td>';
		 		$result = $result.'<td><textarea readonly>'.$rs['falla_1'].'</textarea></td>';
		 		$result = $result.'<td><textarea readonly>'.$rs['falla_2'].'</textarea></td>';
		 		$result = $result.'</tr>';

		 	}
		 	return $result;
		 }

		 }
?>