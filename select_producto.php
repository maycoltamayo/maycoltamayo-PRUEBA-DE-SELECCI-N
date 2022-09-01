<?php
$conexion = mysqli_connect('localhost','root','','db_tecnoparque');
if ($_POST) {
    $categorias=$_POST['categorias'];


$sql = "SELECT * FROM productos WHERE id_categorias='$categorias'";
$result=mysqli_query($conexion,$sql);

$cadena="<label>Productos</label> 
			<select id='productos' name='productos' class='form-control'>";

            while ($ver=mysqli_fetch_row($result)) {
                $cadena=$cadena.'<option  value='.$ver[0].' >'.utf8_encode($ver[2]).'</option>';
            }
            echo  $cadena."</select>";
}
?>