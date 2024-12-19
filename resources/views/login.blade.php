
<html>

<head>
    <title>Welcome</title>
<link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="icon" href="{{asset('storage/images/logo.png')}}" type="image/icon type">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    function myAlert(message){
        alert(message);
    }
</script>

</head>

<div class="container">

    <div class="row">
        <div class="col">
            <h1>Welcome to <br>the Admin <br> Dashboard</h1>
            <p>You can log in and start working</p>
        </div>


        <div class="background"></div>

    <form action="{{ route('login.submit') }}" method="post" class="login">
        @csrf
        <h3>Login Here</h3>

        <label for="name">username</label>
        <input type="text" placeholder="user name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value=" ">
        <span class="invalid-feedback"></span>


        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"></span>

        <button>Log In</button>

    </form>
@if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `
                <ul style="text-align: left;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `
        });
    </script>
@endif
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}'
        });
    </script>
@endif

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        });
    </script>
@endif

    </div>
</div>
</html>

