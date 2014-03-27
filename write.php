<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>訪客留言版 - 送出留言</title>
	<link rel="stylesheet" media="screen" href="style_gb.css">
</head>

<?php
$name = $_POST["name"];
$url = $_POST["url"];
$email = $_POST["email"];
$content = $_POST["content"];
$time = date("Y-m-d g:i:s");
$ip = $_SERVER["REMOTE_ADDR"];

$validate = 1;
if (!$name) { $validate = 0; $msg = "必要欄位不可空白";}
if (!$content) { $validate = 0; $msg = "必要欄位不可空白";}
if ($url === 'http://') { $url = ""; }

include("db_conn.php");
$query = "SELECT * FROM messages ORDER BY id DESC LIMIT 1";
$result = mysql_query($query);
$Entry = mysql_fetch_array($result);
if ($_POST["content"] === $Entry['content']) { $validate = 0; $msg = "請勿重複留言";}

if ($validate) {
	$query = "INSERT INTO messages (name,url,email,content,time,ip) VALUES ('$name','$url','$email','$content','$time','$ip')";
	mysql_query($query); 

	$msg = "謝謝您的留言";
}

?>

<body>
<div class="page-wrapper">
	<section class="intro">
		<header>
			<h1>Perl 教學 - 訪客留言版</h1>
			<h2>送出留言</h2>
		</header>
	</section>

	<div class="main">
		<h3><?=$msg?></h3>
	</div>
<!--
<script>
alert("<?echo $finish?>");
location.href="index.php";
</script>
-->

		<div class="footer">
			<h3><a href="./">回留言版</a></h3><br>
			<p><a href="/teach/perl.shtml">回Perl教學</a><br><br><a href="http://master2.com">Master2.com</a></p>
		</div>
	</div>
</div>

</body>
</html>
