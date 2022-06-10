<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="../images/logo.png" width="100" height="60" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
        if ($_SESSION['role_teacher'] == 'is_teacher') { ?>
            <ul class="navbar-nav mr-auto">
                <li class='nav-item'>
                    <a <?php if (isset($_GET['teacher']) == 'teacher') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/teacher.php?teacher">Dashboard</a>
                <li class="nav-item">
                    <a <?php if (isset($_GET['messsage']) == 'messsage') {
                        ?> class="nav-link active" <?php } else {
                                                    ?> class="nav-link" <?php
                                                                    } ?> href="<?php echo SITEURL ?>Admin/notify.php?messsage">Message</a>
                </li>
                <?php if ($_SESSION['username']) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo SITEURL . 'Admin/profile.php?profile'  ?>">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout_teacher.php">Logout</a>
                        </div>
                    </li>
                <?php  } ?>
            </ul>
        <?php }  ?>
    </div>
</nav>
<!-- end-navbar -->