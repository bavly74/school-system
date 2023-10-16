@extends('layouts.master')
@section('css')
<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico" />

<!-- Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<!-- css -->
<link rel="stylesheet" type="text/css" href="css/style.css" />
@section('title')
{{ trans('Sections_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                            {{ trans('Sections_trans.add_section') }}</a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{trans('Sections_trans.title_page')}}</h5>
                        <div class="accordion plus-icon shadow">
                            @foreach($grades as $grade)
                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{$grade->name}}</a>
                                <div class="acd-des">
                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                    <th>{{ trans('Sections_trans.Status') }}</th>
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($grade->sections as $i=>$list_Sections)
                                                                <tr>

                                                                    <td>{{ ++$i }}</td>
                                                                    <td>{{ $list_Sections->name }}</td>
                                                                    <td>{{ $list_Sections->classroom->name }}
                                                                    </td>
                                                                    <td>

                                                                        <label class="badge badge-success">{{ trans('Sections_trans.Status_Section_AC') }}</label>


                                                                    </td>
                                                                    <td>

                                                                        <a href="#" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#edit{{ $list_Sections->id }}">{{ trans('Sections_trans.Edit') }}</a>
                                                                        <a href="#" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete{{ $list_Sections->id }}">{{ trans('Sections_trans.Delete') }}</a>
                                                                    </td>
                                                                </tr>




                                                                <!--تعديل قسم جديد -->

                                                                <div class="modal fade" id="edit{{ $list_Sections->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                                                                                    {{ trans('Sections_trans.edit_Section') }}
                                                                                </h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">

                                                                                <form action="{{ route('sections.update', 'test') }}" method="POST">

                                                                                    {{ csrf_field() }}
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <input type="text" name="Name_Section_Ar" class="form-control" value="{{ $list_Sections->getTranslation('name', 'ar') }}">
                                                                                        </div>

                                                                                        <div class="col">
                                                                                            <input type="text" name="Name_Section_En" class="form-control" value="{{ $list_Sections->getTranslation('name', 'en') }}">
                                                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $list_Sections->id }}">
                                                                                        </div>

                                                                                    </div>
                                                                                    <br>


                                                                                    <div class="col">
                                                                                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                                                                        <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">

                                                                                            <option value="{{ $grade->id }}">
                                                                                                {{ $grade->name }}
                                                                                            </option>
                                                                                            @foreach ($grades as $list_Grade)
                                                                                            <option value="{{ $list_Grade->id }}">
                                                                                                {{ $list_Grade->name }}
                                                                                            </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>

                                                                                    <div class="col">
                                                                                        <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                                                                        <select name="Class_id" class="custom-select">
                                                                                            <option value="{{ $list_Sections->classroom->id }}">
                                                                                                {{ $list_Sections->classroom->name }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <br>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                                <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                                                                            </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                    <!-- delete_modal_Grade -->
                                                                    <div class="modal fade" id="delete{{ $list_Sections->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                                        {{ trans('Sections_trans.delete_Section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="{{ route('sections.delete', 'test') }}" method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('Sections_trans.Warning_Section') }}
                                                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $list_Sections->id }}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                                            <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>


        </div>



        <!-- add -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;" id="exampleModalLabel">
                            {{ trans('Sections_trans.add_section') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('sections.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="Name_Section_Ar" class="form-control" placeholder="{{ trans('Sections_trans.Section_name_ar') }}">
                                </div>

                                <div class="col">
                                    <input type="text" name="Name_Section_En" class="form-control" placeholder="{{ trans('Sections_trans.Section_name_en') }}">
                                </div>

                            </div>
                            <br>


                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Grade') }}</label>
                                <select name="Grade_id" class="custom-select" onchange="console.log($(this).val())">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{ trans('Sections_trans.Select_Grade') }}
                                    </option>
                                    @foreach ($grades as $list_Grade)
                                    <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                            <div class="col">
                                <label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Class') }}</label>
                                <select name="Class_id" class="custom-select">

                                </select>
                            </div><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                <button type="submit" class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>

        </div>


        <!-- row closed -->
        @endsection
        @section('js')

        <script>
            $(document).ready(function() {
                $('select[name="Grade_id"]').on('change', function() {
                    var Grade_id = $(this).val();
                    if (Grade_id) {
                        $.ajax({
                            url: "{{ URL::to('classes') }}/" + Grade_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="Class_id"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                                });
                            },
                        });
                    } else {
                        console.log('AJAX load did not work');
                    }
                });
            });
        </script>


        <!-- jquery -->
        <script src="js/jquery-3.3.1.min.js"></script>

        <!-- plugins-jquery -->
        <script src="js/plugins-jquery.js"></script>

        <!-- plugin_path -->
        <script>
            var plugin_path = 'js/';
        </script>

        <!-- chart -->
        <script src="js/chart-init.js"></script>

        <!-- calendar -->
        <script src="js/calendar.init.js"></script>

        <!-- charts sparkline -->
        <script src="js/sparkline.init.js"></script>

        <!-- charts morris -->
        <script src="js/morris.init.js"></script>

        <!-- datepicker -->
        <script src="js/datepicker.js"></script>

        <!-- sweetalert2 -->
        <script src="js/sweetalert2.js"></script>

        <!-- toastr -->
        <script src="js/toastr.js"></script>

        <!-- validation -->
        <script src="js/validation.js"></script>

        <!-- lobilist -->
        <script src="js/lobilist.js"></script>

        <!-- custom -->
        <script src="js/custom.js"></script>
        @endsection