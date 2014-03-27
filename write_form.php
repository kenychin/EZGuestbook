<?php
	parse_str($_SERVER['QUERY_STRING'], $URL);
	$heading2 = "填寫留言";
	$submit_txt = "送出留言";
	if ($URL['id']) {
		$heading2 = "回覆留言";
		$submit_txt = "送出回覆";
	};
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>訪客留言版 - 填寫留言</title>
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
		<form action="write.php" method="post" class="write_form">
			<?php if ($URL['id']) { ?>
				<p>留言編號: &nbsp; &nbsp;
				<input type="text" name="r_id" value="<?=$URL['id']?>" size="1" readonly>
			<?php } ?>
			<p>姓名: &nbsp; &nbsp;
			<input type="text" name="name" maxlength="20" value="<?=$_COOKIE["name"]?>">*</p>

			<p>網站: &nbsp; &nbsp;
			<input type="text" name="url" maxlength="50" value="<?=$_COOKIE["url"]?>"></p>

			<p>電郵: &nbsp; &nbsp;
			<input type="text" name="email" maxlength="30" value="<?=$_COOKIE["email"]?>"></p>

			<p><span>內容: &nbsp; &nbsp;</span>
			<textarea name="content" cols="45" rows="5"></textarea></p>

			<p><input type="submit" name="Submit" value="<?=$submit_txt?>"></p><br>
			<p>* 姓名 和 內容 必須填寫</p>
		</form>

		<div class="footer">
			<h3><a href="./">回留言版</a></h3><br>
			<p><a href="/teach/perl.shtml">回Perl教學</a><br><br><a href="http://master2.com">Master2.com</a></p>
		</div>
	</div>
</div>

</body>
</html>
