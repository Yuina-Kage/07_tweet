<?php

require_once('config.php');
require_once('functions.php');

$dbh = connectDb();

$sql = 'SELECT * FROM tweets ORDER BY created_ad DESC';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $content = $_POST['content'];
  $errors = [];

  if ($content == '') {
    $errors[] = 'ツイート内容を入力してください';
  }

  if (empty($errors)) {
    $dbh = connectDb();
    $sql = 'INSERT INTO tweets (content, created_at) VALUES (:content, now())';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->execute();
  
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
  <?php if (count($tweets)) : ?>
      <ul class="tweet-list">
        <?php foreach ($tweets as $tweet) : ?>
          <li>
            
            <a href="show.php?id=<?php echo h($tweet['id']) ?>">
            <?php echo h($tweet['content']); ?></a><br>
            <?php echo h($tweet['good']); ?><br>
            投稿日時: <?php echo h($tweet['created_at']); ?>
            <hr>
          </li>
        <?php endforeach; ?>
      </ul> 
    <?php  else : ?>  
      <p>投稿されたtweetはありません</p>
    <?php endif; ?>
      
</body>
</html>