    <footer class="bg-primary text-white text-center mt-auto">
        <div class="container p-4">
            <section class="mb-4">
                <!-- Social media -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            </section>
            <section class="">
                <p>
                    Politeknik Negeri Pontianak berkomitmen untuk menyediakan pendidikan vokasi terbaik di Kalimantan Barat.
                </p>
            </section>
            <hr>
            <?php
            // Tampilkan link Admin Login hanya jika belum ada sesi login admin
            if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) :
            ?>
                <a href="login.php" class="text-white">Admin Login</a>
            <?php endif; ?>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2025 Copyright:
            <a class="text-white" href="index.php">POLNEP</a>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>