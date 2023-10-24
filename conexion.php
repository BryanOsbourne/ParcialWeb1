<?php
class conexion
{
	private $link;
	
	public function conectar(){
		$this->link = new mysqli('aws.connect.psdb.cloud', 'e3a7feva4305ap9bbsqv', 'pscale_pw_1lXfooeYPh8T5zjHjA5EzGjZC5eHUO0M8XTbNsj5aVl', 'parcial');
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