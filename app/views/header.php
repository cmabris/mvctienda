<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $data['title'] ?></title>
    <script src="https://kit.fontawesome.com/c858fc57f5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a href="<?= ROOT ?>shop" class="navbar-brand">Tienda</a>
    <div class="collapse navbar-collapse" id="menu">
        <?php if ($data['menu']): ?>
            <ul class="nav navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="<?= ROOT . 'courses' ?>" class="nav-link
                    <?= (isset($data['active']) && $data['active'] == 'courses') ? 'active' : '' ?>">Cursos</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT . 'books' ?>" class="nav-link
                    <?= (isset($data['active']) && $data['active'] == 'books') ? 'active' : '' ?>">Libros</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT . 'shop/whoami' ?>" class="nav-link
                    <?= (isset($data['active']) && $data['active'] == 'whoami') ? 'active' : '' ?>">Quienes somos</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT . 'shop/contact' ?>" class="nav-link
                    <?= (isset($data['active']) && $data['active'] == 'contact') ? 'active' : '' ?>">Contacto</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right mt-2 mt-lg-0">
                <?php if (isset($_SESSION['cartTotal']) && $_SESSION['cartTotal'] > 0): ?>
                <li class="nav-item">
                    <a href="<?= ROOT ?>cart" class="nav-link">Carrito: <?= number_format($_SESSION['cartTotal'], 2) ?> &euro;</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <form action="<?= ROOT ?>search/products" class="d-flex form-inline" method="POST">
                        <input type="text" name="search" id="search" class="form-control"
                               size="20" placeholder="¿producto?" required>
                        <button type="submit" class="btn btn-light">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT . 'shop/logout' ?>" class="nav-link">Salir</a>
                </li>
            </ul>
        <?php endif; ?>
        <?php if (isset($data['admin']) && $data['admin']): ?>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminuser" class="nav-link">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT ?>adminproduct" class="nav-link">Productos</a>
                </li>
                <li class="nav-item">
                    <a href="<?= ROOT ?>admincarts/sales" class="nav-link">Ventas</a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-8">
