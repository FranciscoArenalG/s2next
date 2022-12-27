$(function () {
  $(".menus").click(function () {
    $('#titulo-card').text($(this).text());
    $("#contenedor").empty().text($(this).data('descripcion'));
  });
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
  $("#submit").click(function () {
    let form = $("#" + $(this).data("formulario"));
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      /* $.ajax({
                type: 'POST',
                url: servidor + 'login/registrar',
                dataType: 'json',
                data: form.serialize(),
                beforeSend: function() {
                    // setting a timeout
                    $("#loading").addClass('loading');
                },
                success: function(data) {
                    console.log(data);
                    if (data.estatus == "warning") {
                        $('#reg_correo').focus();
                    }
                    swal({
                        icon: data.estatus,
                        title: data.titulo,
                        text: data.respuesta,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        allowOutsideClick: false,
                        buttons: false,
                        timer: 2000
                    });
                },
                error: function(data) {
                    console.log(data);
                },
                complete: function() {
                    $("#loading").removeClass('loading');
                }
            }); */
    }
    form.addClass("was-validated");
  });
  async function menuPadre(){
    try {
        $("#form_menu_padre").empty();
        let peticion = await fetch(servidor + `menus/getMenuPadre`);
        let response = await peticion.json();
        let option_select = document.createElement("option")
        option_select.value = '';
        option_select.text = 'Sin menú padre...'
        $("#form_menu_padre").append(option_select)
        for (let item of response) {
            let option = document.createElement("option")
            option.value = item.id_menu;
            option.text = item.nombre_menu
            $("#form_menu_padre").append(option)
        }
        console.log('cargando menu padre ...');
    } catch (err) {
        if (err.name == 'AbortError') { } else { throw err; }
    }
}
menuPadre()
});
