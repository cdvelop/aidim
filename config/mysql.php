<?php

ini_set('date.timezone', 'America/Santiago');

class Mysql {

	private $host = "localhost";
	private $user = "root";
	private $pass = "123456789";
	private $db	  = "tesis";

	public function conexion() {


			$mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

			$mysqli->query("SET NAMES 'utf8'");

			if($mysqli) {
				return $mysqli;
			}
			else {
				return $mysqli->error();
		   }
	 }

	public function status_inspecciones_reporte($status) {
			if($status == 'No realizada'){
				$status = '<span style="margin-top:5px;" class="label label-danger col-md-4">No Realizada</span>';
			}
			else {
				$status = '<span style="margin-top:5px;" class="label label-success col-md-4">Realizada</span>';
			}
			return $status;
		}
	 
	

	public function obtener_nombre_operador($rut) {
			$find = mysqli_query($this->conexion(),"SELECT * FROM users WHERE rut = '".$rut."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['nombre'].' '.$row['apellido_paterno'].' '.$row['apellido_materno'];
		}

	public function get_rol_name($id) {

			$find = mysqli_query($this->conexion(),"SELECT * FROM especialidad WHERE id_especialidad='".$id."'");
			$row = mysqli_fetch_array($find,MYSQLI_ASSOC);
			return $row['nombre_especialidad'];
		}

	public function get_rol_inspeccion_operador($rut) {
			$find=mysqli_query($this->conexion(), "SELECT especialidad FROM users WHERE rut='".$rut."'");
			$rows=mysqli_fetch_array($find,MYSQLI_ASSOC);
			$especialidad = $this->get_rol_name($rows['especialidad']);
			if($especialidad == 'Mecanico'){
				return 'Mecanica';
			}
			else {
				return 'Electrica';
			}
		}

	public function get_name_equipo($id){
			$sql =mysqli_query($this->conexion(), "SELECT * FROM equipo WHERE id_equipo='".$id."'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			return $rs['nombre_equipo'];
		}

	public function get_operadores_especialidad($tipo_operador) {
			$find = mysqli_query($this->conexion(),"SELECT * FROM users WHERE especialidad='".$tipo_operador."'");
			while ($row = mysqli_fetch_array($find,MYSQLI_ASSOC)) {
				$option = $option.'<option value='.$row['rut'].'>'.$row['nombre'].' '.$row['apellido_paterno'].' ('.$this->get_rol_name($row['especialidad']).')</option>';
			}
			return $option;
		}

	public function get_type_falla($id){
			$sql =mysqli_query($this->conexion(), "SELECT * FROM tipo_falla WHERE id_tipo_falla='".$id."'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			$nombre = "";

			if($rs['nombre_tipo_falla'] == 'Emergencia'){
				$nombre = '<span style="margin-top:5px;" class="label label-warning col-md-3">Emergencia</span>';
			}
			else if($rs['nombre_tipo_falla'] == 'Urgente'){
				$nombre = '<span style="margin-top:5px;" class="label label-danger col-md-3">Urgente</span>';
			}
			else {
				$nombre = '<span style="margin-top:5px;" class="label label-info col-md-3">Planificada</span>';
			}

			return $nombre;
		}

		
	public function get_areas() {

		$result = null;

		$sql = mysqli_query($this->conexion(), "SELECT * FROM area WHERE area_status ='Habilitado'");
			
		while($row = mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
				$result = $result.'<option value="'.$row['id_area'].'">'.$row['nombre_area'].'</option>';
		}

		return $result;
	}

	public function get_area_id_nombre($idArea) {
			$sql = mysqli_query($this->conexion(), "SELECT nombre_area FROM area WHERE id_area ='".$idArea."'");
			$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			return $row['nombre_area'];

	}

	public function get_maquina_id_nombre($idMaquina) {
			$sql = mysqli_query($this->conexion(), "SELECT nombre_maquina FROM maquina WHERE id_maquina ='".$idMaquina."'");
			$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			return $row['nombre_maquina'];

	}

	public function get_equipo_id_nombre($IdEquipo) {
			$sql = mysqli_query($this->conexion(), "SELECT nombre_equipo FROM equipo WHERE id_equipo ='".$IdEquipo."'");
			$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			return $row['nombre_equipo'];

	}

	public function get_tipo_falla($tipoFalla) {
			$sql = mysqli_query($this->conexion(), "SELECT nombre_tipo_falla FROM tipo_falla WHERE id_tipo_falla ='".$tipoFalla."'");
			$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);

			return $row['nombre_tipo_falla'];

	}

	public function listar_maquina() {
			$result = null;
			$sql = mysqli_query($this->conexion(), "SELECT * FROM maquina WHERE maquina_status = 'Habilitado'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<option value="'.$rs['id_maquina'].'">'.$rs['nombre_maquina'].'</option>';;
			}
			return $result;
		}

	public function ListarEquipos() {
			$result = null;
			$sql = mysqli_query($this->conexion(),"SELECT * FROM equipo WHERE equipo_status='Habilitado'");
			while($rs=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
				$result = $result.'<option value="'.$rs['id_equipo'].'">'.$rs['nombre_equipo'].'</option>';
			}
			return $result;
		}
	public function total_columnas_plantilla_revision_ajax() {
			$sql = mysqli_query($this->conexion(),"SELECT COUNT(*) as TOTAL FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = 'tesis' AND table_name = 'plantilla_revision'");
			$rs=mysqli_fetch_array($sql,MYSQLI_ASSOC);
			return $rs['TOTAL'];
	}

	public function listar_fallas_tipo($tipo_falla) {
			$sql = mysqli_query($this->conexion(), "SELECT * FROM falla WHERE tipo_falla = '".$tipo_falla."'");
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