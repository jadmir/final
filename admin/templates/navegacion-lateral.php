  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <!--<div class="pull-left image">-->
          <!--<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->
        <!--</div>-->
        <div class="info">
          <p><?php echo $_SESSION['nombre']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú de Administración</li>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="dashboard.php"><i class="far fa-circle"></i> Dashboard </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Eventos</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-evento.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-evento.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Categoria Eventos</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-categoria.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-categoria.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle"></i>
            <span>Invitados</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-invitado.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-invitado.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-card"></i>
            <span>Registrados</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-registrado.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="crear-registrado.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>

        <?php //Código para restringir el acceso al menú Administradores.
          if($_SESSION['nivel'] == 1):
        ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i>
              <span>Administradores</span>
            </a>
            <ul class="treeview-menu">
              <li><a href="lista-admin.php"><i class="fa fa-list-ul"></i> Ver todos</a></li>
              <li><a href="crear-admin.php"><i class="fa fa-plus-circle"></i> Agregar </a></li>
            </ul>
          </li>
        <?php endif; ?>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-comments"></i>
            <span>Testimoniales</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-list-ul"></i> Ver todos</a></li>
            <li><a href="#"><i class="fa fa-plus-circle"></i> Agregar </a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->