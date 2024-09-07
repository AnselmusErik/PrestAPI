<?php
// Mulai sesi
session_start();

// Sambungkan ke database Anda di sini
$db = mysqli_connect("localhost", "root", "", "platformdb");

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Query untuk mencari mahasiswa dengan nama yang sesuai
    $query = "SELECT * FROM mahasiswa WHERE nama = '$username' AND nim = '$old_password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika mahasiswa ditemukan dan password lama benar, update password
        $query = "UPDATE mahasiswa SET nim = '$new_password' WHERE nama = '$username'";
        $result = mysqli_query($db, $query);
        if ($result) {
            // Alihkan ke halaman login
            header("Location: ../Login/login.php");
            exit;
        } else {
            $error = "Gagal mereset password!";
        }
    } else {
        $error = "Username tidak ditemukan atau password lama salah!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Mahasiswa</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form method="post">
        <h1>Reset Password</h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (isset($success)) : ?>
            <p><?php echo $success; ?></p>
        <?php endif; ?>

        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <label for="old_password">Old Password : </label>
        <input type="password" name="old_password" id="old_password">
        <label for="new_password">New Password : </label>
        <input type="password" name="new_password" id="new_password">
        <button type="submit" name="submit">Reset Password</button>

        <!-- untuk membuat link dengan ikon -->
        <a href="../Login/login.php" style="display: block; margin-top: 5px; margin-left: 175px;">
            <i class="fas fa-arrow-left"></i></a>
    </form>


</body>
<script src="reset.js"></script>

</html>