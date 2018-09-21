
<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="app/css/vuetify.min.css" rel="stylesheet">
    <link href="app/css/app.css" rel="stylesheet">
    <link href="app/css/palette.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>ColsamApp - Pagina Principal</title>
</head>
<body>
<div id="app">
    <v-app :dark="isDark">
        <v-toolbar app color="primary" class="toolbar">
                <v-toolbar-title class="white--text titulo">
                    <v-img src="app/images/logo.png" class="logo" height="66" width="54"></v-img>Bienvenidos a ColsamApp</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn flat class="white--text">Quienes somos</v-btn>
                <v-btn flat class="white--text">Ayuda</v-btn>
                <v-btn flat slot="activator" @click="dialogActivar" class="white--text">Contactenos</v-btn>
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
                <v-dialog v-model="dialogMora" max-width="500px">
                    <v-card>
                        <v-card-title>
                            <span class="headline">No se ha podido ingresar al sistema</span>
                        </v-card-title>
                        <v-card-text>
                                <v-layout wrap>
                                    <v-flex xs12>
                                        No ha realizado el(los) pago(pagos) pendientes de la pensión, por favor realice los pagos pertinentes para tener acceso al panel de notas.
                                    </v-flex>
                                </v-layout>
                        </v-card-text>
                    </v-card>
                </v-dialog>
                <v-btn flat icon color="white" v-on:click="irA('https://github.com/Dreft12/ColsamApp')">
                    <v-icon>favorite</v-icon>
                </v-btn>
                <v-menu bottom left>
                    <v-btn slot="activator" dark icon>
                        <v-icon>more_vert</v-icon>
                    </v-btn>
                    <v-list>
                        <v-list-tile>
                            <v-list-tile-title><v-switch
                                        label="Tema oscuro"
                                        v-model="isDark"
                                ></v-switch>
                            </v-list-tile-title>
                        </v-list-tile>
                        <v-btn v:on:clicl="passforget" color="primary">¿Olvidaste la contraseña?</v-btn>
                    </v-list>
            </v-toolbar-items>
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
                                <v-alert type="error" v-model="errorPass" dismissible>Por favor ingrese una contraseña valida.</v-alert>
                                <v-alert type="error" v-model="errorUser" dismissible>Por favor ingrese un usuario valido.</v-alert>
                                <v-alert type="error" v-model="errorLogin" dismissible>Usuario y/o contraseña incorrecta.</v-alert>
                                <v-alert type="info" v-model="redireccion">Redirigiendo al panel, por favor espere...</v-alert>
                                <v-alert type="success" v-model="exito" dismissible v-for="us in usuario">Bienvenido al sistema: {{ us.Nombre }} {{ us.Apellido }}.</v-alert>
                                <v-form>
                                    <v-text-field v-model="user" v-on:keypress.enter="validar" name="user" prepend-icon="person" label="Usuario" type="text"></v-text-field>
                                    <v-text-field v-model="pass" v-on:keypress.enter="validar" id="password" prepend-icon="lock"  label="Contraseña" type="password"></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn v-on:click="validar" color="primary">Entrar</v-btn>
                                <v-btn v-on:click="reset" color="primary">Limpiar</v-btn>

                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app class="footer-bar">
            <v-container class="text-lg-center">Todos los derechos reservados 2018, Casa San Luis Beltran de Barrranquilla</v-container>
        </v-footer>
    </v-app>
</div>
<script src="app/javascript/vue.js"></script>
<script src="app/javascript/vuetify.js"></script>
<script src="app/javascript/login.js"></script>
<script src="app/javascript/vue-resource@1.3.5"></script>
</body>
</html>
