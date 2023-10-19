<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Iniciar Sesión</li>
            <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
            <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
            <li class="breadcrumb-item"><a href="#">Verificar los datos</a></li>
        </ol>
    </nav>
    <h2><?= $data['subtitle'] ?></h2>
        <form class="text-left">
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" class="form-control"
                       required placeholder="Escribe tu correo electrónico">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control"
                       required placeholder="Escribe tu contraseña">
            </div>
            <div class="form-group">
                <a href="<?= ROOT ?>cart/address" class="btn btn-success">Enviar</a>
            </div>
        </form>
</div>
<?php include_once (VIEWS . 'footer.php') ?>