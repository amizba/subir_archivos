<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Catálogo de manuales online</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>

<body>

<div class="alert alert-primary" role="alert">
  Subir archivos al servidor
</div>
	<?php

$name=$_POST['nombre'];
	$surname=$_POST['apellidos'];
	$mail=$_POST['email'];
	$phone=$_POST['movil'];
	$nombre=$_FILES['userfile']['name'];
$guardado=$_FILES['userfile']['tmp_name'];

if(!file_exists('archivos')){ //nos crea el directorio archivos si no existe
	mkdir('archivos',0777,true);
	if(file_exists('archivos')){ //si existe lo guarda en la carpeta archivos
		if(move_uploaded_file($guardado, 'archivos/'.$nombre)){ //sube el archivo
			echo "Archivo guardado con exito </br>";
		}else{
			echo "Archivo no se pudo guardar </br>";
		}
	}
}else{
	if(move_uploaded_file($guardado, 'archivos/'.$nombre)){
		echo "Archivo guardado con exito </br>";
	}else{
		echo "Archivo no se pudo guardar </br>";
	}
}

if(!$name || !$surname || !$mail || !$phone)
	{

		echo "Nos has introducido todos los detalles necesarios del manual. Intentalo de nuevo, por favor";

		exit;
	}

	$name=addslashes($name);
	$surname=addslashes($surname);
	$mail=addslashes($mail);
	$phone=addslashes($phone);

	$obj_conexion=mysqli_connect('localhost', 'root', 'root', 'datos');
    if(!$obj_conexion)
    {
        echo "<h4>No podemos conectar con la base de datos en estos momentos. Disculpe las molestia</h4><br>";

        exit;
    }

	$sql="insert into users values ('".$name."', '".$surname."', '".$mail."', '".$phone."')"; 
	$consulta=mysqli_query($obj_conexion, $sql);

	if ($consulta) {
      echo "Se han introducido correctamente los datos del formulario</br>";
      echo "Nombre: ".$name."</br>";
      echo "Apellidos: ".$surname."</br>";
      echo "Email: ".$mail."</br>";
      echo "Movil: ".$phone."</br>";
} else {
      echo "No se ha podido introducir los datos del formulario, por favor, intentalo de nuevo. Gracias";
}
mysqli_close($obj_conexion);


	?>

	</div>
	
</body>
</html>