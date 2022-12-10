<?php
	
	require 'funcs/conexion.php';
	require 'funcs/funcs.php';
	
	$user_id = $mysqli->real_escape_string($_POST['user_id']);
	$token = $mysqli->real_escape_string($_POST['token']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$con_password = $mysqli->real_escape_string($_POST['con_password']);
	
	if(validaPassword($password, $con_password))
	{
		
		$pass_hash = hashPassword($password);
		
		if(cambiaPassword($pass_hash, $user_id, $token))
		{
			$res="Contrase&ntilde;a actualizada, inicie sesión para continuar";
			} else {
			
				$res="Error al modificar contrase&ntilde;a";
			
		}
		
		} else {
		
			$res='Las contraseñas no coinciden';
		
	}
?>	

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitromex</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/estiloss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
	
	<body>
	<header class="hero">
    <nav class="nav container">
      <h3 class="nav__logo">Sistema para la administración de indicadores</h3>
      <ul class="nav__list">
            
              <li class="nav-item">
                <a  href="index.php" class="hero__cta">Inicio</a>
              </li>
              
              
            </ul>
      </nav>  
  </header>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title"><?php echo $res;?></div>
					</div>     
					
					                    
				</div>  
			</div>
		</div>
	</body>
</html>							