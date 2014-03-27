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
			<h2>填寫留言</h2>
		</header>
	</section>

	<div class="main">
		<form action="write.php" method="post" class="write_form">
			<p>姓名: &nbsp; &nbsp;
			<input type="text" name="name">*</p>

			<p>網站: &nbsp; &nbsp;
			<input type="text" name="url" value="http://"></p>

			<p>電郵: &nbsp; &nbsp;
			<input type="text" name="email" value=""></p>

			<p><span>內容: &nbsp; &nbsp;</span>
			<textarea name="content" cols="45" rows="5"></textarea></p>

			<p><input type="submit" name="Submit"value="送出留言"></p><br>
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
