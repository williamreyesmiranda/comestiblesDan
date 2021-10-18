//MONTAR PEDIDO
//ingresar Pedido
function registrarPedido() {
  $.ajax({
    type: "POST",
    url: "registrarPedido.php",
    data: $("#formRegistrarPedido").serialize(),
    datatype: "json",
    success: function (r) {
      if (r == 1) {
        Swal.fire({
          html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
          position: "center",
          icon: "success",
          title: "Pedido Ingresado Correctamente",
          showConfirmButton: false,
          timer: 2000,
        }).then((result) => {
          window.location.href = "listaMontarPedido.php";
        });
      } else {
        Swal.fire({
          html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
          position: "center",
          icon: "error",
          title: "Error al montar el pedido",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    },
  });
}

//APROBAR PEDIDO

//aprobar pedido
function aprobarPedido(datos) {
  let d = datos.split("||");
  let respuesta = ("idPedido=" + d[1] + "&estado="+1);
  // alert(respuesta);
  Swal.fire({
    title: "Desea aprobar el Pedido??",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aprobar",
    cancelButtonText: "Atras",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "aprobarPedido.php",
        data: respuesta,
        datatype: "json",
        success: function (r) {
         
          if (r == 1) {
            Swal.fire({
              html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
              position: "center",
              icon: "success",
              title: "Pedido Aprobado",
            });
            $("#tablaAprobacion").load("tablaAprobar.php");
          } else {
            Swal.fire({
              html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
              position: "center",
              icon: "error",
              title: "Error aprobar pedido",
            });
          }
        },
      });
    }
  });
}

//cancelar pedido
function cancelarPedido(datos) {
  let d = datos.split("||");
  let respuesta = ("idPedido=" + d[1] + "&estado="+2);
  // alert(respuesta);
  Swal.fire({
    title: "Desea Anular el Pedido??",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Anular",
    cancelButtonText: "Atras",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "aprobarPedido.php",
        data: respuesta,
        datatype: "json",
        success: function (r) {
         
          if (r == 1) {
            Swal.fire({
              html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
              position: "center",
              icon: "success",
              title: "Pedido Anulado",
            });
            $("#tablaAprobacion").load("tablaAprobar.php");
          } else {
            Swal.fire({
              html: '<br><img src="../img/logo-dan.png" alt="" style="width:150px">',
              position: "center",
              icon: "error",
              title: "Error anular pedido",
            });
          }
        },
      });
    }
  });
}
