<?php
$datos = kmimos_get_info_syte();
$referidos = get_referred_list_options();
$referidos_options = "";
foreach ($referidos as $key => $value) {
	$selected="";
	if(array_key_exists("wlabel",$_SESSION)){
		$wlabel=$_SESSION['wlabel'];

		if($key=='Volaris' && $wlabel=='volaris'){
			$selected='selected';

		}else if($key=='Vintermex' && $wlabel=='viajesintermex'){
			$selected='selected';
		}
	}

	$referidos_options.= "<option value='{$key}' $selected>{$value}</option>";
}

$HTML .='
	<!-- POPUPS REGISTRARTE -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="popup-registrarte" style="padding: 40px;">
	<div class="modal-dialog">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<div class="popup-registrarte-1">
				<p class="popup-tit">REGISTRARME</p>
				<a href="#" class="km-btn-fb" onclick="login_facebook();">
					<img src="'.getTema().'/images/icons/km-redes/icon-fb-blanco.svg">
					REGISTRARME CON FACEBOOK
				</a>
				
				<a href="#" class="google_auth km-btn-border" id="customBtn1">
					<img src="'.getTema().'/images/icons/km-redes/icon-gmail.svg">
					REGISTRARME CON GOOGLE
				</a>
				<script>/*startApp();*/</script>
				<div class="line-o">
					<p class="text-line">o</p>
					<div class="bg-line"></div>
				</div>
				<a href="#" class="km-btn-correo km-btn-popup-registrarte-1"><img src="'.getTema().'/images/icons/km-redes/icon-mail-blanco.svg">REGISTRARME POR CORREO ELECTRÓNICO</a>
				<p style="color: #979797; margin-top: 20px;">Al crear una cuenta, aceptas las <a style="color: blue;" target="_blank" href="'.site_url().'/terminos-y-condiciones/">condiciones del servicio y la Política de privacidad</a> de Kmimos.</p>

				<p><b>Dudas escríbenos</b></p>
				<div class="row">
					<div class="col-xs-12"><p><img style="width: 20px; margin-right: 5px; position: relative; top: -3px;" src="'.getTema().'/images/icons/km-redes/icon-wsp.svg">En caso de dudas escríbenos al whatsapp '.$datos["whatsapp"].'</p></div>
					
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-5">
						<p>¿Ya tienes una cuenta?</p>
					</div>
					<div class="col-xs-7">
						<a href="#" class="modal_show km-btn-border" data-modal="#popup-iniciar-sesion"><b>INICIAR SESIÓN</b></a>
					</div>
				</div>
			</div>
			<div class="popuphide popup-registrarte-nuevo-correo">
				<p style="color: #979797; text-align: center;">Regístrate por <a href="#" onclick="login_facebook();">Facebook</a> o <a href="#" class="google_auth" id="customBtn2">Google</a></a></p>
					<h3 style="margin: 0; text-align: center;">Completa tus datos</h3>
				<form id="form_nuevo_cliente" name="form_nuevo_cliente" enctype="multipart/form-data" method="POST">	
					<div class="km-box-form">
						<div class="content-placeholder">
							<input type="text" id="id_login_face" name="id_login_face" class="hidden">
							<input type="text" id="id_login_gmail" name="id_login_gmail" class="hidden">
							<div class="km-datos-foto" id="km-datos-foto-profile" style="background: url('.getTema().'/images/popups/registro-cuidador-foto.svg) center/contain;">
								<div id="loading-perfil" style="width:100%;line-height: 100%;display:none">
									<img src="'.getTema().'/images/new/bx_loader.gif" class="img-responsive">
								</div>
							</div>
							

							<input type="file" class="hidden" id="carga_foto_profile" accept="image/*">
							<input type="hidden" id="img_profile" name="img_profile" value="">
							

							<div class="label-placeholder">
								<label>Nombre</label>
								<input type="text" id="nombre" name="nombre" maxlength="30" data-charset="xlf" class="input-label-placeholder" pattern=".{3,}">
							</div>
							<div class="label-placeholder">
								<label>Apellido</label>
								<input type="text" name="apellido" id="apellido" maxlength="30"  data-charset="xlf" class="input-label-placeholder" pattern=".{3,}">
							</div>

							<div class="label-placeholder">
								<label>IFE/Documento de Identidad</label>
								<input type="text" name="ife" id="ife" class="input-label-placeholder" data-charset="num" maxlength="11">
							</div>
							<div class="label-placeholder verify">
								<label>Correo electrónico</label>
								<input type="email" name="email_1" data-verify="active" id="email_1" class="verify_mail input-label-placeholder" data-charset="espalfnum" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
								<span class="verify_result"></span>
							</div>
							<div class="label-placeholder">
								<label>Crea tu contraseña</label>
								<input type="password" name="pass" id="pass" maxlength="20"  class="input-label-placeholder">
							</div>
							<div class="label-placeholder">
								<label>Teléfono</label>
								<input type="text" name="movil" id="movil" class="input-label-placeholder" data-charset="num" maxlength="11">
							</div>
							<div class="km-datos-mascota">
								<select class="km-datos-mascota-opcion bg-select-custom" name="genero" id="genero">
									<option value="">Género</option>
									<option value="hombre">Hombre</option>
									<option value="mujer">Mujer</option>
								</select>
							</div>
							<div class="km-datos-mascota">
								<select class="km-datos-mascota-opcion bg-select-custom" name="edad" id="edad">
									<option value="">Edad</option>
									<option value="18-25">18-25 años</option>
									<option value="25-35">26-35 años</option>
									<option value="Mayor-46">Mayor 36 años</option>
								</select>
							</div>
							<div class="km-datos-mascota">
								<select class="km-datos-mascota-opcion bg-select-custom" name="fumador" id="fumador">
									<option value="">Es Fumador</option>
									<option value="SI">Si</option>
									<option value="NO">No</option>
								</select>
							</div>
							<div class="km-datos-mascota">
								<select id="referido" name="referido bg-select-custom" class="km-datos-mascota-opcion" data-title="Debes seleccionar una opción" required>
									<option value="">Donde nos conocio?</option>
									'.$referidos_options.'
								</select>
							</div>


						</div>
					</div>
				</form>
				
				<!-- span id="guardando"></span -->
				<!-- div id="resp"></div -->
				
				<a href="#" id="siguiente" class="km-btn-correo km-btn-popup-registrarte-nuevo-correo">SIGUIENTE</a>

				<p style="color: #979797; margin-top: 20px;">Al crear una cuenta, aceptas las <a style="color: blue;" target="_blank" href="'.site_url().'/terminos-y-condiciones/">condiciones del servicio y la Política de privacidad</a> de Kmimos.</p>
				<p><img style="width: 20px; margin-right: 5px; position: relative; top: -3px;" src="'.getTema().'/images/icons/km-redes/icon-wsp.svg">En caso de dudas escríbenos al whatsapp '.$datos["whatsapp"].'</p>
				<hr>
				<div class="row">
					<div class="col-xs-5">
						<p>¿Ya tienes una cuenta?</p>
					</div>
					<div class="col-xs-7">
						<a href="#" class="modal_show km-btn-border km-link-login" data-modal="#popup-iniciar-sesion"><b>INICIAR SESIÓN</b></a>
					</div>
				</div>
			</div>
			<div class="popuphide popup-registrarte-datos-mascota">
				<h3 style="margin: 0; text-align: center;">Datos de tus Mascotas</h3>
				<p style="text-align: center;">Queremos conocer más sobre tus mascotas, llena los campos</p>

				<div class="km-datos-foto" id="km-datos-foto" style="background: url('.getTema().'/images/popups/registro-cuidador-foto.svg) center/contain;">
					<div id="loading-mascota" style="width:100%;line-height: 100%;display:none;text-align:center;">
						<img src="'.getTema().'/images/new/bx_loader.gif" class="img-responsive">
					</div>
				</div>

				<input type="file" class="hidden" id="carga_foto" accept="image/*">
				<input type="hidden" id="img_pet" name="img_pet" value="">

				<form id="nueva_mascota" enctype="multipart/form-data" method="POST">
				<div class="km-box-form">
					<div class="content-placeholder">
						<div class="label-placeholder">
							<label>Nombre de tu mascota</label>
							<input type="text" name="nombre_mascota" data-charset="xlf" id="nombre_mascota" class="input-label-placeholder">
						</div>
						<div class="km-datos-mascota">
							<select class="km-datos-mascota-opcion bg-select-custom" name="tipo_mascota" id="tipo_mascota">
								<option value="">Tipo de Mascota</option>
								<option value="2605">Perros</option>
								<option value="2608">Gatos</option>
							</select>
							<select class="km-datos-mascota-opcion bg-select-custom" name="raza_mascota" id="raza_mascota">
								<option value="">Raza de la Mascota</option>
							</select>
						</div>
						<div class="label-placeholder">
							<label>Color de tu mascota</label>
							<input type="text" name="color_mascota" data-charset="xlf" id="color_mascota" class="input-label-placeholder">
						</div>
						<div class="km-fecha-nacimiento">
							<input type="text" name="date_birth" id="datepets" placeholder="Fecha de Nacimiento" class="date_birth" readonly>
						</div>
						<div class="km-datos-mascota">
							<select class="km-datos-mascota-opcion bg-select-custom" name="genero_mascota" id="genero_mascota">
								<option value="">Género</option>
								<option value="1">Macho</option>
								<option value="2">Hembra</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row row-sin-padding" class="tamano-mascota-content" style="margin-bottom: 20px;">
					<div class="col-xs-6 col-sm-3">
						<div class="km-opcion" id="select_1" value="0">
							<img src="'.getTema().'/images/icons/icon-pequenio.svg" width="25">
							<br>
							<div class="km-opcion-text">
								<b>PEQUEÑO</b><br> 0 a 25 cm
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3">
						<div class="km-opcion" id="select_2" value="1">
							<img src="'.getTema().'/images/icons/icon-mediano.svg" width="25">
						<br>
							<div class="km-opcion-text">
								<b>MEDIANO</b><br> 25 a 58 cm
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3">
						<div class="km-opcion" id="select_3" value="2">
							<img src="'.getTema().'/images/icons/icon-grande.svg" width="25">
						<br>
							<div class="km-opcion-text">
								<b>GRANDE</b><br> 58 a 73 cm</div>
							</div>
					</div>
					<div class="col-xs-6 col-sm-3">
						<div class="km-opcion" id="select_4" value="3">
							<img src="'.getTema().'/images/icons/icon-gigante.svg" width="25">
						<br>
							<div class="km-opcion-text"><b>
								GIGANTE</b><br> 73 a 200 cm
							</div
						></div>
					</div>
				</div>
				<div class="km-registro-checkbox">
					<div class="km-registro-checkbox-opcion">
						<p>Mascota Estilizada</p>
						<div class="km-check-1">
							<input type="checkbox" value="0" id="km-check-1" name="estilizada" />
							<label for="km-check-1"></label>
						</div>
					</div>
					<div class="km-registro-checkbox-opcion">
						<p>Mascota Sociable</p>
						<div class="km-check-2">
							<input type="checkbox" value="0" id="km-check-2" name="sociable" />
							<label for="km-check-2"></label>
						</div>
					</div>
				</div>
				<div class="km-registro-checkbox" style="margin-top: 0px;">
					<div class="km-registro-checkbox-opcion">
						<p>Agresiva con Humanos</p>
						<div class="km-check-3">
							<input type="checkbox" value="0" id="km-check-3" name="agresiva_humano" />
							<label for="km-check-3"></label>
						</div>
					</div>
					<div class="km-registro-checkbox-opcion">
						<p>Agresiva con Mascotas</p>
						<div class="km-check-4">
							<input type="checkbox" value="0" id="km-check-4" name="agresiva_mascota" />
							<label for="km-check-4"></label>
						</div>
					</div>
				</div>
				</form>						
				<a href="#" class="km-btn-correo km-btn-popup-registrarte-datos-mascota">REGISTRARME</a>
				<p style="color: #979797; margin-top: 20px;">Al crear una cuenta, aceptas las <a style="color: blue;" target="_blank" href="'.site_url().'/terminos-y-condiciones/">condiciones del servicio y la Política de privacidad</a> de Kmimos.</p>
				<p><img style="width: 20px; margin-right: 5px; position: relative; top: -3px;" src="'.getTema().'/images/icons/km-redes/icon-wsp.svg">En caso de dudas escríbenos al whatsapp '.$datos["whatsapp"].'</p>
			</div>
			<div class="popuphide popup-registrarte-final">
				<h3 style="margin: 0; text-align: center;">¡FELICIDADES,<br>TU REGISTRO SE REALIZÓ CON ÉXITO!</h3>
				<img src="'.getTema().'/images/popups/km-registro-exitoso.png">
				<!--
					<a href="#" class="modal_show km-btn-correo" data-modal="#popup-iniciar-sesion">INICIAR SESIÓN</a>
				-->
				<a href="javascript:;" onclick="location.reload();" class="km-btn-correo">INICIAR SESIÓN</a>
			</div>
		</div>
	</div>
</div>	
';