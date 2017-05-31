@extends('backend.template')

@section('title', 'Edit portfolio skill')

@section('page_level_plugins_css')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
<script src="/assets/pages/scripts/portfolio-skill-edit.js" type="text/javascript"></script>
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
            <a href="{{ url('/portfolio/skill') }}">Skills</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Edit skill</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Edit portfolio skill</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold font-green uppercase">Edit Skill</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="form_portfolio_skill" action="/portfolio/skill/save" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $skill->name }}" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $skill->slug }}" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" class="form-control" rows="5">{{ $skill->description }}</textarea>
                    </div>
                    <div class="margin-top-10">
                        <button type="submit" class="btn green">Update Category</button>
                    </div>
                    <input type="hidden" name="id" value="{{ $skill->id }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
