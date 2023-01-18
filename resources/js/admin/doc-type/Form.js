import AppForm from '../app-components/Form/AppForm';

Vue.component('doc-type-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});