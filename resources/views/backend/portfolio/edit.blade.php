@extends('backend.template')

@section('title', 'New portfolio')

@section('page_level_plugins_css')

@endsection

@section('page_level_plugins_js')

@endsection

@section('page_level_js')

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
            <a href="{{ url('/portfolio') }}">Portfolios</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>New portfolio</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Add New Portfolio</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        Display all portfolios.
    </div>
</div>
@endsection
