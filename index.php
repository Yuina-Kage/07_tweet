<?php

require_once('config.php');

$dbh = connectDb();

$sql = "select * from tweets order by updated_at desc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $content = $_POST['content'];

  $errors = [];

  if ($content == '') {
    $errors[] = 'ツイート内容を入力してください';
  }
}





?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tweet一覧</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>新規Tweet</h1>
  <?php if ($errors) : ?>
      <ul class="error-list">
        <?php foreach ($errors as $error) : ?>
          <li><?php echo $error; ?></li>
        <?php endforeach; ?>
      </ul>
  <?php endif; ?>
  
  <form action="" method="post">
  <label for="content">ツイート内容<br>
    <textarea name="テキストエリア" placeholder="いまどうしてる？" rows="5" cols=32></textarea><br>
  <br> 
    <input type="submit" value="投稿する">
  </label>
  </form>
  <h2>Tweet一覧</h2>
</body>
</html>