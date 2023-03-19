  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
          <img src="views/dist/img/logosolo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">Ossil Envases</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) 


          <!-- SidebarSearch Form -->
          <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
     <!--</div>-->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item menu-close">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fas fa-glass-whiskey"></i>
                          <p>
                              Reportes Productos
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos Mas Pedidos
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/maspedidos/mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/maspedidos/trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/maspedidos/semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/maspedidos/anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a onclick="CargarContenido('content-wrapper','views/productos/productosmasvendidospormes.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos Mas Pedidos por Mes/Año</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a onclick="CargarContenido('content-wrapper','views/productos/productosfaltantes.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos con Faltante</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Porcentaje de Ganancia Neta
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/ganancianeta/ganancianetagraf_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/ganancianeta/ganancianetagraf_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/ganancianeta/ganancianetagraf_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/ganancianeta/ganancianetagraf_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Monto de Ganancia Neta
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/productos/gananciamonto/ganancianetamontograf_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/gananciamonto/ganancianetamontograf_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/gananciamonto/ganancianetamontograf_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/productos/gananciamonto/ganancianetamontograf_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </ul>

                  </li>
                  <li class="nav-item menu-close">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fas fa-user"></i>
                          <p>
                              Reportes Clientes
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Clientes Frecuentes
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/clientes/clientesfrecuentesgraf_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/clientes/clientesfrecuentesgraf_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/clientes/clientesfrecuentesgraf_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/clientes/clientesfrecuentesgraf_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>

                      </ul>
                  </li>
                  <li class="nav-item menu-close">
                      <a href="#" class="nav-link active">
                          <i class="nav-icon fas fa-truck"></i>
                          <p>
                              Reportes Proveedores
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a onclick="CargarContenido('content-wrapper','views/articulosporproveedor.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos por Proveedor</p>
                              </a>
                          </li>
                  </li>

              </ul>
              </li>
              <li class="nav-item menu-close">
                  <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-shopping-cart"></i>
                      <p>
                          Reportes Pedidos
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Pedidos
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/pedidos/pedidos_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/pedidos_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/pedidos_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/pedidos_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Cantidad de Pedidos por Estado
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporestado_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporestado_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporestado_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporestado_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Cantidad de Pedidos por Envio
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporenvio_mensual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Mensual</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporenvio_trimestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Trimestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporenvio_semestral.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Semestral</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                  <a onclick="CargarContenido('content-wrapper','views/pedidos/cantidadpedidosporenvio_anual.php')"
                                          class="nav-link" style="cursor:pointer;">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Anual</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/ventaspordiagraf.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Monto Total por Día</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/ventaspormesgraf.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Monto Total por Mes</p>
                          </a>
                      </li>

                  </ul>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/pedidospendientes.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pedidos Pendientes de Preparar</p>
                          </a>
                      </li>

                  </ul>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/pedidoscancelados.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pedidos Cancelados</p>
                          </a>
                      </li>
                      
                  </ul>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/pedidosfinalizados.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pedidos Finalizados</p>
                          </a>
                      </li>
                      
                  </ul>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/pedidosdiarioss.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pedidos Diarios</p>
                          </a>
                      </li>
                      
                  </ul>
              </li>
              <li class="nav-item menu-close">
                  <a href="#" class="nav-link active">
                      <i class="nav-icon fas fa-calculator"></i>
                      <p>
                          Reportes Stock
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a onclick="CargarContenido('content-wrapper','views/stock/inventario.php')" class="nav-link active"
                              style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Inventario Valorizado</p>
                          </a>
                      </li>
                  </ul>

                  <!--  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>