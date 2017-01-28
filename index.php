<?php

	$connection = mysqli_connect("localhost", "root", "", "countries");

	$q1 = mysqli_query($connection, "SELECT * FROM countries");
	$count = mysqli_num_rows($q1);
	


	$rowsperpage = 20;

	$page = $_REQUEST['p'];


	if( $page == 0 or $page == '' ){
		$page = 1;
	}


	$page = $page - 1;


	$p = $page * $rowsperpage;
	

	$query = "SELECT * FROM countries limit ".$p.", ".$rowsperpage;


	$run = mysqli_query($connection, $query);

	while( $rs = mysqli_fetch_array($run) ){

		echo $rs['id'].' -> '.$rs['country_name'].'<br />';

	}

	if( $_REQUEST['p'] > 1 ){
		$prev_page = $_REQUEST['p'] - 1;
		echo '<span style="cursor:pointer;" onclick="LoadData('.$prev_page.')">Back</span>';

	}

	$check = $p + $rowsperpage;

	if( $count > $check ){
		$next_page = $_REQUEST['p'] + 1;
		echo '<span style="cursor:pointer;" onclick="LoadData('.$next_page.')">Next</span>';
	}

	$limit = $count / $rowsperpage;

	$limit = ceil($limit);


	echo '<br /><br />';
	for( $i=1; $i<=$limit; $i++ ){

		if( $i==$_REQUEST['p'] ){
			echo '<strong>'.$i.'</strong> ';
		}else{
			echo '<span style="cursor:pointer;" onclick="LoadData('.$i.')">'.$i.'</span> ';
		}

		

	}


	

?>