<?php include("templates/page_header.php");?>
<?php include("lib/auth.php") ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$aid = $_GET['aid'];	
	$result=get_article($dbconn, $aid);
	$row = pg_fetch_array($result, 0);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = $_POST['title'];

	$str = $title;
	$pattern = "/(SELECT|FROM|WHERE|ALTER|TABLE|ADD|AND|AS|AVG|BETWEEN|CASE|THEN|ELSE|END|COUNT|CREATE|DELETE|GROUP|BY|HAVING|JOIN|ON|INSERT|INTO|VALUES|IS|NULL|NOT|LIKE|LIMIT|MAX|MIN|OR|ORDER|LEFT|ROUND|DISTINCT|SUM|WITH)/";
	$value = preg_match($pattern, $str);
	$content = htmlspecialchars($_POST['content']);
	$aid = $_POST['aid'];

	if($value > 0) {

} else {
	
	$result=update_article($dbconn, $title, $content, $aid);
	}
	Header ("Location: /");
}
	

?>

<!doctype html>
<html lang="en">
<head>
	<title>New Post</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<h2>New Post</h2>

<form action='#' method='POST'>
	<input type="hidden" value="<?php echo $row['aid'] ?>" name="aid">
	<div class="form-group">
	<label for="inputTitle" class="sr-only">Post Title</label>
	<input type="text" id="inputTitle" required autofocus name='title' value="<?php echo $row['title'] ?>">
	</div>
	<div class="form-group">
	<label for="inputContent" class="sr-only">Post Content</label>
	<textarea name='content' id="inputContent"><?php echo $row['content'] ?></textarea>
	</div>
	<input type="submit" value="Update" name="submit" class="btn btn-primary">
</form>
<br>

	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
