@extends('backend.template')

@section('title', 'All portfolios')

@section('page_level_plugins_css')
    <link href="{{ url('/') }}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
@endsection

@section('page_level_css')
    <link href="{{ url('/') }}/assets/pages/css/portfolio.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_js')
    <script src="{{ url('/') }}/assets/pages/scripts/portfolio.js" type="text/javascript"></script>
@endsection

@section('content')
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('/admin_1lkh6x/') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>All portfolios</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Portfolios</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <form id="form_portfolio" action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover" id="datatable_portfolio">
                    <thead>
                    <tr role="row" class="heading">
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Overview</th>
                        <th>Categories</th>
                        <th>Url</th>
                        <th>Tags</th>
                        <th>Design Level</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </form>
@endsection
