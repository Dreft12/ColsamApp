new Vue({
    el: '#app',
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
        dialogMora: false
    },
    mounted() {
        this.isDark = (this.readCookie("dark")==='true');
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
                    this.exito = true;
                    setInterval(this.redireccionar, 3000);
                    setTimeout("location.href = '/ColsamApp/panel.php'", 5000);
                } else if (this.usuario.includes('<br />')) {
                    this.errorDB = true
                } else {
                    this.errorLogin = true;
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
        },
        reset: function () {
            this.user = '';
            this.pass = '';
        },
        cookieTheme: function () {
            document.cookie = "dark=" + this.isDark;
        },
        readCookie: function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) {
                    return decodeURIComponent(c.substring(nameEQ.length, c.length));
                }
            }
            return null;
        }
    }
});