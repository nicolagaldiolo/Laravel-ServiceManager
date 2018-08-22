<!-- END: Subheader -->
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Ajax Sourced Client Side Processing
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{{route('domains.create')}}@if(!empty($customer))?cid={{$customer->id}}@endif" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
												<span>
													<i class="la la-cart-plus"></i>
													<span>New Record</span>
												</span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                <i class="la la-ellipsis-h m--font-brand"></i>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">Quick Actions</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">Create Post</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">Send Messages</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                        <span class="m-nav__link-text">Upload File</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__section">
                                                    <span class="m-nav__section-text">Useful Links</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                        <span class="m-nav__link-text">FAQ</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">Support</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit m--hide">
                                                </li>
                                                <li class="m-nav__item m--hide">
                                                    <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Submit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="m_table_1">
                <thead>
                <tr>
                    <th>Url</th>
                    <th>Domain</th>
                    <th>Hosting</th>
                    <th>Deadline</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Payed</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- END EXAMPLE TABLE PORTLET-->
</div>


@section('scripts')
    @parent
    <script>

        window.laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


        jQuery(document).ready( function () {
            var dataTable = jQuery('#m_table_1').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{$dataTableUrl}}',
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
                            '_token': laravel.csrfToken,
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

        });
    </script>
@stop