<template>
    <v-app :dark="isDark">
        <v-toolbar app color="primary" class="toolbar">
            <v-toolbar-title class="logoMargin">
                <v-img :src="require('@/assets/logo.png')" class="logo" height="66" width="54"></v-img>
            </v-toolbar-title>
            <v-toolbar-title class="white--text titulo hidden-md-and-down">
                ColsamApp
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-menu bottom offset-y>
                    <v-btn flat slot="activator" dark>
                        <div>Bienvenido: {{usuario.displayName}}</div>
                    </v-btn>
                    <v-list>
                        <v-list-tile v-on:click="cookieTheme">
                            <v-list-tile-title>
                                Tema oscuro
                            </v-list-tile-title>
                            <v-switch v-model="isDark"></v-switch>
                        </v-list-tile>
                        <v-list-tile>
                            <v-btn block flat @click.stop="perfil = true">Perfil Estudiantil</v-btn>
                        </v-list-tile>
                        <v-list-tile>
                            <v-btn block flat @click="cerrarSesion">Cerrar Sesión</v-btn>
                        </v-list-tile>
                    </v-list>
                </v-menu>
            </v-toolbar-items>
        </v-toolbar>
        <v-content>
            <v-dialog v-model="errorNoIn" max-width="500px" persistent>
                <v-card>
                    <v-card-title>
                        <span class="headline">Error al ingresar</span>
                    </v-card-title>
                    <v-card-text>
                        <v-layout wrap>
                            <v-flex xs12>
                                Usted no se ha logueado correctamente en el sistema, por favor ingrese sus datos en la
                                pagina de inicio. Será redireccionado a la pagina de inicio en 10 segundos.
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-dialog v-model="errorNoPer" max-width="500px" persistent>
                <v-card>
                    <v-card-title>
                        <span class="headline">Error al ingresar</span>
                    </v-card-title>
                    <v-card-text>
                        <v-layout wrap>
                            <v-flex xs12>
                                Usted no tiene permisos para ingresar a este panel, Será redireccionado a la pagina de
                                inicio en 10 segundos.
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogLogout" max-width="270px" content-class="alertCerrar" persistent>
                <v-container class="text-xl-center white--text">Cerrando sesion por favor espere...</v-container>
                <v-progress-circular
                        :size="90"
                        :width="10"
                        color="primary"
                        indeterminate
                ></v-progress-circular>
            </v-dialog>
            <v-dialog v-model="dialogCarga" max-width="270px" content-class="alertCerrar" persistent>
                <v-container class="text-xl-center white--text">Cargando Datos, por favor espere...</v-container>
                <v-progress-circular
                        :size="90"
                        :width="10"
                        color="primary"
                        indeterminate
                ></v-progress-circular>
            </v-dialog>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app class="footer-bar">
            <v-container class="text-lg-center">Todos los derechos reservados 2018, Casa San Luis Beltran de
                Barrranquilla
            </v-container>
        </v-footer>
        <v-dialog
                v-model="perfil"
                fullscreen
                transition="dialog-bottom-transition"
                :overlay="false"
                scrollable
        >
            <v-card tile>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-toolbar card dark color="primary">
                        <v-btn icon @click.native="perfil = false" dark>
                            <v-icon>close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Perfil Estudiantil</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark flat @click.native="guardar" :disabled="!valid">Guardar</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-card-text>
                        <v-alert type="success" v-model="alertOk" dismissible>Datos actualizados correctamente, su
                            perfil se actualizará al cerrarse esta ventana automaticamente.
                        </v-alert>
                        <v-alert type="error" v-model="errorUpdate" dismissible>Los datos no se pudieron actualizar, ya
                            que los mismos se encuentran registrados en la base de datos.
                        </v-alert>
                        <v-alert type="error" v-model="errorPassNew" dismissible>Las contraseñas no coindiden, por favor
                            revise los datos en el campo contraseña.
                        </v-alert>
                        <v-list three-line subheader>
                            <v-subheader>A continuación modifique sus datos si lo requiere.</v-subheader>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Usuario:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield"  v-model="usuario.uid" readonly></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Nombres:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield" :rules="nombreRules"  v-model="usuario.displayName"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Email:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield" :rules="emailRules"  v-model="usuario.email"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Telefono Acudiente:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield" :rules="telefonoRules"  v-model="usuario.phoneNumber"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Fecha de nacimiento:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-menu
                                                ref="menu2"
                                                :close-on-content-click="false"
                                                v-model="menu2"
                                                :nudge-right="40"
                                                :return-value.sync="edad"
                                                lazy
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                min-width="290px"
                                                class="textfield"
                                        >
                                            <v-text-field class="textfield" slot="activator" v-model="edad"
                                                          :rules="edadRules">Seleccionar fecha
                                                <v-dialog max-width="290px" v-model="dialogFecha">
                                                    <v-date-picker v-model="edad"></v-date-picker>
                                                </v-dialog>
                                            </v-text-field>
                                            <v-date-picker v-model="edad"
                                                           @input="$refs.menu2.save(edad)"></v-date-picker>
                                        </v-menu>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                        <v-divider></v-divider>
                        <v-list three-line subheader>
                            <v-subheader>Cambiar contraseña</v-subheader>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Nueva contraseña:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield" type="password" v-model="passNew"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Repite nueva contraseña:</v-list-tile-title>
                                    <v-list-tile-content class="textfield">
                                        <v-text-field class="textfield" type="password" v-model="passNew2"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-card-text>
                </v-form>
                <div style="flex: 1 1 auto;"></div>
            </v-card>
        </v-dialog>
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
            isDark: false,
            user: [],
            errorNoIn: false,
            errorNoPer: false,
            dialogLogout: false,
            perfil: false,
            valid: true,
            number: '',
            usuario: [],
            alertOk: false,
            errorUpdate: false,
            errorPassNew: false,
            menu2: false,
            dialogFecha: false,
            dialogCarga: true,
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
        }),
        watch:{
            usuario2: function(user) {
                this.usuario = JSON.parse(user);
                this.dialogCarga = false;
            }
        },
        mounted() {
            this.isDark = (localStorage.getItem("dark") === 'true');
            firebase.auth().onAuthStateChanged(function (user) {
                if (user) {
                    localStorage.setItem('usuario', JSON.stringify(user));
                    this.usuario2(localStorage.getItem('usuario'));
                }
                else
                    return null
            });
                if (localStorage.getItem('user') == null) {
                    this.noLogIn();
                } else {
                    this.user = JSON.parse(localStorage.getItem('user'));
                    if (this.user.tipo !== 'est') {
                        this.noLogPe();
                    }
                }
        },
        methods: {
            cookieTheme: function () {
                localStorage.setItem("dark", '' + this.isDark);
            },
            cerrarSesion: function () {
                this.dialogLogout = true;
                localStorage.removeItem('user');
                localStorage.removeItem('usuario');
                firebase.auth().signOut().then();
                this.user = [];
                setTimeout("localStorage.removeItem('User')", 3000);
                setTimeout("location.href = '/'", 5000);
            },
            noLogIn: function () {
                this.errorNoIn = true;
                localStorage.removeItem('user');
                setTimeout("location.href = '/'", 10000);
            },
            noLogPe: function () {
                this.errorNoPer = true;
                localStorage.removeItem('user');
                setTimeout("location.href = '/'", 10000);
            },
            guardar: function () {
                let profile = firebase.auth().currentUser;
                profile.updateProfile({
                    displayName: this.usuario.displayName,
                    phoneNumber: this.usuario.phoneNumber
                }).then(function () {
                    console.log('exito')
                }).catch(function (error) {
                    console.log(error)
                });
            },

        }
    }
</script>

<style>
    @import '../assets/css/app.css';
    @import '../assets/css/palette.css';
</style>