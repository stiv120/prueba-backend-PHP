<div class="modal fade" id="modalCrearEmpleado" tabindex="-1" aria-labelledby="modalCrearEmpleadoLabel" aria-hidden="true">
    <form id="formCrearEmpleado">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCrearEmpleadoLabel">Crear Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        include_once 'resources/views/gestion-empleados/crear.php';
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btnGuardarEmpleado"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="modalEditarEmpleado" tabindex="-1" aria-labelledby="modalEditarEmpleadoLabel" aria-hidden="true">
    <form id="formEditarEmpleado">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarEmpleadoLabel">Editar Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                        include_once 'resources/views/gestion-empleados/editar.php';
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary btnActualizarEmpleado"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </form>
</div>