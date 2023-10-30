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
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="index.html">Dashboard 01</a> </li>
                            <li> <a href="index-02.html">Dashboard 02</a> </li>
                            <li> <a href="index-03.html">Dashboard 03</a> </li>
                            <li> <a href="index-04.html">Dashboard 04</a> </li>
                            <li> <a href="index-05.html">Dashboard 05</a> </li>
                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('main_trans.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('grades.index')}}">{{trans('main_trans.Grades_list')}}</a></li>

                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('classrooms.index')}}">{{ trans('main_trans.List_classes') }} </a> </li>

                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu2">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu2" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('sections.index')}}">{{ trans('main_trans.List_sections') }} </a> </li>

                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu3">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu3" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{ url('add-parent') }}">{{ trans('main_trans.List_Parents') }} </a> </li>


                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu4">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu4" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teachers.index') }}">{{ trans('main_trans.List_Teachers') }} </a> </li>
                            <li> <a href="{{route('teachers.create') }}">{{ trans('Teacher_trans.Add_Teacher') }} </a> </li>


                        </ul>
                    </li>

                    <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i class="fa solid fa-user"></i>{{trans('main_trans.students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                    <ul id="students-menu" class="collapse">
                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Student_information">{{trans('main_trans.Student_information')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                            <ul id="Student_information" class="collapse">
                                <li> <a href="{{route('students.create')}}">{{trans('main_trans.add_student')}}</a></li>
                                <li> <a href="{{route('students.index')}}">{{trans('main_trans.list_students')}}</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('main_trans.Students_Promotions')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                            <ul id="Students_upgrade" class="collapse">
                                <li> <a href="{{route('promotions.index')}}">{{trans('main_trans.add_Promotion')}}</a></li>
                                <li> <a href="{{route('promotions.create')}}">{{trans('main_trans.list_Promotions')}}</a> </li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Graduate students">{{trans('main_trans.Graduate_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                            <ul id="Graduate students" class="collapse">
                                <li> <a href="{{route('graduated.create')}}">{{trans('main_trans.add_Graduate')}}</a> </li>
                                <li> <a href="{{route('graduated.index')}}">{{trans('main_trans.list_Graduate')}}</a> </li>
                            </ul>
                        </li>
                    </ul>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu6">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{ trans('main_trans.Fees') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu6" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('fees.index') }}">{{ trans('main_trans.Fees') }} </a> </li>
                            <li> <a href="{{route('fees-invoices.index') }}">{{ trans('main_trans.Fees_invoices') }} </a> </li>
                            <li> <a href="{{route('receipt-students.index')}}"> {{ trans('main_trans.Receipts') }}</a> </li>
                            <li> <a href="{{route('processing-fees.index')}}"> {{ trans('main_trans.processing_fees') }}</a> </li>

                        </ul>
                    </li>

                </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
