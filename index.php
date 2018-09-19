<?php
require "class/Controller.php";
session_start();
if(!isset($_SESSION['Controller'])){
    $_SESSION['Controller'] = new Controller();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="app/css/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
<div id="app">
    <v-app>
        <v-navigation-drawer app></v-navigation-drawer>
        <v-toolbar app>ColsamApp</v-toolbar>
        <v-content>
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</div>

<script src="app/javascript/vue.js"></script>
<script src="app/javascript/vuetify.js"></script>
<script>
    new Vue({ el: '#app' })
</script>
</body>
</html>
