<?php include_once (VIEWS . 'header.php') ?>
<div class="card" id="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Iniciar Sesión</a></li>
            <li class="breadcrumb-item"><a href="#">Datos de envío</a></li>
            <li class="breadcrumb-item"><a href="#">Forma de pago</a></li>
            <li class="breadcrumb-item"><a href="#">Verificar los datos</a></li>
            <li class="breadcrumb-item">Gracias por su compra</li>
        </ol>
    </nav>
    <h2>Estimado/a <?= $data['data']->first_name ?>:</h2>
    <h4>¡Gracias por visitarnos y hacer su compra!</h4>
    <h5>Estamos contentos de que haya encontrado lo que buscaba. Nuestro objetivo es que siempre esté satisfecho/a. Esperamos volver a verle pronto.</h5>
    <h3>¡Qué tenga un bonito día!</h3>
    <br>
    &nbsp;
    <br>
    <h3>Atentamente:</h3>
    <br>
    <h3>Sus amigos de MVCTienda</h3>
    <br>
    <div>
        <a href="<?= ROOT ?>shop" class="btn btn-success" role="button">Regresar a la tienda</a>
    </div>
</div>
<?php include_once (VIEWS . 'footer.php') ?>
