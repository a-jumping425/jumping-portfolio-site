@extends('backend.template')

@section('title', 'Edit Portfolio')

@section('page_level_plugins_css')
    <link href="{{ url('/') }}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
    <link href="{{ url('/') }}/assets/pages/css/portfolio-edit.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_plugins_js')
    <script src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
@endsection

@section('page_level_js')
    <script src="{{ url('/') }}/assets/pages/scripts/portfolio-edit.js" type="text/javascript"></script>
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
                <span>Edit Portfolio</span>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">Edit Portfolio</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject bold font-blue-steel uppercase">Portfolio Info</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <form id="form_portfolio_edit" action="{{ url('admin_1lkh6x/portfolio/save') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $portfolio->title }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Overview</label>
                                    <textarea name="overview" class="form-control" rows="5">{{ $portfolio->overview }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Category</label>
                                    <select class="form-control" name="category[]" id="category" multiple>
                                        @foreach($categories as $category)
                                            @if (in_array($category->id, $selected_categories))
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" style="display: block;">Featured image</label>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 250px;">
                                            <img src="{{ $portfolio->thumbnail }}" alt="" /> </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px;"> </div>
                                        <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Select image </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="thumbnail" />
                                        </span>
                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tags</label>
                                    <select class="form-control" name="tags[]" id="tags" multiple="multiple">
                                        @foreach($tags as $tag)
                                            @if (in_array($tag->id, $selected_tags))
                                                <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                            @else
                                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Technologies</label>
                                    <select class="form-control" name="technologies[]" id="technologies" multiple="multiple">
                                        @foreach($technologies as $tech)
                                            @if (in_array($tech->id, $selected_technologies))
                                                <option value="{{ $tech->id }}" selected>{{ $tech->name }}</option>
                                            @else
                                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Design level</label>
                                    <select class="form-control" style="width: 250px;" name="design_level">
                                        <option value="">Select a design level ...</option>
                                        @foreach(config('constants.design_levels') as $key => $value)
                                            @if ($portfolio->design_level == $key)
                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Project url</label>
                                    <input type="text" name="url" class="form-control" value="{{ $portfolio->url }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Completed Date (Optional)</label>
                                    <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="completed_date" value="{{ $portfolio->completed_date }}" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Client (Optional)</label>
                                    <input type="text" name="client" class="form-control" value="{{ $portfolio->client }}" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Visibility</label>
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="visibility" id="visibility_show" value="1"
                                                   @if ($portfolio->visibility) checked="" @endif /> Show
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="visibility" id="visibility_hidden" value="0"
                                                   @if ($portfolio->visibility == 0) checked="" @endif> Hidden
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="margin-top-10">
                                        <button type="submit" id="save_portfolio_butt" class="btn blue-steel">Save Portfolio</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="portfolio_id" value="{{ $portfolio->id }}"/>
                            <input type="hidden" name="portfolio_files" id="portfolio_files" value="" />
                        </form>
                        <form id="form_portfolio_upload" action="{{ url('admin_1lkh6x/portfolio/upload_file') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Portfolio Files</label>
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn blue-steel fileinput-button">
                                            <i class="fa fa-plus"></i>
                                            <span> Add file </span>
                                            <input type="file" name="portfolio_file"> </span>
                                            <!--button type="submit" class="btn blue start">
                                                <i class="fa fa-upload"></i>
                                                <span> Start upload </span>
                                            </button>
                                            <button type="reset" class="btn warning cancel">
                                                <i class="fa fa-ban-circle"></i>
                                                <span> Cancel upload </span>
                                            </button-->
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process"> </span>
                                        </div>
                                    </div>
                                    <!-- The table listing the files available for upload/download -->
                                    <table id="portfolio_files" role="presentation" class="table table-striped clearfix">
                                        <tbody class="files"> </tbody>
                                    </table>
                                </div>
                            </div>
                            <input type="hidden" name="portfolio_id" value="{{ $portfolio->id }}"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The blueimp Gallery widget -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
        <div class="slides"> </div>
        <h3 class="title"></h3>
        <a class="prev"> ‹ </a>
        <a class="next"> › </a>
        <a class="close white"> </a>
        <a class="play-pause"> </a>
        <ol class="indicator"> </ol>
    </div>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                <div class="progress-bar progress-bar-success-new" style="width:100%;"></div>
            </div>
        </td>
        <td> {% if (!i && !o.options.autoUpload) { %}
            <button class="btn blue start" disabled>
                <i class="fa fa-upload"></i>
                <span>Start</span>
            </button> {% } %} {% if (!i) { %}
            <button class="btn red cancel">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %} </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade" data-id="{%=file.id%}">
        <td>
            <span class="preview portfolio-image-thumbnail">
                {% if (file.is_image) { %}
                    <img src="{%=file.url%}">
                {% } %}
            </span>
        </td>
        <td>
            <p class="name"> {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
            <div>
                <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td> {% if (file.deleteUrl) { %}
            <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                <i class="fa fa-trash-o"></i>
                <span>Delete</span>
            </button>
            {% } else { %}
            <button class="btn yellow cancel btn-sm">
                <i class="fa fa-ban"></i>
                <span>Cancel</span>
            </button> {% } %} </td>
    </tr> {% } %} </script>
@endsection
