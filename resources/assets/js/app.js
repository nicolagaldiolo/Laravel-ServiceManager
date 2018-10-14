
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//== Class Definition
var HostingManager = function($) {

    var modalPanel = $('#app_modal_panel');
    var openModalBtn = $('.open-modal');

    var custom_inline_datepicker = function(){
        $('.custom_inline_datepicker').datepicker({
            todayHighlight: true,
            format: "dd-mm-yyyy",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    }

    var general = function(){

        custom_inline_datepicker();

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

        openModalBtn.on('click', function (el) {
            el.preventDefault();

            _self = this;
            $.ajax(_self.href, {
                method: "GET",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {

                    if(data.view){
                        modalPanel.find('.modal-body').html(data.view);
                    }

                    custom_inline_datepicker();

                    modalPanel.modal('show');
                },
                error: function(resp, status, error) {
                    resp = JSON.parse(resp.responseText);
                    toastr.error(resp.message);
                },
            })

        });

        $('.modal-submit').on('click', function(el) {
            el.preventDefault();

            var btnDataTableId = $(this).attr('data-tableid');
            var dataTableRef = $('#' + btnDataTableId);

            var serviceForm = $(el.target.closest('.modal-content')).find('form');
            $.ajax(serviceForm.attr('action'), {
                method: serviceForm.attr('method'),
                data: serviceForm.serialize(), // faccio la serializzazione dei dati per inviare tutti i campi del form
                success: function (data) {
                    modalPanel.modal('hide');
                    toastr.success(data.message);

                    if(dataTableRef.length ) {
                        dataTableRef.DataTable().ajax.reload();
                    }
                },
                error: function(resp) {

                    resp = JSON.parse(resp.responseText);
                    modalPanel.find("span[data-field]").html('');

                    if(resp.errors) {
                        jQuery.each(resp.errors, function (key, value) {
                            modalPanel.find("span[data-field='" + key + "']").html('<strong>' + value + '</strong>');
                        });
                    }else{
                        toastr.error(resp.message);
                        modalPanel.modal('hide');
                    }

                },
            })
        });

    };

    var serviceRenewalsDataTable = function() {
        var obj = $('#service_renewals_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {data: "id"},
                { data: "amount" },
                { data: "status" },
                { data: "deadline" },
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
                }
            ]

        });

        dataTable.on('click', '.update-transition', function (el) {
            el.preventDefault();

            var _self = this;
            var _currentTransition = $(_self).data('transition');
            var _defaultTransition = $(_self).data('transition-default');

            $.ajax(_self.href, {

                method: "PATCH",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    toastr.success(data.message);
                    dataTable.ajax.reload();

                    if(_currentTransition == _defaultTransition){
                        swal({
                            title: 'Vuoi già creare la prossima scadenza?',
                            text: 'Modifica scadenza e importo se lo desideri',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Si, procedi'
                        }).then(function(result) {
                            if (result.value) {
                                openModalBtn.trigger( "click" );
                            }
                        });
                    }

                },
                error: function (resp, status, error) {
                    resp = JSON.parse(resp.responseText);
                    toastr.error(resp.message);
                },
            });

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
        editDataTableRecord(dataTable);

    };

    var providersDataTable = function() {
        var obj = $('#providers_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {data: "id"},
                { data: "name" },
                { data: "label" },
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
                }
            ]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);

    };

    var customersDataTable = function() {
        var obj = $('#customers_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {data: "id"},
                { data: "name" },
                { data: "email" },
                { data: "phone" },
                { data: "address" },
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
                }
            ]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);

    };

    var servicesDataTable = function() {
        var obj = $('#services_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {data: "id"},
                {data: "url"},
                {data: "customer"},
                {data: "provider"},
                {data: "service_type"},
                {data: "frequency"},
                {data: "deadline"},
                {data: "amount"},
                {data: "status"},
                {data: "actions", name: 'action', orderable: false, searchable: false}
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
                    targets: 1,
                    render: function (data, type, full, meta) {
                        var image = (full.screenshoot !== null) ? '<img src="' + full.screenshoot + '">' : '';

                        var label, status;
                        if (full.status == 1) {
                            label = "success";
                            status = Lang.get('messages.online');
                        } else {
                            label = "danger";
                            status = Lang.get('messages.offline');
                        }

                        var html = '<div class="m-card-user m-card-user--sm">' +
                            '  <div class="m-card-user__pic">' +
                            '    <div class="m-card-user__no-photo">' + image + '</div>' +
                            '  </div>' +
                            '  <div class="m-card-user__details">' +
                            '    <span class="m-card-user__name">' + data + '</span>' +
                            '    <span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + status + '</span>' +
                            '  </div>' +
                            '</div>';
                        return html;
                    },
                },

                {
                    targets: [2],
                    render: function (data, type, full, meta) {
                        return data == null ? '' : data.name;
                    },
                },

                {
                    targets: [3],
                    render: function (data, type, full, meta) {
                        if (data == null) return '';
                        var color = (typeof data.label !== 'undefined') ? 'style="background:' + data.label + '"' : '';
                        return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data.name + '</span>';
                    },
                },

                {
                    targets: [4],
                    render: function (data, type, full, meta) {
                        return data == null ? '' : data.name;
                    },
                },
            ]

        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);

    };

    var serviceTypeDataTable = function(){
        var obj = $('#serviceType_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[1, 'desc']],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                { data: "id" },
                { data: "name" },
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
                }
            ]
        });

        dataTableSelectAllSupport(dataTable);
        deleteDataTableRecord(dataTable);
        editDataTableRecord(dataTable);
    };

    var userDataTable = function(){
        var obj = $('#users_table');
        var deleteAllRoute = obj.data("deleteall");
        var dataTable = obj.DataTable({
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
                {
                    text: '<i class="m-nav__link-icon flaticon-delete-2"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
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
        deleteDataTableRecord(dataTable);
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

    var editDataTableRecord = function(dataTable){
        dataTable.on('click', '.edit', function (el) {
            el.preventDefault();

            console.log("CI sono");

            _self = this;

            $.ajax(_self.href, {
                method: "GET",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if(data.view){
                        modalPanel.find('.modal-body').html(data.view);
                    }

                    modalPanel.find('form')
                        .attr('action', $(_self).data('update'))
                        .attr('method', 'PATCH');

                    $('.custom_inline_datepicker').datepicker({
                        todayHighlight: true,
                        format: "dd-mm-yyyy",
                        templates: {
                            leftArrow: '<i class="la la-angle-left"></i>',
                            rightArrow: '<i class="la la-angle-right"></i>'
                        }
                    });

                    modalPanel.modal('show');
                },
            })

        });
    }

    var deleteDataTableRecord = function(dataTable){

        dataTable.on('click', '.deleteDataTableRecord', function (el) {
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
                    //var action = "https://hostingmanager.app/it/services/40";
                    $.ajax(action, {

                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {

                            console.log(data.redirect, window.location.href);

                            if (data.redirect &&
                                data.redirect != '' &&
                                data.redirect != window.location.href)
                            {
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

    var deleteAllDataTableRecord = function(dataTable, deleteAllRoute) {

        var deleteCheckbox = $("input[name='delete_data[]']:checked");
        var ids = deleteCheckbox.map(function () {
            return $(this).val();
        }).get();
        //var _self = this;

        if (ids.length > 0) {
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.confirm_delete')
            }).then(function(result) {
                var join_selected_values = ids.join(",");

                //console.log(join_selected_values);

                if (result.value) {
                    $.ajax(deleteAllRoute, {
                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            'ids': join_selected_values,
                        },

                        success: function (data) {

                            if (data.redirect && data.redirect != '') {
                                window.location.replace(data.redirect);
                            } else {
                                dataTable.ajax.reload();
                                toastr.success(data.message);
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
    };

    var deleteRecord = function(){

        $('.deleteRecord').on('click', function (el) {
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
                            if (data.redirect && data.redirect != '') {
                                window.location.replace(data.redirect);
                            } else {
                                toastr.success(data.message);
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

    return {
        init: function() {
            general();
            serviceRenewalsDataTable();
            providersDataTable();
            customersDataTable();
            userDataTable();
            serviceTypeDataTable();
            servicesDataTable();
            deleteRecord();
        },
    };

}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
