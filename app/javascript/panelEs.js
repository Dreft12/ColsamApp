new Vue({
    el: '#panel',
    data:{
        usuario: [],
        isDark: false,
        dialogLogout: false
    },
    mounted() {
        this.usuario = JSON.parse(localStorage.getItem('User'));
        this.isDark = (this.readCookie("dark")==='true');
    },
    methods: {
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
        },
        cerrarSesion: function () {
            this.usuario = [];
            localStorage.clear();
            this.dialogLogout = true
            setTimeout("location.href = '/ColsamApp/index.html'", 5000);
        }
    }
});