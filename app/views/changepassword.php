<?php include_once 'header.php' ?>
<div class="card p-4 bg-light">
    <div class="card-header">
        <h1 class="text-center"><?= $data['subtitle'] ?></h1>
    </div>
    <div class="card-body">
        <form action="<?= ROOT ?>login/changePassword/<?= $data['data'] ?>" method="POST">
            <div class="form-group text-left mb-2">
                <label for="password1">Contraseña:</label>
                <input type="password1" name="password1" class="form-control">
            </div>
            <div class="form-group text-left mb-2">
                <label for="password2">Repite la contraseña:</label>
                <input type="password2" name="password2" class="form-control">
            </div>
            <input type="hidden" name="id" value="<?= $data['data'] ?>">
            <div class="form-group text-left">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="row">
            <a href="<?= ROOT ?>login" class="btn btn-info">Regresar</a>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>
