<?php
include './library/configServer.php';
include './library/consulSQL.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="assets\img\logosolo.png">

    <title>Ossil Envases</title>
    <?php include './inc/link.php'; ?>
</head>

<body id="container-page-product">
    <?php include './inc/navbar.php'; ?>
    <section id="store">
        <br>
        <div class="container">
            <div class="page-header">
                <h1>PRODUCTOS <small class="tittles-pages-logo">Ossil Envases</small></h1>
            </div>

            <?php
         
              $checkAllCat=ejecutarSQL::consultar("SELECT * FROM categoria");
             if(mysqli_num_rows($checkAllCat)>=1):
            ?>
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <form action="./search.php" method="GET">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                            <input type="text" id="addon1" class="form-control" name="term" required=""
                                title="Escriba nombre o marca del producto">
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-raised" type="submit">Buscar</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        <?php
                $categoria=consultasSQL::clean_string($_GET['categ']);
                if(isset($categoria) && $categoria!=""){
            ?>
        <div class="row">
            <?php
                  $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                  mysqli_set_charset($mysqli, "utf8");

                  $pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
                  $regpagina = 20;
                  $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                  $consultar_productos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM producto WHERE CodigoCat='$categoria' AND Stock > 0 AND Estado='Activo' LIMIT $inicio, $regpagina");

                  $selCat=ejecutarSQL::consultar("SELECT * FROM categoria WHERE CodigoCat='$categoria'");
                  $datCat=mysqli_fetch_array($selCat, MYSQLI_ASSOC);

                  $totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
                  $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);
        
                  $numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

                  if(mysqli_num_rows($consultar_productos)>=1){
                    echo '<h3 class="text-center">Se muestran los productos de la categoría <strong>"'.$datCat['Nombre'].'"</strong></h3><br>';
                    while($prod=mysqli_fetch_array($consultar_productos, MYSQLI_ASSOC)){
                ?>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img class="img-product" src="./assets/img-products/<?php if($prod['Imagen']!="" && is_file("./assets/img-products/".$prod['Imagen'])){ echo $prod['Imagen']; }else{ echo "default.png"; } ?>
                           ">
                    <div class="caption">
                        <h3><?php echo $prod['NombreProd']; ?></h3>
                        <p> Marca <?php echo $prod['Marca']; ?>
                            // Codigo <?php echo $prod['CodigoProd']; ?></p>

                        <?php if($prod['Descuento']>0): ?>
                        <p>
                            <?php
                             $pref=number_format($prod['Precio']-($prod['Precio']*($prod['Descuento']/100)), 2, '.', '');
                             echo $prod['Descuento']."% descuento: $".$pref; 
                             ?>
                        </p>
                        <?php else: ?>
                        <p>$<?php echo $prod['Precio']; ?></p>
                        <?php endif; ?>
                        <p class="text-center">
                            <a href="infoProd.php?CodigoProd=<?php echo $prod['CodigoProd']; ?>"
                                class="btn btn-primary btn-raised btn-sm btn-block"><i class="fa fa-plus"></i>&nbsp;
                                Detalles</a>
                        </p>

                    </div>
                </div>
            </div>
            <?php    
                  }
                  if($numeropaginas>0):
                ?>
            <div class="clearfix"></div>
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
                        <a href="product.php?categ=<?php echo $categoria; ?>&pag=<?php echo $pagina-1; ?>">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>


                    <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="product.php?categ='.$categoria.'&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="product.php?categ='.$categoria.'&pag='.$i.'">'.$i.'</a></li>';
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
                        <a href="product.php?categ=<?php echo $categoria; ?>&pag=<?php echo $pagina+1; ?>">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php
                  endif;
                  }else{
                    echo '<h2 class="text-center">Lo sentimos, no hay productos registrados en la categoría <strong>"'.$datCat['Nombre'].'"</strong></h2>';
                  }
                ?>
        </div>
        <?php
                }else{

                
                }
              else:
                
                echo '<h2 class="text-center">Lo sentimos, no hay productos ni categorías registradas en la tienda</h2>';
              endif;
            ?>
        </div>
        </li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <br><br>
                    <div class="panel panel-info">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-raised dropdown-toggle" type="button"
                                            id="drpdowncategory" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                            Categoría &nbsp;
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="drpdowncategory">
                                            <?php 
                          while($cate=mysqli_fetch_array($checkAllCat, MYSQLI_ASSOC)){
                              echo '
                                <li><a href="product.php?categ='.$cate['CodigoCat'].'">'.$cate['Nombre'].'</a></li>
                                <li role="separator" class="divider"></li>
                              ';
                          }
                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-heading text-left">
                                    <h4>Listado de Productos</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="">
                                            <tr>
                                                <th class="text-center">Foto</th>
                                                <th class="text-center">Código Producto</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Categoria</th>
                                                <th class="text-center"></th>
                                                <th class="text-right">Precio</th>
                                                <th class="text-center">Modelo</th>
                                                <th class="text-center">Marca</th>
                                                <th class="text-center">Stock</th>
                                                <th class="text-right">Info</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                        	$mysqli = mysqli_connect(SERVER, USER, PASS, BD);
							mysqli_set_charset($mysqli, "utf8");

							$pagina = isset($_GET['pag']) ? (int)$_GET['pag'] : 1;
							$regpagina = 10;
							$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

							$productos=mysqli_query($mysqli,"SELECT SQL_CALC_FOUND_ROWS * FROM producto where Estado='Activo' and stock>'0' LIMIT $inicio, $regpagina"  );

							$totalregistros = mysqli_query($mysqli,"SELECT FOUND_ROWS()");
							$totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

							$numeropaginas = ceil($totalregistros["FOUND_ROWS()"]/$regpagina);

							$cr=$inicio+1;
                            while($prod=mysqli_fetch_array($productos, MYSQLI_ASSOC)){
                        ?>
                                            <tr>
                                                <td> <img class="img-product" src="./assets/img-products/<?php if($prod['Imagen']!="" && is_file("./assets/img-products/".$prod['Imagen'])){ echo $prod['Imagen']; }else{ echo "default.png"; } ?>
                           " width="90px"></td>

                                                <td class="text-center"><?php echo $prod['CodigoProd']; ?></td>
                                                <td class="text-center"><?php echo $prod['NombreProd']; ?></td>
                                                <td class="text-center">
                                                    <?php 
                        			$categ=ejecutarSQL::consultar("SELECT Nombre FROM categoria WHERE CodigoCat='".$prod['CodigoCat']."'");
                        			$datc=mysqli_fetch_array($categ, MYSQLI_ASSOC);
                        			echo $datc['Nombre'];
                        		?>
                                                <td class="text-right">
                                                </td>
                                                <td class="text-center">$<?php echo $prod['Precio']; ?></td>
                                                <td class="text-center"><?php echo $prod['Modelo']; ?></td>
                                                <td class="text-center"><?php echo $prod['Marca']; ?></td>
                                                <td class="text-center"><?php echo $prod['Stock']; ?></td>


                                                <td class="text-right">
                                                    <a href="infoProd.php?CodigoProd=<?php echo $prod['CodigoProd']; ?>"
                                                        class="btn btn-info btn-sm"></button><i
                                                            class="fa fa-plus"></i>&nbsp; Info</a>


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
                                            <a href="product.php?view=productlist&pag=<?php echo $pagina-1; ?>">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        <?php endif; ?>


                                        <?php
                        for($i=1; $i <= $numeropaginas; $i++ ){
                            if($pagina == $i){
                                echo '<li class="active"><a href="product.php?view=productlist&pag='.$i.'">'.$i.'</a></li>';
                            }else{
                                echo '<li><a href="product.php?view=productlist&pag='.$i.'">'.$i.'</a></li>';
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
                                            <a href="product.php?view=productlist&pag=<?php echo $pagina+1; ?>">
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
    </section>
    <?php include './inc/footer.php'; ?>
</body>

</html>