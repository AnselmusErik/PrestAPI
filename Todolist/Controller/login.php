<?php
// Mulai sesi
session_start();

// Sambungkan ke database Anda di sini
$db = mysqli_connect("localhost", "root", "", "platformdb");

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST['password'];

    // Query untuk mencari mahasiswa dengan nama dan NIM yang sesuai
    $query = "SELECT * FROM mahasiswa WHERE nama = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verifikasi password
        if ($password == $user['nim']) {
            // Jika mahasiswa ditemukan, simpan username ke dalam sesi
            $_SESSION["username"] = $username;      

            // Alihkan ke halaman admin
            header("Location: ../Home/home.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form action="" method="post">
        <h1>Login Mahasiswa</h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit">Login</button>

        <!-- Link ke halaman reset password dan register -->
        <div class="link-container">
            <a href="../Reset/reset.php">Reset Password?</a>
            <!-- <span></span> -->
            <a href="../Register/regis.php">Create Account</a>
        </div>

    </form>
</body>
<script src="login.js"></script>

</html>