<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IoT Panel - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">IoT Panel</h1>
                                    </div>
                                    <form id="login-form" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>
    <script src="{{ asset('template') }}/sweetalert2/dist/sweetalert2.all.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $("#login-form").submit(function(event) {
            event.preventDefault();

            // get form data
            var formData = {
                email: $("#email").val(),
                password: $("#password").val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('auth.login') }}",
                data: formData,
                dataType: "json",
                encode: true,
                success: function(data) {
                    localStorage.setItem("token", data.token);
                    localStorage.setItem("user", JSON.stringify(data.data));
                    window.location.href = "{{ route('dashboard') }}";
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal Login',
                        text: response.responseJSON.message
                    });
                    // handle login error
                    // console.error("Login error: " + xhr.responseText);
                }
            });

        });

    });
</script>
