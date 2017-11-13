<?php
class User

{
	public $db;

	function __construct()
	{
	$this->db = new PDO('mysql:host=localhost;dbname=yourdb', 'root', 'pass'); //connection
	array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

	public function add_user($username, $password, $email)
	{
		$password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]); //we hash the password using BCrypt
		$sql = $this->db->prepare("SELECT * FROM users WHERE username= :Username OR email = :Email");
		$sql->bindParam(':Username', $username);
		$sql->bindParam(':Email', $email);
		$sql->execute(); // check if the username/email exists
		if ($sql->rowCount() > 0) {
		die('Username/Email already exists bro');
		}
		else {
			$insert_user = "INSERT INTO `users` (`Username`, `Password`, `Email`) VALUES ";
			$insert_user.= "(:Username, :Password, :Email);";
			$insertStatement = $this->db->prepare($insert_user);
			$insertStatement->bindValue(":Username", $username);
			$insertStatement->bindValue(":Password", $password);
			$insertStatement->bindValue(":Email", $email);
			$insertStatement->execute();
			$insertStatement->closeCursor(); //after going through the server-validation checks, this query gets executed.
		}
	}
}

?>
