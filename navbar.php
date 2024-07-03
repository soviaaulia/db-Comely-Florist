
    <nav class="navbar navbar-expand-lg navbar-dark warna1">
        <div class="container">
            <!-- Navbar Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigasi di Kiri -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link nav-link-custom" href="index.php">Home</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link nav-link-custom" href="tentang-kami.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link nav-link-custom" href="produk.php">Produk</a>
                    </li>
                </ul>

                <!-- Judul di Tengah -->
                <a class="navbar-brand mx-auto" href="index.php">
                    <span class="Comely">Comely Florist</span>
                </a>

                <!-- Navigasi di Kanan -->
                <ul class="navbar-nav ms-auto">
                    <?php
                    session_start();
                    if (isset($_SESSION['user_id'])) {
                        // Session is available (user is logged in)
                        ?>
                        <li class="nav-item me-4">
                            <a class="nav-link nav-link-custom">Hello, <?php echo $_SESSION['name']; ?></a>
                        </li>
                        <li class="nav-item me-4">
                            <a id="logoutBtn" class="nav-link btn btn-warna3" href="#">Logout</a>
                        </li>
                    <?php } else {
                        // Session is not available (user is not logged in)
                        ?>
                        <li class="nav-item me-4">
                            <a class="nav-link nav-link-custom" href="auth.php"><i class="fas fa-user"></i></a>
                        </li>
                    <?php } ?>
                    <li class="nav-item me-4">
                        <a class="nav-link nav-link-custom" href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#logoutBtn').on('click', function(e) {
        e.preventDefault(); // Prevent default link action

        // Send AJAX request to logout.php
        $.ajax({
            type: 'POST',
            url: 'backend/logout.php',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Logout successful
                    alert("Logout Success"); // Optional: Show success message
                    window.location.href = 'index.php'; // Redirect to homepage after logout
                } else {
                    // Logout failed
                    alert(response.message); // Optional: Show error message
                }
            },
            error: function(xhr, status, error) {
                alert('Error occurred while logging out.'); // Optional: Show generic error message
            }
        });
    });
});
</script>
</body>
</html>
