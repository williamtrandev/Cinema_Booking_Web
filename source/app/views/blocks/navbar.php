<nav class="my-sidebar close">
    <header>
        <a href="<?php echo _WEB_ROOT ?>/home">
            <div class="logo">
                <div class="brand">W</div>
                <div class="text header-text">
                    <span class="name">WillCinema</span>
                </div>
            </div>
        </a>
        <i class="fa-solid fa-angle-right toggle"></i>
    </header>
    <div class="my-menu-bar">
        <div class="my-menu">
            <ul class="my-menu-links">
                <li class="my-nav-link">
                    <a href="<?php echo _WEB_ROOT ?>/home">
                        <i class="fa-solid fa-house-chimney icon"></i>
                        <span class="nav-text text">Trang chủ</span>
                        <span class="tooltip-text">Trang chủ</span>
                    </a>
                </li>
                <li class="my-nav-link">
                    <a href="<?php echo _WEB_ROOT ?>/film">
                        <i class="fa-solid fa-tv icon"></i>
                        <span class="nav-text text">Phim đang chiếu</span>
                        <span class="tooltip-text">Phim đang chiếu</span>
                    </a>
                </li>
                <li class="my-nav-link">
                    <a href="<?php echo _WEB_ROOT ?>/film/coming">
                        <i class="fa-solid fa-calendar-days icon"></i>
                        <span class="nav-text text">Phim sắp chiếu</span>
                        <span class="tooltip-text">Phim sắp chiếu</span>
                    </a>
                </li>
                <li class="my-nav-link">
                    <a href="<?php echo _WEB_ROOT ?>/theater">
                        <i class="fa-solid fa-masks-theater icon"></i>
                        <span class="nav-text text">Hệ thống rạp</span>
                        <span class="tooltip-text">Hệ thống rạp</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bottom-content">
            <?php
            if (!isset($_SESSION['user'])) {
                echo
                "<li>
                    <a href='" . _WEB_ROOT . "/user/login'>
                        <i class='fa-solid fa-right-to-bracket icon'></i>
                        <span class='nav-text text'>Đăng nhập</span>
                        <span class='tooltip-text'>Đăng nhập</span>
                    </a>
                </li>";
            } else {
                echo
                "<li>
                    <a href='" . _WEB_ROOT . "/user/logout'>
                        <i class='fa-solid fa-right-from-bracket icon logout-icon'></i>
                        <span class='nav-text text'>Đăng xuất</span>
                        <span class='tooltip-text'>Đăng xuất</span>
                    </a>
                </li>";
            }
            ?>
            <li class="theme-mode">
                <div class="moon-sun">
                    <i class="far fa-moon icon moon"></i>
                    <i class="far fa-sun icon sun"></i>
                </div>
                <span class="theme-mode-text text">Dark Mode</span>
                <span class="tooltip-text">Dark/Light Mode</span>

                <div class="toggle-switch">
                    <div class="switch"></div>
                </div>
            </li>
        </div>
        <?php
        if (isset($_SESSION['user'])) {
            $name = json_decode($_SESSION['user'])->name;
            // echo $_SESSION['user'];
            echo "<div class='user-icon'>
                <a href='" . _WEB_ROOT . "/user'>
                    <img src='" . _WEB_ROOT . "/public/assets/client/img/user.png' alt='' />
                    <span class='text'>$name</span>
                </a>
            </div>";
        }
        ?>
    </div>
</nav>
<nav class="my-sidebar-bottom">
    <ul class="my-menu-bottom-links">
        <li class="my-nav-bottom-link">
            <a href="<?php echo _WEB_ROOT ?>/home">
                <i class=" fa-solid fa-house-chimney icon"></i>
                <span class="nav-text text">Trang chủ</span>
            </a>
        </li>
        <li class="my-nav-bottom-link has-sub-menu">
            <i class="fa-solid fa-calendar-days icon"></i>
            <span class="nav-text text">Phim</span>
            <ul class="sub-menu-nav mid">
                <li>
                    <a href="<?php echo _WEB_ROOT ?>/film">
                        <i class=" fa-solid fa-user icon sub-icon"></i>
                        <span class="sub-menu-text">Đang chiếu</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo _WEB_ROOT ?>/film/coming">
                        <i class="fa-solid fa-right-from-bracket icon logout-icon sub-icon"></i>
                        <span class="sub-menu-text">Sắp chiếu</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="my-nav-bottom-link">
            <a href="<?php echo _WEB_ROOT ?>/theater">
                <i class="fa-solid fa-masks-theater icon"></i>
                <span class="nav-text text">Hệ thống rạp</span>
            </a>
        </li>
        <li class="my-nav-bottom-link has-sub-menu">
            <i class="fa-sharp fa-solid fa-gear icon"></i>
            <span class="nav-text text">Cài đặt</span>
            <ul class="sub-menu-nav">
                <li class="theme-mode d-flex flex-column justify-content-center">
                    <div class="wrapper-toggle-switch d-flex flex-column justify-content-center">
                        <div class="toggle-switch">
                            <div class="switch"></div>
                        </div>
                        <span class="sub-menu-text">Dark Mode</span>
                    </div>
                </li>


                <?php
                if (!isset($_SESSION['user'])) {
                    echo
                    "<li>
                    <a href='" . _WEB_ROOT . "/user/login'>
                        <i class='fa-solid fa-right-to-bracket icon'></i>
                        <span class='nav-text text'>Đăng nhập</span>
                        <span class='tooltip-text'>Đăng nhập</span>
                    </a>
                </li>";
                } else {
                    echo "<li>
                    <a href='" . _WEB_ROOT . "/user'><i class=' fa-solid fa-user icon sub-icon'></i>
                        <span class='sub-menu-text'>Thông tin</span></a>
                </li>";
                    echo
                    "<li>
                    <a href='" . _WEB_ROOT . "/user/logout'>
                        <i class='fa-solid fa-right-from-bracket icon logout-icon'></i>
                        <span class='nav-text text'>Đăng xuất</span>
                        <span class='tooltip-text'>Đăng xuất</span>
                    </a>
                </li>";
                }
                ?>
            </ul>
        </li>
    </ul>
</nav>