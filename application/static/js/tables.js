var tablaDetClientes,
    tablaClientes;
$(function() {
  setTimeout(function () {
    $("#mensaje").html("");
  }, 6000);

  var start = moment();
  var end = moment();

  function cb(start, end) {
    $('input[name="rango_fecha"]').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
  }
  cb(start, end);
  $('input[name="rango_fecha"]').daterangepicker({
    startDate: start,
    endDate: end,
    autoUpdateInput: false,
    locale: {
      applyLabel: 'Aplicar',
      cancelLabel: 'Limpiar',
      format: 'DD/MM/YYYY'
    }
  });
  $('input[name="rango_fecha"]').on('apply.daterangepicker', function(ev, picker) {
     $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
  });
  $('input[name="rango_fecha"]').on('cancel.daterangepicker', function(ev, picker) {
     $(this).val('');
  });
  tablaDetClientes = $('#listaDetalleClientes').DataTable({
    paging: false,
    bInfo: false,
    ordering: false,
    searching: false,
    columns: [
      {title: 'Nombre'},
      {title: 'Teléfono alternativo'},
      {title: 'Teléfono móvil'},
      {title: 'Cód. postal'},
      {title: 'Fecha de registro'},
      {title: 'Observaciones'},
      {title: 'Contacto con telecentro'},
      {title: 'Región'},
      {title: 'Agente'}
    ],
  });
  tablaClientes = $('#listaClientes').DataTable({
    language: {
      search: "Búsqueda en tabla:",
      paginate: {
          first: "Primera",
          previous: "anterior",
          next: "Siguiente",
          last: "Última"
      },
      lengthMenu: "Mostrar _MENU_ registros por página",
      info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
      infoEmpty: "Sin resultados",
      emptyTable: "Sin registros disponibles"
    },
    columns: [
      {title: 'Nombre y apellido'},
      {title: 'Domicilio'},
      {title: 'Localidad'},
      {title: 'Provincia'},
      {title: 'Teléfono'},
      {title: 'E-mail'},
      {title: 'Calificación'},
      {title: 'Acciones'}
    ]
  });
  $('#listaClientes').on('click', '.ver', function (e) {
    var arrDetalleCliente = [];
    var cliente_id = $(this).val();
    $.ajax({
      type: 'GET',
      contentType: "application/json",
      url: 'index.php/clientes/get_detalle_cliente?id=' + cliente_id,
      success: function (msg) {
        jsonMsj = JSON.parse(msg);
        if(jsonMsj.lista_detalle_cliente.length > 0) {
            switch (jsonMsj.lista_detalle_cliente[0].selPub) {
              case "1":
              jsonMsj.lista_detalle_cliente[0].selPub = "Lo vi en televisión";
              break;
              case "2":
              jsonMsj.lista_detalle_cliente[0].selPub = "Vi un cartel en la calle";
              break;
              case "3":
              jsonMsj.lista_detalle_cliente[0].selPub = "Vi un cartel en el subte";
              break;
              case "4":
              jsonMsj.lista_detalle_cliente[0].selPub = "Vi un cartel en una parada de colectivo";
              break;
              case "5":
              jsonMsj.lista_detalle_cliente[0].selPub = "Lo vi en una revista o diario";
              break;
              case "6":
              jsonMsj.lista_detalle_cliente[0].selPub = "Me llego un folleto a mi casa";
              break;
              case "7":
              jsonMsj.lista_detalle_cliente[0].selPub = "Vi una publicidad en Internet";
              break;
              case "8":
              jsonMsj.lista_detalle_cliente[0].selPub = "Entré a la página web";
              break;
              case "9":
              jsonMsj.lista_detalle_cliente[0].selPub = "Me lo recomendó un amigo o pariente";
              break;
            }

            switch (jsonMsj.lista_detalle_cliente[0].selReg) {
              case "1":
              jsonMsj.lista_detalle_cliente[0].selReg = "CABA";
              break;
              case "2":
              jsonMsj.lista_detalle_cliente[0].selReg = "Norte";
              break;
              case "3":
              jsonMsj.lista_detalle_cliente[0].selReg = "Sur";
              break;
              case "4":
              jsonMsj.lista_detalle_cliente[0].selReg = "Oeste";
              break;
            }
            arrDetalleCliente = [
              jsonMsj.lista_detalle_cliente[0].nom,
              jsonMsj.lista_detalle_cliente[0].tel2,
              jsonMsj.lista_detalle_cliente[0].tel3,
              jsonMsj.lista_detalle_cliente[0].codpostal,
              jsonMsj.lista_detalle_cliente[0].fecha_registracion,
              jsonMsj.lista_detalle_cliente[0].obsC,
              jsonMsj.lista_detalle_cliente[0].selPub,
              jsonMsj.lista_detalle_cliente[0].selReg,
              jsonMsj.lista_detalle_cliente[0].agcod
            ];

        }
        tablaDetClientes.rows().remove().draw();
        tablaDetClientes.row.add(arrDetalleCliente).draw();
        arrDetalleCliente = null;
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error al ejecutar => " + textStatus + " - " + errorThrown);
      }
    });
  });
  $("#btnSearch").click(function () {
    var arrCliente = [];
    $.ajax({
      type: 'GET',
      contentType: "application/json",
      url: 'index.php/clientes/get_clientes_por?tel1=' + $("#tel1").val() +'&agente=' + $("#agente").val() + '&rango_fecha=' + $("#rango_fecha").val(),
      success: function (msg) {
        jsonMsj = JSON.parse(msg);
        for (var i = 0; i < jsonMsj.lista_clientes_por.length; i++) {
          if (jsonMsj.lista_clientes_por.length > 0) {
            switch (jsonMsj.lista_clientes_por[i].selCalif) {
              case "1":
              jsonMsj.lista_clientes_por[i].selCalif = "No Califico!";
              break;
              case "2":
              jsonMsj.lista_clientes_por[i].selCalif = "Fuera de zona";
              break;
              case "3":
              jsonMsj.lista_clientes_por[i].selCalif = "No venta";
              break;
              case "4":
              jsonMsj.lista_clientes_por[i].selCalif = "UHF";
              break;
              case "5":
              jsonMsj.lista_clientes_por[i].selCalif = "Venta";
              break;
            }

            jsonMsj.lista_clientes_por[i].acciones = "<button type='button' class='btn btn-xs btn-primary ver' data-toggle='modal' data-target='#myModal2' value=" + jsonMsj.lista_clientes_por[i].id + ">+ info</button>&nbsp;"+
            "<a type='button' class='btn btn-xs btn-primary' href=index.php/clientes/editar_cliente?id=" + jsonMsj.lista_clientes_por[i].id + ">Editar</button></a>";
            arrCliente[i] = [
              jsonMsj.lista_clientes_por[i].nom,
              jsonMsj.lista_clientes_por[i].direc,
              jsonMsj.lista_clientes_por[i].localid,
              jsonMsj.lista_clientes_por[i].pcia,
              jsonMsj.lista_clientes_por[i].tel1,
              jsonMsj.lista_clientes_por[i].email,
              jsonMsj.lista_clientes_por[i].selCalif,
              jsonMsj.lista_clientes_por[i].acciones
            ];
          }
        }
        tablaClientes.rows().remove().draw();
        tablaClientes.rows.add(arrCliente).draw();
        arrCliente = null;
      },
      error: function (jqXHR, textStatus, errorThrown) {
          console.log("Error al ejecutar => " + jqXHR + " - " + errorThrown);
      }
    });
  });
  $("#selCalif").change(function () {
    $("#btnGuardar").attr('disabled', false);
  });
});
