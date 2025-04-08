<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Incerebrum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Optional: Your custom fonts or styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Custom Styles -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
            background: linear-gradient(145deg, #4A90E2, #356AC3);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #fff;
            border-radius: 20px;
            padding: 40px 35px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .login-heading {
            text-align: center;
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .login-subheading {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .login-form-group {
            margin-bottom: 22px;
        }

        .login-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #444;
        }

        .login-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 15px;
        }

        .login-input:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .login-form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .login-form-footer a {
            font-size: 13px;
            text-decoration: none;
            color: #4A90E2;
        }

        .login-form-footer a:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            background: #4A90E2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(74, 144, 226, 0.3);
        }

        .login-btn:hover {
            background: #3B7DD8;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="login-heading">Login to Account</h2>
        <p class="login-subheading">Please enter your email and password to continue</p>

        <form id="loginform" method="POST" action="{{ url('login') }}">
            {{ csrf_field() }}
            <div class="login-form-group">
                <label for="email" class="login-label">Email address:</label>
                <input id="email" class="login-input" type="email" name="email" required placeholder="you@example.com" autofocus>
            </div>

            <div class="login-form-group">
                <label for="password" class="login-label">Password:</label>
                <input id="password" class="login-input" type="password" name="password" required placeholder="••••••••">
            </div>

            <div class="login-form-footer">
                <label>
                    <input type="checkbox" name="remember"> Remember Password
                </label>
                <a href="#">Forgot Password?</a>
            </div>

            <button id="submit_btn" class="login-btn" type="submit">Sign In</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="{{ url('/') }}/assets/plugins/jquery/jquery.min.js"></script>
    <script src="{{ url('/') }}/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('#loginform').on('submit', function(e) {
            e.preventDefault();
            $("#submit_btn").attr("disabled", true).text('Loading...');
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        Toast.fire({ icon: 'success', title: response.message });
                        window.location.href = "{{ url('/dashboard') }}";
                    } else {
                        Toast.fire({ icon: 'error', title: response.message });
                        $("#submit_btn").attr("disabled", false).text('Sign In');
                    }
                },
                error: function() {
                    Toast.fire({ icon: 'error', title: 'Something went wrong. Please try again.' });
                    $("#submit_btn").attr("disabled", false).text('Sign In');
                }
            });
        });
    </script>

</body>
</html>