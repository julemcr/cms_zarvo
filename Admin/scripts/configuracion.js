$(document).ready(function() {
  ListarPais();
  TraerConfiguracion();
  ObtenerPasarelasPago();
})

$("#btnGuardarDatos").on('click', function(e) {
  e.preventDefault();
  UpdateAgregarConfiguracion();
})

function TraerConfiguracion() {
  $.ajax({
    url: './ajax/ConfigurarAjax.php?op=TraerConfiguracion',
    type: 'POST',
    beforesend: function() {
      alert('Procesando, Espere por favor...');
    },
    success: function(r) {
      result = JSON.parse(r);
      if (result == 0) {
        $("#idconfiguracion").val(result);
      } else {
        $("#idconfiguracion").val(result.ConfiguracionID);
        document.getElementById('lblnomimg').innerHTML = result.Logo;
        $("#preview").attr('src', "./phpimages/" + result.Logo);
        $("#txtRuc").val(result.RUC);
        $("#txtRazon").val(result.RazonSocial);
        $("#txtContacto").val(result.Contacto);
        $("#txtPais").val(result.PaisID).change();
        $("#txtCiudad").val(result.Ciudad);
        $("#txtTelefono").val(result.Telefono);
        $("#txtCorreo").val(result.Correo);
        $("#txtDireccion").val(result.DireccionFiscal);
        $("#txtIgv").val(result.IGV);
        $("#txtofertascursos").val(result.Offers_activate).change();
        $("#correoremitente").val(result.remitentesmtp);
        $("#hostsmtp").val(result.hostsmtp);
        $("#puertosmtp").val(result.puertosmtp);
        $("#usuariosmtp").val(result.usuariosmtp);
        $("#clavesmtp").val(result.clavesmtp);
        $("#tipoconexionsmtp").val(result.conexionsmtp);
        setTimeout(() => {
          $("#txtRegion").val(result.Region).change();
        }, 1000);
      }
    },
    error: function(e) {
      alert(e.responseText);
    }
  });
}

function UpdateAgregarConfiguracion() {
  var formDatosGenerales = new FormData(document.getElementById("formDatosGenerales"));
  formDatosGenerales.append('img', $('#imagen')[0].files[0]);
  formDatosGenerales.append('icon', $('#icono')[0].files[0]);
  formDatosGenerales.append('remitente', $("#correoremitente").val());
  formDatosGenerales.append('host', $("#hostsmtp").val());
  formDatosGenerales.append('puerto', $("#puertosmtp").val());
  formDatosGenerales.append('usuairo', $("#usuariosmtp").val());
  formDatosGenerales.append('clave', $("#clavesmtp").val());
  formDatosGenerales.append('conexion', $("#tipoconexionsmtp").val());
  $.ajax({
    url: './ajax/ConfigurarAjax.php?op=UpdateAgregarConfiguracion',
    type: 'POST',
    processData: false,
    contentType: false,
    data: formDatosGenerales,
    beforesend: function() {
      alert('Procesando, Espere por favor...');
    },
    success: function(r) {
      if (r == 0) {
        Swal.fire({
          title: 'UPS!',
          text: "Error al guardar, vuelva a intentarlo",
          icon: 'error',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK!'
        }).then((result) => {
          if (result.isConfirmed) {
            location.reload();
          }
        })
      } else if (r == 1) {
        Swal.fire({
          title: '',
          text: "Se actualizaron los datos",
          icon: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'logout.php';
          }
        })
      } else if (r == 2) {
        Swal.fire({
          title: '',
          text: "Se Guardaron los datos",
          icon: 'success',
          showCancelButton: false,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'OK!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'logout.php';
          }
        })
      }
    },
    error: function(e) {
      alert(e.responseText);
    }
  });
}

function ListarPais() {
  $.ajax({
    url: './ajax/ConfigurarAjax.php?op=ListarPais',
    type: 'POST',
    success: function(r) {
      $("#txtPais").empty(r);
      $("#txtPais").append(r);
      $("#txtPais").select2({
        theme: "bootstrap"
      });

      $("#txtPaisculqi").empty(r);
      $("#txtPaisculqi").append(r);
      $("#txtPaisculqi").select2({
        theme: "bootstrap"
      });

    },
    error: function(e) {
      console.log(e.responseText);
    }
  });
}

$(document).on('change', '#txtPais', function() {
  ListarRegion($(this).val());
});

function ListarRegion(cod_pais) {
  $.ajax({
    url: './ajax/ConfigurarAjax.php?op=ListarRegion',
    type: 'POST',
    data: {
      cod_pais: cod_pais
    },
    success: function(r) {
      $("#txtRegion").empty(r);
      $("#txtRegion").append(r);
      $("#txtRegion").select2({
        theme: "bootstrap"
      });
    },
    error: function(e) {
      console.log(e.responseText);
    }
  });
}

function cargarImagen() {
  if ($('#imagen').prop("files")[0] == undefined) {
    $('#preview').attr('src', 'img/cajon.png');
    document.getElementById('lblnomimg').innerHTML = '';
  } else {
    var tipoimg = document.getElementById('imagen').files[0].type;

    if (tipoimg == 'image/jpeg' || tipoimg == 'image/jpg' || tipoimg == 'image/png') {
      var pdrs = document.getElementById('imagen').files[0].name;
      console.log();
      document.getElementById('lblnomimg').innerHTML = pdrs;

      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview').attr('src', e.target.result);
      }
      reader.readAsDataURL($('#imagen').prop("files")[0]);
    } else {
      Swal.fire('Ups!','Solo se permite imágenes del tipo png, jpg y jpeg.','info');
    }
  }
}

