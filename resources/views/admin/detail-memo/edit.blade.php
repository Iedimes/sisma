@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.detail-memo.actions.edit', ['name' => $detailMemo->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <detail-memo-form
                :action="'{{ $detailMemo->resource_url }}'"
                :data="{{ $detailMemo->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.detail-memo.actions.edit', ['name' => $detailMemo->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.detail-memo.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </detail-memo-form>

        </div>
    
</div>

@endsection