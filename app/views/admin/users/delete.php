<?php include_once (VIEWS . 'header.php') ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Vista de usuarios - Eliminación</h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>adminuser/delete/<?= $data['data']->id ?>" method="POST">
            <div class="form-group text-left mb-2">
                <label for="name">Usuario:</label>
                <input type="text" name="name" id="name"
                       class="form-control" required disabled
                       placeholder="Escribe el nombre completo"
                       value="<?= $data['data']->name ?? '' ?>">
            </div>
            <div class="form-group text-left mb-2">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email"
                       class="form-control" required disabled
                       placeholder="Escriba el correo electrónico"
                       value="<?= $data['data']->email ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="status">Selecciona el estado</label>
                <select name="status" id="status" class="form-control" disabled>
                    <option value="">Selecciona el estado del usuario</option>
                    <?php foreach($data['status'] as $status): ?>
                        <option value="<?= $status->value ?>" <?= $status->value == $data['data']->status ? 'selected' : '' ?>><?= $status->description ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group text-left mt-4">
                <input type="submit" value="Eliminar" class="btn btn-success">
                <a href="<?= ROOT ?>adminuser" class="btn btn-info">Regresar</a>
                <p class="mt-2">Una vez eliminado, los datos no serán recuperables</p>
            </div>
        </form>
    </div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>

