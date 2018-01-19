<?php
/**
* Remote connection for database and queries
*/
class Database {
	
	// Atributes of class
	private static $db=null;

	// Function to connect with db
	public function connect() {
		
		// Data of database
		$db_host="us-cdbr-iron-east-02.cleardb.net";
		$db_user="b3905f855460a9";
		$db_pass="9fdb9c4f";
		$db_name="ad_15583adf16d2d86";
		// Connection db
		$db=new mysqli("$db_host","$db_user","$db_pass","$db_name");
		// Returns the connection
		return $db;

	} // Cierre de connect

	// Function to query SELECT sql
	public function select($query) {

		$db=$this->connect();
		// No connection db
		if(!$db){
		    
		    echo "Failed to connect to MySQL: " . $db->connect_error;

		}else{
			// Si no hay resultado
			if(!$result=$db->query($query)){
				// Devuelve un error
			    die('There was an error running the query [' . $db->error . ']');
			}
			else{
				// Devuelve un array
				while ($row=$result->fetch_object()){
					// Se guarda el array
					$stmt[]=$row;
				}
			}
		}				
		// Close connection db
		$db->close();
		// Devuelve el array de los resultados o undefined
		return $stmt;

	} // Cierre de select

	// Function to query INSERT sql
	public function insert($query) {

		$db=$this->connect();
		// No connection db
		if(!$db){
		    
		    echo "Failed to connect to MySQL: " . $db->connect_error;

		}else{
			// Prepary our query for binding
			$stmt=$db->prepare($query);

			// Execute the query
			$stmt->execute();
		}
		// Check for successful insertion
		if ($stmt->affected_rows){
			return "true";
		}
		// Close connection db
		$db->close();		
		// Devuelve un false
		return "false";

	} // Cierre de insert

	// Function to query DELETE sql
	public function delete($query) {

		$db=$this->connect();
		// No connection db
		if(!$db){
		    
		    echo "Failed to connect to MySQL: " . $db->connect_error;

		}else{
			// Prepary our query for binding
			$stmt=$db->prepare($query);

			// Execute the query
			$stmt->execute();
		}
		// Close connection db
		$db->close();

	} // Cierre de delete

	// Function to query UPDATE sql
	public function update($query,$value) {

		$db=$this->connect();
		// No connection db
		if(!$db){
		    
		    echo "Failed to connect to MySQL: " . $db->connect_error;

		}else{
			// Prepary our query for binding
			$stmt=$db->prepare($query);

			// Dynamically bind values (s-> string)
			$stmt->bind_param('s',$value);

			// Execute the query
			$stmt->execute();
		}
		// Check for successful insertion
		if ($stmt->affected_rows){
			return "true";
		}
		// Close connection db
		$db->close();		
		// Devuelve un false
		return "false";

	} // Cierre de update

	// Function to query UPDATE  image sql
	public function updateImg($query,$name, $image) {

		$db=$this->connect();
		// No connection db
		if(!$db){
		    
		    echo "Failed to connect to MySQL: " . $db->connect_error;

		}else{
			// Prepary our query for binding
			$stmt=$db->prepare($query);

			// Dynamically bind values (s-> string) para cada value
			$stmt->bind_param('ss',$name, $image);

			// Execute the query
			$stmt->execute();
		}
		// Check for successful insertion
		if ($stmt->affected_rows){
			return "true";
		}
		// Close connection db
		$db->close();		
		// Devuelve un false
		return "false";

	} // Cierre de update
	
} // Cierre de la clase Database

?>