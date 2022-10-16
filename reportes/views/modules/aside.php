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
          <!-- Sidebar user panel (optional) -->


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
                              <a onclick="CargarContenido('content-wrapper','views/articulosmasvendidos-graf.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Historial de Productos Mas Pedidos</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a onclick="CargarContenido('content-wrapper','views/articulosmasvendidospormes.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos Mas Pedidos por Mes</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a onclick="CargarContenido('content-wrapper','consultas/articulosmenosdelmin.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Productos con Faltante</p>
                              </a>
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
                              <a onclick="CargarContenido('content-wrapper','views/clientesfrecuentesgraf.php')"
                                  class="nav-link active" style="cursor:pointer;">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Clientes Frecuentes</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Inactive Page</p>
                              </a>
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
                          <a onclick="CargarContenido('content-wrapper','views/pedidoscongraf.php')"
                              class="nav-link active" style="cursor:pointer;">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pedidos</p>
                          </a>
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
                          <a onclick="CargarContenido('content-wrapper','views/inventario.php')" class="nav-link active"
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