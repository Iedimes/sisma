@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.doc-type.actions.edit', ['name' => $docType->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <doc-type-form
                :action="'{{ $docType->resource_url }}'"
                :data="{{ $docType->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.doc-type.actions.edit', ['name' => $docType->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.doc-type.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </doc-type-form>

        </div>
    
</div>

@endsection