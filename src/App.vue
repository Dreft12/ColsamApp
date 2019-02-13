<template>
    <v-app :dark="isDark" id="inspire" class="back">
        <v-toolbar app color="primary">
            <v-toolbar-title class="logoMargin">
                <v-img src="https://firebasestorage.googleapis.com/v0/b/colsamapp.appspot.com/o/logo%2Flogo.png?alt=media&token=d985d93c-2f39-4758-ba21-07fb86d99401" class="logo" height="66" width="54"></v-img>
            </v-toolbar-title>
            <v-toolbar-title class="white--text titulo">
                ColsamApp
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down">
                <v-btn flat class="white--text" @click="irA('http://www.colsam.edu.co/web/index.php')">Pagina Principal</v-btn>
                <v-btn flat class="white--text">Quienes somos</v-btn>
                <v-btn flat class="white--text">Ayuda</v-btn>
                <v-btn flat slot="activator" @click="dialog = true" class="white--text">Contactenos</v-btn>
                <v-dialog v-model="dialog" persistent max-width="500px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Formulario de contacto</span>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        <v-text-field label="Nombres*" required></v-text-field>
                                        <v-text-field
                                                label="Apellidos*" required
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field label="Correo*" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6>
                                        <v-select
                                                :items="['0-17', '18-29', '30-54', '54+']"
                                                label="Edad*"
                                                required
                                        ></v-select>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                            <small>*Todos los campos deben ser requeridos</small>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click.native="dialog = false">Cerrar</v-btn>
                            <v-btn color="blue darken-1" flat @click.native="dialog = false">Enviar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogC" persistent max-width="500px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">Recuperar contraseña de la cuenta</span>
                        </v-card-title>
                        <v-card-text>
                            <small>Ingresa tu dirección de correo electronico en el siguiente campo, se te enviará un mensaje para la recuperación de la contraseña.</small>
                            <v-alert type="error" v-model="errorRec" dismissible>Correo no encontrado, por favor revise la información digitada.
                            </v-alert>
                            <v-alert type="success" v-model="exitoRec" dismissible>Correo enviado, por favor revise su buzón de mensajes para seguir con el proceso.
                            </v-alert>

                            <v-flex xs12>
                                        <v-text-field label="Correo" v-model="correo" required></v-text-field>
                            </v-flex>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click.native="dialogC = false">Cerrar</v-btn>
                            <v-btn color="blue darken-1" flat @click.native="recuperar">Recuperar</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogMora" max-width="500px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">No se ha podido ingresar al sistema</span>
                        </v-card-title>
                        <v-card-text>
                            <v-layout wrap>
                                <v-flex xs12>
                                    No ha realizado el(los) pago(pagos) pendientes de la pensión, por favor realice los
                                    pagos pertinentes para tener acceso al panel de notas; <br>Meses en mora: {{meses}}.
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-dialog>
                <v-btn flat icon color="white" v-on:click="irA('https://github.com/Dreft12/ColsamApp')">
                    <v-icon>favorite</v-icon>
                </v-btn>
            </v-toolbar-items>
            <v-menu bottom offset-y left>
                <v-btn slot="activator" dark icon>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>

                    <v-list-tile v-on:click="cookieTheme">
                        <v-list-tile-title>
                            <v-switch
                                    label="Tema oscuro"
                                    v-model="isDark"
                            ></v-switch>
                        </v-list-tile-title>
                    </v-list-tile>
                    <v-btn color="primary" @click="dialogC = true">¿Olvidaste la contraseña?</v-btn>
                    <v-list-tile-content class="hidden-md-and-up">
                        <v-btn color="primary">Pagina Principal</v-btn>
                        <v-btn color="primary">Quienes somos</v-btn>
                        <v-btn color="primary">Ayuda</v-btn>
                        <v-btn color="primary" @click="dialog = true">Contactenos</v-btn>
                    </v-list-tile-content>
                </v-list>
            </v-menu>
        </v-toolbar>

        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title>Iniciar sesión</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-alert type="error" v-model="errorPass" dismissible>Por favor ingrese una contraseña
                                    valida.
                                </v-alert>
                                <v-alert type="error" v-model="errorUser" dismissible>Por favor ingrese un usuario
                                    valido.
                                </v-alert>
                                <v-alert type="error" v-model="errorLogin" dismissible>Usuario y/o contraseña
                                    incorrecta.
                                </v-alert>
                                <v-alert type="error" v-model="errorDB" dismissible>Error en la comunicación hacia la
                                    base de datos.
                                </v-alert>
                                <v-alert type="info" v-model="redireccion">Redirigiendo al panel, por favor espere...
                                </v-alert>
                                <v-alert type="success" v-model="exito" dismissible>Bienvenido al sistema: {{
                                    usuario.displayName}}.
                                </v-alert>
                                <v-form>
                                    <v-text-field v-model="user" :disable="inputDisable" v-on:keypress.enter="validar"
                                                  name="user" prepend-icon="person" label="Usuario"
                                                  type="text"></v-text-field>
                                    <v-text-field v-model="pass" v-on:keypress.enter="validar" id="password"
                                                  prepend-icon="lock" label="Contraseña" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn v-on:click="login" color="primary">Entrar</v-btn>
                                <v-btn v-on:click="reset" color="primary">Limpiar</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app class="footer-bar">
            <v-container class="text-lg-center">Todos los derechos reservados 2018, Casa San Luis Beltran de
                Barrranquilla
            </v-container>
        </v-footer>
    </v-app>
