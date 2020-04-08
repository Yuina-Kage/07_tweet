<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();
$sql = 'SELECT * FROM tweets WHERE id = :id ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$tweet) {
  header('Location: index.php');
  exit;
}
?>




<?php

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>テストツイート</title>
</head>

<body>
  <h1><?php echo h($tweet['content']); ?></h1>
  <a href="index.php">戻る</a>
  <ul class="tweet-list">
    <li>
      [#<?php echo h($tweet['id']); ?>]
      <?php echo h($tweet['content']); ?><br>
      <?php echo h($tweet['good']); ?><br>
      投稿日時: <?php echo h($tweet['created_at']); ?>
      <a href="good.php&id=1&good=true">"★"</a>
      <a href="good.php&id=1&good=false">☆</a>
      <a href="edit.php?id=<?php echo h($tweet['id']); ?>">[編集]</a>
      <a href="delete.php?id=<?php echo h($tweet['id']); ?>">[削除]</a>
      <hr>
    </li>
  </ul>
</body>

</html>