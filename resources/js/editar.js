'use strict';

const formEditarEmpleado = '#formEditarEmpleado';
const modalEditarEmpleado = '#modalEditarEmpleado';

$(document).on('click', '.btnEditarEmpleado', function () {
    let id = $(this).attr('data-modificar');
    if (id) {
        let datos = {
            id
        }
        $.ajax({
            url: `/prueba-backend-PHP/editar-empleado`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(datos),
            success: function(response) {
                $(modalEditarEmpleado).modal('show');
                let datos = response?.datos.shift();
                $(`${formEditarEmpleado} .correo`).val(datos?.email);
                $(`${formEditarEmpleado} .idEmpleado`).val(datos?.id);
                $(`${formEditarEmpleado} .nombre`).val(datos?.nombre);
                $(`${formEditarEmpleado} .descripcion`).val(datos?.descripcion);
                $(`${formEditarEmpleado} .area`).val(datos?.area_id).trigger('change');
                if (datos?.boletin) {
                    $(`${formEditarEmpleado} #checkEditarBoletin`).prop('checked', true);
                }
                if (datos?.sexo == 'M') {
                    $(`${formEditarEmpleado} #editarSexo1`).prop('checked', true);
                } else {
                    $(`${formEditarEmpleado} #editarSexo2`).prop('checked', true);
                }
                actualizarEmpleado();
            },
            error: function(xhr, status, error) {
                toastr.error('Ha ocurrido un error en la solicitud.');
                console.error('Error:', error);
            }
        });
    }
});

let actualizarEmpleado = () => {
        // Validar el formulario
        $(formEditarEmpleado).validate({
            rules: false,
            messages: false,
            highlight: function (element) {
                // resaltar select genéricos
                if ($(element).hasClass('form-select')) {
                    $(element)
                        .parent()
                        .css({
                            'border-width': 'thin',
                            'border-style': 'solid',
                            'border-color': '#f1416c'
                        });
                    return true;
                }
                // resaltar select genéricos
                if ($(element).hasClass('form-checks')) {
                    $(element)
                        .parent()
                        .css({
                            'border-width': 'thin',
                            'border-style': 'solid',
                            'border-color': '#f1416c'
                        });
                    return true;
                }
                // resaltar un elemento normal.
                $(element)
                    .closest('.form-control')
                    .addClass('is-invalid');
            },
            lang: 'es',
            unhighlight: function (element) {
                // borrar la clase en el select generico.
                if ($(element).hasClass('form-select')) {
                    $(element)
                        .parent()
                        .css({
                            'border-width': '',
                            'border-color': '',
                            'border-style': ''
                        });
                    return true;
                }
                if ($(element).hasClass('form-checks')) {
                    $(element)
                        .parent()
                        .css({
                            'border-width': '',
                            'border-color': '',
                            'border-style': ''
                        });
                    return true;
                }
                $(element)
                    .closest('.form-control')
                    .removeClass('is-invalid');
            },
            invalidHandler: function (evt) {
                toastr['error']('Ha ocurrido un error de validación, por favor, verifica todos los campos.');
                evt.preventDefault();
                return false;
            },
            ignoreTitle: true,
            onfocusout: false,
            focusInvalid: true,
            errorPlacement: false,
            ignore: ':hidden,.card-block',
            errorElement: 'span',
            errorClass: 'help-block help-block-error',
            submitHandler: function(form) {
                const formData = $(form).serializeArray();
                const data = {};
                formData.forEach(item => data[item.name] = item.value);
                data.boletin = $('#checkEditarBoletin').is(':checked') ? 1 : 0;
                let datos = JSON.stringify(data);
                $(`${formEditarEmpleado} .btnActualizarEmpleado`).prop({disabled: true});
                $.ajax({
                    url: `/prueba-backend-PHP/actualizar-empleado`,
                    type: 'PUT',
                    contentType: 'application/json',
                    data: datos,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            $(modalEditarEmpleado).modal('hide');
                            $(`${formEditarEmpleado} .btnActualizarEmpleado`).prop({disabled: false});
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.message || 'Error inesperado.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Ha ocurrido un error en la solicitud.');
                        console.error('Error:', error);
                    }
                });
            }
        });
}