<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('main_trans.Dashboard')}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>

                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->







                    <li>

                        <a href="{{route('sons.index')}}"><i class="fa solid fa-eye"></i><span
                                class="right-nav-text">الابناء</span></a>


                    </li>


                    <li>

                        <a href="{{route('sons.attendance')}}"><i class="fa solid fa-eye"></i><span
                                class="right-nav-text">تقرير الحضور والغياب</span></a>


                    </li>


                    <li>

                        <a href="{{route('sons.fees')}}"><i class="fa solid fa-eye"></i><span
                                class="right-nav-text">تقرير المالية</span></a>


                    </li>




                    <li>
                        <a href="{{route('parent-profile.index')}}"><i class="fa solid fa-eye"></i><span
                                class="right-nav-text">الملف الشخصي</span></a>
                    </li>





                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
