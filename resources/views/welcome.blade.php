<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
        <link rel="stylesheet" href="{{url('css/animation.css')}}">
       
    </head>
    <body>
    <div id="app">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <!-- Brand -->
            <a class="navbar-brand" href="#">Activity</a>

            <!-- Links -->
            <ul class="navbar-nav float-right">
                <li class="nav-item">
                    <router-link class="nav-link"  to="login">Booking</router-link>  
                </li>
                <li class="nav-item">
                     <router-link class="nav-link" to="booking">Create Booking</router-link>  
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Profile
                </a>
                <div class="dropdown-menu">
                    <router-link class="nav-link"  to="login">Booking</router-link>  
                    <router-link class="nav-link" to="booking">Create Booking</router-link>  
                </div>
                </li>
            </ul>
    </nav>
               
                <template >
                <div class="container-fluid" style="margin-top:80px">
                     <router-view class="animated slideInUp"></router-view>
                </div>
               </template>
    
            </div>
        </div>
    </body>
</html>
<script src="{{asset('js/app.js')}}"></script>
