<header class="main-header">
 	
	 <!--=====================================
				 LOGOTIPO
	 ======================================-->
	 <a href="inicio" class="logo">
		 
		 <!-- logo mini -->
		 <span class="logo-mini">
			 
			 <img src="vistas/img/plantilla/image_002.png" class="img-responsive" style="padding:10px">
			 <!-- <img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px"> -->
 
		 </span>
 
		 <!-- logo normal se muestra cuando se despliega el toggle el class= logo-lg-->
 
		 <span class="logo-lg">
			 
			 <img src="vistas/img/plantilla/garden-letra.jpg" class="img-responsive" style="padding:10px 0px">
			 <!-- <img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px"> -->
 
		 </span>
 
	 </a>
	 <!--====  End of LOGOTIPO ====-->
 
	 <!--=====================================
	 BARRA DE NAVEGACIÓN
	 ======================================-->
	 <nav class="navbar navbar-static-top" role="navigation">
		 
		 <!-- Botón de navegación -->
 
		  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			 
			 <span class="sr-only">Toggle navigation</span>
		   
		   </a>
 
		 <!-- perfil de usuario que se coloca en la izquina sup izq -->
 
		 <div class="navbar-custom-menu">
				 
			 <ul class="nav navbar-nav">
				 
				 <li class="dropdown user user-menu">
					 
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
 
						 <img src="vistas/img/usuarios/default/anonymous.png" class="user-image">
  
						 <span class="hidden-xs" style="text-transform:uppercase"><?php echo $_SESSION['usuario'];?></span>
 
					 </a>
 
 
					 <ul class="dropdown-menu">
						 
						 <!-- cuerpo del menu -->
						 <li class="user-body">
							 
							 <!-- con esta clase tiramos hacia el lado derecho -->
							 <div class="pull-right">
								 
								 <a href="salir" class="btn btn-default btn-flat">Salir</a>
 
							 </div>
 
						 </li>
 
					 </ul>
 
				 </li>
 
			 </ul>
 
		 </div>
		 <!-- fin perfil de usuario -->
 
	 </nav>
	 <!--====  End of NAVEGACION ====-->
 
  </header>