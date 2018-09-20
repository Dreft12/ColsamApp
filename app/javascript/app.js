new Vue({
    el: '#app',
    data:{
        user: '',
        pass: '',
        errorPass: false,
        errorUser: false,
        exito: false
    },
    methods:{
        validar: function () {
            if (this.user.length === 0){
                this.errorUser = true;
            }else if (this.pass.length === 0){
                this.errorPass = true;
            }else{
                this.exito = true
            }
        }
    }
});