<?php
	// 讀取 URL Query: 登入模式, 留言/回覆編號
	parse_str($_SERVER['QUERY_STRING'], $URL);
	include("db_user.php");

	// 安全檢查
	if (!$URL['mode']) login_error('0');
	session_start();
	if ($URL['mode'] !== "login" && $_SESSION['user'] !== "admin") login_error('0');
	$msg = "訊息";

	  // 登入管理員模式
	if ($URL['mode'] === "login") {
		if ($_POST['pass'] !== $pass_admin) login_error('1');
		$heading2 = "管理員登入";

		$_SESSION['user'] = "admin";
		$msg = "登入成功, Session 開始";
	}  // 登入管理員模式
	else if ($URL['mode'] === "logoff") {
		$heading2 = "管理員登出";
		session_unset();
		session_destroy();
		$msg = "登出成功, Session 關閉";
	} // 修改模式
	else if ($URL['mode'] === "edit") {
		if (!$URL['id']) login_error('2');
		$heading2 = "修改留言";

		include("db_conn.php");
		$query = "SELECT * FROM messages WHERE id = {$URL['id']} LIMIT 1 ;";
		$result = mysql_query($query);
		$Entry = mysql_fetch_array($result);

		$msg = "留言詳細資料";
		$submit_txt = "修改送出";
	} // 更新模式
	else if ($URL['mode'] === "edit_proc") {
		if (!$_POST['id']) login_error('3');

		$name = $_POST["name"];
		$url = $_POST["url"];
		$email = $_POST["email"];
		$content = $_POST["content"];

		include("db_conn.php");
		$query = "UPDATE messages SET name='$name',url='$url',email='$email',content='$content' WHERE id = {$_POST['id']} LIMIT 1 ;";
		mysql_query($query) or login_error('cannot change');

		$msg = "留言已經更新";
	} // 刪除模式
	else if ($URL['mode'] === "del") {
		if (!$URL['id']) login_error('4');

		include("db_conn.php");
		$query = "UPDATE messages SET del = 1 WHERE id = {$URL['id']} LIMIT 1 ;";
		mysql_query($query) or login_error('cannot change');
		$msg = "留言已刪除";
	} // 其他: 錯誤
	else login_error('5');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>訪客留言版 - 管理介面</title>
	<link rel="stylesheet" media="screen" href="style_gb.css">
</head>

<body>
<div class="page-wrapper">
	<section class="intro">
		<header>
			<h1>Perl 教學 - 訪客留言版</h1>
			<h2><?=$heading2?></h2>
		</header>
	</section>

	<div class="main">
		<?php
		if ($URL['mode'] === "edit") { ?>
		<form action="admin.php?mode=edit_proc" method="post" class="write_form">
			<p>留言編號: &nbsp; &nbsp;
			<input type="text" name="id" value="<?=$URL['id']?>" size="1" readonly>

			<p>姓名: &nbsp; &nbsp;
			<input type="text" name="name" maxlength="20" value="<?=$Entry["name"]?>">*</p>

			<p>網站: &nbsp; &nbsp;
			<input type="text" name="url" maxlength="50" value="<?=$Entry["url"]?>"></p>

			<p>電郵: &nbsp; &nbsp;
			<input type="text" name="email" maxlength="30" value="<?=$Entry['email']?>"></p>

			<p><span>內容: &nbsp; &nbsp;</span>
			<textarea name="content" cols="45" rows="5"><?=$Entry['content']?></textarea></p>

			<p><input type="submit" name="Submit" value="<?=$submit_txt?>"></p><br>
		</form><br>

		<?php
		} ?>
		<div class="message">
		    <h3><?=$msg?></h3><br>
			<p id="admin_msg" class="msg_content"><?php
			if ($URL['mode'] === "edit") {
		    foreach ($Entry as $EntryName => $EntryData) {
				if (!is_int($EntryName))
				echo "$EntryName:     \t\t" . "$EntryData\n";
		    } }
			?></p>
		</div>

		<div class="footer">
			<h3><a href="./">回留言版</a></h3><br>
			<p><a href="/teach/perl.shtml">回Perl教學</a><br><br>
			<a href="http://master2.com">Master2.com</a></p>
		</div>
	</div>
</div>

</body>
</html>
