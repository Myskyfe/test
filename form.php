<?php

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

		foreach ($data as $key => $value) {
			if ($link != '' && $value->link == $link) {
				
				putData($conn, $link);

			}else{

				$mess = "Your link: "."<a href='$value->key' target='_blank'>"."http://localhost/".$value->key."</a>";

			}
		}

		$data = getData($conn, $table);

		foreach ($data as $key => $v) {
			if($v->link == $link){
				$mess = "Your link: "."<a href='$v->key' target='_blank'>"."http://localhost/".$v->key."</a>";
				dataInFile($data);
			}else{
				$mess = "Your link: "."<a href='$v->key' target='_blank'>"."http://localhost/".$v->key."</a>";
			}
		}
		
		echo $mess;

	}else{

		putData($conn, $link);

		$data = getData($conn, $table);

		printData($data);
		
		$mess = "Your link: "."<a href='$data[0]->key' target='_blank'>"."http://localhost/".$data[0]->key."</a>";
		dataInFile($data);
		
		echo $mess;

	}
	

?>