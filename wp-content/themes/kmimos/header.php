<?php include 'pre-header.php'; ?><!doctype html><html lang="es-ES" class="no-js"><head>

	<title> <?php bloginfo('title'); ?> </title>
	<meta charset="UTF-8"><?php 
	$HTML = '';	
	if (isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){
		header('X-UA-Compatible: IE=edge,chrome=1');
	}
	if ( is_page() ){
		global $post;
		$descripcion = get_post_meta($post->ID, 'kmimos_descripcion', true);
		if( $descripcion != ""){
			$HTML .= "<meta name='description' content='{$descripcion}'>";
		}
	}

	$HTML .= '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">';
	$HTML .= ' <script src="'.getTema().'/js/jquery.min.js"></script>';

	wp_enqueue_style( 'style', getTema()."/style.css", array(), "1.0.0" );
	

	wp_enqueue_style( 'fontawesome4', getTema()."/css/font-awesome.css", array(), '1.0.0');

	wp_enqueue_style( 'jquery.bxslider', getTema()."/css/jquery.bxslider.css", array(), "1.0.0" );
	wp_enqueue_style( 'bootstrap.min', getTema()."/css/bootstrap.min.css", array(), "1.0.0" );
	wp_enqueue_style( 'datepicker.min', getTema()."/css/datepicker.min.css", array(), "1.0.0" );
	wp_enqueue_style( 'kmimos_style', getTema()."/css/kmimos_style.css", array(), "1.0.0" );
	wp_enqueue_style( 'jquery.datepick', getTema()."/lib/datapicker/jquery.datepick.css", array(), "1.0.0" );

	wp_enqueue_style( 'generales_css', getTema()."/css/generales.css", array(), "1.0.0" );

	wp_enqueue_style( 'generales_responsive_css', getTema()."/css/responsive/generales_responsive.css", array(), "1.0.0" );


	wp_head();

	global $post;
	$reserrvacion_page = "";
	if( 
		$post->post_name == 'reservar' 			||
		$post->post_name == 'finalizar' 		
	){
		$reserrvacion_page = "page-reservation";
	}

	$HTML .= '
		<script type="text/javascript"> 
			var HOME = "'.getTema().'/"; 
			var RAIZ = "'.get_home_url().'/"; 
			var pines = [];
			var AVATAR = "";
		</script>
	</head>

	<body class="'.join( ' ', get_body_class( $class ) ).' '.$reserrvacion_page.'" onLoad="menu()">';

	include_once("funciones.php");

	$MENU = get_menu_header(true);

	if( !isset($MENU["head"]) ){
		$menus_normal = '
			<li><a class="modal_show" style="padding-right: 15px" data-modal="#popup-iniciar-sesion">INICIAR SESIÓN</a></li>
			<li><a class="modal_show" style="padding-left: 15px; border-left: 1px solid white;" data-target="#popup-registrarte">REGISTRARME</a></li>
		';
	}else{
		$menus_normal =  $MENU["body"].$MENU["footer"];
	}

	// Avatar default
	$avatar = getTema().'/images/new/km-navbar-mobile.svg';
	$avatar_circle = '';
	if( !is_user_logged_in() ){
		include_once('partes/modal_login.php');
	}else{
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
		$avatar = kmimos_get_foto($user_id);
		$salir = wp_logout_url( home_url() );
		$HTML .= '<script> var AVATAR = "'.$avatar.'"; </script>';
		$avatar_circle = 'img-circle';
	}

	if( !is_user_logged_in() ){
		$HTML .= '	
			<nav class="navbar navbar-fixed-top bg-transparent">
			<div class="container">
				<div class="navbar-header ">
					<button type="button" class="navbar-toggle sin_logear" id="ver_menu">
						<img src="'.$avatar.'" width="40px" height="40px" class="'.$avatar_circle.'">
					</button>
					<a class="navbar-brand" href="'.get_home_url().'">
						<img src="'.getTema().'/images/new/km-logos/km-logo.png" height="60px">
					</a>
				</div>
				<ul class="hidden-xs nav-login">
					<li><a id="login" href="#popup-iniciar-sesion" style="padding-right: 15px" role="button" data-toggle="modal">INICIAR SESIÓN</a></li>
					<li><a href="javascript:;" style="padding-left: 15px; border-left: 1px solid white;" role="button" data-target="#popup-registrarte">REGISTRARME</a></li>
				</ul>	
				<ul class="nav navbar-nav navbar-right">
					<li><a href="'.get_home_url().'/busqueda" class="hidden-xs km-nav-link">BUSCAR CUIDADOR</a></li>
					<li><a href="'.get_home_url().'/quiero-ser-cuidador-certificado-de-perros" class="hidden-xs km-btn-primary">QUIERO SER CUIDADOR</a></li>
		    	</ul>
				<div id="menu_movil" class="hidden-sm hidden-md hidden-lg">

					<div class="menu_movil_interno">
						<form class="barra_buscar_movil" method="POST" action="'.get_home_url().'/wp-content/themes/kmimos/procesos/busqueda/buscar.php">
							<i class="fa fa-search"></i>
							<input type="text" id="txt_buscar" placeholder="Buscar cuidador" name="nombre"  />
						</form>
						<ul class="nav navbar-nav">
							<li><a href="#popup-iniciar-sesion" class="km-nav-link" role="button" data-toggle="modal">Iniciar sesión</a></li>
							<li><a href="javascript:;" data-target="#popup-registrarte" class="km-nav-link" role="button" >Registrarme</a></li>
							<li><a href="'.get_home_url().'/quiero-ser-cuidador-certificado-de-perros" class="km-nav-link">Quiero ser cuidador</a></li>
				    	</ul>
				    </div>
			    </div>
			</div>
		</nav>
		';
	}else{
		$HTML .= '	
			<nav class="navbar navbar-fixed-top bg-transparent">
				<div class="container">
					<button type="button" class="navbar-toggle" id="ver_menu">
						<img src="'.$avatar.'" width="40px" height="40px" class="'.$avatar_circle.'">
					</button>
					<div class="navbar-header ">
						<a class="navbar-brand" href="'.get_home_url().'">
							<img src="'.getTema().'/images/new/km-logos/km-logo.png" height="60px">
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right hidden-xs">
						<li class="dropdown" data-obj="avatar">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<img src="'.$avatar.'" width="60px" height="60px" class="img-circle"> 
							</a>
							<ul class="dropdown-menu"  style="background: #fff;">
								'.$menus_normal.'
							</ul>
			        	</li>
			    	</ul>

					<div id="menu_movil" class="hidden-sm hidden-md hidden-lg">

						<div class="menu_movil_interno">
							<form class="barra_buscar_movil" method="POST" action="'.get_home_url().'/wp-content/themes/kmimos/procesos/busqueda/buscar.php">
								<i class="fa fa-search"></i>
								<input type="text" id="txt_buscar" placeholder="Buscar cuidador" name="nombre"  />
							</form>
							<ul class="nav navbar-nav">
								'.$menus_normal.'
					    	</ul>

					    </div>
	

			    </div>
			</nav>
		';
	}

	if( !is_user_logged_in() ){
		include_once('partes/modal_register.php');
	}
	
	echo comprimir_styles($HTML);



























/*
	global $wpdb;
	$sql = "SELECT * FROM cuidadores";
	$cuidadores = $wpdb->get_results($sql);

	foreach ($cuidadores as $cuidador) {
		$adicionales = unserialize($cuidador->adicionales);
		$new_adicionales = array();
		foreach ($adicionales as $key => $servicio) {
			if( is_array($servicio) ){
				$total = 0;
				foreach ($servicio as $key2 => $valor) {
					$total += $valor;
				}
				if( $total > 0 && $key != "" ){
					$new_adicionales[ $key ] = $servicio;
				}
			}else{
				if( $servicio > 0 ){
					$new_adicionales[ $key ] = $servicio;
				}
			}
		}
		$sql = "UPDATE cuidadores SET adicionales = '".serialize($new_adicionales)."' WHERE user_id = ".$cuidador->user_id.";";
		$wpdb->query($sql);
	}*/
