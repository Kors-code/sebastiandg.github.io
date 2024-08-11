<?php
session_start();

$id_actual = "";
$id = "";
$producto = "";
$precio = "";
$tipo = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include 'conexion.php';
    $query = "SELECT * FROM productos WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $id_actual = $row['id'];
        $producto = $row['producto'];
        $precio = $row['precio'];
        $tipo = $row['tipo'];
    }
}

if (isset($_POST['btnActualizar'])) {
    $id_actual = $_POST['id_actual'];
    $nuevo_id = $_POST['nuevo_id'];
    $tipo = $_POST['tipo'];
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];

    include 'conexion.php';

    $query = "UPDATE productos SET id='$nuevo_id', producto='$producto', precio='$precio', tipo='$tipo' WHERE id='$id_actual'";

    $ejq = mysqli_query($conn, $query);
    if ($ejq) {
        echo "<div class='alert alert-success mt-3'>Se actualizó el producto correctamente</div>";
        header("Location: mostrarproductos.php");
        exit();
    } else {
        echo "<div class='alert alert-danger mt-3'>Hay un error en la consulta: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include('navbar.html'); ?>

<div class="container mt-5">
    <h1 class="text-center p-4 bg-primary text-white rounded">Actualizar Producto</h1>
    <form class="row g-3 p-4 bg-light" action="actualizar.php" method="POST">
        <input type="hidden" name="id_actual" value="<?php echo $id_actual; ?>">
        
        <div class="col-md-6 mb-3">
            <label for="nuevo_id" class="form-label">Nuevo ID</label>
            <input type="text" class="form-control" name="nuevo_id" id="nuevo_id" value="<?php echo $id; ?>" required>
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="inputState" class="form-label">Tipo</label>
            <select id="inputState" name="tipo" class="form-select" required>
                <option value="Aseo" <?php echo ($tipo == 'Aseo') ? 'selected' : ''; ?>>Aseo</option>
                <option value="Empaques" <?php echo ($tipo == 'Empaques') ? 'selected' : ''; ?>>Empaques</option>
                <option value="Verduras" <?php echo ($tipo == 'Verduras') ? 'selected' : ''; ?>>Verduras</option>
                <option value="Alchol" <?php echo ($tipo == 'Alchol') ? 'selected' : ''; ?>>Alchol</option>
            </select>
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="producto" class="form-label">Producto</label>
            <input type="text" class="form-control" name="producto" id="producto" value="<?php echo $producto; ?>" required>
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="precio" class="form-label">Nuevo precio</label>
            <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $precio; ?>" required>
        </div>
        
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary btn-lg" name="btnActualizar">Actualizar</button>
        </div>
    </form>
</div>

</body>
</html>
