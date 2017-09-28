<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="/admin/index.php">Trang quản lý</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if(isset($_SESSION['arUser'])){
                ?>
                <li>
                    <a href="editUser.php?id=<?php echo $_SESSION['arUser']['id_user'] ?>"><?php echo 'Chào,' . $_SESSION['arUser']['fullname']; ?></a>
                </li>
                <?php 
                    }else{ 
                ?>
                <li><a href="">Chào khách</a></li>
                <?php 
                    } 
                ?>
                <?php
                    if(!isset($_SESSION['arUser'])){
                ?>
                <li>
                    <a href="login.php">
                        <i class="fa fa-user"></i>
                        <p>Login</p>
                    </a>
                </li>
                <?php
                    }
                ?>

                <?php
                    if(isset($_SESSION['arUser'])){
                ?>
                 <li>
                    <a href="logout.php">
                        <i class="fa fa-user"></i>
                        <p>Logout</p>
                    </a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>