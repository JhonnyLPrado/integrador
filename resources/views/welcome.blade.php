<!DOCTYPE html>
<html class="no-js"> 
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SISTEMA EXPERTO DE REGISTRO PARA EL SEGUIMIENTO Y PREVENCIÓN DE LA DELINCUENCIA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

	<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
	<!-- Simple Line Icons -->
	<link rel="stylesheet" href="{{ asset('css/simple-line-icons.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
	<!-- Style -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	<header role="banner" id="fh5co-header">
		<div class="fluid-container">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<!-- Mobile Toggle Menu Button -->
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
					<a class="navbar-brand" href="index.html"><span>P</span>olicia Nacional</a> 
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="#" data-nav-section="home"><span>Juego</span></a></li>
						<li><a href="#" data-nav-section="explore"><span>Explorar</span></a></li>
						<li><a href="#" data-nav-section="testimony"><span>Misión y visión </span></a></li>
						<li><a href="#" data-nav-section="services"><span>Servicios</span></a></li>
						<li class="call-to-action">
	<a href="{{ route('login') }}"><span>Ingresar</span></a>
</li>
						
					</ul>
				</div>
			</nav>
	</header>

	<section id="fh5co-home" data-section="home" style="background-image: url({{ asset('images/fondo_01.jpg') }});" data-stellar-background-ratio="0.5">
		<div class="gradient"></div>
		<div class="container">
			<div class="text-wrap">
				<div class="text-inner">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h1 class="to-animate">"La seguridad comienza contigo."</h1>
							<h2 class="to-animate">Realiza una revisión de los distintos puntos de peligro en la ciudad de La Paz, enfocándote en las áreas con altos niveles de robos y problemas de inseguridad ciudadana. <a href=target="_blank"></a> <br> <a href="http://freehtml5.co/" target="_blank" title="Free HTML5 Bootstrap Templates" class="fh5co-link"></a></h2>
							<div class="call-to-action">
								<a href="{{ route('login') }}" class="demo to-animate">Descargar</a>
								<a href="{{ route('login') }}" class="download to-animate">Plataformas</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="fh5co-explore" data-section="explore">
		<div class="container">
			<div class="row">
				<div class="col-md-12 section-heading text-center">
				<h2 class="to-animate">QUIENES SOMOS </h2>
					<div class="row">
						<div class="col-md-8 col-md-offset-2 subtext to-animate">
							<h3>La Dirección Nacional de Tecnología y Telemática es responsable de direccionar, asesorar y promover la implementación, administración y soporte de los sistemas de telecomunicaciones e informática de la Policía Boliviana.</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="fh5co-explore">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-push-5 to-animate-2">
						<img class="img-responsive" src="{{ asset('images/OIP.jpg') }}" alt="work">
					</div>
					<div class="col-md-4 col-md-pull-8 to-animate-2">
						<div class="mt">
							<h3>OBJETIVOS</h3>
							<p>Nuestro objetivo es establecer políticas y procesos que conduzcan al mejoramiento en la utilización de las herramientas tecnológicas en la prestación de los servicios policiales. Nuestra Policía Boliviana ha evolucionado a lo largo de los años, mejorando sus sistemas informáticos y de comunicaciones para brindar un servicio más eficaz a la sociedad.</p>
						</div>
					</div>
					
				</div>
			</div>
		</div>

		<div class="fh5co-explore fh5co-explore-bg-color">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-pull-1 to-animate-3">
						<img class="img-responsive" src="{{ asset('images/punto.jpg') }}" alt="work">
					</div>
					<div class="col-md-4 to-animate-3">
						<div class="mt">
							<div>
								<h4><i class="icon-people"></i>MAPEO DE LA CIUDAD </h4>
								<p> La plataforma apoya en el conocimiento de las zonas de alto peligro ante delitos u/o asaltos </p>
							</div>
							<div>
								<h4><i class="icon-video2"></i>SISTEMA ACTIVO 24 HORAS</h4>
								<p>El sistema esta al alcance de ti, mejorando su registro de los incidentes registrados por la policia Nacional </p>
							</div>
							<div>
								<h4><i class="icon-shield"></i> PREVENCION A TU ALCANCE </h4>
								<p> puede llegar a reportar incidentes o delitos que vea para apoyar a ala comudidad  </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	

	<section id="fh5co-trusted" data-section="trusted">
		<div class="fh5co-trusted">
			<div class="container">
				<div class="row">
					<div class="col-md-12 section-heading text-center">
						<h2 class="to-animate">CONOCE MAS DE NOSOTROS</h2>
						<div class="row">
							<div class="col-md-8 col-md-offset-2 subtext">
								<h3 class="to-animate">La policia nacional llega a tener dintintas ramas de la seguridad para apoyarte </h3>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					 <div class="col-md-2 col-sm-3 col-xs-6 col-sm-offset-0 col-md-offset-1">
					 	<div class="partner-logo to-animate-2">
					 		<img src="{{ asset('images/logo 1.png') }}" alt="Partners" class="img-responsive">
					 	</div>
					 </div>
				    <div class="col-md-2 col-sm-3 col-xs-6">
				    	<div class="partner-logo to-animate-2">
				    		<img src="{{ asset('images/logo 2.png') }}" alt="Partners" class="img-responsive">
						</div>
				    </div>
				    <div class="col-md-2 col-sm-3 col-xs-6">
				    	<div class="partner-logo to-animate-2">
				    		<img src="{{ asset('images/logo 3.png') }}" alt="Partners" class="img-responsive">
				    	</div>
				    </div>
				    <div class="col-md-2 col-sm-3 col-xs-6">
				    	<div class="partner-logo to-animate-2">
				    		<img src="{{ asset('images/logo 4.png') }}" alt="Partners" class="img-responsive">
				    	</div>
				    </div>
				    <div class="col-md-2 col-sm-12 col-xs-12">
				    	<div class="partner-logo to-animate-2">
				    		<img src="{{ asset('images/logo 5.png') }}" alt="Partners" class="img-responsive">
				    	</div>
				    </div>
				</div>
			</div>
		</div>
	</section>

	<!-- jQuery -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
	<!-- Bootstrap -->
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<!-- Waypoints -->
	<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
	<!-- Stellar Parallax -->
	<script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
	<!-- Owl Carousel -->
	<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>

</html>

