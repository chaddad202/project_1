<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,
                   initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/style_navbar.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
     <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="icon" href="{{asset('storage/images/logo.png')}}" type="image/icon type">
</head>

<body>
    <header>
        <div class="logosec">
            <img src="{{asset('storage/images/logo.png')}}" class="icn menuicn" id="menuicn" alt="menu-icon">
            <div class="logo">Hesswany CyberCafe</div>
        </div>
    </header>
    <div class="main-container">

        <div class="sidebar active">

            <ul class="nav_list">
                <li>
                    <a id="category" href="{{ route('category.page') }}">
                        <i class='bx bx-category'></i>
                        <span class="links_name">Category</span>
                    </a>
                </li>
                <br>
                <li>
                    <a id="ads" href="{{ route('ads.page') }}">
                        <i class='bx bx-spreadsheet'></i>
                        <span class="links_name">Ads</span>
                    </a>
                </li>
                <br>
                <li>
                    <a id="view_lawyer" href="{{ route('contact.page') }}">
                        <i class='bx bxs-contact'></i>
                        <span class="links_name">Contact</span>
                    </a>
                </li>
                <br>
                <li>
                    <a id="type" href="{{ route('slideShow.page') }}">
                        <i class='bx bx-slideshow'></i>
                        <span class="links_name">Slideshow</span>
                    </a>
                </li>
                <br>
                <li>
                    <a id="type" href="{{ route('status.page') }}">
                        <i class='bx bx-power-off'></i>
                        <span class="links_name">Status</span>
                    </a>
                </li>
                <br>
                <li>
                    <a id="type" href='{{route('user.logout')}}'>
                        <i class='bx bx-log-out'></i> <span class="links_name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
    <!-- Main Content -->
    <div class="home_content">
        @yield('content')
    </div>
</body>

</html>
