<?php
require_once __DIR__ . '/settings.nogit.php';

class dbInit extends mysqlAuth {

	public function mysqli(){
		$conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (mysqli_connect_errno()){
		    die("Failed to connect to database: ".mysqli_connect_error()."<br/> Inform the administrator");
		}
		mysqli_query($conn, "SET NAMES utf8");
		mysqli_set_charset($conn,"utf8");
		return $conn;
	}

	public function oopmysqli(){
		$conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (mysqli_connect_errno()){
		    die("Failed to connect to database: ".mysqli_connect_error()."<br/> Inform the administrator");
		}
		$conn->query("SET NAMES utf8");
		$conn->set_charset("utf8");
		return $conn;
	}

	public function pdo(){
		$dsn = "mysql:dbname=$this->dbname;host=$this->dbhost;charset=utf8";
		try {
		    $pdo = new PDO($dsn, $this->dbuser, $this->dbpass);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
		    die("Failed to connect to the database: ".$e."<br/> Inform an administrator");
		    exit();
		}
	}
}
class dbManip extends dbInit {
	public function select($datArr){

	}
}
