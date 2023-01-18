import AppForm from '../app-components/Form/AppForm';

Vue.component('memo-form', {
    mixins: [AppForm],
    props:['logueado', 'local_dependencia', 'hoy', 'type', 'odependency'],
    data: function() {
        return {
            form: {
                odependency:  '' ,
                number_memo:  '' ,
                ref:  '' ,
                obs:  '' ,
                date_doc:  '' ,
                date_entry:  this.hoy ,
                date_exit:  '' ,
                ddependency_id:  this.local_dependencia ,
                admin_user_id:  this.logueado ,
                state_id:  1 ,
                type:  '' ,

            },
            mediaCollections: ['gallery']
        }
    }

});
