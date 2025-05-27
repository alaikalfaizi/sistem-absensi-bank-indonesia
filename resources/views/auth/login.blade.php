<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,600" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body,
    html {
      width: 100%;
      height: 100%;
      overflow: hidden;
      font-family: 'PT Sans', sans-serif;
      background-image: url("{{ asset('images/BG.png') }}");
      background-position: center;
      background-size: 100vw auto;
    }

    .form-wrapper {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 350px;
      max-width: 90%;
      padding: 2rem;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .form-wrapper h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #673AB7;
      font-weight: 400;
    }

    .form-wrapper label {
      display: block;
      margin-top: 1rem;
      font-size: 0.85rem;
      color: #333;
    }

    .form-wrapper input {
      width: 100%;
      padding: 0.6rem;
      margin-top: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
      outline: none;
      transition: border-color 0.2s;
    }

    .form-wrapper input:focus {
      border-color: #673AB7;
    }

    .form-wrapper button {
      width: 100%;
      padding: 0.8rem;
      margin-top: 1.5rem;
      background-color: #195896;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s;
    }

    .form-wrapper button:hover {
      background: #003f7d;
    }

    .form-wrapper .back-home {
      text-align: center;
      margin-top: 1rem;
    }

    .form-wrapper .back-home a {
      color: #195896;
      text-decoration: none;
      font-size: 0.9rem;
    }

    .form-wrapper .back-home a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="form-wrapper">
    <form method="POST" action="{{ route('login') }}">
      @csrf

      <label for="email">Email</label>
      <input id="email" type="email" name="email" required value="{{ old('email') }}">

      <label for="password">Password</label>
      <input id="password" type="password" name="password" required>

      <button type="submit">Log In</button>
    </form>

    <div class="back-home">
      <a href="{{ url('/') }}">← Kembali ke Halaman Awal</a>
    </div>
  </div>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if ($errors->any())
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ $errors->first() }}',
        confirmButtonColor: '#195896',
      });
    </script>
  @endif
</body>

</html>
