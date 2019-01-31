
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
    };

    var colorpicker = function(){
        $('.cp_colorpicker').colorpicker({
            format: 'hex'
        });
    };

    var general = function(){

        custom_inline_datepicker();
        colorpicker();

        $('.m_select2_4').select2();

        $('#m_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: "dd-mm-yyyy"
        });

        openModalBtn.on('click', function (el) {
            el.preventDefault();
            openModalAction(this);
        });

        modalPanel.on('click', 'button[type="submit"]', function(el){
            el.preventDefault();
            var dataTarget = $('[name="' + modalPanel.attr('data-target') + '"]');
            var dataTableRef = $('.dataTable');

            var serviceForm = $(el.target.closest('form'));

            $.ajax(serviceForm.attr('action'), {
                method: serviceForm.attr('method'),
                data: serviceForm.serialize(), // faccio la serializzazione dei dati per inviare tutti i campi del form
                success: function (data) {

                    modalPanel.modal('hide');
                    toastr.success(data.message);

                    if(dataTarget.length) {
                        dataTarget.append('<option value="' + data.object.id + '" selected="selected">' + data.object.name + '</option>');
                    }
                    if(dataTableRef.length ){
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
        }).on('click', '.cancel', function(el){
            el.preventDefault();
            modalPanel.modal('toggle');
        });

    };

    var openModalAction = function(obj){
        modalPanel.attr('data-target', '');
        var modalTitle = $(obj).attr('data-original-title') || '';
        $.ajax(obj.href, {
            method: "GET",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                if(data.view){
                    modalPanel.find('.modal-title').html(modalTitle);
                    modalPanel.find('.modal-body').html(data.view);
                    modalPanel.attr('data-target', $(obj).attr('data-target'));
                }

                custom_inline_datepicker();
                colorpicker();

                modalPanel.modal('show');
            },
            error: function(resp, status, error) {
                resp = JSON.parse(resp.responseText);
                toastr.error(resp.message);
            },
        })
    };

    var dashboardChart = function(){
        //== Activities Charts.
        //** Based on Chartjs plugin - http://www.chartjs.org/
            if ($('#m_chart_activities').length == 0) {
                return;
            }

            var ctx = document.getElementById("m_chart_activities").getContext("2d");

            var gradient = ctx.createLinearGradient(0, 0, 0, 240);
            gradient.addColorStop(0, Chart.helpers.color('#00c5dc').alpha(0.7).rgbString());
            gradient.addColorStop(1, Chart.helpers.color('#f2feff').alpha(0).rgbString());

            var config = {
                type: 'line',
                data: {
                    labels: [
                        Lang.get('messages.january'),
                        Lang.get('messages.february'),
                        Lang.get('messages.march'),
                        Lang.get('messages.april'),
                        Lang.get('messages.may'),
                        Lang.get('messages.june'),
                        Lang.get('messages.july'),
                        Lang.get('messages.august'),
                        Lang.get('messages.september'),
                        Lang.get('messages.october'),
                        Lang.get('messages.november'),
                        Lang.get('messages.december')
                    ],
                    datasets: [{
                        label: Lang.get('messages.total_earning'),
                        backgroundColor: gradient, // Put the gradient here as a fill color
                        borderColor: '#0dc8de',

                        pointBackgroundColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                        pointBorderColor: Chart.helpers.color('#ffffff').alpha(0).rgbString(),
                        pointHoverBackgroundColor: mApp.getColor('danger'),
                        pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.2).rgbString(),

                        //fill: 'start',
                        data: dashboardServicesDataChart
                    }]
                },
                options: {
                    title: {
                        display: false
                    },
                    tooltips: {
                        mode: 'nearest',
                        intersect: false,
                        position: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        xAxes: [{
                            display: false,
                            gridLines: false,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            gridLines: false,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    elements: {
                        line: {
                            tension: 0.0000001
                        },
                        point: {
                            radius: 4,
                            borderWidth: 12
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 10,
                            bottom: 0
                        }
                    }
                }
            };

            var chart = new Chart(ctx, config);
    };

    var dashboardCalendar = function(){
        if ($('#m_calendar').length === 0) {
            return;
        }

        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        $('#m_calendar').fullCalendar({
            isRTL: mUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            //defaultDate: moment('2018-08-15'),
            events: dashboardEvents,

            eventRender: function (event, element) {
                if (element.hasClass('fc-day-grid-event')) {
                    element.data('content', event.description);
                    element.data('placement', 'top');
                    mApp.initPopover(element);
                } else if (element.hasClass('fc-time-grid-event')) {
                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                }
            }
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
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
                { data: "deadline" },
                { data: "status" },
                { data: "amount" },
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
                    render: function (data, type, full, meta) {
                        if (data == null) return '';
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    targets: [3],
                    render: $.fn.dataTable.render.number( '.', ',', 2, '&euro; ' )
                },
            ],
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
                            title: Lang.get('messages.renewal_create_next_title'),
                            text: Lang.get('messages.renewal_create_next_desc'),
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: Lang.get('messages.yes_procede'),
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
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
                    },
                },{
                    targets: [2],
                    render: function (data, type, full, meta) {
                        if (data == null) return '';
                        var color = (typeof data !== 'undefined') ? 'style="background:' + data + '"' : '';
                        return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data + '</span>';
                    },
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [
                [7, 'desc'],
                [4, 'asc']
            ],

            headerCallback: dataTableHeaderCallback,

            processing: true,
            serverSide: true,
            ajax: '',
            columns: [
                {data: "id"},
                {data: "name"},
                {data: "provider", orderable: false},
                {data: "service_type", orderable: false},
                {data: "deadline"},
                {data: "amount"},
                {data: "status"},
                {data: "unresolved"},
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

                        var label, health;
                        if (full.health == 1) {
                            label = "success";
                            health = Lang.get('messages.online');
                        } else {
                            label = "danger";
                            health = Lang.get('messages.offline');
                        }
                        var health_html = (full.url) ? '<span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + health + '</span>' : '';

                        var html = '<div class="m-card-user m-card-user--sm">' +
                            '  <div class="m-card-user__pic">' +
                            '    <div class="m-card-user__no-photo">' + image + '</div>' +
                            '  </div>' +
                            '  <div class="m-card-user__details">' +
                            '    <span class="m-card-user__name">' + data + '</span>' +
                            '    ' + health_html +
                            '  </div>'
                            '</div>';
                        return html;
                    },
                },

                {
                    targets: [2],
                    render: function (data, type, full, meta) {
                        if (data == null) return '';
                        var color = (typeof data.label !== 'undefined') ? 'style="background:' + data.label + '"' : '';
                        return '<span class="m-badge m-badge--brand m-badge--wide" ' + color + '>' + data.name + '</span>';
                    },
                },

                {
                    targets: [3],
                    render: function (data, type, full, meta) {
                        return data == null ? '' : data.name;
                    },
                },
                {
                    targets: [4],
                    render: function (data, type, full, meta) {
                        if (data == null) return '';
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                {
                    targets: [5],
                    render: $.fn.dataTable.render.number( '.', ',', 2, '&euro; ' )
                },
                {
                    targets: [7],
                    render: function (data, type, full, meta){
                        var label = (data > 0) ? 'danger' : 'secondary';
                        return '<span class="m-badge m-badge--' + label + '">' + data + '</span>';
                    }
                }
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
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

    var renewalFrequenciesDataTable = function(){
        var obj = $('#renewalFrequencies_table');
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
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
                { data: "value" },
                { data: "type" },
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
                    text: '<i class="m-nav__link-icon flaticon-delete"></i>',
                    className: '',
                    action: function ( e, dt, node, config ) {
                        deleteAllDataTableRecord(dataTable, deleteAllRoute);
                    }
                }
            ],
            order: [[2, 'asc']],

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

            openModalAction(this);

        });
    };


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
                    $.ajax(action, {

                        method: "DELETE",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {
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

    var openAlertBeforeSubmit = function(){
        $('.openAlertBeforeSubmit').on('click', function(el){
            el.preventDefault();
            var _self = this;

            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.are_sure_desc'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.yes_procede')
            }).then(function(result) {
                if (result.value) {
                    $(_self).closest('form').submit();
                }
            })
        })
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

    var customerRenewalManager = function(){

        $(".renewal-service-row input[name^=tmp_renewal_id]").on('change', function(e){
            $(this).closest('.m-radio-inline').find('input[name^=renewal_id]').val($(this).val());
        });

        $('.renewal-service-row .suspend').on('change', function(e){
            var renewal_service_row = $(this).closest('.renewal-service-row');
            renewal_service_row.nextAll().find('input[name^=tmp_renewal_id]').prop("disabled", true);
            if(renewal_service_row.nextAll().find('.suspend:not(:checked)').length > 0){
                swal({
                    title: Lang.get('messages.customer_renewal_manager_title'),
                    text: Lang.get('messages.customer_renewal_manager_desc'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: Lang.get('messages.yes_procede')
                }).then(function(result) {
                    if(result.value){
                        renewal_service_row.nextAll().find('.suspend').prop("checked", true).trigger('change');
                    }else{
                        renewal_service_row.nextAll().find('.renew:checked').prop("disabled", false);
                        renewal_service_row.find('.renew').prop("checked", true).trigger('change');
                    }
                });
            }
        });

        $('.renewal-service-row .renew').on('change', function(e){
            $(this).closest('.renewal-service-row')
                .next().find('input[name^=tmp_renewal_id]').prop("disabled", false);
        });

    };

    var sendCustomerReminder = function(){
        $('.sendCustomerReminder').on('click', function(e){
            e.preventDefault();
            var _self = this;
            swal({
                title: Lang.get('messages.are_sure'),
                text: Lang.get('messages.customer_reminder_alert_status'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: Lang.get('messages.yes_procede')
            }).then(function(result) {

                if (result.value) {
                    var action = _self.href;
                    $.ajax(action, {

                        method: "GET",
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },

                        success: function(data) {
                            (data.type == 'warning') ?
                                toastr.warning(data.message) :
                                toastr.success(data.message);
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
            dashboardChart();
            dashboardCalendar();
            general();
            serviceRenewalsDataTable();
            providersDataTable();
            customersDataTable();
            userDataTable();
            serviceTypeDataTable();
            renewalFrequenciesDataTable();
            servicesDataTable();
            deleteRecord();
            openAlertBeforeSubmit();
            customerRenewalManager();
            sendCustomerReminder();
        },
    };

}(jQuery);

//== Class Initialization

jQuery(document).ready(function() {
    HostingManager.init();
});
