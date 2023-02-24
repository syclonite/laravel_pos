<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{url('css/backend_bootstrap_5.1.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/backend_popper.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{url('js/backend_bootstrap_5.1.3.min.js')}}"  crossorigin="anonymous"></script>
    <title>Nawshad Enterprise</title>
</head>
<body>
<div class="container-fluid home" style="padding-top: 80px">
    <h1 class="d-flex justify-content-center">Welcome Everyone</h1>
    <br>
    <br>
    <br>
    <div>
        <p class="d-flex justify-content-center zoom-in-out-box">Nawshad Enterprise</p>
    </div>
    <br>
    <div class="d-flex justify-content-center">
        <a href="{{route('login')}}" class="btn btn-primary btn-lg"> Login </a>
    </div>
    <!--  <div class="d-flex justify-content-center"><%#= image_tag "home.jpg", width:1098 %></div>-->
</div>

<div class="zoom-in-out-box"></div>
<style>
    p{
        font-size: 50px;
        font-family: 'DejaVu Sans Mono';
    }

    .zoom-in-out-box {
        animation: zoom-in-zoom-out 3s ease-in;
    }

    @keyframes zoom-in-zoom-out {
        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
        50% {
            transform: scale(0.5, 0.5);
            opacity: 0.0;
        }
        0% {
            transform: scale(1, 1);
            opacity: 0.0;
        }
    }
</style>
</body>
</html>
