
@extends('layouts.dashboard')

@section('page-title', 'Genrate Code')

  @section('css')
      <style>
              * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
              font-family: 'Poppins', sans-serif;
          }

          body {
              background-color: #002339;
              color: #002339;
          }

          .container {
              margin: 12%;
              width: 90%;
              max-width: 700px;
          }

          .display {
              width: 100%;
              margin-top: 50px;
              margin-bottom: 30px;
              background: #fff;
              color: #333;
              display: flex;
              align-items: center;
              justify-content: space-between;
              padding: 26px 20px;
              border-radius: 5px;
              -webkit-border-radius: 5px;
              -moz-border-radius: 5px;
              -ms-border-radius: 5px;
              -o-border-radius: 5px;
          }

          .container h1 {
              font-weight: 500;
              font-size: 45px;
              
          }

          .container h1 span {
              color: #019f55;
              border-bottom: 4px solid ;
              padding-bottom: 7px;
          }

          .display img {
              width: 30px;
              cursor: pointer;
          }

          .display input {
              border: 0;
              outline: 0;
              font-size: 24px;
              flex: 1;
          }

          .container button img {
              width: 28px;
              margin-right: 10px;
          }

          .container a, 
          .container button {
              border: 0;
              outline: 0;
              background: #019f55;
              color: #fff;
              font-size: 20px;
              font-weight: 300;
              display: flex;
              align-items: center;
              justify-content: center;
              padding: 10px 26px;
              cursor: pointer;
              border-radius: 4px;
              -webkit-border-radius: 4px;
              -moz-border-radius: 4px;
              -ms-border-radius: 4px;
              -o-border-radius: 4px;
          }
        </style>
  @endsection

  @section('content')
    <div class="container">
      <h1><span>Genrate Code</span></h1>
      <form action="{{route('code.store')}}" method="post">
        @csrf
        <div class="display">
          <input name="code" type="text" name="" id="password" placeholder="Code" readonly>
          <a onclick="copyPassword()" style="cursor: pointer">Copy</a>
        </div>
        <div class="display">
          <input name="descount_price" type="number" name="" id="descount_price" placeholder="descount price" required>
        </div>
        <a id="genrateBtn" class="mb-4" style="cursor: pointer" onclick="createPassword()">Genrate code</a>
        <button id="genrateBtn" type="submit">Save Code</button>
      </form>
    </div>
  @endsection

@section('script')
        <script>

        const passwordBox = document.getElementById("password");
        const genrateBtn = document.getElementById("genrateBtn");
        const lenght = 12;
        
        const upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lowerCase = 'abcdefghijklmnopqrstuvwxyz';
        const number = '123456789';
        const symbol = "!@#$%^&*()_+=}{}[]|?><''";

        const allChars = upperCase + lowerCase + symbol;
        // genrateBtn.addEventListener('click', createPassword());
        function createPassword() {
            let password = '';
            password += upperCase[Math.floor(Math.random() * upperCase.length)];
            password += lowerCase[Math.floor(Math.random() * lowerCase.length)];
            password += number[Math.floor(Math.random() * number.length)];
            password += symbol[Math.floor(Math.random() * symbol.length)];
            console.log(password);

            while (lenght > password.length) {
                password += allChars[Math.floor(Math.random() * allChars.length)];
            }

            passwordBox.value = password;
            console.log(password);
        }

        function copyPassword() {
            passwordBox.select();
            document.execCommand('copy');
            // passwordBox.value = '';
        }

    </script> 
@endsection