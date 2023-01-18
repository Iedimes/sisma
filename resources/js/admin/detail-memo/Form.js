import AppForm from '../app-components/Form/AppForm';

Vue.component('detail-memo-form', {
    mixins: [AppForm],
    props:['memo', 'logueado', 'local_dependencia', 'hoy', 'ddependency'],
    data: function() {
        return {
            form: {
                memo_id:  this.memo ,
                odependency_id:  this.local_dependencia ,
                ddependency_id:  '' ,
                date_entry:  '' ,
                date_exit:  '' ,
                obs:  '' ,
                state_id:  3 ,
                admin_user_id: '',

            }
        }
    }

});
