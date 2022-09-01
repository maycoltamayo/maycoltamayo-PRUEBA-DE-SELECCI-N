<?php
$conexion = mysqli_connect('localhost','root','','db_tecnoparque');
if ($_POST) {
    $cantidad=$_POST['cantidad'];
    $producto=$_POST['producto'];


$sql = "SELECT * FROM productos WHERE id='$producto'";
$result=mysqli_query($conexion,$sql);
$cadena = "<tr>";

            while ($ver=mysqli_fetch_row($result)) {
                // logica cantidad 
                $valorTotal = $ver[4] * $cantidad;
                $cadena=$cadena.'<td> '.$ver[2].' </td>';
                $cadena=$cadena.'<td> '.$cantidad.' </td>';
                $cadena=$cadena.'<td> '.$ver[4].' </td>';
                $cadena=$cadena.'<td class="producto'.$ver[0].'">'.$valorTotal.'</td>';
                
            }
            echo  $cadena."</tr>";
}
?>