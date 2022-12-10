<?php
	
	require 'funcs/conexion.php';
	include 'funcs/funcs.php';
	
	session_start(); //Iniciar una nueva sesión o reanudar la existente
	
	// if(isset($_SESSION["id_usuario"])){ //En caso de existir la sesión redireccionamos
	// 	header("Location: welcome.php");
	// }

    if(isset($_SESSION['tipo_usuario']))
    {
        switch($_SESSION['tipo_usuario']){
        case 1:
            header('location: vistas/admin/index.php');
        break;
        case 2:
            header('location: vistas/supervisor/index.php');
        break;
        default:
            header('location: vistas/supervisor/index.php');
        break;
        }
    }
    
	
	$errors = array(); 
	

	if(!empty($_POST))
	{
		$usuario = $mysqli->real_escape_string($_POST['usuario']);
		$password = $mysqli->real_escape_string($_POST['password']);
		
		if(isNullLogin($usuario, $password))
		{
			$errors[] = "Debe llenar todos los campos";
		}
		
		$errors[] = login($usuario, $password);	
	}
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitromex</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
    
</head>
<body>
    <header class="hero">
        <nav class="nav container">
            <h2 class="nav__logo">Sistema para la administración de indicadores</h2>

            <ul class="nav__list">
                <li class="nav__item"><a href="#" class="hero__cta">Iniciar Sesión</a></li>
                <li class="nav__item"><a href="https://www.vitromex.com.mx/" target="_blank" class="hero__cta">Acerca de</a></li>
              
            </ul>

            <figure class="nav__menu">
                <img src="images/menu.svg" class="nav__icon">
            </figure>
        </nav>

        <section class="hero__main container">
            <div class="hero__texts">
                <h1 class="hero__title">¡Hola! Bienvenido(a)</h1>
                <p class="hero__subtitle">Inicia sesión para ingresar al sistema</p>
                
            </div>

            <figure class="hero__picture">
                <img src="assets/img/img3.jpg" class="hero__img">
            </figure>
        </section>

        <div style="height: 150px; overflow: hidden;" class="hero__waves" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.99 C262.08,217.40 378.89,-120.09 500.00,49.99 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
    </header>

    <section class="modal">
        <div class="modal__container">
            <h2 class="modal__title">Iniciar sesión</h2>
            <div class="modal-content">
                <form class="modal-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
                <div>
                    <label for="name">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario"  class="modalForm-input" required>
                </div>
                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" class="modalForm-input" required>
                </div>
                
                <input type="submit" value="Iniciar sesión" class="hero__cta"><br>
                <a href="recupera.php">¿Se te olvid&oacute; tu contraseña?</a>
                <?php echo resultBlock($errors); ?>
                </form>
            </div>
            <a href="#" class="modal__close">Cerrar Modal</a>
        </div>
    </section>


   
    <script src="assets/js/main.js"></script>
</body>
</html>