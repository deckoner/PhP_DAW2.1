<?php
	$hostname = "localhost";
	$database = "ejercicio6";
	$username = "root";
	$password = "";

	foreach ($_POST as $key => $value){
        if (empty($value)) {
               $value="";
        }
	}

	$tipo = $_POST["tipo"];
	
	$conexion=mysqli_connect($hostname,$username,$password);
	
	if (!$conexion){
		die("No se puede conectar a mysql");
	}

	if (!mysqli_select_db($conexion,$database)){
		die(mysqli_error($conexion));
	}

	if ($tipo=="provincia"){
		$sql="select id_provincia as codigo, provincia as nombre from provincias";
	}else{
		$codigo_provincia = $_POST["codigo_provincia"];
		$sql="select id_municipio as codigo, nombre from municipios where id_provincia=".$codigo_provincia;
	}

	if (!$rs=mysqli_query($conexion,$sql)){
	 	die(mysqli_error($con));
	}

	header("Content-type: text/xml; charset=ISO-8859-1");
	if ($tipo=="provincia"){
		$texto="<provincias>\n";

		while ($registro=mysqli_fetch_assoc($rs)){
			$texto=$texto."\t<provincia>\n".
			"\t\t<codigo>".$registro['codigo']."</codigo>\n\t\t<nombre>".$registro['nombre']."</nombre>\n".
			"\t</provincia>\n";
		}

		$texto=$texto."</provincias>";
	}else{
		$texto="<municipios>\n";

		while ($registro=mysqli_fetch_assoc($rs)){
			$texto=$texto."\t<municipio>\n".
			"\t\t<codigo>".$registro['codigo']."</codigo>\n\t\t<nombre>".$registro['nombre']."</nombre>\n".
			"\t</municipio>\n";
		}

		$texto=$texto."</municipios>";
	}
	echo $texto;