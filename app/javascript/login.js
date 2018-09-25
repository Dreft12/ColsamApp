new Vue({
    el: '#login',
    data: {
        user: '',
        pass: '',
        errorPass: false,
        errorUser: false,
        errorLogin: false,
        errorDB: false,
        meses: 0,
        redireccion: false,
        exito: false,
        usuario: [],
        isDark: false,
        dialog: false,
        dialogMora: false,
        inputDisable: false
    },
    mounted() {
        this.isDark = (localStorage.getItem("dark")==='true');
    },
    methods: {
        validar: function () {
            if (this.user.length === 0) {
                this.errorUser = true;
            } else if (this.pass.length === 0) {
                this.errorPass = true;
            } else {
                this.login();
            }
        },
        login: function () {
            this.$http.post('/ColsamApp/data/data_login.php', {user: this.user}).then(function (respuesta) {
                this.usuario = respuesta.body;
                console.log(this.usuario);
                if (this.usuario.length === 0) {
                    this.errorLogin = true;
                } else if (this.usuario.Mora === "Si") {
                    this.dialogMora = true;
                    this.meses = this.usuario.Meses;
                } else if (this.usuario[0].User === this.user && this.usuario[0].Pass === this.pass) {
                    localStorage.setItem('User', JSON.stringify(this.usuario));
                    this.exito = true;
                    this.inputDisable = true;
                    this.reset();
                    setInterval(this.redireccionar, 3000);
                    setTimeout("location.href = '/ColsamApp/panels/students.html'", 5000);
                } else if (this.usuario[0].User !== this.user || this.usuario[0].Pass !== this.pass) {
                    this.errorLogin = true;
                } else {
                    this.errorDB = true;
                }
            });
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
        },
        reset: function () {
            this.user = '';
            this.pass = '';
        },
        cookieTheme: function () {
            localStorage.setItem("dark", ''+this.isDark);
        }
    }
});