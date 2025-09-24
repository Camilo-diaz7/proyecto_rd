<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Agora Vives Pub') }} - Login</title>

    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;

            /* 👇 Centramos el cuadro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background-color: #1a1a1a;
            border: 2px solid red;
            border-radius: 10px;
            padding: 2rem;
            width: 350px;
            text-align: center;
            box-shadow: 0px 0px 15px rgba(255,0,0,0.3);
        }
        .login-logo img {
            width: 160px;
            margin-bottom: 20px;
        }
        .login-title {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: white;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: none;
            background: #fff;
            color: #000;
            font-size: 1rem;
        }
        .btn-red {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
            margin-bottom: 10px;
        }
        .btn-gray {
            background-color: #666;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            cursor: pointer;
        }
        .btn-red:hover { background-color: #a00000; }
        .btn-gray:hover { background-color: #888; }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
