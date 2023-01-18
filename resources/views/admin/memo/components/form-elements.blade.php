<div class="form-group row align-items-center" :class="{'has-danger': errors.has('odependency_id'), 'has-success': fields.odependency_id && fields.odependency_id.valid }">
    <label for="odependency_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.odependency_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        {{-- <input type="text" v-model="form.odependency_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('odependency_id'), 'form-control-success': fields.odependency_id && fields.odependency_id.valid}" id="odependency_id" name="odependency_id" placeholder="{{ trans('admin.memo.columns.odependency_id') }}"> --}}
        <multiselect
            v-model="form.odependency"
            :options="odependency"
            :multiple="false"
            track-by="id"
            label="name"
            :taggable="true"
            tag-placeholder=""
            placeholder="{{ trans('admin.memo.columns.odependency_id') }}">
        </multiselect>
        <div v-if="errors.has('odependency_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('odependency_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('number_memo'), 'has-success': fields.number_memo && fields.number_memo.valid }">
    <label for="number_memo" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.number_memo') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.number_memo" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('number_memo'), 'form-control-success': fields.number_memo && fields.number_memo.valid}" id="number_memo" name="number_memo" placeholder="{{ trans('admin.memo.columns.number_memo') }}">
        <div v-if="errors.has('number_memo')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('number_memo') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('ref'), 'has-success': fields.ref && fields.ref.valid }">
    <label for="ref" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.ref') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.ref" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('ref'), 'form-control-success': fields.ref && fields.ref.valid}" id="ref" name="ref" placeholder="{{ trans('admin.memo.columns.ref') }}">
        <div v-if="errors.has('ref')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ref') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('obs'), 'has-success': fields.obs && fields.obs.valid }">
    <label for="obs" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.obs') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.obs" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('obs'), 'form-control-success': fields.obs && fields.obs.valid}" id="obs" name="obs" placeholder="{{ trans('admin.memo.columns.obs') }}">
        <div v-if="errors.has('obs')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('obs') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date_doc'), 'has-success': fields.date_doc && fields.date_doc.valid }">
    <label for="date_doc" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.date_doc') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date_doc" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('date_doc'), 'form-control-success': fields.date_doc && fields.date_doc.valid}" id="date_doc" name="date_doc" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('date_doc')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date_doc') }}</div>
    </div>
</div>

{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('date_entry'), 'has-success': fields.date_entry && fields.date_entry.valid }">
    <label for="date_entry" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.date_entry') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date_entry" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('date_entry'), 'form-control-success': fields.date_entry && fields.date_entry.valid}" id="date_entry" name="date_entry" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('date_entry')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date_entry') }}</div>
    </div>
</div> --}}

{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('date_exit'), 'has-success': fields.date_exit && fields.date_exit.valid }">
    <label for="date_exit" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.date_exit') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.date_exit" :config="datetimePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('date_exit'), 'form-control-success': fields.date_exit && fields.date_exit.valid}" id="date_exit" name="date_exit" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('date_exit')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date_exit') }}</div>
    </div>
</div> --}}

{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('ddependency_id'), 'has-success': fields.ddependency_id && fields.ddependency_id.valid }">
    <label for="ddependency_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.ddependency_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.ddependency_id"  @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('ddependency_id'), 'form-control-success': fields.ddependency_id && fields.ddependency_id.valid}" id="ddependency_id" name="ddependency_id" placeholder="{{ trans('admin.memo.columns.ddependency_id') }}">
        <div v-if="errors.has('ddependency_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('ddependency_id') }}</div>
    </div>
</div> --}}

{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('admin_user_id'), 'has-success': fields.admin_user_id && fields.admin_user_id.valid }">
    <label for="admin_user_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.admin_user_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.admin_user_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('admin_user_id'), 'form-control-success': fields.admin_user_id && fields.admin_user_id.valid}" id="admin_user_id" name="admin_user_id" placeholder="{{ trans('admin.memo.columns.admin_user_id') }}">
        <div v-if="errors.has('admin_user_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('admin_user_id') }}</div>
    </div>
</div> --}}

{{-- <div class="form-group row align-items-center" :class="{'has-danger': errors.has('state_id'), 'has-success': fields.state_id && fields.state_id.valid }">
    <label for="state_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.state_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.state_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('state_id'), 'form-control-success': fields.state_id && fields.state_id.valid}" id="state_id" name="state_id" placeholder="{{ trans('admin.memo.columns.state_id') }}">
        <div v-if="errors.has('state_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('state_id') }}</div>
    </div>
</div> --}}

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('type_id'), 'has-success': fields.type_id && fields.type_id.valid }">
    <label for="type_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.memo.columns.type_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        {{-- <input type="text" v-model="form.type_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('type_id'), 'form-control-success': fields.type_id && fields.type_id.valid}" id="type_id" name="type_id" placeholder="{{ trans('admin.memo.columns.type_id') }}"> --}}
        <multiselect
            v-model="form.type"
            :options="type"
            :multiple="false"
            track-by="id"
            label="name"
            :taggable="true"
            tag-placeholder=""
            placeholder="{{ trans('admin.memo.columns.type_id') }}">
        </multiselect>
        <div v-if="errors.has('type_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('type_id') }}</div>
    </div>
</div>


