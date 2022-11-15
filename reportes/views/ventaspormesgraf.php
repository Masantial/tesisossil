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

<body>
    <header>
        <h2 class="text-center">Monto Total Pedido historico por Mes</h2>
        <h6 class="text-center">(Solo se contemplan pedidos Entregados y Enviados)</h6>

    </header>
    <br>
    <div class="card">
        <canvas id="myChart" style="position: relative; width=10vh; height=10vh"></canvas>

        <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                datasets: [{
                    label: 'Monto Total Pedido por Mes',
                    backgroundColor: ['#6bf1ab', '#90CAF9', '#438c6c', '#64B5F6', '#1f794e', '#2196F3',
                        '#90CAF9', '#34444c', '#438c6c', '#2196F3', '#63d69f'
                    ],
                    borderColor: ['black'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }

                }
            }
        })


        let urlTotVendMes = 'http://localhost/Tesis-OssilEnvases/reportes/consultas/ventaspormes.php'
        fetch(urlTotVendMes)
            .then(response => response.json())
            .then(datos => mostrarTotVendMes(datos))
            .catch(error => console.log(error))


        const mostrarTotVendMes = (articulos) => {
            articulos.forEach(element => {
                myChart.data['labels'].push(element.Mes)
                myChart.data['datasets'][0].data.push(element.Total)
                myChart.update()
            });
            console.log(myChart.data)
        }
        </script>
    </div>
    <script src="views/js/jquery.min.js" type="text/javascript"></script>
<script src="views/js/jquery.dataTables.min.js" type="text/javascript"></script>
</body>

</html>