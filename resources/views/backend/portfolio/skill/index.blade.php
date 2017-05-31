@extends('backend.template')

@section('title', 'All portfolio skills')

@section('page_level_plugins_css')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
<script src="/assets/pages/scripts/portfolio-skill.js" type="text/javascript"></script>
@endsection

@section('content')
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ url('/') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="{{ url('/portfolio') }}">Portfolio</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Skill</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Portfolio Skill</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-4">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold font-green uppercase">Add New Skill</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="form_portfolio_skill" action="/portfolio/skill/save" method="post">
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
                        <button type="submit" class="btn green">Add New Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
            <table class="table table-striped table-bordered table-hover" id="datatable_skill">
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
