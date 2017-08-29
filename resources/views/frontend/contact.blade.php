@extends('frontend.template')

@section('title', 'Contact')

@section('page_level_plugins_css')
    <link href="{{ url('/') }}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
@endsection

@section('page_level_plugins_js')
    <script src="{{ url('/') }}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="http://maps.google.com/maps/api/js?key=AIzaSyD1WboZa7GwjCVDa83rkcsFRFZgQk96DN0" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/global/plugins/gmaps/gmaps.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/assets/pages/scripts/contact-us.js" type="text/javascript"></script>

    <script src="{{ url('/') }}/assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();
            Layout.initUniform();
            Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
            ContactUs.init();
        });
    </script>
@endsection

@section('content')
<div class="main">
    <div class="container">
        <div class="row margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12">
                <h1>Contacts</h1>
                <div class="content-page">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="map" class="gmaps margin-bottom-40" style="height:400px;"></div>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <h2>Contact Form</h2>
                            <p>Lorem ipsum dolor sit amet, Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat consectetuer adipiscing elit, sed diam nonummy nibh euismod tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>

                            <!-- BEGIN FORM-->
                            <form action="#" role="form">
                                <div class="form-group">
                                    <label for="contacts-name">Name</label>
                                    <input type="text" class="form-control" id="contacts-name">
                                </div>
                                <div class="form-group">
                                    <label for="contacts-email">Email</label>
                                    <input type="email" class="form-control" id="contacts-email">
                                </div>
                                <div class="form-group">
                                    <label for="contacts-message">Message</label>
                                    <textarea class="form-control" rows="5" id="contacts-message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Send</button>
                            </form>
                            <!-- END FORM-->
                        </div>

                        <div class="col-md-3 col-sm-3 sidebar2">
                            <h2>Our Contacts</h2>
                            <address>
                                <strong>Loop, Inc.</strong><br>
                                795 Park Ave, Suite 120<br>
                                San Francisco, CA 94107<br>
                                <abbr title="Phone">P:</abbr> (234) 145-1810
                            </address>
                            <address>
                                <strong>Email</strong><br>
                                <a href="mailto:info@email.com">info@email.com</a><br>
                                <a href="mailto:support@example.com">support@example.com</a>
                            </address>

                            <h2 class="padding-top-30">About Us</h2>
                            <p>Sediam nonummy nibh euismod tation ullamcorper suscipit</p>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check"></i> Officia deserunt molliti</li>
                                <li><i class="fa fa-check"></i> Consectetur adipiscing </li>
                                <li><i class="fa fa-check"></i> Deserunt fpicia</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
</div>
@endsection
