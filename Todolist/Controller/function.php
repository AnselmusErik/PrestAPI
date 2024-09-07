<?php
// Mulai sesi
session_start();

// Sambungkan ke database Anda di sini
$db = mysqli_connect("localhost", "root", "", "platformdb");

function checkSession()
{
    if (!isset($_SESSION["username"])) {
        // Jika belum, alihkan ke halaman login
        header("Location: login.php");
        exit;
    }
}

function getNama()
{
    global $db;
    // Dapatkan nama dari sesi
    $nama = $_SESSION["username"];

    // Pertama, dapatkan id mahasiswa dari tabel mahasiswa
    $query = "SELECT id FROM mahasiswa WHERE nama = '$nama'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $mahasiswa_id = $row['id'];

    return array($nama, $mahasiswa_id);
}

function handlePostRequest()
{
    global $db;
    // Dapatkan id mahasiswa
    list($nama, $mahasiswa_id) = getNama();

    // Jika form ditambahkan, simpan tugas baru ke database
    if (isset($_POST["add"])) {
        $task = $_POST["task"];
        if (empty($task)) {
            return 'Wajib isi terlebih dahulu!';
        } else {
            $query = "INSERT INTO todolist (task, mahasiswa_id) VALUES ('$task', '$mahasiswa_id')";
            mysqli_query($db, $query);
        }
    }

    // Jika form selesai disubmit, ubah status tugas
    if (isset($_POST["done"])) {
        $id = $_POST["id"];
        $query = "UPDATE todolist SET status = '1' WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    // Jika form batal disubmit, ubah status tugas
    if (isset($_POST["cancel"])) {
        $id = $_POST["id"];
        $query = "UPDATE todolist SET status = '0' WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    // Jika form hapus disubmit, hapus tugas dari database
    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $query = "DELETE FROM todolist WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    return null;
}

function getTasks($mahasiswa_id)
{
    global $db;
    // Kemudian, gunakan id mahasiswa untuk mendapatkan semua tugas dari pengguna yang sedang login
    $query = "SELECT * FROM todolist WHERE mahasiswa_id = '$mahasiswa_id'";
    $result = mysqli_query($db, $query);

    return $result;
}
