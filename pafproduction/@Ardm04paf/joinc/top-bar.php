<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html"><span>pafproduction.co.id | ADMIN</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">&nbsp; Selamat Datang, <?php echo $_SESSION['username']; ?> </span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Akun</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?logout=logout">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="../" target="_blank"><i class="glyphicon glyphicon-globe"></i> Lihat Website</a></li>
            </ul>
            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="#"><?php tanggal_sekarang(); ?></a></li>
            </ul>

        </div>
    </div>
    <!-- topbar ends -->