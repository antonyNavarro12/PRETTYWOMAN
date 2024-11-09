<div class="sidebar" role="navigation">
    <div class="navbar-collapse">
        <nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
            <ul class="nav" id="side-menu">
                
                <?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
                <li>
                    <a href="dashboard.php"><i class="fa fa-home nav_icon"></i>Panel de Control</a>
                </li>
                <?php endif; ?>

                <?php if ($_SESSION['userRole'] === 'Admin') : ?>
                <li>
                    <a href="add-services.php"><i class="fa fa-cogs nav_icon"></i>Servicios<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="add-services.php">Agregar Servicio</a>
                        </li>
                        <li>
                            <a href="manage-services.php">Administrar Servicio</a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="about-us.php"><i class="fa fa-book nav_icon"></i>Páginas <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="about-us.php">Acerca de</a>
                        </li>
                        <li>
                            <a href="contact-us.php">Contacto</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="all-appointment.php"><i class="fa fa-check-square-o nav_icon"></i>Citas<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="all-appointment.php">Todas las Citas</a>
                        </li>
                        <li>
                            <a href="new-appointment.php">Aceptar Cita</a>
                        </li>
                        <li>
                            <a href="accepted-appointment.php">Citas Aceptadas</a>
                        </li>
                        <li>
                            <a href="rejected-appointment.php">Citas Rechazadas</a>
                        </li>
                    </ul>
                </li> 
                <li>
                    <a href="create_user.php" class="chart-nav"><i class="fa fa-user nav_icon"></i>Crear Usuario</a>
                </li>
                <li>
                    <a href="view_users.php" class="chart-nav"><i class="fa fa-users nav_icon"></i>Mostrar Usuarios</a>
                </li>
                <?php endif; ?>

                <?php if ($_SESSION['userRole'] === 'Recepcionista' || $_SESSION['userRole'] === 'Admin') : ?>
                <li>
                    <a href="add-customer.php" class="chart-nav"><i class="fa fa-user nav_icon"></i>Agregar Cliente</a>
                </li>
                <li>
                    <a href="customer-list.php" class="chart-nav"><i class="fa fa-users nav_icon"></i>Lista de Clientes</a>
                </li>
                <?php endif; ?>

                <?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista') : ?>
                <li>
                    <a href="search-appointment.php" class="chart-nav"><i class="fa fa-search nav_icon"></i>Buscar Citas</a>
                </li>
                <?php endif; ?>

                <!-- Solo visible para Admin, Recepcionista y Cliente -->
                <?php if ($_SESSION['userRole'] === 'Admin' || $_SESSION['userRole'] === 'Recepcionista' || $_SESSION['userRole'] === 'Cliente') : ?>
                <li>
                    <a href="crearC-appointment.php"><i class="fa fa-calendar nav_icon"></i>Crear Citas<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="crearC-appointment.php">Crear Cita</a>
                        </li>
                        <li>
                            <a href="editC.php">Editar Cita</a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Nueva sección de Reportes -->
                
            </ul>
            <div class="clearfix"> </div>
            <!-- //sidebar-collapse -->
        </nav>
    </div>
</div>
