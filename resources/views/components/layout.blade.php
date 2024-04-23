<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$pageTitle ?? 'Tasks Todo'}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,200&family=Raleway:wght@300&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:wght@400;500&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
   <div class="container">
     <div class="sidebar">
       <img src="/assets/images/logo.png" alt="">
     </div>
     <div class="content">
        <div class="nav_user">
            {{$userLogged ?? ''}}
        </div>
        <nav>
          {{$btn ?? ''}}
        </nav>
        <main>
           {{$slot}}
        </main>
     </div>
   </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
