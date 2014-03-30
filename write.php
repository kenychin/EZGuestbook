<?php
	// Write COOKIE
	$expire=time()+60*60*24*60;
	setcookie("name", $_POST["name"], $expire);
	setcookie("url", $_POST["url"], $expire);
	setcookie("email", $_POST["email"], $expire);
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>訪客留言版 - 送出留言</title>
	<link rel="stylesheet" media="screen" href="style_gb.css">
</head>

<?php
$r_id = $_POST["r_id"];
$name = $_POST["name"];
$url = $_POST["url"];
$email = $_POST["email"];
$content = $_POST["content"];
$time = date("Y-m-d H:i:s");
$ip = $_SERVER["REMOTE_ADDR"];
$env = gethostbyaddr($ip);
$env = "$env\n{$_SERVER["HTTP_USER_AGENT"]}";

// check required fields
$validate = 1;
if (!$name) { $validate = 0; $msg = "必要欄位不可空白";}
if (!$content) { $validate = 0; $msg = "必要欄位不可空白";}
if ($url === 'http://') { $url = ""; }

// check duplicate
include("db_conn.php");
$query = "SELECT content FROM messages ORDER BY id DESC LIMIT 1";
$result = mysql_query($query);
$Entry = mysql_fetch_array($result);
if ($_POST["content"] === $Entry['content']) { $validate = 0; $msg = "請勿重複留言";}

// write comment after validation
if ($validate) {
	$query = "INSERT INTO messages (r_id,name,url,email,content,time,ip,env) VALUES ('$r_id','$name','$url','$email','$content','$time','$ip','$env')";
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
			<p><a href="/teach/perl.shtml">回Perl教學</a><br><br>
			<a href="http://master2.com">Master2.com</a></p>
		</div>
	</div>
</div>

</body>
</html>
