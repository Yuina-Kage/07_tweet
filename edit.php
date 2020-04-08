<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$errors = array();

$dbh = connectDb();
$sql = 'SELECT * FROM tweets WHERE id = :id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$tweet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tweet) {
  header('Location: index.php');
  exit;
  }




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  $content = $_POST['content'];
  $errors = [];
  
  
  if ($content ==$tweet['content']) {
    $errors[] = '内容が変更されていません';
  }
  
  if ($title == '') {
    $errors[] = '入力がされていません';
  }


  if (empty($errors)) {
    $dbh = connectDb();
    $sql = 'UPDATE tweets SET content = :content, good = :good, cteated_at = now()
            WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':good', $good, PDO::PARAM_STR);
    $stmt->execute();
    
    header('Location: index.php');
    exit;
  }
}

?>







<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>tweetの編集</title>
</head>

<body>
  <h1>tweetの編集</h1>
  <a href="index.php">戻る</a><br>
  <?php if ($errors) : ?>
    <ul class="error-list">
      <?php foreach ($errors as $error) : ?>
        <li>
          <?php echo h($error); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <br>
  <label>ツイート内容<br>
    <textarea name="テキストエリア" placeholder="テストツイート" rows="5" cols=32><?php echo h($tweet['content']); ?></textarea><br>
    <br>
    <input type="submit" value="編集する">
  </label>
</body>

</html>