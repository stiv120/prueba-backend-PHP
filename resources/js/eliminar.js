'use strict';

$(document).on('click', '.btnEliminarEmpleado', function () {
    let id = $(this).attr('data-eliminar');
    if (id) {
        let datos = {
            id
        }
        $.ajax({
            url: `/prueba-backend-PHP/eliminar-empleado`,
            type: 'DELETE',
            contentType: 'application/json',
            data: JSON.stringify(datos),
            success: function(response) {
                toastr.success(response.message);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                toastr.error('Ha ocurrido un error en la solicitud.');
                console.error('Error:', error);
            }
        });
    }
});
