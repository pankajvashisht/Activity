<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if(Auth::user())
            <meta name="user-id" content="{{ Auth::user()->id }}">
            <meta name="auth-key" content="{{ Auth::user()->authorization_key }}">
           
            <script>
                localStorage.setItem("users", '<?php echo json_encode(Auth::user()) ?>');
            </script>
         @endif  
         @if(!Auth::user())
         <script>
            localStorage.setItem("users", undefined);
         </script>
            <meta name="user-id" content="null">
            <meta name="auth-key" content="null">
         @endif   
        <title>Game Activity</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.rawgit.com/oauth-io/oauth-js/c5af4519/dist/oauth.js"></script>
        <link rel="stylesheet" href="{{url('css/animation.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
    <div id="app">
        @if(Auth::user()):
            <navbar></navbar>
         @endif
                <template >
                <div class="container">
                    @include('Flash.flash')
                </div>
                <div class="container-fluid" style="margin-top:80px">
                     <router-view class="animated fadeIn"></router-view>
                </div>
               </template>
    
            </div>
        </div>
    </body>
</html>
<script src="{{asset('js/app.js')}}"></script>
