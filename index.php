<!DOCTYPE html>
<?php
$conexion = mysqli_connect('localhost', 'root', '', 'db_tecnoparque');
$categorias = "select * from categorias";
$productos = "select * from productos";

$result = mysqli_query($conexion, $categorias);
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <title>Document</title>
</head>

<body>
    <div class='container'>
        <h1 class='text-center m-2'>PRUEBA DE SELECCIÓN PARA PRACTICANTES</h1>
        <div class='form-group'>
            <label>Categorias</label>
            <select id="categorias" name="categorias" class='form-control'>
                <?php
                while ($ver = mysqli_fetch_row($result)) { ?>
                    <option value="<?php echo $ver[0]; ?>"><?php echo $ver[1]; ?></option>
                <?php }
                ?>
            </select>
        </div>
        <div class='form-group'>
            <div id="select2lista">

            </div>
        </div>
        <div class='form-group'>
            <label for="">Cantidad</label>
            <input type="number" id="cantidad" class='form-control'>
        </div>
        <div class='form-group'>
            <input type="submit" id="Agregar" value="Agregar" onclick="agregarProducto();">
        </div>

        <div class='form-group'>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>valor unitario</th>
                        <th>valor total</th>
                    </tr>
                </thead>
                <tbody id="factura">

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Valor a Pagar</th>
                        <th id="valor"></th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#categorias').val(1);
        recargarLista();

        $('#categorias').change(function() {
            recargarLista();
        });
    })
</script>
<script type="text/javascript">
    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "select_producto.php",
            data: "categorias=" + $('#categorias').val(),
            success: function(r) {
                $('#select2lista').html(r);
            }
        });
    }

    function agregarProducto() {
        $.ajax({
            type: "POST",
            url: "producto.php",
            data: "producto=" + $('#productos').val() + '&cantidad=' + $('#cantidad').val(),
            success: function(r) {
                $('#factura').append(r);

                var suma = 0;
                $('td').each(function() {
                    if ($(this).attr('class'))
                        suma += parseFloat($(this).text().replace(/,/g, ''), 10);
                });
                $('#valor').html('$'+suma);
                
            }
        });
    }
</script>