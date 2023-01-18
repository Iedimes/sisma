import AppForm from '../app-components/Form/AppForm';

Vue.component('user-cedula-form', {
    mixins: [AppForm],
    props:['user'],
    data: function() {
        return {
            form: {
                user:  '' ,
                cedula:  '' ,

            }
        }
    }

});
