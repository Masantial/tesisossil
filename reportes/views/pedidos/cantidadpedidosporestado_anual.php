<?php
$conexion = mysqli_connect('localhost', 'root', '', 'store');

?>

<!DOCTYPE html>
<html>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="views/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="main.css">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="views/datatables/datatables.min.css" />
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="views/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

    <!--font awesome con CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <style>
    /*estilos para la tabla*/
    table th {
        background-color: #f37f21;
        color: black;
    }
    </style>

</head>
<header>
        <h2 class="text-center">Sumatoria anual de pedidos según su estado</h2>
        <h6 class="text-center">(Se tendrán en cuenta todos los pedidos realizados)</h6>

    </header>
<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-chart-pie mr-1"></i>
                Cantidad de Pedidos por Estado
            </h3>
            <div class="card-tools">
                <!-- This will cause the card to maximize when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                        class="fas fa-expand"></i></button>
                <!-- This will cause the card to collapse when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
                <!-- This will cause the card to be removed when clicked -->
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                        class="fas fa-times"></i></button>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <canvas id="myChart" style="position: relative; width=10vh; height=10vh"></canvas>
                <script>
                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        datasets: [{
                            label: 'Cantidad Pedidos por Estado:',
                            backgroundColor: ['#DC440F', '#64B5F6', '#15F607', '#0A7A1B',
                                '#EC9207'
                            ],
                            borderColor: ['black'],
                            borderWidth: 1
                        }]
                    },

                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        title: {
                            display: true,

                        }
                    }

                })



                let urlPedPenanual = 'http://localhost/Tesis-OssilEnvases/reportes/consultas/pedidosporestado_anual.php'
                fetch(urlPedPenanual)
                    .then(response => response.json())
                    .then(datos => mostrarPedPenanual(datos))
                    .catch(error => console.log(error))


                const mostrarPedPenanual = (articulos) => {
                    articulos.forEach(element => {
                        myChart.data['labels'].push(element.Estado)
                        myChart.data['datasets'][0].data.push(element.cantidad_pedidos)
                        myChart.update()
                    });
                    console.log(myChart.data)
                }
                </script>

            </div>
        </div>
    </div>


</html>