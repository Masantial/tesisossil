<p class="lead">
</p>
<ul class="breadcrumb" style="margin-bottom: 5px;">
    <li>
        <a href="./pdf/listadoclientes.php?"><i class="fa fa-print" aria-hidden="true"></i> &nbsp; Imprimir Listado de Clientes</a>      
    </li>
</ul>
<div class="container">
	<div class="row">
		<div class="col-xs-12">            
            <div class="panel panel-info">
           
                <div class="panel-heading text-center"><h4>Listado de Clientes</h4></div>
              	<div class="table-responsive">
                  <table class="table table-striped table-hover">
                      	<thead>
                          	<tr>
								<th class="text-center">#</th>
                              	<th class="text-center">DNI</th>
                              	<th class="text-center">Nombre</th>
                                <th class="text-center">Apellido</th>
                              	<th class="text-center">Dirección</th>
                              	<th class="text-center">Telefono</th>
                              	<th class="text-center">Mail</th>

                          	</tr>
                      	</thead>
                      	<tbody>
                          	<?php
								$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
								mysqli_set_charset($mysqli, "utf8");

								$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
								$regpagina = 30;
								$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

								$clientes=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM cliente LIMIT $inicio, $regpagina");

								$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
								$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

								$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

								$cr=$inicio+1;
                                while($prov=mysqli_fetch_array($clientes, MYSQLI_ASSOC)){
                            ?>
							<tr>
								<td class="text-center"><?php echo $cr; ?></td>
								<td class="text-center"><?php echo $prov['NIT']; ?></td>
								<td class="text-center"><?php echo $prov['NombreCompleto']; ?></td>
                                <td class="text-center"><?php echo $prov['Apellido']; ?></td>
								<td class="text-center"><?php echo $prov['Direccion']; ?></td>
								<td class="text-center"><?php echo $prov['Telefono']; ?></td>
								<td class="text-center"><?php echo $prov['Email']; ?></td>								
							</td>
                            <?php
                            	$cr++;
                                }
                            ?>
                      	</tbody>
                  </table>
              	</div>
                <?php if($numeropaginas>=1): ?>
              	<div class="text-center">
                  <ul class="pagination">
                    <?php if($pagina == 1): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=clientlist&pag=<?php echo $pagina-1; ?>">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="configAdmin.php?view=clientlist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="configAdmin.php?view=clientlist&pag='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    ?>
                    

                    <?php if($pagina == $numeropaginas): ?>
                        <li class="disabled">
                            <a>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="configAdmin.php?view=clientlist&pag=<?php echo $pagina+1; ?>">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                  </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
	</div>
</div>