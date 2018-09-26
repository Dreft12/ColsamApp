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
        user: '',
        email: '',
        edad: '',
        telAcudiente: '',
        dialogFecha: false,
        form: true,
        passNew: '',
        passNew2: '',
        alertOk: false,
        respuesta: ''
    },
    mounted() {
        this.isDark = (localStorage.getItem("dark")==='true');
        if (localStorage.getItem('User') === null){
            this.noLogIn();
        }else{
            this.usuario = JSON.parse(localStorage.getItem('User'));
            this.nombre= this.usuario[0].Nombre;
            this.apellido = this.usuario[0].Apellido;
            this.email = this.usuario[0].Email;
            this.user = this.usuario[0].User;
            this.edad = this.usuario[0].Edad;
            this.telAcudiente = this.usuario[0].TelAcudiente;
            if (this.usuario[0].valor !== 'Estudiante'){
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
                this.$http.post('/ColsamApp/data/data_students.php', {user: this.user, nombre: this.nombre, apellido: this.apellido, email: this.email
                , edad: this.edad, telAcudiente: this.telAcudiente, passNew: this.passNew, passNew2: this.passNew2}).then(function (respuesta) {
                    console.log(respuesta.body);
                    this.respuesta = respuesta.body;
                    if (this.respuesta === "ok"){
                        this.alertOk = true;
                        //setTimeout(this.cerrar,1000);
                    }else{
                    }
                });
            },
        cerrar: function () {
            this.alertOk = false;
            this.perfil = false;
        }
    }
});