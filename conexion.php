<?php
class conexion
{
	private $link;
	
	public function conectar(){
		$this->link = new mysqli('localhost', 'id21445984_admin', 'Adminadmin1!', 'id21445984_parcial');
		if ($this->link->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $this->link->connect_errno . ") " . $this->link->connect_error;
		}
		return $this->link;
	}

	public function desconectar(){
		mysqli_close($this->link);
	}
	
}	

?>