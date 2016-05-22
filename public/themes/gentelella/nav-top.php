<!-- top navigation -->
<div class="top_nav">

    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="images/img.jpg" alt=""><?php echo $profile->nm_awal;?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="javascript:;">  Profil</a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <span>Pengaturan</span>
                            </a>
                        </li>
                        <li><a href="<?php echo site_url();?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge bg-green">0</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <li><a>
                        <span>
                            <span>User Sender</span>
                            <span class="time">01 Jan 2016 16:02</span>
                        </span>
                        <span class="message">
                            Message text maks 80 char...
                        </span>
                            </a>
                        </li>

                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>Lihat Semua</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>

</div>
<!-- /top navigation -->