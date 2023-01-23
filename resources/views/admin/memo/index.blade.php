@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.memo.actions.index'))

@section('body')
<body onLoad="setTimeout('self.location.reload()', 300000)"></body>

    <memo-listing
        :data="{{ $data->toJson() }}"
        :depen="{{ $depen }}"
        :url="'{{ url('admin/memos') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.memo.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/memos/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.memo.actions.create') }}</a>
                    </div>
                    {{-- <div style="text-align: right; font-weight:  bolder ">{{$depen->dpto->DepenDes}}</div> --}}
                    <div class="card-body" v-cloak>
                        <div class="card-block">
                            <form @submit.prevent="">
                                <div class="row justify-content-md-between">
                                    <div class="col col-lg-7 col-xl-5 form-group">
                                        <div class="input-group">
                                            <input class="form-control" placeholder="BUSCAR POR NRO DOC, REF, OBS" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto form-group ">
                                        <select class="form-control" v-model="pagination.state.per_page">

                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <table class="table table-hover table-listing">
                                <thead>
                                    <tr>
                                        {{-- <th class="bulk-checkbox">
                                            <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                            <label class="form-check-label" for="enabled">
                                                #
                                            </label>
                                        </th> --}}

                                        {{-- <th is='sortable' :column="'id'">{{ trans('admin.memo.columns.id') }}</th> --}}

                                        <th is='sortable' :column="'number_memo'">{{ trans('admin.memo.columns.number_memo') }}</th>
                                        <th is='sortable' :column="'type_id'">{{ trans('admin.memo.columns.type_id') }}</th>
                                        <th is='sortable' :column="'ref'">{{ trans('admin.memo.columns.ref') }}</th>
                                        <th is='sortable' :column="'obs'">{{ trans('admin.memo.columns.obs') }}</th>
                                        <th is='sortable' :column="'date_doc'">{{ trans('admin.memo.columns.date_doc') }}</th>
                                        <th is='sortable' :column="'date_entry'">{{ trans('admin.memo.columns.date_entry') }}</th>
                                        {{-- <th is='sortable' :column="'date_exit'">{{ trans('admin.memo.columns.date_exit') }}</th> --}}
                                        <th is='sortable' :column="'odependency_id'">{{ trans('admin.memo.columns.odependency_id') }}</th>
                                        <th is='sortable' :column="'ddependency_id'">{{ trans('admin.memo.columns.ddependency_id') }}</th>
                                        <th is='sortable' :column="'admin_user_id'">{{ trans('admin.memo.columns.admin_user_id') }}</th>
                                        <th is='sortable' :column="'state_id'">{{ trans('admin.memo.columns.state_id') }}</th>


                                        <th></th>
                                    </tr>
                                    <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                        <td class="bg-bulk-info d-table-cell text-center" colspan="14">
                                            <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/memos')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                        href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                            <span class="pull-right pr-2">
                                                <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/memos/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                            </span>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''">
                                        {{-- <td class="bulk-checkbox">
                                            <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                            <label class="form-check-label" :for="'enabled' + item.id">
                                            </label>
                                        </td> --}}

                                    {{-- <td>@{{ item.id }}</td> --}}

                                        <td>@{{ item.number_memo }}</td>
                                        <td>@{{ item.tipo_doc.name }}</td>
                                        <td>@{{ item.ref }}</td>
                                        <td>@{{ item.obs }}</td>
                                        <td>@{{ item.date_doc | date("DD/MM/Y") }}</td>
                                        <td>@{{ item.estado.date_entry | datetime("DD/MM/Y HH:mm:ss") }}</td>
                                        {{-- <td>@{{ item.date_exit | datetime }}</td> --}}
                                        <td>@{{ item.origen.name }}</td>
                                        <td>@{{ item.estado.post_ddependencia_detalle.name }}</td>
                                        <td>@{{ item.estado.user_admin_detalle.full_name }}</td>
                                        <td>@{{ item.estado.estado_detalle.name }}</td>

                                        {{-- <td>{{ $depen->UniOrgCod }}</td> --}}

                                        <td>
                                            <div class="row no-gutters">
                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info rounded-pill" :href="item.resource_url + '/show'" title="{{ trans('brackets/admin-ui::admin.btn.show') }}" role="button"><i class="fa fa-search"></i></a>
                                                </div>

                                                <div class="col-auto">
                                                    <a class="btn btn-sm btn-spinner btn-info rounded-pill" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                    {{-- <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button> --}}
                                                </form>
                                                {{-- <div class="col-auto">

                                                    <a class="btn btn-sm btn-danger rounded-pill" :href="'../media/' + item.imagen.id + '/' + item.imagen.file_name" target= '_blank' title="{{ trans('brackets/admin-ui::admin.btn.pdf') }}" role="button"><i class="fa fa-file-pdf-o"></i></a>

                                               </div> --}}

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>

                            <div class="no-items-found" v-if="!collection.length > 0">
                                <i class="icon-magnifier"></i>
                                <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                                <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                                <a class="btn btn-primary btn-spinner" href="{{ url('admin/memos/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.memo.actions.create') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </memo-listing>

@endsection
