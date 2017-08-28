var PortfolioClass = function () {
    var newPortfolio = function () {
        var form = $('#form_portfolio_new');

        $('#save_portfolio_butt').click(function (e) {
            e.preventDefault();

            form.submit();
        });

        // initialize datepicker
        $('.date-picker').datepicker({
            autoclose: true
        });

        // initialize select2
        $("#category").select2({
            placeholder: "Select the categories ..."
        });
        $("#tags").select2({
            placeholder: "Select the tags ..."
        });

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                title: {
                    minlength: 2,
                    required: true
                },
                'category[]': {
                    required: true
                },
                thumbnail: {
                    required: true
                },
                design_level: {
                    required: true
                },
                url: {
                    required: true
                },
                'tags[]': {
                    required: true
                },
            },
            errorPlacement: function (error, element) { // render error placement for each input type
            },
            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
                // Portfolio files
                var file_ids = '';
                $('#portfolio_files tr.template-download').each(function (index) {
                    var id = $(this).attr('data-id');
                    if (file_ids)
                        file_ids += ',' + id;
                    else
                        file_ids = id;
                });
                $('#portfolio_files').val(file_ids);

                return true;
            }
        });
    }

    var uploadPortfolio = function () {
        // Initialize the jQuery File Upload widget:
        $('#form_portfolio_upload').fileupload({
            disableImageResize: false,
            autoUpload: false,
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
            // acceptFileTypes: /(\.|\/)(mp4|mpg|mpeg|avi|jpg|jpeg|gif|png|bmp)$/i
            acceptFileTypes: /(\.|\/)(jpg|jpeg|gif|png|bmp)$/i
        }).bind('fileuploadstart', function (e) {
            $('.progress-bar-success').hide();
            $('.progress-bar-success-new').show();
        }).bind('fileuploaddestroy', function (e, data) {
            return confirm('Are you sure you want to delete this file?');
        });

        // Enable iframe cross-domain access via redirect option:
        $('#form_portfolio_upload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );

        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                        new Date())
                    .appendTo('#form_portfolio_upload');
            });
        }

        // Load & display existing files:
        $('#form_portfolio_upload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: SITE_URL + '/admin_1lkh6x/portfolio/uploaded_files_api/0',
            dataType: 'json',
            context: $('#form_portfolio_upload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }

    return {
        // main function to initiate the module
        init: function () {
            newPortfolio();
            uploadPortfolio();
        }
    };
}();

jQuery(document).ready(function() {
    PortfolioClass.init();
});