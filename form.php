<?php

	/**
	* @author Ermakov Matthew <mazdaraser.91@gmail.com>
	* @brief Short link (handler)
	* @date 17-sep-2021
	*/

	include_once("functions.php");

	$data = getData($conn, $table);

	$link = '';

	if (!empty($_POST['link']))
	{
		$link = $_POST['link'];
	}else{
		$link = '';
	}

	if (count($data) != 0) {

		$flag = '';
		$key = '';

		foreach ($data as $key => $value) {
			if ($link != '' && $value->link == $link) {
				
				$flag = 'y';
				$key = $value->key;
				break;

				

			}else{

				$flag = 'n';
				$key = $value->key;

			}
		}

		if ($flag == 'y') {
			$mess = "Your link: "."<a href='$key' target='_blank'>"."http://localhost/".$key."</a>";
		}else{
			
			putData($conn, $link);
		}

		$data = getData($conn, $table);

		$flag = '';

		foreach ($data as $key => $v) {
			if($v->link == $link){

				$key = $v->key;
				$flag = 'y';
				break;

			}else{
				$key = $v->key;
				$flag = 'n';
			}
		}

		if ($flag == 'y') {

			$mess = "Your link: "."<a href='$key' target='_blank'>"."http://localhost/".$key."</a>";
			dataInFile($data);

		}else{

			$mess = "Your link: "."<a href='$key' target='_blank'>"."http://localhost/".$key."</a>";

		}
		
		echo $mess;

	}else{

		putData($conn, $link);

		$data = getData($conn, $table);

		printData($data);
		
		foreach ($data as $key => $value) {
			$mess = "Your link: "."<a href='$value->key' target='_blank'>"."http://localhost/".$value->key."</a>";
		}
		
		dataInFile($data);
		
		echo $mess;

	}
	

?>