<aside id="menubar" class="menubar light">
    <div class="app-user">

        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive"
                                                      src="<?php echo base_url('assets'); ?>/assets/images/221.jpg"
                                                      alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username">John Doe</a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <small>Web Developer</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="/index.html">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="profile.html">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="settings.html">
                                        <span class="m-r-xs"><i class="fa fa-gear"></i></span>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="logout.html">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Home</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">


                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                <li class="has-submenu">
                    <a href="javascript:void(0)" class="submenu-toggle">
                        <i class="menu-icon fa fa-cubes"></i>
                        <span class="menu-text">Kategoriler</span>
                        <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                    </a>

                    <!-- //! Submenus -->
                    <ul class="submenu">
                        <li class="has-submenu">
                            <a href="javascript:void(0)" class="submenu-toggle">
                                <span class="menu-text">Dolaplar</span>
                                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                            </a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)" class="submenu-toggle">
                                <span class="menu-text">Yataklar</span>
                                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                            </a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)" class="submenu-toggle">
                                <span class="menu-text">Masalar</span>
                                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                            </a>
                        </li>

                        <li class="has-submenu">
                            <a href="javascript:void(0)" class="submenu-toggle">
                                <span class="menu-text">Oturma Grupları</span>
                                <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="<?php echo base_url('product'); ?>">
                        <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                        <span class="menu-text">Ürünler</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon zmdi zmdi-layers zmdi-hc-lg"></i>
                        <span class="menu-text">Raflar</span>
                    </a>
                </li>

                <li>
                    <a href="documentation.html">
                        <i class="menu-icon zmdi zmdi-check zmdi-hc-lg"></i>
                        <span class="menu-text">Stoklar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-newspaper-o"></i>
                        <span class="menu-text">Stok Kartları</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-users"></i>
                        <span class="menu-text">Kullanıcılar</span>
                    </a>
                </li>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>