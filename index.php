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
        <v-toolbar app color="primary">
            <v-toolbar-side-icon class="white--text"></v-toolbar-side-icon>
            <v-toolbar-title class="white--text">ColsamApp</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn icon>
            <v-icon class="white--text">more_vert</v-icon>
        </v-btn>
        </v-toolbar>
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
<script src="app/javascript/app.js"></script>
</body>
</html>
