<?php
namespace PHPMaker2019\cmsweb;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();
?>
<?php include_once "autoload.php" ?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$setting_sistem = new setting_sistem();

// Run the page
$setting_sistem->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<link href="plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="plugins/select2/dist/css/select2-bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="plugins/sweealert2/dist/sweetalert2.min.css">

<script src="plugins/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/sweealert2/dist/sweetalert2.min.js"></script>
<div class="row">
	<div class="col-md-3">
		<div class="card card-success">
			<div class="card-header">
				<p class="text-center" style="margin: 0;"><b>Logo Empresa</b></p>
			</div>
			<div class="card-body box-profile">

				<div class="text-center">

					<img class="profile-user-img img-fluid  img-response" src="./phpimages/logo.png" alt="LogoEmpresa" id="preview" name="preview">
				</div>
				<hr>
				<div>
					<input type="file" class="" id="imagen" name="imagen" onchange="cargarImagen()" hidden>
					<label for="" id="lblnomimg" style="display: none;"></label>
					<label id="lblSubirFoto" class="btn btn-primary btn-block" for="imagen"><i class="fa fa-paperclip"></i> Logo</label>
				</div>
			</div>
		</div>
		<div class="card card-success">
			<div class="card-header">
				<p class="text-center" style="margin: 0;"><b>Icono Empresa</b></p>
			</div>
			<div class="card-body box-profile">

				<div class="text-center">

					<img class="img-fluid img-thumbnail" style="width: 35%;" src="./favicon.ico" alt="IconoEmpresa" id="previewIcon" name="previewIcon">
				</div>
				<hr>
				<div>
					<label for="">
						<center>
							<small>*El formato de su icono debe ser .ico</small>
						</center>
					</label>
					<input type="file" class="" id="icono" name="icono" onchange="cargarIcono()" hidden>
					<label for="" id="lblnomicon" style="display: none;"></label>
					<label id="lblSubirIcono" class="btn btn-primary btn-block" for="icono"><i class="fa fa-paperclip"></i> Icono</label>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header p-2">
				<ul class="nav nav-pills">
					<li class="nav-item"><a class="nav-link active" href="#datosgenerales" data-toggle="tab">Datos Generales</a></li>
					<li class="nav-item"><a class="nav-link" href="#smtp" data-toggle="tab">SMTP</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="#metodopago" data-toggle="tab">Metodos de pago</a></li> -->
					<!--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Datos Sunat</a></li> -->
				</ul>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane active" id="datosgenerales">
						<form class="form-horizontal" id="formDatosGenerales" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								<label for="txtRuc" class="col-sm-2 col-form-label">RUC</label>
								<div class="col-sm-10">
									<input type="hidden" id="idconfiguracion" name="idconfiguracion">
									<input type="number" class="form-control" id="txtRuc" name="txtRuc" placeholder="Ingrese RUC">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtRazon" class="col-sm-2 col-form-label">RAZON SOCIAL</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtRazon" name="txtRazon" placeholder="Ingrese Razon Social" style="width: 100%;">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtContacto" class="col-sm-2 col-form-label">CONTACTO</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtContacto" name="txtContacto" placeholder="Ingrese Nombre Contacto" style="width: 100%;">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtCorreo" class="col-sm-2 col-form-label">CORREO</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtCorreo" name="txtCorreo" placeholder="Ingrese Correo" style="width: 100%;">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtDireccion" class="col-sm-2 col-form-label">DIRECCION</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="Ingrese Direccion" style="width: 100%;">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtTelefono" class="col-form-label">TELEFONO</label>
										<div class="">
											<input type="number" class="form-control" id="txtTelefono" name="txtTelefono" placeholder="Ingrese Telefono" style="width: 100%;">
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtTelefono" class="col-form-label">IGV</label>
										<div class="">
											<input type="number" class="form-control" id="txtIgv" name="txtIgv" placeholder="Ingrese Telefono" style="width: 100%;">
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label for="txtTelefono" class="col-form-label">Activar Ofertas</label>
										<div class="">
											<select name="txtofertascursos" id="txtofertascursos" class="form-control" style="width: 100%;">
												<option value="s">SI</option>
												<option value="n" selected>NO</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group">
										<label class="col-form-label">PAIS</label>
										<div class="">
											<select class="form-control" id="txtPais" name="txtPais" style="width: 100%;"></select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-form-label">REGIÓN</label>
										<div class="">
											<select class="form-control" id="txtRegion" name="txtRegion" style="width: 100%;"></select>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="col-form-label">CIUDAD</label>
										<div class="">
											<input type="text" class="form-control" id="txtCiudad" name="txtCiudad">
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="smtp">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for=""><i class="fa fa-at"></i> Dirección de correo del remitente:</label>
									<input type="text" class="form-control" name="correoremitente" id="correoremitente" placeholder="Ej. correo@ejemplo.com">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for=""><i class="fa fa-server"></i> Host smtp:</label>
									<input type="text" class="form-control" name="hostsmtp" id="hostsmtp" placeholder="Ej. mail.ejemplo.com">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for=""><i class="fa fa-plug"></i> Puerto smtp:</label>
									<input type="text" class="form-control" name="puertosmtp" id="puertosmtp" placeholder="Ej. 587">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for=""><i class="fa fa-user"></i> Usuario smtp:</label>
									<input type="text" class="form-control" name="usuariosmtp" id="usuariosmtp" placeholder="Ej. correo@ejemplo.com">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for=""><i class="fa fa-key"></i> Contraseña smtp:</label>
									<input type="text" class="form-control" name="clavesmtp" id="clavesmtp" placeholder="Ej. ******">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for=""><i class="fa fa-shield"></i> Tipo de Conexión:</label>
									<select name="tipoconexionsmtp" id="tipoconexionsmtp" class="form-control">
										<option value="tls">TLS</option>
										<option value="ssl">SSL</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 hide">
								<div class="form-group">
									<label for="">&nbsp;</label><br>
									<button class="btn btn-block" id="sendemail"><i class="fa fa-paper-plane"></i> Probar Correo</button>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="metodopago">
						<label>Tarjetade Crédito/Debito:</label>
						<!-- <form method="POST" id="frmmercadopago" name="frmmercadopago">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">
										<div class="form-check">
											<input type="checkbox" data-toggle="collapse" data-target="#body-mercadopago" aria-expanded="false" aria-controls="body-mercadopago" class="form-check-input col-form-label" name="checkmercadopago" id="checkmercadopago">
											<label class="form-check-label" for="checkmercadopago">Activar Mercado de Pago?</label>
										</div>
									</h4>
								</div>
								<div class="collapse" id="body-mercadopago">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="txtPaismp">Pais</label>
															<select class="form-control" id="txtPaismp" name="txtPaismp" style="width: 100%;">
																<option value="">- Seleccionar -</option>
																<option value="MLA">Argentina</option>
																<option value="MLB">Brasil</option>
																<option value="MLC">Chile</option>
																<option value="MLU">Uruguay</option>
																<option value="MCO">Colombia</option>
																<option value="MLV">Venezuela</option>
																<option value="MPE">Perú</option>
																<option value="MLM">México</option>
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="form-label" for="">Public Key</label>
													<input type="text" class="form-control" placeholder="Ingresar llave pública" id="publickeymp" name="publickeymp">
												</div>
												<div class="form-group">
													<label class="form-label" for="">Token</label>
													<input type="text" class="form-control" placeholder="Ingresar Token" id="tokenmp" name="tokenmp">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-primary" id="btnsavemercadopago" type="button">Guardar</button>
										</div>
									</div>
								</div>
							</div>
						</form> -->
						<form method="POST" id="frmculqi" name="frmculqi">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">
										<div class="form-check">
											<input type="checkbox" data-toggle="collapse" data-target="#body-culqi" aria-expanded="false" aria-controls="body-culqi" class="form-check-input col-form-label" id="checkculqi" name="checkculqi">
											<label class="form-check-label" for="checkculqi">Activar Culqi?</label>
										</div>
									</h4>
								</div>
								<div class="collapse" id="body-culqi">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label" for="">Llave Secreta</label>
													<input type="text" class="form-control" placeholder="Ingresar llave pública" id="secretkeyculqi" name="secretkeyculqi">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label" for="txtPaisculqi">Pais</label>
													<select class="form-control" id="txtPaisculqi" name="txtPaisculqi" style="width: 100%;"></select>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-primary" id="btnsaveculqi" type="button">Guardar</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<hr>
						<label>Otros:</label>
						<form id="frmpaypal">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">
										<div class="form-check">
											<input type="checkbox" data-toggle="collapse" data-target="#body-paypal" aria-expanded="false" aria-controls="body-paypal" class="form-check-input col-form-label" id="checkpaypal">
											<label class="form-check-label" for="checkpaypal">Activar Paypal?</label>
										</div>
									</h4>
								</div>
								<div class="collapse" id="body-paypal">
									<div class="card-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="form-label" for="">Public Key</label>
													<input type="text" class="form-control" placeholder="Ingresar llave pública">
												</div>
												<div class="form-group">
													<label class="form-label" for="">Token</label>
													<input type="text" class="form-control" placeholder="Ingresar Token">
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="txtPaispaypal">Pais</label>
															<select class="form-control" id="txtPaispaypal" name="txtPaispaypal" style="width: 100%;">
																<option value="">- Seleccionar -</option>
																<option value="MLA">Argentina</option>
																<option value="MLB">Brasil</option>
																<option value="MLC">Chile</option>
																<option value="MLU">Uruguay</option>
																<option value="MCO">Colombia</option>
																<option value="MLV">Venezuela</option>
																<option value="MPE">Perú</option>
																<option value="MLM">México</option>
															</select>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group row">
															<label class="form-label" for="txtMoneda">Moneda</label>
															<select class="form-control" id="txtMoneda" name="txtMoneda" style="width: 100%;"></select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="row">
					<div class="col-md-6">
						<button type="button" class="btn btn-danger" id="btnCancelar" onclick="location.reload()">Cancelar</button>
					</div>
					<div class="col-md-6">
						<button type="button" class="btn btn-primary" id="btnGuardarDatos">Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="scripts/configuracion.js"></script>
<?php if (DEBUG_ENABLED) echo GetDebugMessage(); ?>
<?php include_once "footer.php" ?>
<?php
$setting_sistem->terminate();
?>