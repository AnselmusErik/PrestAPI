<?php
include 'function.php';

checkSession();
list($nama, $mahasiswa_id) = getNama();
$error = handlePostRequest();
$result = getTasks($mahasiswa_id);
?>

<!DOCTYPE html>
<html lang="en">        

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist <?php echo $nama; ?></title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <h1>Selamat Datang <?php echo $nama; ?>!</h1>
        <h2>Daftar Tugas:</h2>
        <form action="" method="post">
            <input type="text" name="task" placeholder="Tambahkan tugas baru...">
            <button type="submit" name="add">Tambah <i class="fa-regular fa-square-plus"></i></button>
        </form>

        <?php if ($error) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <ul id="todolist">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <li>
                    <?php echo $row['task']; ?>
                    <small><?php echo $row['timestamp']; ?></small>
                    <?php if ($row['status'] == '0') : ?>
                        <!-- Selesai -->
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="done"><i class="fa-solid fa-check"></i></button>
                        </form>
                    <?php else : ?>
                        <!-- Batal -->
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="cancel"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    <?php endif; ?>
                    <!-- Hapus -->
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="../Login/logout.php" class="logout-button"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
    <script src="home.js"></script>
</body>

</html>