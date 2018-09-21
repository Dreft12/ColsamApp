new Vue({
    el: '#app',
    data:{
        user: '',
        pass: '',
        errorPass: false,
        errorUser: false,
        errorLogin: false,
        redireccion: false,
        exito: false,
        usuario:[],
        isDark: false,
        dialog: false,
        dialogMora: false
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
                console.log(this.usuario);
                if (this.usuario.length === 0){
                    this.errorLogin = true;
                }else if(this.usuario.Mora === "Si"){
                    this.dialogMora = true;
                } else if (this.usuario[0].User === this.user && this.usuario[0].Pass === this.pass){
                    this.exito = true;
                    setInterval(this.redireccionar, 3000);
                    setTimeout("location.href = '/ColsamApp/panel.php'", 5000);
                }else{
                    this.errorLogin = true
                }
            })
        },
        redireccionar: function () {
            this.exito = false;
            this.errorPass = false;
            this.errorUser = false;
            this.errorLogin = false;
            this.redireccion = true;
        },
        irA: function (url) {
            location.href = url;
        },
        dialogActivar: function () {
            this.dialog = true
        }
    }
});