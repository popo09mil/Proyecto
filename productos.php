<?php
include 'db.php';

// Operaciones CRUD
if (isset($_POST['add'])) {
    $nombre = $_POST['nombre'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad = $_POST['cantidad'];
    $ubicacion = $_POST['ubicacion'];

    $conn->query("INSERT INTO PRODUCTOS (Prod_Nombre, Prod_Prec_Compra, Prod_Prec_Venta, Prod_Cantidad, Prod_Ubicacion)
                  VALUES ('$nombre', '$precio_compra', '$precio_venta', '$cantidad', '$ubicacion')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM PRODUCTOS WHERE Prod_ID = $id");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad = $_POST['cantidad'];
    $ubicacion = $_POST['ubicacion'];

    $conn->query("UPDATE PRODUCTOS SET Prod_Nombre='$nombre', Prod_Prec_Compra='$precio_compra', Prod_Prec_Venta='$precio_venta',
                  Prod_Cantidad='$cantidad', Prod_Ubicacion='$ubicacion' WHERE Prod_ID=$id");
}

// Obtener productos
$result = $conn->query("SELECT * FROM PRODUCTOS");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Gestión de Productos</title>
</head>
<body>
    <header>
        <h1>Gestión de Productos</h1>
    </header>
    <form method="POST">
        <h2>Añadir Producto</h2>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="number" name="precio_compra" placeholder="Precio de Compra" required>
        <input type="number" name="precio_venta" placeholder="Precio de Venta" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <input type="text" name="ubicacion" placeholder="Ubicación" required>
        <input type="submit" name="add" value="Añadir Producto">
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Cantidad</th>
                <th>Ubicación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['Prod_ID']; ?></td>
                    <td><?= $row['Prod_Nombre']; ?></td>
                    <td><?= $row['Prod_Prec_Compra']; ?></td>
                    <td><?= $row['Prod_Prec_Venta']; ?></td>
                    <td><?= $row['Prod_Cantidad']; ?></td>
                    <td><?= $row['Prod_Ubicacion']; ?></td>
                    <td>
                        <a href="?delete=<?= $row['Prod_ID']; ?>">Eliminar</a>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $row['Prod_ID']; ?>">
                            <input type="text" name="nombre" value="<?= $row['Prod_Nombre']; ?>" required>
                            <input type="number" name="precio_compra" value="<?= $row['Prod_Prec_Compra']; ?>" required>
                            <input type="number" name="precio_venta" value="<?= $row['Prod_Prec_Venta']; ?>" required>
                            <input type="number" name="cantidad" value="<?= $row['Prod_Cantidad']; ?>" required>
                            <input type="text" name="ubicacion" value="<?= $row['Prod_Ubicacion']; ?>" required>
                            <input type="submit" name="update" value="Actualizar">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>