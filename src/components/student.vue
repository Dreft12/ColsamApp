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
            <v-dialog v-model="dialogMora" max-width="500px" persistent>
                <v-card>
                    <v-card-title>
                        <span class="headline">No se ha podido ingresar al sistema</span>
                    </v-card-title>
                    <v-card-text>
                        <v-layout wrap>
                            <v-flex xs12>
                                No ha realizado el(los) pago(pagos) pendientes de la pensión, por favor realice los
                                pagos pertinentes para tener acceso al panel de notas; <br>Meses en mora: {{user.mora}}.
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-card>
            </v-dialog>
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
                        <v-toolbar-title>Perfil</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark flat @click.native="guardar" :disabled="!valid">Guardar</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-card-text>
                        <v-alert type="success" v-model="alertOk" dismissible>Datos actualizados correctamente, por
                            favor inicie sesión nuevamente para aplicar los cambios.
                        </v-alert>
                        <v-alert type="error" v-model="errorUpdate" dismissible>Los datos no se pudieron actualizar, ya
                            que los mismos se encuentran registrados en la base de datos.
                        </v-alert>
                        <v-alert type="error" v-model="errorPassNew" dismissible>Las contraseñas no coindiden, por favor
                            revise los datos en el campo contraseña.
                        </v-alert>
                        <v-alert type="success" v-model="alertPass" dismissible>La contraseña ha sido cambiada con
                            exito, por favor inicie sesión nuevamente para aplicar los cambios.
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
                                    <v-list-tile-title>UID:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field v-model="usuario.uid" readonly></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Nombres:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field :rules="nombreRules" v-model="usuario.displayName"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Email:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field :rules="emailRules" v-model="usuario.email"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Telefono:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field :rules="telefonoRules" v-model="user.telefono"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Fecha de nacimiento:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-menu
                                                ref="menu2"
                                                :close-on-content-click="false"
                                                v-model="menu2"
                                                :nudge-right="40"
                                                :return-value.sync="user.edad"
                                                lazy
                                                transition="scale-transition"
                                                offset-y
                                                full-width
                                                min-width="290px"

                                        >
                                            <v-text-field slot="activator" v-model="user.edad"
                                                          :rules="edadRules">Seleccionar fecha
                                                <v-dialog max-width="290px" v-model="dialogFecha">
                                                    <v-date-picker v-model="user.edad"></v-date-picker>
                                                </v-dialog>
                                            </v-text-field>
                                            <v-date-picker v-model="user.edad"
                                                           @input="$refs.menu2.save(user.edad)"></v-date-picker>
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
                                    <v-list-tile-title>Antigua contraseña:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field type="password" v-model="passOld"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Nueva contraseña:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field type="password" v-model="passNew"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-title>Repite nueva contraseña:</v-list-tile-title>
                                    <v-list-tile-content>
                                        <v-text-field type="password" v-model="passNew2"
                                                      required></v-text-field>
                                    </v-list-tile-content>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile avatar>
                                <v-list-tile-content>
                                    <v-list-tile-content>
                                        <v-btn color="primary" @click="cambiarContrasena">Cambiar contraseña</v-btn>
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
            passNew: '',
            passNew2: '',
            usuario: [],
            alertPass: false,
            passOld: '',
            alertOk: false,
            errorUpdate: false,
            errorPassNew: false,
            menu2: false,
            dialogFecha: false,
            dialogCarga: true,
            dialogMora: false,
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
        mounted() {
            this.isDark = (localStorage.getItem("dark") === 'true');
            this.usuario = JSON.parse(localStorage.getItem('usuario'));
            setTimeout(this.carga(), 5000);
            if (localStorage.getItem('user') == null) {
                this.noLogIn();
            } else {
                this.user = JSON.parse(localStorage.getItem('user'));
                if (this.user.mora > 0) {
                    this.dialogMora = true;
                    setTimeout("location.href='/'", 5000);
                }
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
                }).then(function () {
                }).catch(function (error) {
                    console.log(error)
                });
                profile.updateEmail(this.usuario.email).then(result => {
                    return result;
                });
                this.alertOk = true;
                setTimeout(() => {
                    localStorage.setItem('usuario', JSON.stringify(firebase.auth().currentUser));
                }, 10000)
            },
            carga: function () {
                this.dialogCarga = false;
            },
            cambiarContrasena: function () {
                if (this.passNew === this.passNew2) {
                    firebase.auth().currentUser.reauthenticateAndRetrieveDataWithCredential(firebase.auth.EmailAuthProvider.credential(firebase.auth().currentUser.email, this.passOld)).then(() => {
                    });
                    let profile = firebase.auth().currentUser;
                    profile.updatePassword(this.passNew).then(() => {
                            this.alertPass = true;
                        }
                    ).catch((error) => {
                        this.alertPass = false;
                    });
                }
            }
        }
    }
</script>

<style>
    @import '../assets/css/app.css';
    @import '../assets/css/palette.css';
</style>