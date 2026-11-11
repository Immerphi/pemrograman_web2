<?php
session_start();
if (isset($_POST['Login'])) {
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	if (empty($user) && empty($pass)) {
		echo "<h2>Username dan Password wajib diisi!</h2>";
		echo "<a href='session1.php'>Kembali ke Login</a>";
	} else if (empty($user)) {
		echo "<h2>Username belum diisi!</h2>";
		echo "<a href='session1.php'>Kembali ke Login</a>";
	} else if (empty($pass)) {
		echo "<h2>Password belum diisi!</h2>";
		echo "<a href='session1.php'>Kembali ke Login</a>";
	} else if ($user == "lily" && $pass == "123") {
		$_SESSION['login'] = $user;
		echo "<h1>Anda berhasil LOGIN</h1>";
		echo "<h2>Klik <a href='session2.php'>di sini (session2.php)</a> untuk menuju ke halaman pemeriksaan session</h2>";
	} else if ($user == "lily" && $pass != "123") {
		echo "<h2>Password salah!</h2>";
		echo "<a href='session1.php'>Coba lagi</a>";
	} else if ($user != "lily" && $pass == "123") {
		echo "<h2>Username salah!</h2>";
		echo "<a href='session1.php'>Coba lagi</a>";
	} else {
		echo "<h2>Username dan Password salah!</h2>";
		echo "<a href='session1.php'>Coba lagi</a>";
	}
} else {
?>
<html>
<head>
<title>Login here...</title>
</head>
<body>
<form action="" method="post">
<h2>Login Here...</h2>
Username : <input type="text" name="user"><br>
Password : <input type="password" name="pass"><br>
<input type="submit" name="Login" value="Log In">
</form>
</body>
</html>
<?php
}
?>