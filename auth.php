<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .center-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
        }
        .card {
            width: 100%;
            max-width: 500px;
        }

        .nav-pills .nav-link.active {
            background-color: #863486ad; /* Change this to your desired active color */
            color: white;
        }
        .nav-pills .nav-link:not(.active) {
            color: black; /* Change this to your desired inactive text color */
        }
        .btn-floating i {
            color: #885f3d; /* Change this to your desired icon color */
        }
    </style>
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container center-content">
        <div class="card">
            <div class="card-body">
                <!-- Pills navs -->
                 <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-toggle="pill" href="#pills-login" role="tab"
                        aria-controls="pills-login" aria-selected="true">Masuk</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register" data-toggle="pill" href="#pills-register" role="tab"
                        aria-controls="pills-register" aria-selected="false">Daftar</a>
                    </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form id="loginForm">
                            <div class="text-center mb-3">
                                <p>Sign in with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>
                            <p class="text-center">or:</p>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="loginName">Username</label>
                                <input type="text" id="loginName" class="form-control" name="loginName" />
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="loginPassword">Password</label>
                                <input type="password" id="loginPassword" class="form-control" name="loginPassword" />
                            </div>
                            <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                                        <label class="form-check-label" for="loginCheck"> Ingat Saya</label>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Simple link -->
                                    <a href="#!" >Lupa password?</a>
                                </div>
                            </div>
                            <div id="alert" class="mt-3"></div>
                            <!-- Submit button -->
                            <button type="submit" class="btn warna3 btn-block mb-4 text-white">Sign in</button>
                            <!-- Register buttons -->
                            <div class="text-center">
                                <p>Not a member? <a href="#!">Daftar</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                        <form id="registerForm">
                            <div class="text-center mb-3">
                                <p>Sign up with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>
                            <p class="text-center">or:</p>
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="registerName">Name</label>
                                <input type="text" id="registerName" class="form-control" name="name" />
                            </div>
                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="registerUsername">Username</label>
                                <input type="text" id="registerUsername" class="form-control" name="username" />
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="registerEmail">Email</label>
                                <input type="email" id="registerEmail" class="form-control" name="email" />
                            </div>
                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="registerPassword">Password</label>
                                <input type="password" id="registerPassword" class="form-control" name="password" />
                            </div>
                            <!-- Repeat Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                                <input type="password" id="registerRepeatPassword" class="form-control" name="repeatPassword" />
                            </div>
                            <!-- Checkbox -->
                            <div class="form-check d-flex mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                                    aria-describedby="registerCheckHelpText" />
                                <label class="form-check-label" for="registerCheck">
                                    I have read and agree to the terms
                                </label>
                            </div>
                            <div id="alert2" class="mt-3"></div>
                            <!-- Submit button -->
                            <button type="submit" class="btn warna3 text-white btn-block mb-3">Sign up</button>
                            
                        </form>
                    </div>
                </div>
                <!-- Pills content -->
            </div>
        </div>
    </div>

    <!-- Include Bootstrap and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                // Clear any existing alerts
                $('#alert2').empty();

                // Collect form data
                var formData = $(this).serialize();

                // Perform AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'backend/signup.php',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                         
                            // Registration successful
                            $('#alert2').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                            // Clear form inputs
                            $('#registerForm')[0].reset();
                            window.location.href = 'index.php';
                        } else {
                            // Display error message as alert
                          
                            $('#alert2').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    
                        $('#alert2').html('<div class="alert alert-danger" role="alert">Error occurred while processing your request.</div>');
                    }
                });
            });
        });
    </script>
    <script>
$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form submission

        // Clear any existing alerts
        $('#alert').empty();

        // Collect form data
        var formData = $(this).serialize();

        // Perform AJAX request
        $.ajax({
            type: 'POST',
            url: 'backend/login.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                    // Login successful
                    $('#alert').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    // Optionally redirect to dashboard or another page
                    window.location.href = 'index.php';
                } else {
                    // Login failed
                    $('#alert').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#alert').html('<div class="alert alert-danger" role="alert">Error occurred while processing your request.</div>');
            }
        });
    });
});
</script>

</body>
</html>
