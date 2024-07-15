<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>School - Home</title>
    <link rel="stylesheet" href="{{url('../assets/css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Header -->
    <header class="hdr">
        <input type="checkbox" id="menu-dis">
        <label for="menu-dis"><i class="fas fa-bars"></i></label>
        <label for="menu-dis"><i class="fas fa-times"></i></label>
        <!-- Logo -->
        <div class="logo">
            <h3>Marke<span>teer</span></h3>
        </div>
        <!-- Nav Menu -->
        <ul class="menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            @if(session()->has('admin') || session()->has('student'))
            <a href="/{{session()->has('admin') ? 'admin' : 'student'}}/dashboard" class="get-btn">Dashboard</a></li>
            @else
             <li><a href="{{route('student.auth')}}">Login</a></li>
            <li><a class="get-btn" href="/student/register">Sign Up</a></li>
            @endif
        </ul>
    </header>
    <!-- Container -->
    <div class="container">
        <!-- Content -->
        <div class="content">
            <h1>Best Ever Marketing Plans</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione blanditiis odio aperiam. Quas, alias
                nam? Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, illo.</p>
            <a href="#">Learn More</a>
        </div>
        <!-- Image -->
        <div class="bg-image">
            <img src="https://i.ibb.co/Db6LXYV/back.png" alt="background">
        </div>
    </div>

    <!-- Footer -->
    <footer class="ftr">
        <p>Copyright &copy; 2021 - Marketeer</p>
        <p>Deisgned & Developed by WAHS</p>
    </footer>
</body>
<script>
  const img = document.querySelector("img");
  img.ondragstart = () => {
    return false;
  };
</script>
</html>
