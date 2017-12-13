	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Simple Stock</a>
    
    </div>

    <div class="collapse navbar-collapse" >
      <ul class="nav navbar-nav">

        <li class="<?php if (isset($active_productos)){echo $active_productos;}?>"><a href="stock_gerente.php"><i class='glyphicon glyphicon-barcode'></i> Inventario</a></li>
		<li class="<?php if (isset($active_categoria)){echo $active_categoria;}?>"><a href="categorias_gerente.php"><i class='glyphicon glyphicon-tags'></i> Categorías</a></li>
		<li class="<?php if (isset($active_usuarios)){echo $active_usuarios;}?>"><a href="clientes_gerente.php"><i  class='glyphicon glyphicon-user'></i> Distribuidores</a></li>
       </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>