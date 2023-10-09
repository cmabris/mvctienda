<?php include_once (VIEWS . 'header.php') ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center">Usuarios administradores</h1>
    </div>
    <div class="card-body">
        <table class="table table-striped text-center" style="width: 100%">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Modificar</th>
                <th>Borrar</th>
            </thead>
            <tbody>
                <?php foreach ($data['data'] as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>
                        <td><a href="<?= ROOT ?>adminuser/update/<?= $user->id ?>" class="btn btn-info">Modificar</a></td>
                        <td><a href="<?= ROOT ?>adminuser/delete/<?= $user->id ?>" class="btn btn-danger">Borrar</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-6">
                <a href="<?= ROOT ?>adminuser/create" class="btn btn-success">
                    Crear usuario
                </a>
            </div>
        </div>
    </div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>
