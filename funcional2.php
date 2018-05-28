<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
//Creamos la conexión
   $server = "148.202.89.3";
   $user = "sicaweb";
   $pass = "20sic@18?**";
   $BD = "checador";
   $conexion = mysqli_connect($server,$user,$pass,$BD);
   //generamos la consulta
   //if(!$result = mysqli_query($conexion, $sql));
   
   $sql = "SELECT * FROM administradores";
           mysqli_query($conexion,$sql);
   
   if(!$result = mysqli_query($conexion, $sql)) die(); //modificacion

   $rawdata = array();
   //guardando datos en array multidimencional
   $i=0;

   while($row = mysqli_fetch_array($result))
   {
       $rawdata[$i] = $row;
       $i++;
   }

   $close = mysqli_close($conexion);
?>
        <div class="container">
            <h2>Export Data to Excel with PHP and MySQL</h2>
            <div class="well-sm col-sm-12">
                <div class="btn-group pull-right">
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                        <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
                    </form>
                </div>
            </div>
            <table id="" class="table table-striped table-bordered">
                <tr>
                    <th>codigo</th>
                    <th>Nombre</th>
                </tr>
                <tbody>
                    <?php foreach ($sql as $developer) { ?>
                        <tr>
                            <td><?php echo $developer ['codigo']; ?></td>
                            <td><?php echo $developer ['nombre']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        if (isset($_POST["export_data"])) {
            $filename = "phpzag_data_export_" . date('Ymd') . ".ods";
            header("Content-Type: application/vnd.ms-start scalc.exe");
            header("Content-Disposition: attachment; filename=".$filename);
            $show_coloumn = false;
            if (!empty($sql)) {
                foreach ($sql as $record) {
                    if (!$show_coloumn) {
                    // display field/column names in first row
                        echo implode("t", array_keys($record)) . "n";
                        $show_coloumn = true;
                    }
                    echo implode("t", array_values($record)) . "n";
                }
            }
            exit;
        }
        ?>
    </body>
</html>