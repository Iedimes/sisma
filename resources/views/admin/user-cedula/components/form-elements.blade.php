<div class="form-group row align-items-center" :class="{'has-danger': errors.has('user_id'), 'has-success': fields.user_id && fields.user_id.valid }">
    <label for="user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user-cedula.columns.user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        {{-- <input type="text" v-model="form.user_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('user_id'), 'form-control-success': fields.user_id && fields.user_id.valid}" id="user_id" name="user_id" placeholder="{{ trans('admin.user-cedula.columns.user_id') }}"> --}}
        <multiselect
            v-model="form.user"
            :options="user"
            :multiple="false"
            track-by="id"
            label="full_name"
            :taggable="true"
            tag-placeholder=""
            placeholder="">
        </multiselect>
        <div v-if="errors.has('user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('user_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('cedula'), 'has-success': fields.cedula && fields.cedula.valid }">
    <label for="cedula" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user-cedula.columns.cedula') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.cedula" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('cedula'), 'form-control-success': fields.cedula && fields.cedula.valid}" id="cedula" name="cedula" placeholder="{{ trans('admin.user-cedula.columns.cedula') }}">
        <div v-if="errors.has('cedula')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('cedula') }}</div>
    </div>
</div>


