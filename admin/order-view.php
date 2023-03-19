<p class="lead">
</p>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <br><br>
            <div class="panel panel-info">
                <div class="panel-heading text-center">
                    <h4>Pedidos en Curso</h4>
                </div>
                <div class="table-responsive">
                    <div id="reportrange"
                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <form action="?view=order" method="post" id="filtro">
                        <input type="hidden" name="inicio" id="finicio">
                        <input type="hidden" name="fin" id="ffin">
                    </form>
                    <table class="table table-striped table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">N° Pedido</th>
                                <!-- <th class="text-center">N° Deposito Bancario</th> -->
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Tipo Envío</th>
                                <th class="text-center">Direccion</th>
                                <th class="text-center">Acciones</th>
                                <th class="text-center"> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                            mysqli_set_charset($mysqli, "utf8");

                            $pagina = isset($_GET['pag']) ? (int) $_GET['pag'] : 1;
                            $regpagina = 30;
                            $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;

                            if (count($_POST)) {
                                // print_r($_POST);
                                // print("SELECT SQL_CALC_FOUND_ROWS * FROM venta v where v.estado in ('En Preparacion','Pendiente','Listo Para Retirar') and v.fecha between  '".$_POST["inicio"] . "' and '" .$_POST["fin"]."'" );
                                $pedidos = mysqli_query($mysqli, "SELECT SQL_CALC_FOUND_ROWS * FROM venta v where v.estado in ('En Preparacion','Pendiente','Listo Para Retirar') and v.fecha between '" . $_POST["inicio"] . "' and '" . $_POST["fin"] . "'");

                            } else {
                                $pedidos = mysqli_query($mysqli, "SELECT SQL_CALC_FOUND_ROWS * FROM venta v where v.estado in ('En Preparacion','Pendiente','Listo Para Retirar')  LIMIT $inicio, $regpagina");
                            }


                            $totalregistros = mysqli_query($mysqli, "SELECT FOUND_ROWS()");
                            $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                            $numeropaginas = ceil($totalregistros["FOUND_ROWS()"] / $regpagina);

                            $cr = $inicio + 1;
                            while ($order = mysqli_fetch_array($pedidos, MYSQLI_ASSOC)) {
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $order['NumPedido']; ?>
                                    </td>
                                    <!-- <td class="text-center">
                                        <?php echo $order['NumeroDeposito']; ?>
                                    </td> -->
                                    <td class="text-center">
                                        <?php echo $order['Fecha']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $conUs = ejecutarSQL::consultar("SELECT CONCAT(c.NombreCompleto,' ',c.Apellido) as Nombre FROM cliente c WHERE  NIT='" . $order['NIT'] . "'");
                                        $UsP = mysqli_fetch_array($conUs, MYSQLI_ASSOC);
                                        echo $UsP['Nombre'];
                                        ?>
                                    </td>
                                    <td class="text-center">$
                                        <?php echo $order['TotalPagar']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $order['Estado']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $order['TipoEnvio']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $conUs = ejecutarSQL::consultar("SELECT c.direccion as Direccion FROM cliente c WHERE  NIT='" . $order['NIT'] . "'");
                                        $UsP = mysqli_fetch_array($conUs, MYSQLI_ASSOC);
                                        echo $UsP['Direccion'];
                                        ?>
                                    </td>
                                    <td class="text-center  btn-group-toggle">
                                        <a href="#!" class="btn-xs btn-success btn-up-order glyphicon glyphicon-pencil "
                                            data-toggle="tooltip" data-placement="top" title="Cambiar Estado"
                                            data-code="<?php echo $order['NumPedido']; ?>"></a>
                                        <?php
                                        if (is_file("./assets/comprobantes/" . $order['Adjunto'])) {
                                            echo '<a href="./assets/comprobantes/' . $order['Adjunto'] . '" target="_blank" class="btn-xs btn-info glyphicon glyphicon-file" data-toggle="tooltip" data-placement="top" title="Ver Comprobante Adjunto"></a>';
                                        }
                                        ?>
                                        <a href="./pdf/pedido.php?id=<?php echo $order['NumPedido']; ?>"
                                            class="btn-xs btn-primary glyphicon glyphicon-print	" data-toggle="tooltip"
                                            data-placement="top" title="Imprimir" target="_blank"></a>
                                    </td>
                                    <td class="text-center  btn-group-toggle data-toggle=">
                                        <a>
                                            <form action="process/cancPedido.php" method="POST" class="FormCatElec"
                                                data-form="delete">
                                                <input type="hidden" name="num-pedido"
                                                    value="<?php echo $order['NumPedido']; ?>">
                                                <button type="submit" class="btn-xs btn-danger glyphicon glyphicon-remove "
                                                    data-toggle="tooltip" data-placement="top" title="Cancelar"></button>
                                            </form>
                                        </a>
                                    </td>


                                </tr>
                                <?php
                                $cr++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($numeropaginas >= 1): ?>
                    <div class="text-center">
                        <ul class="pagination">
                            <?php if ($pagina == 1): ?>
                                <li class="disabled">
                                    <a>
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="configAdmin.php?view=order&pag=<?php echo $pagina - 1; ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <?php
                            for ($i = 1; $i <= $numeropaginas; $i++) {
                                if ($pagina == $i) {
                                    echo '<li class="active"><a href="configAdmin.php?view=order&pag=' . $i . '">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="configAdmin.php?view=order&pag=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            ?>


                            <?php if ($pagina == $numeropaginas): ?>
                                <li class="disabled">
                                    <a>
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="configAdmin.php?view=order&pag=<?php echo $pagina + 1; ?>">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal-order" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="padding: 15px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title text-center text-primary" id="myModalLabel">Actualizar estado del pedido</h5>
            </div>
            <form action="./process/updatePedido.php" method="POST" class="FormCatElec" data-form="update">
                <div id="OrderSelect"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-raised btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-danger btn-raised btn-sm"
                        data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(document).ready(function () {
        $('.btn-up-order').on('click', function (e) {
            e.preventDefault();
            var code = $(this).attr('data-code');
            $.ajax({
                url: './process/checkOrder.php',
                type: 'POST',
                data: 'code=' + code,
                success: function (data) {
                    $('#OrderSelect').html(data);
                    $('#modal-order').modal({
                        show: true,
                        backdrop: "static"
                    });
                }
            });
            return false;

        });
    });
    $(function () {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            console.log("estoy aplicando un filtro")

        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hoy': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
                'Ultimo 30 Dias': [moment().subtract(29, 'days'), moment()],
                'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                'Ultimo Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        

        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
            let formulario = document.getElementById("filtro")

            let inicio = document.getElementById("finicio")
            let fin = document.getElementById("ffin")
            inicio.value = $(this).val(picker.startDate.format('YYYY-MM-DD'))[0].value;
            fin.value = $(this).val(picker.endDate.format('YYYY-MM-DD'))[0].value;
            formulario.submit()
            
            
        });
        cb(start, end);
    });
</script>
