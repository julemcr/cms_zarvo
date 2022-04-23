<?php
		require_once("Admin/includes/conexion.php");
		require_once("Admin/model/Cms.php");
		$cms = new Cms();
		$id = $_GET['id'];
		$services = $cms->get_services_x_id($id);
		foreach ($services as $servicio) {
			$serdesc = $servicio['Descripcion'];
			$serimg = $servicio['Imagen'];
			$sertitulo = $servicio['Titulo'];
			if(empty($servicio['Imagen'])){
				$serimg  = $servicio['Titulo'];
			}else{
				$serimg  = '<img src="public/images/'.$servicio['Imagen'].'" class="img-fluid" alt="'. $servicio['Titulo'].'">';
			}
			if(empty($servicio['Icono'])){
				$sericon  = '<i class="fa fa-cogs fa-2x"></i>';
			}else{
				$sericon  = '<i class="fa '.$servicio['Icono'].' fa-2x"></i>';
			}

		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the page title -->
	<title>Zarvo | Ready for action</title>
	<!-- inlcude google poppins font cdn link -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="public/css/bootstrap.css">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="public/css/style.css">
	<!-- include theme color setting stylesheet -->
	<link rel="stylesheet" href="public/css/colors.css">
	<!-- include the site responsive stylesheet -->
	<link rel="stylesheet" href="public/css/responsive.css">
</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- phStickyWrap -->
		<div class="phStickyWrap">
			<!-- pageHeader -->
			<header id="pageHeader" class="headerFixer">
				<div class="container">
					<div class="position-relative">
						<div class="row">
							<div class="col-6 col-md-3">
								<!-- logo -->
								<div class="logo">
									<a href=="index.html">
										<img src="public/images/logo.png" class="img-fluid" alt="scavvios">
									</a>
								</div>
							</div>
							<div class="col-6 col-md-9 position-static">
								<!-- pageNav -->
								<nav id="pageNav" class="navbar navbar-expand-md navbar-dark rounded-0 border-0 px-0 pt-0 pt-md-2 pb-0 justify-content-end position-static">
									<!-- pgNavOpener -->
									<button class="navbar-toggler pgNavOpener position-relative p-0 border-0 rounded-0 mt-2" type="button" data-toggle="collapse" data-target="#pageMainNavCollapse" aria-controls="pageMainNavCollapse" aria-expanded="false" aria-label="Toggle navigation">
										<!-- icnBar -->
										<span class="icnBar position-absolute"><span class="sr-only">menu</span></span>
									</button>
									<!-- pageMainNavCollapse -->
									<div class="collapse navbar-collapse justify-content-md-end pageMainNavCollapse" id="pageMainNavCollapse">
										<!-- pgMainNavigation -->
										<ul class="navbar-nav text-uppercase pgMainNavigation font-weight-normal">
											<li class="nav-item">
												<a class="nav-link smooth" href="#pageWrapper">Inicio</a>
											</li>
											<li class="nav-item">
												<a class="nav-link smooth" href="#about">Quienes Somos</a>
											</li>
											<li class="nav-item">
												<a class="nav-link smooth" href="#services">Servicios</a>
											</li>
											<li class="nav-item">
												<a class="nav-link smooth" href="#works">Trabajos</a>
											</li>
											<li class="nav-item">
												<a class="nav-link smooth" href="#journey">Experiencia</a>
											</li>
											<!-- <li class="nav-item">
												<a class="nav-link smooth" href="#blog">Blog</a>
											</li> -->
											<li class="nav-item">
												<a class="nav-link smooth" href="#contact">Contacto</a>
											</li>
										</ul>
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</header>
		</div>
		<main>
				<!-- servicesBlock -->
				<section class="servicesBlock bg-secondary pt-7 pt-md-13 pt-lg-19 pb-lg-13 pt-xl-24 pb-xl-19">
					<div id="services" class="mt-n43 pt-43">
						<div class="container">
							<header class="text-center mb-14 mb-lg-20">
								<h2 class="text-capitalize mb-4 mb-lg-7">
									<!-- headingTitle -->
									<strong class="fwMedium d-inline-block align-top text-white position-relative headingTitle text-capitalize mb-3 wow fadeInRight">Nuestro Servicios</strong>
									<div class="row justify-content-center wow fadeInUp" data-wow-delay="1s">
										<?php echo $serimg; ?>
									</div>
								</h2>
							</header>

							<div class="row justify-content-center">
								<div class="col-12 col-md-12 col-lg-12 col-xl-12 d-flex">
									<!-- msColumn -->
									<article class="msColumn position-relative bg-dark rounded-lg pt-14 pb-1 px-6 w-100 mb-13 text-white wow fadeInUp" data-wow-delay="1s">
										<!-- mscIcnWrap -->
										<span class="mscIcnWrap rounded-circle d-flex align-items-center text-center position-absolute wow bounceIn" data-wow-delay="1.3s">
												<span class="w-100">
													<?php echo $sericon; ?>
												</span>
										</span>
										<!-- hasLineBottom -->
										<h3 class="h5 hasLineBottom fwMedium text-capitalize text-white position-relative pb-4 mb-5"><?php echo $sertitulo; ?></h3>
										<p>	<?php echo $serdesc; ?></p>
									</article>
								</div>
							</div>
						</div>
					</div>
				</section>
		</main>
		<!-- ftAreaWrap -->
		<div class="ftAreaWrap position-relative">
			<!-- footerAside -->
			<aside class="footerAside pt-6 pb-6 pt-md-10 pb-md-8 pt-lg-16 pb-lg-13 pt-xl-24 pb-xl-18 wow fadeIn">
				<div id="contact" class="mt-n43 pt-43">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-5 col-xl-4">
								<!-- extraWrap -->
								<div class="extraWrap pr-lg-6 pr-xl-12 mb-5 mb-md-0">
									<!-- ftLogo -->
									<div class="ftLogo mb-7 mb-lg-12">
										<a href=="javascript:void(0);">
											<img src="public/images/logo.png" class="img-fluid" alt="scavvios">
										</a>
									</div>
									<!-- <strong class="h2 d-block mb-4">Ready <span class="text-white">for action</span></strong> -->
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel mattis tellus, non rutru m ante. Morbi sed ipsum cursus, blandit odio</p>
									<!-- textCopyright -->
									<div class="textCopyright pt-7 d-none d-md-block">
										<p><strong class="fwMedium">&copy; <a href=="javascript:void(0);">Zarvo</a> 2020 | Todos los Derechos Reservados</strong></p>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-6 col-lg-7 col-xl-8">
								<header class="mb-6 mb-lg-10">
									<h2 class="text-capitalize">
										<!-- headingTitle -->
										<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-3">Cualquier Consulta</strong>
										<span class="d-block">No dude en contactarnos</span>
									</h2>
								</header>
								<!-- messageForm -->
								<div class="messageForm">
									<form id="contactForm" data-toggle="validator">
										<div class="row">
											<div class="col-12 col-sm-6">
												<div class="form-group position-relative">
													<input id="name" type="text" class="form-control w-100 d-block" required data-error="NEW ERROR MESSAGE">
													<label class="labelAbsolute mb-0 font-weight-normal position-absolute">Nombre</label>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group position-relative">
													<input id="email" type="email" class="form-control w-100 d-block" required data-error="NEW ERROR MESSAGE">
													<label class="labelAbsolute mb-0 font-weight-normal position-absolute">Correo</label>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group position-relative">
													<input type="sub" type="text" class="form-control w-100 d-block" required data-error="NEW ERROR MESSAGE">
													<label class="labelAbsolute mb-0 font-weight-normal position-absolute">Asunto</label>
												</div>
											</div>
											<div class="col-12 col-sm-6">
												<div class="form-group position-relative">
													<input type="tel" type="tel" class="form-control w-100 d-block" required data-error="NEW ERROR MESSAGE">
													<label class="labelAbsolute mb-0 font-weight-normal position-absolute">Teléfono/Cel.</label>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group position-relative">
													<textarea id="message" class="form-control w-100 d-block textareaInput" required data-error="NEW ERROR MESSAGE"></textarea>
													<label class="labelAbsolute mb-0 font-weight-normal position-absolute">Mensaje</label>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div id="msgSubmit" class="form-message hidden"></div>
										</div>
										<button id="form-submit" type="submit" class="btn btnThemeOutline position-relative btnMinSmall mt-4 mt-lg-8" data-hover="Send Message"><span class="d-block btnText">Enviar</span></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</aside>
			<!-- pageFooter -->
			<footer id="pageFooter" class="bg-secondary pt-3 pb-1 position-relative text-center text-md-left wow fadeIn">
				<div class="container">
					<!-- ftNav -->
					<nav class="ftNav">
						<ul class="list-unstyled d-flex justify-content-center justify-content-md-start flex-wrap font-weight-normal text-uppercase mb-0">
							<li>
								<a href="#pageWrapper" class="smooth">Inicio</a>
							</li>
							<li>
								<a href="#about" class="smooth">Quienes Somos</a>
							</li>
							<li>
								<a href="#services" class="smooth">Servicios</a>
							</li>
							<li>
								<a href="#works" class="smooth">Trabajos</a>
							</li>
							<li>
								<a href="#journey" class="smooth">Experiencia</a>
							</li>
							<!-- <li>
								<a href="#blog" class="smooth">Blog</a>
							</li> -->
							<li>
								<a href="#contact" class="smooth">Contacto</a>
							</li>
						</ul>
					</nav>
					<!-- textCopyright -->
					<div class="textCopyright pt-4 d-md-none">
						<p><strong class="fwMedium">&copy; <a href=="javascript:void(0);">SmithJohnson</a> 2020 | All Rights Reserved</strong></p>
					</div>
				</div>
				<!-- btnTop -->
				<a href="#pageWrapper" class="btnTop smooth fas fa-arrow-up d-none d-md-flex align-items-center justify-content-center bg-warning text-white position-absolute"><span class="sr-only">back to top</span></a>
				<div id="loader" class="loader-holder">
					<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
				</div>
			</footer>
		</div>
	</div>
	<!-- include jQuery library -->
	<script src="public/js/jquery-3.4.1.min.js"></script>
	<!-- include bootstrap popper JavaScript -->
	<script src="public/js/popper.min.js"></script>
	<!-- include bootstrap JavaScript -->
	<script src="public/js/bootstrap.min.js"></script>
	<!-- include custom JavaScript -->
	<script src="public/js/jqueryCustom.js"></script>
	<!-- include fontAwesome -->
	<script src="https://kit.fontawesome.com/391f644c42.js"></script>
</body>
</html>