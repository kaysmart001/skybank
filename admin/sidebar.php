<nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
    <div class="simplebar-content" style="padding: 0px;">
        <a class="sidebar-brand" href="../index.php">
            <span class="align-middle"><?php echo $bank_name; ?></span>
        </a>

        <ul class="navbar-nav align-self-stretch">

            <!-- <li class="sidebar-header">
                        Pages
                    </li> -->
            <li class="">

                <a class="nav-link text-left active" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="flaticon-bar-chart-1"></i><i class="bx bxs-dashboard ico"></i> Dashboard
                </a>
            </li>

            <li class="has-sub menuHover">
                <!-- this link href="collapseExample1" shows submenue  -->
                <a class="nav-link collapsed text-left" href="#collapseExample1" role="button" data-toggle="collapse">
                    <i class="flaticon-user"></i> <i class="bx bxs-wallet-alt Profile ico"></i> Wallet
                </a>
                <!-- id is a collapseExample1 -->
                <div class="collapse menu mega-dropdown" id="collapseExample1">
                    <div class="dropmenu" aria-labelledby="navbarDropdown">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-12 px-2">
                                    <div class="submenu-box">
                                        <ul class="list-unstyled m-0">
                                            <li><a href="../admin/wallet/Withdraw.php">Withdraw Money</a></li>
                                            <li><a href="../admin/wallet/Deposit.php">Deposit Money</a></li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <li class="menuHover">
                <a href="../admin/TransferMoney.php" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i><i class="bx bx-transfer ico"></i> Transfer
                </a>
            </li>

            <li class="has-sub menuHover">
                <a class="nav-link collapsed text-left" href="#collapseExample2" role="button" data-toggle="collapse">
                    <i class="flaticon-user"></i> <i class="bx bx-user-circle Profile ico"></i> Customer Accounts
                </a>
                <div class="collapse menu mega-dropdown" id="collapseExample2">
                    <div class="dropmenu" aria-labelledby="navbarDropdown">
                        <div class="container-fluid ">
                            <div class="row">
                                <div class="col-lg-12 px-2">
                                    <div class="submenu-box">
                                        <ul class="list-unstyled m-0">
                                            <!-- <li><a href="../admin/accounts/OpenAccount.php">Open Account</a></li> -->
                                            <li><a href="../admin/accounts/EditAccount.php">Edit Account</a></li>
                                            <li><a href="../admin/accounts/ActivateAccount.php">Activate Account</a></li>
                                            <li><a href="../admin/accounts/DeactivateAccount.php">Deactivate Account</a></li>
                                            <li><a href="../admin/accounts/CloseAccount.php">Close Account</a></li>


                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="menuHover box-icon">
                <a href="../admin/VerifyAccount.php" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> <i class="bx bx-check-circle ico"></i> Verify Account <span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $count; ?> new</span>
                </a>
            </li>

            <!-- <li class="menuHover" id="Transaction">
                        <a class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i> <i class="bx bx-history ico"></i> Transaction
                        </a>
                    </li> -->






            <!-- <li class="sidebar-header">
                        tools and component
                    </li> -->

            <!-- <li class="menuHover box-icon">
                        <a class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i> <i class="bx bx-dollar-circle ico"></i>Insurance Requests
                        </a>
                    </li> -->

            <!-- <li class="menuHover box-icon">
                        <a class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="bx bxs-coin ico"></i> Loan Requests<span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $debitNotify; ?> new</span>
                        </a>
                    </li> -->

            <li class="menuHover">
                <a href="../admin/cards.php" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> <i class="bx bxs-credit-card ico"></i>Cards Requests <span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $debitNotify; ?> new</span>
                </a>
            </li>
            <li class="menuHover">
                <a href="../admin/cards.php" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i> <i class="bx bxs-bank ico"></i>Loan Requests <span class="badge badge-success" style="font-size: 12px; margin-left: 50px;"> <?php echo $debitNotify; ?> new</span>
                </a>
            </li>

            <!-- <li class="sidebar-header">
                        tools and component
                    </li> -->
            <!-- <li class="menuHover">
                        <a class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i> <i class="bx bxs-cog ico"></i> Setting
                        </a>
                    </li> -->
            <li class="menuHover">
                <a class="nav-link text-left" role="button" href="../admin/logout.php">
                    <i class="flaticon-map"></i><i class="bx bx-log-out ico"></i> Logout
                </a>
            </li>

        </ul>


    </div>


</nav>