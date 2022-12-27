$(function () {
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
      let ruta = ($(this).data('boton') == "nuevo")?'menus/crearMenu':'menus/actualizarMenu';
      $.ajax({
        type: 'POST',
        url: servidor + ruta,
        dataType: 'json',
        data: form.serialize(),
        success: function (data) {
          swal({
            icon: data.icono,
            title: data.titulo,
            text: data.texto,
            closeOnClickOutside: false,
            closeOnEsc: false,
            allowOutsideClick: false,
            buttons: false,
            timer: 2000
          });
          setTimeout(function(){
            location.reload()
          }, 2000);
        },
        error: function (data) {
          console.log("error");
        },
        complete:function(){
          
        }
      });
    }
    form.addClass("was-validated");
  });

  $(".acciones").click(async function () {
    let id = $(this).data('id');
    if ($(this).data('type') == "edit") {
      console.log("Formulario editar, presiono btn edit");
      let peticion = await fetch(servidor + `menus/datosMenu/${id}`);
      let response = await peticion.json();
      let selected = (response.fk_id_menu == null) ? "" : response.fk_id_menu;

      $('#form_menu_padre').find('option:selected').attr("selected", false);
      $('#form_menu_padre option[value="' + selected + '"]').attr('selected', true);
      $('#form_nombre').val(response.nombre_menu);
      $('#form_descripcion').val(response.descripcion_menu);
      $('#form_id').val(response.id_menu);
      $('#submit').attr('data-boton', 'actualizar')
    } else if ($(this).data('type') == "new") {
      console.log("Formulario Nuevo, presiono btn nuevo");
      $('#form_menu_padre').find('option:selected').attr("selected", false);
      $('#form_nombre').val("");
      $('#form_descripcion').val("");
      $('#form_id').val("");
      $('#submit').attr('data-boton', 'nuevo')
    } else {
      console.log("Eliminar, presiono btn eliminar");
      console.log("Eliminar menu");
      swal({
        title: "Eliminar",
        text: `Desea eliminar el menú "${$(this).data('menu')}"?`,
        icon: "warning",
        buttons: true,
        buttons: ["Cancelar", "Eliminar"],
        dangerMode: true,
      })
        .then(async (willDelete) => {
          if (willDelete) {
            $.ajax({
              type: 'POST',
              url: servidor + `menus/eliminarMenu/${id}`,
              dataType: 'json',
              success: function (data) {
                console.log(data);
                swal({
                  icon: data.icono,
                  title: data.titulo,
                  text: data.texto,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  allowOutsideClick: false,
                  buttons: false,
                  timer: 2000
                });
                setTimeout(function(){
                  location.reload()
                }, 2000);
              },
              error: function (data) {
                swal({
                  icon: data.icono,
                  title: data.titulo,
                  text: data.texto,
                  closeOnClickOutside: false,
                  closeOnEsc: false,
                  allowOutsideClick: false,
                  buttons: false,
                  timer: 2000
                });
              }
            });
          }
        });
    }
  });

  async function menuPadre() {
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
  $(".menus").click(function () {
    $('#titulo-card').text($(this).text());
    $("#contenedor").empty().text($(this).data('descripcion'));
  });
});
