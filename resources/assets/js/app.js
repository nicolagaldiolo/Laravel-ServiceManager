
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//== Class Definition
var HostingManager = function($) {

/*
    var dataTableDomains= function($url){

                var dataTable = jQuery('#m_table_1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: $url,
                    columns: [
                    { data: "url" },
                    { data: "domain" },
                    { data: "hosting" },
                    { data: "deadline" },
                    { data: "amount" },
                    { data: "note" },
                    { data: "payed" },
                    { data: "status" },
                    { data: "actions", name: 'action', orderable: false, searchable: false}
                    //{ data: "updated_at" },
                    //{ data: "deleted_at" },

                ],
                    columnDefs: [
                    {
                        targets: 0,
                        render: function(data, type, full, meta) {
                            console.log(full);
                            if(full.screenshoot == null) return data;
                            return '<img width="100" src="' + full.screenshoot + '"/>' + data;
                        },
                    },

                    {
                        targets: [ 1, 2 ],
                        render: function(data, type, full, meta) {
                            if(data == null) return data;
                            var color = (typeof data.label !== 'undefined') ? 'style="background:' + data.label + '"' : '';
                            return '<span class="m-badge ' + data + ' m-badge--wide" ' + color + '>' + data.name + '</span>';
                        },
                    },

                    {
                        targets: 6,
                        render: function(data, type, full, meta) {
                            if(data == null) return data;

                            var label,status;
                            if(data == 1){
                                label = "primary";
                                status = "Payed";
                            }else{
                                label = "danger";
                                status = "Not Payed";
                            }
                            return '<span class="m-badge  m-badge--' + label + ' m-badge--wide">' + status + '</span>';
                        },
                    },

                    {
                        targets: 7,
                        render: function(data, type, full, meta) {
                            if(data == null) return data;

                            var label,status;
                            if(data == 1){
                                label = "primary";
                                status = "Online";
                            }else{
                                label = "danger";
                                status = "Offline";
                            }
                            return '<span class="m-badge m-badge--' + label + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + label + '">' + status + '</span>';
                        },
                    },

                ]
                });



        $('#m_table_1').on('click', '.delete', function (el) {
            el.preventDefault();

            if(confirm('Are you sure to delete the service?')){
                var action = this.href;
                $.ajax(action, {

                    method: "DELETE",
                    data: {
                        '_token': laravel.csrfToken,
                    },
                    success: function( data ) {
                        //console.log(data);
                        dataTable.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    },

                })
            }

        });

        $('#m_table_1').on('click', '.setPayed', function (el) {
            el.preventDefault();

            if(confirm('Are you sure to proceed?')){
                var action = this.href;
                $.ajax(action, {

                    method: "PATCH",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'payed' : this.getAttribute('data-status')
                    },
                    success: function( data ) {
                        //console.log(data);
                        dataTable.ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    },

                })
            }

        });

    }
*/

    var general = function(){
        //$('#mycp').colorpicker();

        $('#m_inputmask_7').change(function(i){
            console.log(i);
        })

        $('.m_select2_4').select2();

        $('#m_datepicker_1').datepicker({
            todayHighlight: true,
            orientation: "bottom left",
            format: "dd-mm-yyyy"
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            general();
        },
        //datatableDomainsInit: function($url){
        //    dataTableDomains($url);
        //}
    };
}(jQuery);

//== Class Initialization
jQuery(document).ready(function() {
    HostingManager.init();
});