function cargarIcono() {
  if ($('#icono').prop("files")[0] == undefined) {
    $('#previewIcon').attr('src', 'icono.ico');
    document.getElementById('lblnomicon').innerHTML = '';
  } else {
    var tipoicon = document.getElementById('icono').files[0].type;
    console.log(tipoimg);
    if (tipoicon == 'image/x-icon') {
      var pdrs = document.getElementById('icono').files[0].name;
      document.getElementById('lblnomicon').innerHTML = pdrs;

      var reader = new FileReader();
      reader.onload = function(e) {
        $('#previewIcon').attr('src', e.target.result);
      }
      reader.readAsDataURL($('#icono').prop("files")[0]);
    } else {
      Swal.fire('Ups!','Solo se permite imágenes del tipo ico.','info');
    }
  }
}

// const btnsavemp = document.getElementById('btnsavemercadopago');
// btnsavemp.addEventListener('click', SaveMercadoPago);

// const checkmercadopago = document.getElementById('checkmercadopago');
// checkmercadopago.addEventListener('click', DisableEnabledMercadoPago)

// function SaveMercadoPago(e) {
//   //e.preventDefault();
//   var frmmercadopago = document.getElementById('frmmercadopago');
//   var frmData = new FormData(frmmercadopago);
//   $.ajax({
//     url: './ajax/ConfigurarAjax.php?op=SaveConfigMercadoPago',
//     method: 'POST',
//     data: frmData,
//     processData: false,
//     contentType: false,
//     success: function(data) {
//       console.log(JSON.parse(data));
//       if (data == 1) {
//         Swal.fire('Módulo Configuración', 'Pasarela de pago, Mercado de pago actualizada', 'success');
//       } else {
//         Swal.fire('Módulo Configuración', 'No se pudo guardar', 'error');
//       }
//     }
//   });
// }

// function DisableEnabledMercadoPago() {
//   //e.preventDefault();
//   if (checkmercadopago.checked) {
//     $.ajax({
//       url: './ajax/ConfigurarAjax.php?op=DisableEnabledMercadoPago',
//       method: 'POST',
//       data: {
//         checkmercadopago: 'on'
//       },
//       success: function(data) {
//         console.log(data);
//         if (data == 1) {
//           Swal.fire('Módulo Configuración', 'Mercado de pago activado', 'success');
//         } else {
//           Swal.fire('Módulo Configuración', 'No se pudo activar mercado de pago ', 'error');
//         }
//       }
//     });
//   } else {
//     $.ajax({
//       url: './ajax/ConfigurarAjax.php?op=DisableEnabledMercadoPago',
//       method: 'POST',
//       data: {
//         checkmercadopago: 'off'
//       },
//       success: function(data) {
//         if (data == 1) {
//           Swal.fire('Módulo Configuración', 'Mercado de pago desactivcado', 'success');
//         } else {
//           Swal.fire('Módulo Configuración', 'No se pudo desactivar mercado de pago ', 'error');
//         }
//       }
//     });

//   }
// }

const btnsaveculqi = document.getElementById('btnsaveculqi');
btnsaveculqi.addEventListener('click', SaveConfigCulqi);

const checkculqi = document.getElementById('checkculqi');
checkculqi.addEventListener('click', DisableEnabledCulqi)

function SaveConfigCulqi(e) {
  //e.preventDefault();
  var frmculqi = document.getElementById('frmculqi');
  var frmData = new FormData(frmculqi);
  $.ajax({
    url: './ajax/ConfigurarAjax.php?op=SaveConfigCulqi',
    method: 'POST',
    data: frmData,
    processData: false,
    contentType: false,
    success: function(data) {
      console.log(JSON.parse(data));
      if (data == 1) {
        Swal.fire('Módulo Configuración', 'Pasarela de pago, Culqi actualizada', 'success');
      } else {
        Swal.fire('Módulo Configuración', 'No se pudo guardar - Culqi', 'error');
      }
      ObtenerPasarelasPago();
    }
  });
}

function DisableEnabledCulqi() {
  //e.preventDefault();
  if (checkculqi.checked) {
    $.ajax({
      url: './ajax/ConfigurarAjax.php?op=DisableEnabledCulqi',
      method: 'POST',
      data: {
        checkculqi: 'on'
      },
      success: function(data) {
        console.log(data);
        if (data == 1) {
          Swal.fire('Módulo Configuración', 'Culqi activado', 'success');
        } else {
          Swal.fire('Módulo Configuración', 'No se pudo activar Culqi', 'error');
        }
        ObtenerPasarelasPago();
      }
    });
  } else {
    $.ajax({
      url: './ajax/ConfigurarAjax.php?op=DisableEnabledCulqi',
      method: 'POST',
      data: {
        checkculqi: 'off'
      },
      success: function(data) {
        console.log(data);
        if (data == 1) {
          Swal.fire('Módulo Configuración', 'Culqi desactivcado', 'success');
        } else {
          Swal.fire('Módulo Configuración', 'No se pudo desactivar Culqi', 'error');
        }
        ObtenerPasarelasPago();
      }
    });

  }
}

function ObtenerPasarelasPago() {
  $.ajax({
    url: "./ajax/ConfigurarAjax.php?op=ObtenerPasarelasPago",
    method: "POST",
    success: function (data) {
      r = JSON.parse(data);
      console.log(r);
      if (r.culqi_active == 1) {
        $("#checkculqi").prop("checked", true);
        $("#body-culqi").addClass('show');
      }else{
        $("#checkculqi").prop("checked", false);
        $("#body-culqi").removeClass("show");
      }
      $("#secretkeyculqi").val(r.culqi_secret_key);
      $("#txtPaisculqi").val(r.culqi_country).change();
    },
  });
}