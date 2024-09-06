<?php
    include_once 'Models/Rol.php';
    include_once 'Models/Area.php';

    $objDb = new DbConnect();
    $conn = $objDb->connect();
    
    $rol = new Rol($conn);
    $roles = $rol->obtenerRoles();
    $area = new Area($conn);
    $areas = $area->obtenerAreas();
?>
<div class="alert alert-primary" role="alert">
    Los campos con asteriscos (*) son obligatorios.
</div>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Nombre completo *</label>
    </div>
    <div class="col-md-9">
        <input required type="text" class="form-control claseTexto" name="nombre">
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Correo electrónico *</label>
    </div>
    <div class="col-md-9">
        <input required type="text" class="form-control claseTexto" name="email">
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Sexo *</label>
    </div>
    <div class="col-md-9">
        <div class="form-check">
            <input required class="form-check-input" type="radio" name="sexo" id="sexo1" value="M">
            <label class="form-check-label" for="sexo1">
                Masculino
            </label>
        </div>
        <div class="form-check">
            <input required class="form-check-input" type="radio" name="sexo" id="sexo2" value="F">
            <label class="form-check-label" for="sexo2">
                Femenino
            </label>
        </div>
        <span class="form-checks"></span>
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Área *</label>
    </div>
    <div class="col-md-9">
        <select name="area_id" class="form-control claseTexto" required>
            <?php foreach ($areas as $area): $id = $area['id'];$nombre = $area['nombre'];?>
                <option value="<?php echo $id?>"><?php echo htmlspecialchars($nombre);?></option>
            <?php endforeach;?>
        </select>
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Descripción *</label>
    </div>
    <div class="col-md-9">
        <textarea class="form-control claseTexto" name="descripcion" rows="3" required></textarea>
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2"></label>
    </div>
    <div class="col-md-9">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="checkBoletin" name="boletin">
            <label class="form-check-label" for="checkBoletin">
                Deseo recibir boletín informativo
            </label>
        </div>
    </div>
</div><br>
<div class="form-group row">
    <div class="col-md-3 text-end">
        <label class="fs-6 fw-semibold mb-2 required">Roles *</label>
    </div>
    <div class="col-md-9">
        <?php foreach ($roles as $rol): $id = $rol['id'];$nombre = $rol['nombre'];?>
            <div class="form-check">
                <input required class="form-check-input" type="checkbox"
                    id="option<?php echo $id?>"
                    name="roles[]" value="<?php echo $id;?>">
                <label class="form-check-label" for="option1">
                    <?php echo $nombre;?>
                </label>
            </div>
        <?php endforeach;?>
        <span class="form-checks"></span>
    </div>
</div>