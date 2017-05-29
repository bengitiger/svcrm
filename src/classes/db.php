<?php
class DB {
	private $db_host = 'localhost';
	private $db_user = 'root';
	private $db_password = 'root';
	private $db_name = 'svcrm';

    public function connect() {
        try {
        	$db = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
        	return $db;
        } catch (PDOException $e) {
        	die("Error: " . $e->getMessage());
        }
    }       
}
?>
