<?php

	/**
	 * LINK REDIRECTION
	*/
	class LinkRedir 
	{
		public $link;
		public $key;

		function __construct($link, $key)
		{
			$this->link = $link;
			$this->key = $key;
		}
	}

	$globalLink = 'http://localhost/';

	$server = 'localhost';
	$un = 'root';
	$pass = '';
	$db = 'shortlink';
	$table = 'links keys';

	$mess = ' ';

	$conn = mysqli_connect($server, $un, $pass, $db);

	if($conn)
		;
	else
		$mess = "Connection error";

	//peforms all data of array
	function printData($arr){

		echo "<pre>";
		var_dump($arr);
		echo "</pre>";

	}

	//gets all data from $table in $db
	function getData($conn, $table){

		$query = "SELECT * FROM `$table` WHERE 1";

		$query = mysqli_query($conn, $query);

		$arr = [];

		$i = 0;

		while ($assc = mysqli_fetch_assoc($query)){
			$arr[$i] = $assc;
			++$i; 
		}

		$arr1 = [];

		foreach ($arr as $key => $elem) {
			$arr1[$key] = new LinkRedir($arr[$key]['link'], $arr[$key]['link_key']);
		}

		return $arr1;

	}

	//put data in database
	function putData($conn, $link){

		$alpha = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvXxYyZz1234567890";

		$key = $alpha[rand(0, 59)].$alpha[rand(0, 59)].$alpha[rand(0, 59)].$alpha[rand(0, 59)].$alpha[rand(0, 59)].$alpha[rand(0, 59)].$alpha[rand(0, 59)];

		$query = "INSERT INTO `links keys`(`link`, `link_key`) VALUES ('$link','$key')";

		$query = mysqli_query($conn, $query);

	}

	//puts data in file
	function dataInFile($arrObj){

		foreach ($arrObj as $key => $arr) {
			
			if(is_dir($arr->key))
				;
			else
				mkdir($arr->key);

			$path = $arr->key."/index.php";

			$file = fopen($path, "w+");

			$data = "<?php

				header('Location: $arr->link');

			";

			file_put_contents($path, $data);

		}

	}




