<?php
// Mulai sesi
session_start();

// Sambungkan ke database Anda di sini
$db = mysqli_connect("localhost", "root", "", "platformdb");

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Query untuk mencari mahasiswa dengan nama yang sama
    $query = "SELECT * FROM mahasiswa WHERE nama = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika mahasiswa dengan nama yang sama ditemukan, tampilkan pesan error
        $error = "Username sudah digunakan!";
    } else if ($password != $confirm_password) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Query untuk menambahkan pengguna baru ke database
        $query = "INSERT INTO mahasiswa (nama, nim) VALUES ('$username', '$password')";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Alihkan ke halaman login
            header("Location: ../Login/login.php");
            exit;
        } else {
            $error = "Gagal membuat akun!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <link rel="stylesheet" href="regis.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form action="" method="post">
        <h1>Register Mahasiswa</h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password">
        <label for="confirm_password">Confirm Password : </label>
        <input type="password" name="confirm_password" id="confirm_password">
        <button type="submit" name="submit">Register</button>

        <a href="../Login/login.php" style="display: block; margin-top: 20px; margin-left: 150px;">
            <i class="fas fa-arrow-left"></i></a>
    </form>
</body>
<script src="regis.js"></script>

</html>