</template>
<script>
    import firebase from 'firebase'
    const config = {
        apiKey: "AIzaSyD8twKowSi1OFExb8i3oiwItWrXD3zZKKY",
        authDomain: "colsamapp.firebaseapp.com",
        databaseURL: "https://colsamapp.firebaseio.com",
        projectId: "colsamapp",
        storageBucket: "colsamapp.appspot.com",
        messagingSenderId: "374315306977"
    };
    let app = firebase.initializeApp(config);
    let db = firebase.firestore(app);
    export default {
        data: () => ({
            drawer: null,
            user: '',
            pass: '',
            correo: '',
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
            exitoRec: false,
            errorRec: false,
            dialogMora: false,
            dialogC: false,
            nombres: '',
            inputDisable: false,
            title: 'Inicio de sesión'
        }),
        mounted() {
            this.isDark = (localStorage.getItem("dark") === 'true');
        },
        props: {
            source: String
        },
        methods: {
            login: function () {
                if (this.user.length === 0) {
                    this.errorUser = true;
                    this.errorPass = false;
                } else if (this.pass.length === 0) {
                    this.errorPass = true;
                    this.errorUser = false;
                } else {
                    let f = firebase.auth().signInWithEmailAndPassword(this.user, this.pass).then(
                        function () {
                            return true;
                        },
                        function () {
                            return false;
                        }
                    );
                    f.then(res => {
                        if (res) {
                            let uid = firebase.auth().currentUser.uid;
                            let docRef = db.collection("usuarios").doc(uid);
                            this.usuario = firebase.auth().currentUser;
                            localStorage.setItem('usuario', JSON.stringify(this.usuario));
                            this.exito = true;
                            this.errorLogin = false;
                            this.errorUser = false;
                            this.errorPass = false;
                            this.user = '';
                            this.pass = '';
                            docRef.get().then(doc => {
                                localStorage.setItem('user', JSON.stringify(doc.data()));
                                setInterval(this.redireccionar, 2000);
                                switch (doc.data().tipo) {
                                    case 'est':{
                                        //this.$router.push('student');
                                        setTimeout("location.href = '/student'", 4000);
                                        break;
                                    }
                                    case 'doc':{
                                        setTimeout("location.href = '/teachers'", 4000);
                                        break;
                                    }
                                }
                            });
                        } else
                            this.errorLogin = true;
                    });
                }
            },
            redireccionar: function () {
                this.exito = false;
                this.errorPass = false;
                this.errorUser = false;
                this.errorLogin = false;
                this.redireccion = true;
            },
            registro: function () {
               let f = firebase.auth().createUserWithEmailAndPassword(this.user, this.pass).then(
                    function () {
                        return true;
                    },
                    function () {
                        return false;
                    }
                );

            },
            recuperar: function(){
                let f = firebase.auth().sendPasswordResetEmail(this.correo).then(function() {
                    return true;
                }).catch(function() {
                    // An error happened.
                });

                f.then(res => {
                    if (res){
                        this.exitoRec = true;
                        this.errorRec = false;
                        this.correo = '';
                    }else{
                        this.exitoRec = false;
                        this.errorRec = true;
                    }
                })
            },
            irA: function (url) {
                location.href = url;
            },
            cookieTheme: function () {
                localStorage.setItem("dark", '' + this.isDark);
            },
            reset: function () {
                this.user = '';
                this.pass = '';
            },
            validar: function () {
                if (this.user.length === 0) {
                    this.errorUser = true;
                } else if (this.pass.length === 0) {
                    this.errorPass = true;
                } else {
                    this.login();
                }
            },
        },
    }
</script>
<style>
    @import './assets/css/app.css';
    @import './assets/css/palette.css';
</style>
