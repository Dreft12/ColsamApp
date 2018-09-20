new Vue({
    el: '#app',
    data:{
        user: '',
        pass: '',
        errorPass: false,
        errorUser: false,
        errorLogin: false,
        exito: false,
        usuario:[]
    },
    methods:{
        validar: function () {
            if (this.user.length === 0){
                this.errorUser = true;
            }else if (this.pass.length === 0){
                this.errorPass = true;
            }else{
                this.login();
            }
        },
        login: function () {
            this.$http.post('/ColsamApp/data/login.php',{user: this.user}).then(function (respuesta) {
                this.usuario = respuesta.body;
                if (this.usuario.length === 0){
                    this.errorLogin = true;
                }else if (this.usuario[0].User === this.user && this.usuario[0].Pass === this.pass){
                    this.exito = true;
                    this.errorPass = false;
                    this.errorUser = false;
                    this.errorLogin = false;
                }else{
                    this.errorLogin = true
                }
            })
        }
    }
});