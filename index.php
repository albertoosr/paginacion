<?php include_once('backend/conexion.php');
if (!$_GET) {
    header('Location:index.php?pagina=1');
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Paginación</title>
</head>

<body>
    <div class="container py-5">

    <!-- mensajes -->
    <?php if(isset($_SESSION['mensaje'])){ ?>
    <div class="alert alert-<?php echo $_SESSION['tipo'] ?> alert-dismissible fade show" role="alert">
         <strong><?php echo $_SESSION['mensaje']; ?></strong> 
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
     </button>
    </div>
    <?php session_unset(); } ?>

        <label class="h3 py-4" for="title">Paginación y registro de usuario</label>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Agregar</button>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Level</th>
                    <th scope="col">Status</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <!-- segunda consulta -->

            <?php

            $mostrar = 5;
            $operacion = ($_GET['pagina'] - 1) * $mostrar;
            $consulta2 = 'SELECT * FROM t_usuarios LIMIT :operacion,:mostrar';
            $articulos = $conexion->prepare($consulta2);
            $articulos->bindParam(':operacion', $operacion, PDO::PARAM_INT);
            $articulos->bindParam(':mostrar', $mostrar, PDO::PARAM_INT);
            $articulos->execute();

            $resultado2 = $articulos->fetchAll();

            ?>

            <tbody>
                <?php foreach ($resultado2 as $datos) : ?>
                    <tr>
                        <th scope="row"><?php echo $datos['id_usuario'] ?></th>
                        <td><?php echo $datos['correo'] ?></td>
                        <td><?php echo $datos['contrapass'] ?></td>
                        <td><?php echo $datos['nevel'] ?></td>
                        <td><?php echo $datos['status'] ?></td>
                        <td><?php echo $datos['images'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?php
        $consulta = 'SELECT * FROM t_usuarios';
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $total = $resultado->rowCount();
        $paginas = $total / 5;
        $paginas = ceil($paginas);
        ?>

        <!-- paginador -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
                <li class="page-item">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <?php for ($n = 0; $n < $paginas; $n++) : ?>
                    <li class="page-item <?php echo $_GET['pagina'] == $n + 1 ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?pagina=<?php echo $n + 1; ?>"><?php echo $n + 1; ?></a>
                    </li>
                <?php endfor ?>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="backend/registro.php" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" required aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" required  placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Nevel</label>
                            <select class="form-control" name="nevel" id="exampleFormControlSelect1">
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-success" value="Register">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>