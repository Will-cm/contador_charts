
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="shortcut icon" href="img/logo-mywebsite-urian-viera.svg"/>
  <title>Charts :: Obbso</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
<!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-dark fixed-top" style="background-color: #231fe6 !important;">
    <ul class="navbar-nav mr-auto collapse navbar-collapse">
      <li class="nav-item active">
        <a href="index.php"> 
          <img src="img/logo-mywebsite-urian-viera.svg" alt="Web Developer" width="120">
        </a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
      <h5 class="navbar-brand">Web</h5>
    </div>
</nav>


<div class="container">
<br>
<hr>
<br>

 <div class="row">
    <div class="col-md-5">
      
      <!-- otro -->
      <div class="card">
        <div class="card-header">Sube tu archivo</div>
        <div class="card-body">
          <form class="upload_file">
            <div class="form-group">
              <label for="file">Archivo a subir</label>
              <input type="file" class="form-control form-control-file" name="dataCliente" id="dataCliente" required>
            </div>

            <button class="btn btn-success" type="submit">Subir archivo</button>

            <div class="wrapper mt-5" style="display: none;">
              <div class="progress progress_wrapper">
                <div class="progress-bar progress-bar-striped bg-info progress-bar-animated progress_bar" role="progressbar" style="width: 0%;">0%</div>
              </div>
            </div>
          </form>
          
        </div>
      </div>
      <hr>
      <!-- tabla -->
        <?php 
          include_once 'conexion.php';
          $nombres = array();
          $cantidad_ventas = array();
          $porcentaje_ventas = array();

          $sql_zonas = 'SELECT * FROM departamentos';
          $sentencia_zonas = $pdo->prepare($sql_zonas);
          $sentencia_zonas->execute();
          $resultado_zonas = $sentencia_zonas->fetchAll();
          $total = 0;
          foreach($resultado_zonas as $row){
            $total += $row['cantidad_pedidos'];
            $nombres[] = $row['nombre'];
            $cantidad_ventas[] = $row['cantidad_pedidos'];
          } 
          
          foreach($resultado_zonas as $row){
            if($row['cantidad_pedidos'] > 0){
              $porcentaje_ventas[] = ( $row['cantidad_pedidos'] * 100) / $total;
            }
            
          }
          
          
          //var_dump($resultado_zonas);
        ?>
        <!-- Caja de búsqueda -->
          <input id="searchTerm" placeholder="Buscar" type="text" onkeyup="doSearch()" />
        <table id="regTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Departamento</th>
              <th>Nro de Ventas</th>
            </tr>
          </thead>
          <tbody> 
            <?php foreach($resultado_zonas as $zona): ?>
            <tr>
              <th ><?php echo $zona['id']; ?></th>
              <td style="max-width: 350px; overflow: hidden;"><?php echo $zona['nombre']; ?></td>
              <td><?php echo $zona['cantidad_pedidos']; ?></td>
              
            </tr>
            <?php endforeach ?>
            
          </tbody>
        </table>
        <h6 class="text-center alert alert-dark">
          Total ventas <strong>(<?php echo $total; ?>)</strong>
        </h6>
        <!-- tabla -->  
    </div>

    <div class="col-md-7">
      <br>
      <br>
      <br>
      <br>
      <br>
      <!-- chart -->
      <div style="width: 100%; margin: auto;">
        <canvas id="myChart" width="400" height="400"></canvas>
      </div>
      <!-- chart -->
        
    </div>
  </div>

  <hr>

<!-- Script de mapas -->
</div>

<!-- Script de cargar excel -->
<script type="text/javascript">
  function uploadFile() {
    var form_data = new FormData();
    var files = $("#file-input")[0].files[0];
    form_data.append('dataCliente', files);
      $.ajax({
        url: "upload_excel.php",
        type: "post",
        data: form_data,
        processData: false,
        contentType: false,
      })
      .done(function(res) {
        $('#respuesta').html(res)
        alert('Registros Agregados: ' + res);
      });   
  }
</script>

<!-- Script de búsqueda -->
<script>
  // Busco todos los controles de búsqueda.
  function doSearch() {
      var tableReg = document.getElementById('regTable');
      var searchText = document.getElementById('searchTerm').value.toLowerCase();
      for (var i = 1; i < tableReg.rows.length; i++) {
          var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
          var found = false;
          for (var j = 0; j < cellsOfRow.length && !found; j++) {
              var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
              if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                  found = true;
              }
          }
          if (found) {
              tableReg.rows[i].style.display = '';
          } else {
              tableReg.rows[i].style.display = 'none';
          }
      }
  }
</script>

<script>
  var nombres = <?php echo json_encode($nombres) ?>;
  var porcentaje_ventas = <?php echo json_encode($porcentaje_ventas) ?>;
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/main.js"></script>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script src="js/index.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });      
});
</script>

</body>
</html>