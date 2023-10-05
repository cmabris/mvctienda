<?php include_once (dirname(__DIR__). ROOT . 'header.php') ?>
<?php if(isset($data['errors']) && count($data['errors']) > 0): ?>
    <div class="alert alert-danger mt-3">
        <?php foreach ($data['errors'] as $value): ?>
            <strong><?= $value ?></strong><br>
        <?php endforeach; ?>
    </div>
<?php endif ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Módulo de Administración</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>admin/verifyUser" method="POST">
            <div class="form-group text-left mb-2">
                <label for="user">Usuario:</label>
                <input type="text" name="user" class="form-control"
                       placeholder="Escribe tu correo electrónico"
                       value="<?= $data['data']['user'] ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" class="form-control"
                       value="<?= $data['data']['password'] ?? '' ?>">
            </div>
            <div class="form-group text-left">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>


<?php include_once (dirname(__DIR__). ROOT . 'footer.php') ?>

