<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="decision.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="title">今日はこれをやろう！</div>
  <br>
    <div class="do">あなたがするのは…</div>
    <div class="deci">
    <?php
    $dsn = 'mysql:dbname=g128kato;host=localhost';
    $user = 'root';
    $password = 'ERYHH64gO4Mj7c5p';

    try{
      $dbh = new PDO($dsn, $user, $password);

      $q = $dbh->query('SELECT action FROM list ORDER BY RAND()');

      foreach ($q as $row) {
        print $row["action"];
        break;
      }

    } catch (PDOException $e) {
      echo "接続失敗: ".$e->getMessage()."\n";
      exit();
    }
    ?>
  </div>
    <div class="do">です！</div><br>
    <form action="decision.php" method="POST">
      <input class="btn" type="submit" value="やり直し">
    </form>
    <button class="btn" type="submit" onclick="location.href='./home.php'">TOP</button>
    <body>
