<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class dbConn
{
	private static $conn;

	public static function connect()
	{
		self::$conn = mysqli_connect("localhost", "root", "1234", "testusers");

		if (mysqli_connect_errno()) {
			die("No connection established: " . mysqli_connect_errno());
		} else {
			echo "Connection established<br>";
		}
	}

	public static function search(int $searchTerm)
	{
		$sql = "Select * from users where userid = $searchTerm;";
		$result = mysqli_query(self::$conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "ID: " . $row["userid"];
				echo " E-Mail: " . $row["usermail"] . "<br>";
			}
		} else {
			echo "no result<br>";
		}
	}

	public static function insert(string $mail, $pw)
	{
		$sql = "Insert into users (usermail, userpw) values ('$mail', '$pw');";
		$insert = mysqli_query(self::$conn, $sql);
	}

	public static function disconnect()
	{
		mysqli_close(self::$conn);
	}
}

//Connect first
dbConn::connect();

//Search for id
dbConn::search(1,2);

//Insert a user
//dbConn::insert("p@w.de", "test");

//Disconnect in the end
dbConn::disconnect();
