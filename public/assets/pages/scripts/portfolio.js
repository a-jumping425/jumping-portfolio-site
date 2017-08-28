var PortfolioClass = function () {
    var portfolioGrid = function() {
        $.fn.dataTableExt.oStdClasses.sFilterInput = "form-control input-xs input-sm input-inline";

        var table = $("#datatable_portfolio").DataTable({
            ajax: {
                url: SITE_URL + '/admin_1lkh6x/portfolio/get_portfolios_api',
                dataType: 'json',
                method: 'GET',
                data: {}
            },
            columns: [
                {
                    data: 'thumbnail',
                    width: 80,
                    searchable: false,
                    className: 'reorder align-left',
                },
                {
                    data: 'title',
                },
                {
                    data: 'overview'
                },
                {
                    data: 'categories',
                },
                {
                    data: 'url',
                },
                {
                    data: 'tags',
                },
                {
                    data: 'design_level',
                    className: 'align-center',
                    width: 100
                },
                {
                    data: null,
                    searchable: false,
                    width: 110,
                    defaultContent: '<a href="javascript:;" class="btn btn-xs blue edit-butt"><i class="fa fa-edit"></i> Edit</a><a href="javascript:;" class="btn btn-xs red delete-butt"><i class="fa fa-trash"></i> Delete</a>'
                }
            ],
            autoWidth: false,
            paging: true,
            "lengthMenu": [
                [50, 100, 150, -1],
                [50, 100, 150, "All"] // change per page values here
            ],
            "pageLength": 50, // default record count per page
            ordering: false,
            createdRow: function(row, data, dataIndex) {
                // $(row).attr('data-id', data.DT_RowData.id);
                $(row).find('.edit-butt').attr('href', "portfolio/edit/" + data.DT_RowData.id)
            },
            rowReorder: {
                dataSrc: 'id',
                update: false   // Disable redraw after reorder
            }
        });

        // Click "Delete" button
        $('#datatable_portfolio tbody').on('click', '.delete-butt', function() {
            if( confirm('Are you sure you want to delete selected item?') ) {
                var id = table.row($(this).parents('tr')).data().id;
                // table.row($(this).parents('tr')).remove().draw();
                $.ajax({
                    method: "POST",
                    url: SITE_URL + '/admin_1lkh6x/portfolio/delete/' + id,
                    data: { '_token': $('#form_portfolio input[name="_token"]').val() },
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

        table.on('row-reorder', function(e, diff, edit) {
            // console.log(diff);
            var orders = [];
            for ( var i = 0; i < diff.length; i++ ) {
                orders[i] = {id: diff[i].oldData, pos: diff[i].newPosition};
            }

            $.ajax({
                method: "POST",
                url: SITE_URL + '/admin_1lkh6x/portfolio/reorder',
                data: {
                    '_token': $('#form_portfolio input[name="_token"]').val(),
                    orders: orders
                },
                cache: false,
                success: function(data, textStatus, jqXHR){
                    // console.log(data, textStatus, jqXHR);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // console.log(jqXHR, textStatus, errorThrown);
                    alert('Sorry! Occurred some error. Please retry again.');
                    table.ajax.reload();
                }
            });
        });
    };

    return {
        // main function to initiate the module
        init: function () {
            portfolioGrid();
        }
    };
}();

jQuery(document).ready(function() {
    PortfolioClass.init();
});