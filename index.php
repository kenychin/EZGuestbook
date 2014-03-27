<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Perl 教學 - 訪客留言版</title>
	<link rel="stylesheet" media="screen" href="style_gb.css">
</head>

<body>
<div class="page-wrapper">
	<section class="intro">
		<header>
			<h1>Perl 教學</h1>
			<h2>訪客留言版</h2>
		</header>
	</section>

	<div class="main">

<?php
/***** 程式執行: 讀取資料庫 *****/
include("db_conn.php");
$query = "SELECT * FROM messages ORDER BY id DESC";
$result = mysql_query($query) or die('Query failed: ' . mysql_error() . "<br />\n$sql");

/***** 顯示留言 *****/
if($result) {
	$num = mysql_num_rows($result);
	for($i=0;$i<$num;$i++){
		$Entry = mysql_fetch_array($result);
		?>

		<div class="message">
			<?php if ($Entry['url']) {
				if (strpos($Entry['url'], 'http://') === false) {
					$Entry['url'] = "http://{$Entry['url']}";
				}
				$Entry['name'] = "<a href=\"{$Entry['url']}\">{$Entry['name']}</a>";
			} ?>
			<h3><?=$Entry['name']?></h3>
			<?php
//				if(preg_match('[xmp|noscript|table]', $Entry["content"])) {
					$replace1 = array("<", ">");
					$replace2 = array("&lt;", "&gt;");
					$Entry["content"] = str_replace($replace1, $replace2, $Entry["content"]);
//				} 
			?>
			<p class="msg_content"><?=$Entry["content"]?></p>
			<p class="msg_footer">
			<span>
					<?php if ($Entry['email']) {
						echo "<a href=\"mailto:{$Entry['email']}\" title=\"{$Entry['email']}\"><img src=\"email.jpg\" alt=\"{$Entry['email']}\"></a> &nbsp;";
					} ?>
					<?=$Entry["time"]?>
			</span>
			</p>
		</div>
		<?php
	}
 }
?>

		<div class="footer">
			<h3><a href="write_form.php">填寫留言</a></h3><br>
			<p><a href="/teach/perl.shtml">回到Perl教學</a><br><br><a href="http://master2.com">Master2.com</a></p>
		</div>
	</div>
</div>

</body>
</html>
