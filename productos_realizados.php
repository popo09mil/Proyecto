<?php
include 'db.php';

// Operaciones CRUD
if (isset($_POST['add'])) {
    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio_realizacion = $_POST['precio_realizacion'];
    $detalle_producto = $_POST['detalle_producto'];

    $conn->query("INSERT INTO PRODUCTO_REALIZADO (PRe_Cantidad, PRe_Nombre, PRe_Referencia, PRe_Prec_Realizacion, Detalle_producto)
                  VALUES ('$cantidad', '$nombre', '$referencia', '$precio_realizacion', '$detalle_producto')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM PRODUCTO_REALIZADO WHERE PRe_ID = $id");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio_realizacion = $_POST['precio_realizacion'];
    $detalle_producto = $_POST['detalle_producto'];

    $conn->query("UPDATE PRODUCTO_REALIZADO SET 
                  PRe_Cantidad='$cantidad', 
                  PRe_Nombre='$nombre', 
                  PRe_Referencia='$referencia', 
                  PRe_Prec_Realizacion='$precio_realizacion', 
                  Detalle_producto='$detalle_producto' 
                  WHERE PRe_ID=$id");
}

// Obtener productos realizados
$result = $conn->query("SELECT * FROM PRODUCTO_REALIZADO");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Gestión de Productos Realizados</title>
</head>
<body>
    <header>
        <h1>Gestión de Productos Realizados</h1>
    </header>
    <form method="POST">
        <h2>Añadir Producto Realizado</h2>
        <input type="number" name="cantidad" placeholder="Cantidad" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="referencia" placeholder="Referencia" required>
        <input type="number" step="0.01" name="precio_realizacion" placeholder="Precio Realización" required>
        <input type="text" name="detalle_producto" placeholder="Detalle del Producto" required>
        <input type="submit" name="add" value="Añadir Producto Realizado">
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cantidad</th>
                <th>Nombre</th>
                <th>Referencia</th>
                <th>Precio Realización</th>
                <th>Detalle del Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['PRe_ID']; ?></td>
                    <td><?= $row['PRe_Cantidad']; ?></td>
                    <td><?= $row['PRe_Nombre']; ?></td>
                    <td><?= $row['PRe_Referencia']; ?></td>
                    <td><?= $row['PRe_Prec_Realizacion']; ?></td>
                    <td><?= $row['Detalle_producto']; ?></td>
                    <td>
                        <!-- Botón de Eliminar -->
                        <a href="?delete=<?= $row['PRe_ID']; ?>">Eliminar</a>
                        
                        <!-- Formulario para Editar -->
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $row['PRe_ID']; ?>">
                            <input type="number" name="cantidad" value="<?= $row['PRe_Cantidad']; ?>" required>
                            <input type="text" name="nombre" value="<?= $row['PRe_Nombre']; ?>" required>
                            <input type="text" name="referencia" value="<?= $row['PRe_Referencia']; ?>" required>
                            <input type="number" step="0.01" name="precio_realizacion" value="<?= $row['PRe_Prec_Realizacion']; ?>" required>
                            <input type="text" name="detalle_producto" value="<?= $row['Detalle_producto']; ?>" required>
                            <input type="submit" name="update" value="Actualizar">
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>