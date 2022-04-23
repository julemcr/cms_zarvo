<?php
		require_once("Admin/includes/conexion.php");
		require_once("Admin/model/Cms.php");
		$cms = new Cms();

		$profiles = $cms->get_profile();
		foreach ($profiles as $profile) {
			$qs = $profile['title'];
			$qsdesc = $profile['biography'];
			$qsimg = $profile['imagen'];
			$qsfb = $profile['facebook'];
			$qslkd = $profile['linkedin'];
			$qsyt = $profile['youtube'];
			$qsinst = $profile['instagram'];
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
	<style>
	</style>
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
									<a href="index.html">
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
												<a class="nav-link smooth" href="#works">Trabajos</a>
											</li>
											<li class="nav-item">
												<a class="nav-link smooth" href="#services">Servicios</a>
											</li>
											<!-- <li class="nav-item">
												<a class="nav-link smooth" href="#journey">Experiencia</a>
											</li> -->
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
			<!-- introBlock -->
			<article class="introBlock w-100 d-flex flex-column" id="banners">
					<!-- vAlign -->
					<div class="vAlign d-flex w-100 align-items-sm-center" style="background-image: url('public/images/slider-1.jpg');
						background-size: cover;
						background-size: 100% 100%;
						background-color: transparent;">
						<!-- xAlign -->
						<div class="xAlign w-100 pt-15 pt-md-20 pb-md-10 pt-xl-60 pb-xl-60" style="z-index: 9999;">
							<div class="container">
								<div class="row">
									<div class="col-12 col-md-8">
										<!-- ibCaptionHolder -->
										<div class="position-relative ibCaptionHolder">
											<h1 class="text-capitalize mb-3 mb-md-5">
												<!-- headingTitle -->
												<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-3 mb-md-5 wow fadeInLeft" data-wow-delay="2s">UI/UX Designer</strong>
												<span class="d-block wow fadeInLeft" data-wow-delay="2.5s">Lorem <span class="text-white">Impsu</span></span>
											</h1>
											<p class="wow fadeInLeft" data-wow-delay="2.8s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel mattis tellus, non rutru m ante. Morbi sed ipsum cursus, blandit odio</p>
											<!-- ibBtnsWrap -->
											<div class="ibBtnsWrap d-flex flex-wrap mx-n1 mx-lg-n3 pt-4 pt-lg-9">

											</div>
										</div>
									</div>
									<div class="col-12 col-md-4 position-static">
										<!-- ibSocialNetworks -->
										<ul class="list-unstyled socialNetworks ibSocialNetworks mb-0 d-none d-md-block wow fadeIn" data-wow-delay="4s">
											<li>
												<a href="<?php echo $qsfb; ?>" target="_blank">
													<i class="fab fa-facebook-f"><span class="sr-only">Facebook</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qsinst; ?>" target="_blank">
													<i class="fab fa-instagram"><span class="sr-only">Instagram</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qslkd; ?>" target="_blank">
													<i class="fab fa-linkedin-in"><span class="sr-only">Linkedin</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qsyt; ?>" target="_blank">
													<i class="fab fa-youtube"><span class="sr-only">Youtube</span></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="vAlign d-flex w-100 align-items-sm-center" style="background-image: url('public/images/slider-2.jpg');
						background-size: cover;
						background-color: transparent;">
						<!-- xAlign -->
						<div class="xAlign w-100 pt-15 pt-md-20 pb-md-10 pt-xl-60 pb-xl-60">
							<div class="container">
								<div class="row">
									<div class="col-12 col-md-8">
										<!-- ibCaptionHolder -->
										<div class="position-relative ibCaptionHolder">
											<h1 class="text-capitalize mb-3 mb-md-5">
												<!-- headingTitle -->
												<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-3 mb-md-5 wow fadeInLeft" data-wow-delay="2s">UI/UX Designer</strong>
												<span class="d-block wow fadeInLeft" data-wow-delay="2.5s">Smith <span class="text-white">Johnson</span></span>
											</h1>
											<p class="wow fadeInLeft" data-wow-delay="2.8s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vel mattis tellus, non rutru m ante. Morbi sed ipsum cursus, blandit odio</p>
											<!-- ibBtnsWrap -->
											<div class="ibBtnsWrap d-flex flex-wrap mx-n1 mx-lg-n3 pt-4 pt-lg-9">

											</div>
										</div>
									</div>
									<div class="col-12 col-md-4 position-static">
										<!-- ibSocialNetworks -->
										<ul class="list-unstyled socialNetworks ibSocialNetworks mb-0 d-none d-md-block wow fadeIn" data-wow-delay="4s">
											<li>
												<a href="<?php echo $qsfb; ?>" target="_blank">
													<i class="fab fa-facebook-f"><span class="sr-only">Facebook</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qsinst; ?>" target="_blank">
													<i class="fab fa-instagram"><span class="sr-only">Instagram</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qslkd; ?>" target="_blank">
													<i class="fab fa-linkedin-in"><span class="sr-only">Linkedin</span></i>
												</a>
											</li>
											<li>
												<a href="<?php echo $qsyt; ?>" target="_blank">
													<i class="fab fa-youtube"><span class="sr-only">Youtube</span></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
			</article>
			<!-- ibUpperWrap -->
			<div class="ibUpperWrap">
				<!-- aboutBlock -->
				<article class="aboutBlock bg-secondary pt-7 pb-7 pt-md-13 pb-md-13 pt-lg-18 pb-lg-18 pt-xl-23 pb-xl-24">
					<div id="about" class="mt-n43 pt-43">
						<div class="container">
							<div class="row">
								<div class="col-12 col-md-8 order-md-2">
									<header class="mb-lg-5">
										<h2 class="text-capitalize mb-4 mb-lg-7">
											<!-- headingTitle -->
											<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-3 wow fadeInRight"><?php echo $qs; ?></strong>
											<!-- <span class="d-block wow fadeInRight" data-wow-delay="0.7s">Unleash Your Creativity</span> -->
										</h2>
									</header>
									<p class="wow fadeInRight" data-wow-delay="0.7s"><?php echo $qsdesc; ?></p>
									<div class="row">
											<div class="col-md-6 wow">
												<header class="mb-lg-5">
													<h2 class="text-capitalize mb-4 mb-lg-7">
														<span class="d-block wow fadeInRight" data-wow-delay="0.7s">Misión</span>
													</h2>
												</header>
												<p class="wow fadeInRight" data-wow-delay="0.7s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, temporibus voluptatum ratione dolorum, nam quo illo at vel vitae iste, rerum dolorem nostrum asperiores doloribus. Eligendi sed nihil aperiam minima.</p>
											</div>
											<div class="col-md-6 wow">
												<header class="mb-lg-5">
													<h2 class="text-capitalize mb-4 mb-lg-7">
														<span class="d-block wow fadeInRight" data-wow-delay="0.7s">Visión</span>
													</h2>
												</header>
												<p class="wow fadeInRight" data-wow-delay="0.7s">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt aspernatur quae explicabo! Eveniet nisi sapiente molestias! Sit qui eius, provident mollitia rem quaerat quasi. Veritatis dolores quod autem sit doloribus?</p>
											</div>
									</div>
									<!-- <h3 class="text-white fwMedium wow fadeInRight" data-wow-delay="0.9s">A Lead UX & UI Designer based in Canada, with 8+ Years of Experience</h3> -->
									<!-- btn -->
									<!-- <a href=="javascript:void(0);" class="btn btnThemeOutline position-relative btnMinSmall mt-3 mt-lg-5 wow bounceIn" data-hover="Download CV" data-wow-delay="2.3s"><span class="d-block btnText">Download CV</span></a> -->
								</div>
								<div class="col-12 col-md-4 order-md-1">
									<!-- abFeaturesWrap -->
									<div class="abFeaturesWrap mx-auto mx-md-0 position-relative">
										<img src="Admin/phpimages/<?php echo $qsimg; ?>" alt="Quienes Somos?" class="img-fluid rounded">
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<!-- portfolioBlock -->
				<section class="portfolioBlock bg-dark pt-7 pb-3 pt-md-12 pb-md-7 pt-lg-17 pb-lg-12 pt-xl-23 pb-xl-18">
					<div id="works" class="mt-n43 pt-43">
						<div class="container">
							<!-- filterHead -->
							<header class="filterHead mb-10">
								<div class="row align-items-md-end">
									<div class="col-12 col-lg-5">
										<h2 class="text-capitalize">
											<!-- headingTitle -->
											<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-3 wow fadeInRight">Portfolio</strong>
											<span class="d-block wow fadeInUp" data-wow-delay="0.5s">Nuestros Trabajos</span>
										</h2>
									</div>
									<div class="col-12 col-lg-7">
										<!-- filtersList -->
										<ul class="list-unstyled filtersList isoFiltersList d-flex flex-wrap justify-content-lg-end text-uppercase fwMedium text-white wow bounceInUp" data-wow-delay="1s">
											<li>
												<a href="javascript:void(0);">TODO</a>
											</li>
											<?php

												$categorias = $cms->get_categorias();
												$datos = $categorias->fetch_all(MYSQLI_ASSOC);
												for ($i=0; $i < count($datos); $i++) {
													echo '<li>
																	<a href="javascript:void(0);" data-filter=".ctg'.$datos[$i]['PortafolioCategoriaID'].'">'.$datos[$i]['Categoria'].'</a>
																</li>';
												}
											?>
										</ul>
									</div>
								</div>
							</header>
						</div>
						<div class="container-fluid">
							<div class="wow fadeInUp">
								<!-- isoContentHolder -->
								<div class="row isoContentHolder">
									<?php
										$portafolio = $cms->get_portafolio();
										$datos = $portafolio->fetch_all(MYSQLI_ASSOC);
										for ($i=0; $i < count($datos); $i++) {
											echo '<div class="col-12 col-sm-6 col-lg-4 ctg'.$datos[$i]['PortafolioCategoriaID'].' isoCol">
														<!-- mcwColumn -->
														<article class="position-relative mcwColumn text-center mb-6">
															<div class="imgHolder">
																<img src="public/images/'.$datos[$i]['Imagen'].'" class="img-fluid" alt="'.$datos[$i]['Descripcion'].'">
															</div>
															<!-- mcwcCaption -->
															<div class="mcwcCaption text-white position-absolute d-flex align-items-center">
																<div class="mcwccWrap w-100 p-3">
																	<h4 class="text-white text-capitalize fwMedium subTitle">'.$datos[$i]['Descripcion'].'</h4>
																</div>
															</div>
														</article>
													</div>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- servicesBlock -->
				<section class="servicesBlock bg-secondary pt-7 pt-md-13 pt-lg-19 pb-lg-13 pt-xl-24 pb-xl-19">
					<div id="services" class="mt-n43 pt-43">
						<div class="container">
							<header class="text-center mb-14 mb-lg-20">
								<h2 class="text-capitalize mb-4 mb-lg-7">
									<!-- headingTitle -->
									<strong class="fwMedium d-inline-block align-top text-white position-relative headingTitle text-capitalize mb-3 wow fadeInRight">Nuestro Servicios</strong>
									<span class="d-block wow fadeInUp" data-wow-delay="0.5s">Ofrecemos una amplia gama de servicios y soluciones.</span>
								</h2>
							</header>
							<div class="row justify-content-center">
								<?php
									$services = $cms->get_services();
									$datos = $services->fetch_all(MYSQLI_ASSOC);
									for ($i=0; $i < count($datos); $i++) {
										if(empty($datos[$i]['Icono'])){
											$sericon  = '<i class="fa fa-cogs fa-2x"></i>';
										}else{
											$sericon  = '<i class="fa '.$datos[$i]['Icono'].' fa-2x"></i>';
										}
										echo '
													<div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex" role="button" onClick="abrirServicio('.$datos[$i]['PageServiceID'].')">
														<!-- msColumn -->
														<article class="msColumn position-relative bg-dark rounded-lg pt-14 pb-1 px-6 w-100 mb-13 text-white wow fadeInUp" data-wow-delay="1s">
															<!-- mscIcnWrap -->
															<span class="mscIcnWrap rounded-circle d-flex align-items-center text-center position-absolute wow bounceIn" data-wow-delay="1.3s">
																<span class="w-100">
																	'.$sericon.'
																</span>
															</span>
															<!-- hasLineBottom -->
															<h3 class="h5 hasLineBottom fwMedium text-capitalize text-white position-relative pb-4 mb-5">'. $datos[$i]['Titulo'].'</h3>
															<p style="width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; height: 36px; ">'. $datos[$i]['Descripcion'].'</p>
														</article>
													</div>';
									}
								?>
							</div>
						</div>
					</div>
				</section>
				<!-- expertiseBlock -->
				<article id="ctcont" class="expertiseBlock bg-dark pt-7 pb-7 pt-md-10 pb-md-10 pt-lg-12 pb-lg-17 pt-xl-16 pb-xl-25">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-5">
								<header class="mb-5">
									<h2 class="text-capitalize mb-6">
										<!-- headingTitle -->
										<strong class="fwMedium d-block text-white position-relative headingTitle text-capitalize mb-4 wow fadeInLeft">Expertise</strong>
										<span class="d-block wow fadeInLeft" data-wow-delay="0.5s">My Skills &amp; Tools</span>
									</h2>
									<h3 class="text-white fwMedium wow fadeInLeft" data-wow-delay="0.9s">Every Day is a New Challenge</h3>
								</header>
								<p class="wow fadeInLeft" data-wow-delay="1.3s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's  unknown printer took a galley</p>
								<!-- btn -->
								<a href=="javascript:void(0);" class="btn btnThemeOutline position-relative btnMinSmall mt-5 wow bounceIn" data-wow-delay="1.7s" data-hover="Hire Me"><span class="d-block btnText">Hire Me</span></a>
							</div>
							<div class="col-12 col-md-7">
								<!-- extraWrap -->
								<div class="extraWrap mt-7 mt-md-0 pt-md-5 pl-md-14">
									<!-- prgCapWrap -->
									<div class="prgCapWrap d-flex align-items-center position-relative mb-5 wow">
										<!-- prgTitle -->
										<strong class="d-block flex-shrink-0 text-uppercase fwMedium prgTitle text-white">Adobe Photoshop</strong>
										<!-- progress -->
										<div class="progress w-100 position-relative">
											<div class="progress-bar bg-info" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<!-- prgShowSpan -->
										<strong class="prgShowSpan rounded fwMedium bg-info text-white text-center d-block flex-shrink-0 position-relative ml-6 dataCountBar">85</strong>
									</div>
									<!-- prgCapWrap -->
									<div class="prgCapWrap d-flex align-items-center position-relative mb-5 wow">
										<!-- prgTitle -->
										<strong class="d-block flex-shrink-0 text-uppercase fwMedium prgTitle text-white">Adobe Illustrator</strong>
										<!-- progress -->
										<div class="progress w-100 position-relative">
											<div class="progress-bar bg-orange" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<!-- prgShowSpan -->
										<strong class="prgShowSpan rounded fwMedium bg-orange text-white text-center d-block flex-shrink-0 position-relative ml-6 dataCountBar">92</strong>
									</div>
									<!-- prgCapWrap -->
									<div class="prgCapWrap d-flex align-items-center position-relative mb-5 wow">
										<!-- prgTitle -->
										<strong class="d-block flex-shrink-0 text-uppercase fwMedium prgTitle text-white">Adobe XD</strong>
										<!-- progress -->
										<div class="progress w-100 position-relative">
											<div class="progress-bar bg-pink" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<!-- prgShowSpan -->
										<strong class="prgShowSpan rounded fwMedium bg-pink text-white text-center d-block flex-shrink-0 position-relative ml-6 dataCountBar">70</strong>
									</div>
									<!-- pieList -->
									<ul class="list-unstyled pieList d-flex justify-content-between flex-wrap mb-n6 mt-7 mt-md-11">
										<li class="wow" data-wow-delay="0.5s">
											<!-- pieColumn -->
											<div class="pieColumn position-relative text-white text-center">
												<strong class="fwMedium position-absolute titleIn d-flex align-items-center justify-content-center dataCount" data-count-start="0" data-count-end="87">87</strong>
												<svg width="100" height="100" class="align-top mb-4">
													<circle class="cr1" r="47.5" cx="50" cy="50" fill="none" stroke="#19232b" stroke-width="5" />
													<circle class="cr2" r="47.5" cx="50" cy="50" fill="none" stroke="#d593ff" stroke-width="5" stroke-dasharray="170 53" />
												</svg>
												<strong class="fwMedium titleOut d-block text-uppercase">After Effects</strong>
											</div>
										</li>
										<li class="wow" data-wow-delay="1s">
											<!-- pieColumn -->
											<div class="pieColumn position-relative text-white text-center">
												<strong class="fwMedium position-absolute titleIn d-flex align-items-center justify-content-center dataCount" data-count-start="0" data-count-end="75">75</strong>
												<svg width="100" height="100" class="align-top mb-4">
													<circle class="cr1" r="47.5" cx="50" cy="50" fill="none" stroke="#19232b" stroke-width="5" />
													<circle class="cr2" r="47.5" cx="50" cy="50" fill="none" stroke="#35fc00" stroke-width="5" stroke-dasharray="150 73" />
												</svg>
												<strong class="fwMedium titleOut d-block text-uppercase">Dream WeAver</strong>
											</div>
										</li>
										<li class="wow" data-wow-delay="1.5s">
											<!-- pieColumn -->
											<div class="pieColumn position-relative text-white text-center">
												<strong class="fwMedium position-absolute titleIn d-flex align-items-center justify-content-center dataCount" data-count-start="0" data-count-end="69">69</strong>
												<svg width="100" height="100" class="align-top mb-4">
													<circle class="cr1" r="47.5" cx="50" cy="50" fill="none" stroke="#19232b" stroke-width="5" />
													<circle class="cr2" r="47.5" cx="50" cy="50" fill="none" stroke="#ffa726" stroke-width="5" stroke-dasharray="131 92" />
												</svg>
												<strong class="fwMedium titleOut d-block text-uppercase">Html / Css</strong>
											</div>
										</li>
										<li class="wow" data-wow-delay="2s">
											<!-- pieColumn -->
											<div class="pieColumn position-relative text-white text-center">
												<strong class="fwMedium position-absolute titleIn d-flex align-items-center justify-content-center dataCount" data-count-start="0" data-count-end="80">80</strong>
												<svg width="100" height="100" class="align-top mb-4">
													<circle class="cr1" r="47.5" cx="50" cy="50" fill="none" stroke="#19232b" stroke-width="5" />
													<circle class="cr2" r="47.5" cx="50" cy="50" fill="none" stroke="#00a0d2" stroke-width="5" stroke-dasharray="160 63" />
												</svg>
												<strong class="fwMedium titleOut d-block text-uppercase">Wordpress</strong>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
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
								<a href="#works" class="smooth">Trabajos</a>
							</li>
							<li>
								<a href="#services" class="smooth">Servicios</a>
							</li>
							<!-- <li>
								<a href="#journey" class="smooth">Experiencia</a>
							</li> -->
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
	<script>
		function abrirServicio(id) {
			window.open('servicios.php?id='+id,'_blank');
		}
	</script>
</body>
</html>