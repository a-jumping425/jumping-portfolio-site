var PortfolioTag = function () {
    var saveTag = function () {
        var form = $('#form_portfolio_tag');

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
    };

    var tagGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";
        $.fn.dataTableExt.oStdClasses.sLengthSelect = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_tag").DataTable({
            ajax: {
                url: SITE_URL + '/api/portfolio/get_tags',
                dataType: 'json',
                method: 'post',
                data: {}
            },
            columns: [
                {
                    data: 'name',
                    width: '20%',

                },
                {
                    data: 'description'
                },
                {
                    data: 'slug',
                    width: '20%'
                },
                {
                    data: null,
                    searchable: false,
                    width: 110,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a><a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a>'
                }
            ],
            lengthMenu: [
                [15, 50, 100, -1],
                [15, 50, 100, "All"] // change per page values here
            ],
            pageLength: 15,     // set the initial value
            paging: true,
            ordering: false,
            // pagingType: "bootstrap_extended",
            pagingType: "bootstrap_full_number",
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', SITE_URL + '/admin_1lkh6x/portfolio/tag/edit/' + data.id)
            },
        });

        // Click "Delete" button
        $('#datatable_tag tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: SITE_URL + '/admin_1lkh6x/portfolio/tag/delete/' + id,
                    data: { '_token': $('#form_portfolio_tag input[name="_token"]').val() },
                    cache: false,
                    success: function(data, textStatus, jqXHR){
                        // console.log('success', data, textStatus, jqXHR);
                        table.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        // console.log('error', jqXHR, textStatus, errorThrown);
                        alert('Sorry! Occurred some error. Please retry again.');
                        table.ajax.reload();
                    }
                });
            }
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            saveTag();
            tagGrid();
        }
    };
}();

jQuery(document).ready(function() {
    PortfolioTag.init();
});