var PortfolioCategory = function () {
    var saveCategory = function () {
        var form = $('#form_portfolio_category');

        form.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: {
                name: {
                    minlength: 2,
                    required: true
                }
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
            submitHandler: function (form) {
                form[0].submit(); // submit the form
            }
        });
    }

    var categoryGrid = function () {
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_category"),
            dataTable: {
                ajax: {
                    url: 'http://localhost/ajax_p_category.php'
                }
            }
        });
    }

    return {
        // main function to initiate the module
        init: function () {
            saveCategory();
            categoryGrid();
        }
    };
}();

jQuery(document).ready(function() {
    PortfolioCategory.init();
});