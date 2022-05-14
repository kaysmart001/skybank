<nav class="navbar navbar-expand navbar-light gray_bg my-navbar">

    <!-- Sidebar Toggle (Topbar) -->
    <div type="button" id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
        <span class="light_bg"></span>
        <span class="light_bg"></span>
        <span class="light_bg"></span>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item ">
            <a class="nav-link" href="#" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $Admin ?></span>
                <img id="AdminDropdown" class="img-profile rounded-circle" src="<?php echo $AdminProfileInner; ?>">
            </a>
        </li>

    </ul>

</nav>