$("#formLogin").submit(function (e) {
  e.preventDefault();
  var usuario = $.trim($("#usuario").val());
  var password = $.trim($("#password").val());

  if (usuario.length == "" || password.length == "") {
    Swal.fire({
      html: '<br><img src="img/logo-dan.png" alt="" style="width:150px">',
      position: "center",
      icon: "warning",
      title: "Usuario y Contraseña obligatorios",
      showConfirmButton: false,
      timer: 2000,
    });
  } else {
    $.ajax({
      type: "POST",
      url: "db/login.php",
      data: { usuario: usuario, password: password },
      dataType: "json",
      success: function (data) {
        if (data == -1) {
          Swal.fire({
            html: '<br><img src="img/logo-dan.png" alt="" style="width:150px">',
            position: "center",
            icon: "error",
            title: "Usuario y Contraseña no son correctos",
            showConfirmButton: false,
            timer: 2000,
          });
        } else {
          Swal.fire({
            html: '<br><img src="img/logo-dan.png" alt="" style="width:150px">',
            position: "center",
            icon: "success",
            title: "Bienvenidos",
            showConfirmButton: false,
            timer: 2000,
          }).then((result) => {
            window.location.href = "panel_admin/";
          });
        }
      },
    });
  }
});
