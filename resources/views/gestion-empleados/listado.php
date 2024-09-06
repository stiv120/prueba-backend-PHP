<?php
    include_once 'Models/Empleado.php';

    $objDb = new DbConnect();
    $conn = $objDb->connect();
    
    $empleado = new Empleado($conn);
    $empleados = $empleado->obtenerEmpleados();
?>
<table class="table table-stripered" id="tabla-empleados" data-toggle="table" data-pagination="true" data-search="true">
    <thead>
        <th><i class="fa-solid fa-user"></i> Nombre</th>
        <th><i class="fas fa-at"></i> Email</th>
        <th><i class="fas fa-venus-mars"></i> Sexo</th>
        <th><i class="fa-solid fa-briefcase"></i> Área</th>
        <th><i class="fa-solid fa-envelope"></i> Boletín</th>
        <th>Modificar</th>
        <th>Eliminar</th>
    </thead>
    <tbody>
        <?php foreach ($empleados as $empleado): ?>
            <tr>
                <td><?php echo $empleado['nombre']?></td>
                <td><?php echo $empleado['email']?></td>
                <td><?php echo $empleado['sexo'] == 'M' ? 'Masculino' : 'Femenino';?></td>
                <td><?php echo $empleado['area_id'] == 1 ? 'Administrativo' : 'Prestacón de servicios';?></td>
                <td><?php echo $empleado['boletin'] ? 'Si' : 'No';?></td>
                <td class="text-center">
                    <button type="button" class="btn btn-primary btnEditarEmpleado" data-modificar="<?php echo $empleado['id']?>;">
                        <i class="fa fa-edit"></i></button>
                    </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btnEliminarEmpleado" data-eliminar="<?php echo $empleado['id']?>;">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>