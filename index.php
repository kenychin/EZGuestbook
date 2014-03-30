<?php
/*
 *	EZGuestbook - coded by Ken Chin (kenychin@gmail.com)
 *
 * 	LICENSE: free to use and share for all =)
 *
 */

	// 開始 Session, 檢查使用者
	session_start();
	if (isset($_SESSION['user']) && $_SESSION['user'] === "admin") {
		$URL['user'] = "admin";
	}
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Perl 教學 - 訪客留言版</title>
	<link rel="stylesheet" media="screen" href="style_gb.css">
	<script>
		function showElement() {
			if (document.getElementById("AdminLogin").style.display=="block")
				document.getElementById("AdminLogin").style.display="none";
			else document.getElementById("AdminLogin").style.display="block";
		}
	</script>
</head>

<body>
<div class="page-wrapper">
	<section class="intro">
		<header>
			<h1>Perl 教學 - 訪客留言版</h1>
			<h2><a href="write_form.php">填寫留言</a></h2>
		</header>
	</section>

	<div class="main">

<?php
/***** 程式執行: 讀取資料庫 *****/
include("db_conn.php");
$query = "SELECT * FROM messages ORDER BY id DESC";
$result = mysql_query($query) or die('Query failed: ' . mysql_error() . "<br />\n$query");

/***** 顯示留言 *****/
if($result) {
	while ($Entry = mysql_fetch_array($result)) {
		if ($Entry['r_id'] || $Entry['del']) { continue; }
		?>

		<div class="message">
			<?php if ($Entry['url']) {
				if (strpos($Entry['url'], 'http://') === false) {
					$Entry['url'] = "http://{$Entry['url']}";
				}
				$Entry['name'] = "<a href=\"{$Entry['url']}\">{$Entry['name']}</a>";
			} ?>
			<h3><?=$Entry['name']?></h3>
			<?php // 過濾 HTML 碼
//			if(preg_match('[xmp|noscript|table]', $Entry["content"])) {
				$replace1 = array("<", ">");
				$replace2 = array("&lt;", "&gt;");
				$Entry["content"] = str_replace($replace1, $replace2, $Entry["content"]);
//			} 
			?>
			<p class="msg_content"><?=$Entry["content"]?></p>
			<p class="msg_footer">
					<?php
						if ($URL['user']) {
							echo "<a href=\"admin.php?mode=edit&id={$Entry['id']}\">E</a> &nbsp; ";
							echo "<a href=\"admin.php?mode=del&id={$Entry['id']}\">D</a> &nbsp; ";
						}
						if ($Entry['email'])
							echo "<a href=\"mailto:{$Entry['email']}\" title=\"{$Entry['email']}\"><img src=\"email.png\" alt=\"{$Entry['email']}\"></a> &nbsp;";
						$Entry['time'] = date('Y-m-d H:i', strtotime($Entry['time']));
						echo $Entry['time'];
					?>
			</p>

			<?php
				/***** 顯示回覆 *****/
				$query = "SELECT * FROM messages WHERE r_id = {$Entry['id']}";
				$result_r = mysql_query($query) or die('Query failed: ' . mysql_error() . "<br />\n$query");
				if($result_r) {
					while ($Entry_R = mysql_fetch_array($result_r)) {
						if ($Entry_R['del']) continue; ?>
						<hr>
						<div class="msg_reply">
						<?php if ($Entry_R['url']) {
							if (strpos($Entry_R['url'], 'http://') === false) {
								$Entry_R['url'] = "http://{$Entry_R['url']}";
							}
							$Entry_R['name'] = "<a href=\"{$Entry_R['url']}\">{$Entry_R['name']}</a>";
						} ?>
						<h4><?=$Entry_R['name']?></h4>
						<p class="msg_content"><?=$Entry_R['content']?></p>
						<p class="msg_footer">
						<?php
							if ($URL['user']) {
								echo "<a href=\"admin.php?mode=edit&id={$Entry_R['id']}\">E</a> &nbsp; ";
								echo "<a href=\"admin.php?mode=del&id={$Entry_R['id']}\">D</a> &nbsp; ";
							}
							if ($Entry_R['email'])
								echo "<a href=\"mailto:{$Entry_R['email']}\" title=\"{$Entry_R['email']}\"><img src=\"email.png\" alt=\"{$Entry_R['email']}\"></a> &nbsp;";
							$Entry_R['time'] = date('Y-m-d H:i', strtotime($Entry_R['time']));
							echo $Entry_R['time'];
						?>
						</p>
						</div><?php
					}
				}
			?>
			<p class="reply_link">
				<a href="write_form.php?id=<?=$Entry['id']?>">回覆</a>
			</p>
		</div>
		<?php
	}
}
?>

        <div id="AdminText" onClick="showElement();"><p class="center">admin</p></div>
		<div id="AdminLogin" class="hidden">
			<?php if (!isset($_SESSION['user'])) { ?>
				<form action="admin.php?mode=login" method="post">
				<input type="password" name="pass" size=10>
				<input type="submit" value="login">
				</form> <?php }
			else { ?>
				<a href="admin.php?mode=logoff">Logoff</a>
			<?php } ?>
		</div>
		<div class="footer">
			<p><a href="/teach/perl.shtml">回到Perl教學</a><br><br>
			<a href="http://master2.com">Master2.com</a></p>

			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Footer -->
			<ins class="adsbygoogle"
				 style="display:inline-block;width:468px;height:15px"
				 data-ad-client="ca-pub-4473834210007622"
				 data-ad-slot="2531147599"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>

		</div>
	</div>
</div>

</body>
</html>
