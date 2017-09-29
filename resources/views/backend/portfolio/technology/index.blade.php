@extends('backend.template')

@section('title', 'All portfolio technologies')

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

@section('page_level_js')
<script src="{{ url('/') }}/assets/pages/scripts/portfolio-technology.js" type="text/javascript"></script>
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
            <a href="{{ url('/admin_1lkh6x/portfolios') }}">Portfolios</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Technologies</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Portfolio Technology</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-4">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold font-green uppercase">Add New Technology</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="form_portfolio_technology" action="{{ url('admin_1lkh6x/portfolio/technology/save') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Slug</label>
                        <input type="text" name="slug" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="margin-top-10">
                        <button type="submit" class="btn green">Add New Technology</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
            <table class="table table-striped table-bordered table-hover" id="datatable_technology">
                <thead>
                <tr role="row" class="heading">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
    </div>
</div>
@endsection
