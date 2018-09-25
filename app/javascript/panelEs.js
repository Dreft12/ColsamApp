new Vue({
    el: '#panel',
    data:{
        usuario: [],
        isDark: false,
        dialogLogout: false,
        errorNoIn: false
    },
    mounted() {
        this.isDark = (localStorage.getItem("dark")==='true');
        if (localStorage.getItem('User') === null){
            this.noLogIn();
        }else{
            this.usuario = JSON.parse(localStorage.getItem('User'));
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
        irA: function (url) {
            location.href = url;
        }
    }
});