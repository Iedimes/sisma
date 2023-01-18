@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.memo.actions.edit', ['name' => $memo->id]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <memo-form
                :action="'{{ $memo->resource_url }}'"
                :data="{{$memo->toJson()}}"
                :type="{{$type->toJson()}}"
                :odependency="{{$odependency->toJson()}}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.memo.actions.edit', ['name' => $memo->id]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.memo.components.form-elements')
                        @include('brackets/admin-ui::admin.includes.media-uploader', [
                            'mediaCollection' => app(App\Models\Memo::class)->getMediaCollection('gallery'),
                            'media' => $memo->getThumbs200ForCollection('gallery'),
                            'label' => 'Foto'
                        ])
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>

                </form>

        </memo-form>

        </div>

</div>

@endsection
