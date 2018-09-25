new Vue({
    el: '#panel',
    data:{
        usuario: [],
        isDark: false,
        dialogLogout: false
    },
    mounted() {
        this.usuario = JSON.parse(localStorage.getItem('User'));
        this.isDark = (localStorage.getItem("dark")==='true');
    },
    methods: {
        cookieTheme: function () {
            localStorage.setItem("dark", ''+this.isDark);
        },
        cerrarSesion: function () {
            this.usuario = [];
            localStorage.removeItem('User');
            this.dialogLogout = true
            setTimeout("location.href = '/ColsamApp/index.html'", 5000);
        }
    }
});