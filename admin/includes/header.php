<div class="sticky-header header-section">
    <div class="header-left">
        <!--toggle button start-->
        <button id="showLeftPush"><i class="fa fa-bars"></i></button>
        <!--toggle button end-->
        <!--logo -->
        <div class="logo">
            <a href="index.php">
                <h1>SALON</h1>
                <span>Panel Administrativo</span>
            </a>
        </div>
        <!--//logo-->

        <div class="clearfix"> </div>
    </div>
    <div class="header-right">
        <div class="profile_details_left">
            <!-- Aquí verificamos el rol del usuario -->
            <?php
            $adid = $_SESSION['bpmsaid'];
            $ret = mysqli_query($con, "SELECT AdminName, Role FROM tbladmin WHERE ID='$adid'");
            $row = mysqli_fetch_array($ret);
            $name = $row['AdminName'];
            $role = $row['Role']; // Asegúrate de que el rol esté también en la consulta
            ?>

            <!-- Mostrar las notificaciones solo si el rol no es "Cliente" -->
            <?php if ($role != 'Cliente') { ?>
                <ul class="nofitications-dropdown">
                    <?php
                    $ret1 = mysqli_query($con, "SELECT ID, Name FROM tblappointment WHERE Status=''");
                    $num = mysqli_num_rows($ret1);
                    ?>
                    <li class="dropdown head-dpdn">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge blue"><?php echo $num; ?></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <div class="notification_header">
                                    <h3>Tienes <?php echo $num; ?> notificación</h3>
                                </div>
                            </li>
                            <li>
                                <div class="notification_desc">
                                    <?php if ($num > 0) {
                                        while ($result = mysqli_fetch_array($ret1)) { ?>
                                            <a class="dropdown-item" href="view-appointment.php?viewid=<?php echo $result['ID']; ?>">
                                                Nueva cita recibida de <?php echo $result['Name']; ?>
                                            </a><br />
                                        <?php }
                                    } else { ?>
                                        <a class="dropdown-item" href="all-appointment.php">No se recibió nueva cita</a>
                                    <?php } ?>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                            <li>
                                <div class="notification_bottom">
                                    <a href="new-appointment.php">Ver todas las notificaciones</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>

            <div class="clearfix"> </div>
        </div>

        <!--notification menu end -->
        <div class="profile_details">  
            <ul>
                <li class="dropdown profile_details_drop">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <div class="profile_img"> 
                            <span class="prfil-img"><img src="images/logo2.png" alt="" width="50" height="60"> </span> 
                            <div class="user-name">
                                <p><?php echo htmlspecialchars($name); ?></p>
                                <span><?php echo htmlspecialchars($role); ?></span> <!-- Mostrar el rol del usuario -->
                            </div>
                            <i class="fa fa-angle-down lnr"></i>
                            <i class="fa fa-angle-up lnr"></i>
                            <div class="clearfix"></div>  
                        </div>  
                    </a>
                    <ul class="dropdown-menu drp-mnu">
                        <li><a href="change-password.php"><i class="fa fa-cog"></i> Configuración</a></li> 
                        <li><a href="admin-profile.php"><i class="fa fa-user"></i> Perfil</a></li> 
                        <li><a href="index.php"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>  
        <div class="clearfix"> </div> 
    </div>
    <div class="clearfix"> </div> 
</div>
