'use strict';

const formCrearEmpleado = '#formCrearEmpleado';
const modalCrearEmpleado = '#modalCrearEmpleado';

$(_=> {
    toastr.options = {
        "debug": false,
        "onclick": null,
        "timeOut": "5000",
        "newestOnTop": true,
        "progressBar": true,
        "closeButton": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "extendedTimeOut": "1000",
        "preventDuplicates": false,
        "positionClass": "toast-top-right"
    };
    // Validar el formulario
    $(formCrearEmpleado).validate({
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
            data.boletin = $('#checkBoletin').is(':checked') ? 1 : 0;
            data.roles = $('#checkBoletin').is(':checked') ? 1 : 0;
            let datos = JSON.stringify(data);
            $(`${formCrearEmpleado} .btnGuardarEmpleado`).prop({disabled: true});
            $.ajax({
                url: '/prueba-backend-PHP/crear-empleado',
                type: 'POST',
                contentType: 'application/json',
                data: datos,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $(modalCrearEmpleado).modal('hide');
                        $(formCrearEmpleado)
                            .find('.claseTexto')
                            .val('');
                        $(formCrearEmpleado)
                            .find('.form-check-input')
                            .prop('checked', false)
                            .trigger('change');
                        $(`${formCrearEmpleado} .btnGuardarEmpleado`).prop({disabled: false});
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
});