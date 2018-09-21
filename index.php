
<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="app/css/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <title>ColsamApp - Pagina Principal</title>
</head>
<body>
<div id="app">
    <v-app>
        <v-toolbar app color="primary">
            <v-toolbar-title class="white--text">Bienvenidos a ColsamApp</v-toolbar-title>
        <v-spacer></v-spacer>
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
                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</div>

<script src="app/javascript/vue.js"></script>
<script src="app/javascript/vuetify.js"></script>
<script src="app/javascript/login.js"></script>
<script src="app/javascript/vue-resource@1.3.5"></script>
</body>
</html>
