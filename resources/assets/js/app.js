
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//== Class Definition
var HostingManager = function($) {

    var general = function(){
        $('#m_inputmask_7').change(function(i){
            console.log(i);
        });

        $('.m_select2_4').select2();

        $('#m_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: "dd-mm-yyyy"
        });

        $('.cp_colorpicker').colorpicker({
            format: 'hex'
        });

        /*$('.custom_inline_datepicker').datepicker({
            todayHighlight: true,
            format: "yyyy-mm-dd",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
        */

    };

    var userDataTable = function(){
        var dataTable = jQuery('#users_table').DataTable({
            responsive: true,
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			            <'row'<'col-sm-12'tr>>
			            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            buttons: [
                'print',
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                { data: "id" },
                { data: "avatar" },
                { data: "name" },
                { data: "email" },
                { data: "role" },
                { data: "actions", name: 'action', orderable: false, searchable: false}
            ],

            columnDefs: [
                {
                    targets: [0],
                    width: '30px',
                    className: 'dt-right',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return `
                                <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                                    <input type="checkbox" name="delete_data[]" value="${data}" class="m-checkable">
                                    <span></span>
                                </label>`;
                    }
                },
                {
                    targets: [1],
                    render: function(data, type, full, meta) {
                        if(data == null) return data;
                        return '<img class="m--img-rounded" width="50" src="' + data + '"/>';
                    },
                },
            ]
        });

        dataTableSelectAllSupport(dataTable);
        deleteRecord(dataTable);
        deleteAllRecord(dataTable);
    };

    var dataTableHeaderCallback = function(thead, data, start, end, display) {
        thead.getElementsByTagName('th')[0].innerHTML = `
                    <label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">
                        <input type="checkbox" value="" class="m-group-checkable">
                        <span></span>
                    </label>`;
    };

    var dataTableSelectAllSupport = function(dataTable){
        dataTable.on('change', '.m-group-checkable', function() {
            var set = $(this).closest('table').find('td:first-child .m-checkable');
            var checked = $(this).is(':checked');

            $(set).each(function() {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                }
                else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        dataTable.on('change', 'tbody tr .m-checkbox', function() {
            $(this).parents('tr').toggleClass('active');
        });
    };


    var deleteRecord = function(dataTable){

        dataTable.on('click', '.deleteRecord', function (el) {
            el.preventDefault();
            var _self = this;
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.confirm_delete')
            }).then(function(result) {

                if (result.value) {
                    var action = _self.href;
                    $.ajax(action, {

                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {
                            if (data.redirect != '') {
                                window.location.replace(data.redirect);
                            } else {
                                toastr.success(data.message);
                                dataTable.ajax.reload();
                            }
                        },
                        error: function(resp, status, error) {
                            resp = JSON.parse(resp.responseText);
                            toastr.error(resp.message);
                        },

                    })
                }
            });

        });
    };

    var deleteAllRecord = function(dataTable) {
        $(document).on('click', '.deleteAllRecord', function (el) {
            el.preventDefault();
            var deleteCheckbox = $("input[name='delete_data[]']:checked");
            var ids = deleteCheckbox.map(function () {
                return $(this).val();
            }).get();
            var _self = this;

            if (ids.length > 0) {
                swal({
                    title: Lang.get('messages.are_sure'),
                    text: Lang.get('messages.are_sure_desc'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: Lang.get('messages.confirm_delete')
                }).then(function(result) {
                    var join_selected_values = ids.join(",");

                    if (result.value) {
                        $.ajax(_self.href, {
                            method: "GET",
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'ids': join_selected_values,
                            },

                            success: function (data) {
                                if (data.redirect != '') {
                                    window.location.replace(data.redirect);
                                } else {
                                    toastr.success(data.message);
                                    dataTable.ajax.reload();
                                }
                            },
                            error: function (resp, status, error) {
                                resp = JSON.parse(resp.responseText);
                                toastr.error(resp.message);
                            },

                        })
                    }
                });
            }

        });
    };

    return {
        init: function() {
            general();
            userDataTable();
        },
    };
}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
