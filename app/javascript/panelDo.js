new Vue({
    el: '#panel',
    data:{
        usuario: [],
        isDark: false,
        dialogLogout: false,
        errorNoIn: false,
        errorNoPer: false,
        perfil: false,
        nombre: '',
        apellido: '',
        menu2: false,
        nombreRules: [
            v => !!v || 'Nombre es requerido',
            v => (v && v.length <= 30) || 'Nombre debe ser maximo de 30 caracteres'
        ],
        apellidoRules: [
            v => !!v || 'Apellido es requerido',
            v => (v && v.length <= 30) || 'Apellido debe ser maximo de 30 caracteres'
        ],
        emailRules: [
            v => !!v || 'E-mail es requerido',
            v => /.+@.+/.test(v) || 'E-mail debe ser valido'
        ],
        telefonoRules: [
            v => !!v || 'Telefono es requerido',
            v => (v && v.length <= 10) || 'Telefono debe tener maximo 10 caracteres'
        ],
        edadRules: [
            v => !!v || 'Edad es requerido',
            v => (v && v.length <= 10) || 'Edad debe ser seleccionado debe tener maximo 10 caracteres'
        ],
        user: '',
        email: '',
        edad: '',
        tel: '',
        dialogFecha: false,
        valid: true,
        passNew: '',
        passNew2: '',
        alertOk: false,
        respuesta: '',
        errorUpdate: false,
        errorPassNew: false
    },
    mounted() {
        this.isDark = (localStorage.getItem("dark")==='true');
        if (localStorage.getItem('User') === null){
            this.noLogIn();
        }else{
            this.usuario = JSON.parse(localStorage.getItem('User'));
            this.inicio();
            if (this.usuario[0].valor !== 'Docente'){
                this.noLogPe();
            }
        }
    },
    methods: {
        cookieTheme: function () {
            localStorage.setItem("dark", ''+this.isDark);
        },
        cerrarSesion: function () {
            this.usuario = [];
            this.dialogLogout = true;
            setTimeout("localStorage.removeItem('User')", 3000);
            setTimeout("location.href = '/ColsamApp/index.html'", 5000);
        },
        noLogIn: function () {
            this.errorNoIn = true;
            setTimeout("location.href = '/ColsamApp/index.html'", 10000);
        },
        noLogPe: function(){
          this.errorNoPer = true;
          setTimeout("location.href = '/ColsamApp/index.html'", 10000);
        },
        irA: function (url) {
            location.href = url;
        },
        guardar: function () {
            if(this.validarContrasena()){
                this.$http.post('/ColsamApp/data/data_teachers.php', {user: this.user, nombre: this.nombre, apellido: this.apellido, email: this.email
                    , edad: this.edad, tel: this.tel, passNew: this.passNew}).then(function (respuesta) {
                    this.respuesta = respuesta.body;
                    console.log(this.respuesta);
                    if (this.respuesta[1] === "si"){
                        this.alertOk = true;
                        setTimeout(this.cerrar,5000);
                        this.usuario = this.respuesta;
                        this.inicio();
                    }else if(this.respuesta[0] === "no"){
                        this.errorUpdate = true;
                    }
                });
            }else {
                this.errorPassNew = true;
            }
            },
        cerrar: function () {
            this.alertOk = false;
            this.perfil = false;
        },
        inicio: function () {
            console.log(this.usuario);
            this.nombre= this.usuario[0].Nombre;
            this.apellido = this.usuario[0].Apellido;
            this.email = this.usuario[0].Email;
            this.user = this.usuario[0].User;
            this.edad = this.usuario[0].Edad;
            this.tel = this.usuario[0].TelAcudiente;
        },
        validarContrasena: function(){
            return this.passNew === this.passNew2;
        }
    }
});