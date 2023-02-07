@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.memo.actions.index'))

@section('body')

<div class="card">
    <div class="card-header text-center">
         DOCUMENTO

         {{-- <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0 rounded-pill" href="{{ url('admin/helps') }}" role="button"><i class="fa fa-undo"></i>&nbsp; {{ trans('admin.help.show') }}</a>
         {{-- <a href='admin/helps' class="btn btn-primary"> VOLVER <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-undo'"></i></a> --}}<br>

       {{--  <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0 rounded-pill" href="{{ url('admin/helps/finalizadas') }}" role="button"><i class="fa fa-undo"></i>&nbsp; {{ trans('admin.help.show') }}</a>
        --}}
    </div>
    {{-- <div style="text-align: right; font-weight:  bolder">{{ $local_dependencia->name }}</div> --}}

    <div class="card-body">

        <div class="row">
            <div class="form-group col-sm-2">
            <p class="card-text"><strong>NUMERO:</strong>  {{ $memo->number_memo }}</p>
            </div>
            <div class="form-group col-sm-3">
                <p class="card-text"><strong>REFERENCIA:</strong>  {{ $memo->ref }}</p>
            </div>
            <div class="form-group col-sm-3">
                <p class="card-text"><strong>ORIGEN:</strong> {{$memo->origen->name}}</p>
            </div>
            <div class="form-group col-sm-4">
                <p class="card-text"><strong>DESTINO:</strong> {{$memo->destino->name}} </p>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-2">
                <p class="card-text"><strong>FECHA_DOC:</strong> {{ date('d/m/Y',strtotime(trim($memo->date_doc))) }}</p>
            </div>
            <div class="form-group col-sm-3">
                <p class="card-text"><strong>FECHA_ENTRADA:</strong> {{ date('d/m/Y H:i:s',strtotime(trim($memo->date_entry))) }}</p>
            </div>
            <div class="form-group col-sm-3">
                <p class="card-text"><strong>OBSERVACION:</strong> {{ $memo->obs }}</p>

            </div>
            <div class="form-group col-sm-4">
                <p class="card-text"><strong>RECEPCIONADO POR:</strong> {{ $memo->user_admin->full_name }}</p>

            </div>
        </div>

        <div class="row">
            @if (empty($memo->imagen->id))
            <div class="form-group col-sm-2">
                <p class="card-text"><strong>MOVIMIENTOS:</strong> <a class="btn btn-sm btn-danger pull-right m-b-0 rounded-pill" href="{{ url('admin/detail-memos/'.$memos->id.'/pdf/') }}" title="{{ trans('brackets/admin-ui::admin.btn.show') }}" role="button"><i class="fa fa-file-pdf-o "></i>&nbsp;GENERAR PDF</a></p>
            </div>

            @else
            <div class="form-group col-sm-2">
                <p class="card-text"><strong>ADJUNTO:</strong> <a class="btn btn-sm btn-danger" href="/media/{{$memo->imagen->id}}/{{ $memo->imagen->file_name}}"  target= '_blank' title="{{ trans('brackets/admin-ui::admin.btn.show') }}" role="button"><i class="fa fa-file-pdf-o"></i>&nbsp;PDF</a></p>
            </div>
            <div class="form-group col-sm-3">
                <p class="card-text"><strong>MOVIMIENTOS:</strong> <a class="btn btn-sm btn-danger pull-center m-b-0" href="{{ url('admin/detail-memos/'.$memo->id.'/pdf/') }}" role="button"><i class="fa fa-file-pdf-o "></i> GENERAR REPORTE</a></p>

            </div>
            @endif
        </div>



    </div>
  </div>


<detail-memo-listing
:data="{{ $data->toJson() }}"
:url="'{{ url('admin/detail-memos') }}'"
:local="{{$local_dependencia->id}}"
{{-- :detalle="{{ $detalle->estado->id }}" --}}
inline-template>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ trans('admin.detail-memo.actions.index') }}

                {{-- <div v-if="{{ $detalle->estado->id }}==2">
                </div>

                <div v-else-if="{{ $detalle->estado->id }}==1">
                </div>

                <div v-else>

                    <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/memos/'.$memo->id.'/createdetail') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.detail-memo.actions.create') }}</a>

                </div> --}}



            </div>
            <div class="card-body" v-cloak>
                <div class="card-block">
                    {{-- <form @submit.prevent="">
                        <div class="row justify-content-md-between">
                            <div class="col col-lg-7 col-xl-5 form-group">
                                <div class="input-group">
                                    <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
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
                    </form> --}}

                    <table class="table table-hover table-listing">
                        <thead>
                            <tr>
                                {{-- <th class="bulk-checkbox">
                                    <input class="form-check-input" id="enabled" type="checkbox" v-model="isClickedAll" v-validate="''" data-vv-name="enabled"  name="enabled_fake_element" @click="onBulkItemsClickedAllWithPagination()">
                                    <label class="form-check-label" for="enabled">
                                        #
                                    </label>
                                </th> --}}

                                {{-- <th is='sortable' :column="'id'">{{ trans('admin.detail-memo.columns.id') }}</th>
                                <th is='sortable' :column="'memo_id'">{{ trans('admin.detail-memo.columns.memo_id') }}</th> --}}
                                <th is='sortable' :column="'odependency_id'">{{ trans('admin.detail-memo.columns.odependency_id') }}</th>
                                <th is='sortable' :column="'ddependency_id'">{{ trans('admin.detail-memo.columns.ddependency_id') }}</th>
                                <th is='sortable' :column="'date_entry'">{{ trans('admin.detail-memo.columns.date_entry') }}</th>
                                <th is='sortable' :column="'date_exit'">{{ trans('admin.detail-memo.columns.date_exit') }}</th>
                                <th is='sortable' :column="'obs'">{{ trans('admin.detail-memo.columns.obs') }}</th>
                                <th is='sortable' :column="'state_id'">{{ trans('admin.detail-memo.columns.state_id') }}</th>
                                <th is='sortable' :column="'admin_user_id'">{{ trans('admin.detail-memo.columns.admin_user_id') }}</th>

                                <th></th>
                            </tr>
                            <tr v-show="(clickedBulkItemsCount > 0) || isClickedAll">
                                <td class="bg-bulk-info d-table-cell text-center" colspan="10">
                                    <span class="align-middle font-weight-light text-dark">{{ trans('brackets/admin-ui::admin.listing.selected_items') }} @{{ clickedBulkItemsCount }}.  <a href="#" class="text-primary" @click="onBulkItemsClickedAll('/admin/detail-memos')" v-if="(clickedBulkItemsCount < pagination.state.total)"> <i class="fa" :class="bulkCheckingAllLoader ? 'fa-spinner' : ''"></i> {{ trans('brackets/admin-ui::admin.listing.check_all_items') }} @{{ pagination.state.total }}</a> <span class="text-primary">|</span> <a
                                                href="#" class="text-primary" @click="onBulkItemsClickedAllUncheck()">{{ trans('brackets/admin-ui::admin.listing.uncheck_all_items') }}</a>  </span>

                                    <span class="pull-right pr-2">
                                        <button class="btn btn-sm btn-danger pr-3 pl-3" @click="bulkDelete('/admin/detail-memos/bulk-destroy')">{{ trans('brackets/admin-ui::admin.btn.delete') }}</button>
                                    </span>

                                </td>
                            </tr>

                        <tbody>
                            <tr v-for="(item, index) in collection" :key="item.id" :class="bulkItems[item.id] ? 'bg-bulk' : ''" v-if="item.post_ddependencia_detalle.id == {{$local_dependencia->id}} && item.estado_detalle.id != 2">
                                {{-- <td class="bulk-checkbox">
                                    <input class="form-check-input" :id="'enabled' + item.id" type="checkbox" v-model="bulkItems[item.id]" v-validate="''" :data-vv-name="'enabled' + item.id"  :name="'enabled' + item.id + '_fake_element'" @click="onBulkItemClicked(item.id)" :disabled="bulkCheckingAllLoader">
                                    <label class="form-check-label" :for="'enabled' + item.id">
                                    </label>
                                </td> --}}

                                {{-- <td>@{{ item.id }}</td>
                                <td>@{{ item.memo_id }}</td>--}}
                                <td>@{{ item.post_odependencia_detalle.name }}</td>
                                <td>@{{ item.post_ddependencia_detalle.name }}</td>
                                <td>@{{ item.date_entry | datetime("DD/MM/Y HH:mm:ss") }}</td>
                                <td>@{{ item.date_exit | datetime("DD/MM/Y HH:mm:ss") }}</td>
                                <td>@{{ item.obs }}</td>
                                <td>@{{ item.estado_detalle.name }}</td>
                                <td>@{{ item.user_admin_detalle.full_name }}</td>

                                <td>
                                <div class="row no-gutters">
                                        {{-- <div class="col-auto">
                                            <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                        </div> --}}
                                    <div class="col-auto" v-if="item.estado_detalle.id==3">
                                        <a :href="item.resource_url + '/actualizar'" class="btn btn-success"> <i class="fa" :class="submiting ? 'fa-spinner' : 'fa fa-arrow-down'" title="Recibir documento"></i></a>
                                    </div>
                                        <div class="col-auto" v-if="item.estado_detalle.id==1">
                                            <a :href="item.resource_url + '/enviar'" class="btn btn-info">  <i class="fa" :class="submiting ? 'fa-spinner' : 'fa fa-paper-plane-o'" title="Enviar documento"></i></a>
                                            <a :href="item.resource_url + '/archivar'" class="btn btn-warning"> <i class="fa" :class="submiting ? 'fa-spinner' : 'fa fa-hdd-o'" title="Archivar documento"></i></a>

                                        </div>
                                        <div class="col-auto" v-if="item.estado_detalle.id==4">
                                            {{-- <a :href="item.resource_url + '/enviar'" class="btn btn-info rounded-pill">  <i class="fa"  title="Enviar documento"><b>ENVIAR</b></i></a>
                                            <a :href="item.resource_url + '/archivar'" class="btn btn-warning rounded-pill">  <i class="fa" title="Archivar documento"><b>ARCHIVAR</b></i></a> --}}
                                        </div>

                                        {{-- <div class="col-auto">
                                            <a :href="item.resource_url + '/archivar'" class="btn btn-warning rounded-pill">  <i class="fa" :class="submiting ? 'fa-spinner' : 'fa fa-external-link-square'" title="Archivar documento"></i></a>
                                        </div> --}}


                                        {{-- <div class="col-auto" v-if="item.estado_detalle.id!=3">
                                            <a href="{{ url('admin/memos/'.$memo->id.'/createdetail') }}" class="btn btn-info rounded-pill">  <i class="fa" :class="submiting ? 'fa-spinner' : 'fa fa-external-link-square'" title="Enviar documento"></i></a>
                                        </div> --}}
                                        {{-- <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                            <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                        </form>--}}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- <div class="row" v-if="pagination.state.total > 0">
                        <div class="col-sm">
                            <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                        </div>
                        <div class="col-sm-auto">
                            <pagination></pagination>
                        </div>
                    </div> --}}

                    <div class="no-items-found" v-if="!collection.length > 0">
                        <i class="icon-magnifier"></i>
                        <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
                        <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                        <a class="btn btn-primary btn-spinner" href="{{ url('admin/detail-memos/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.detail-memo.actions.create') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</detail-memo-listing>

@endsection
