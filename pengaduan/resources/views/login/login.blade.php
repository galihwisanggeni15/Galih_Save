<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login & Registration Form</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="container">
        <input type="checkbox" id="check">
        <div class="login form">
            <header>Login</header>
            <form action="{{ route('loginsubmit') }}" method="POST">
                @csrf
                <input type="text" name="username" placeholder="Masukkan username" required>
                <input type="password" name="password" placeholder="Buat password" required>
                <input type="submit" class="button" value="Login">
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <label for="check">Signup</label>
                </span>
            </div>
        </div>
        <div class="registration form">
            <header>Signup</header>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" name="nama_lengkap" placeholder="Masukkan nama lengkap" required>
                <input type="text" name="username" placeholder="Masukkan username" required>
                <input type="number" name="nip" placeholder="Masukkan NIP" required>
                <input type="number" name="telephone" placeholder="Masukkan telephone" required>
                <input type="password" name="password" placeholder="Buat password" required>
                <input type="submit" class="button" value="Signup">
            </form>
            <div class="signup">
                <span class="signup">Already have an account?
                    <label for="check">Login</label>
                </span>
            </div>
        </div>
    </div>
    @if (session('sudahada'))
        <script>
            alert('Username, Email, Telephone sudah ada');
        </script>
    @endif
    @if (session('berhasil'))
        <script>
            alert('Buat akun berhasil silahkan login');
        </script>
    @endif
    @if (session('menunggu'))
        <script>
            alert('Sabar akun menunggu persetujuan');
        </script>
    @endif
    @if (session('diblokir'))
        <script>
            alert('Akun mu diblokir gae 0 neh');
        </script>
    @endif
    @if (session('ditolak'))
        <script>
            alert('Akun mu ditolak gae 0 neh');
        </script>
    @endif
</body>

</html>
