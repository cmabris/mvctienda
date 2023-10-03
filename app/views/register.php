<?php include_once 'header.php' ?>
<?php if(isset($data['errors']) && count($data['errors']) > 0): ?>
    <div class="alert alert-danger mt-3">
        <?php foreach ($data['errors'] as $value): ?>
            <strong><?= $value ?></strong><br>
        <?php endforeach; ?>
    </div>
<?php endif ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Registro</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>login/registro" method="POST">
            <div class="form-group text-left mb-2">
                <label for="first_name">Nombre:</label>
                <input type="text" name="first_name" id="first_name"
                       class="form-control" required
                       placeholder="Escribe tu nombre"
                       value="<?= $data['dataForm']['first_name'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="last_name_1">Primer apellido:</label>
                <input type="text" name="last_name_1" id="last_name_1"
                       class="form-control" required
                       placeholder="Escribe tu primer apellido"
                       value="<?= $data['dataForm']['last_name_1'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="last_name_2">Segundo apellido:</label>
                <input type="text" name="last_name_2" id="last_name_2"
                       class="form-control"
                       placeholder="Escribe tu segundo apellido"
                       value="<?= $data['dataForm']['last_name_2'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email"
                       class="form-control" required
                       placeholder="Escriba su correo electrónico"
                       value="<?= $data['dataForm']['email'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password1">Contraseña:</label>
                <input type="password" name="password1"
                       class="form-control" required
                       placeholder="Escribe una contraseña">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password2">Repita la contraseña:</label>
                <input type="password" name="password2"
                       class="form-control" required
                       placeholder="Repite la contraseña">
            </div>
            <div class="form-group text-left mb-2">
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address"
                       class="form-control" required
                       placeholder="Escribe tu dirección"
                       value="<?= $data['dataForm']['address'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="city">Ciudad:</label>
                <input type="text" name="city" id="city"
                       class="form-control" required
                       placeholder="Escribe tu ciudad"
                       value="<?= $data['dataForm']['city'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="state">Provincia:</label>
                <input type="text" name="state" id="state"
                       class="form-control" required
                       placeholder="Escribe tu provincia"
                       value="<?= $data['dataForm']['state'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="postcode">Código Postal:</label>
                <input type="text" name="postcode" id="postcode"
                       class="form-control" required
                       placeholder="Escribe tu código postal"
                       value="<?= $data['dataForm']['postcode'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="country">País:</label>
                <input type="text" name="country" id="country"
                       class="form-control" required
                       placeholder="Escribe tu país"
                       value="<?= $data['dataForm']['country'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Enviar datos" class="btn btn-success">
                <a href="<?= ROOT ?>login" class="btn btn-info">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<?php include_once 'footer.php' ?>
