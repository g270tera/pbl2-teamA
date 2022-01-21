<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="decision.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="title">今日はこれをやろう！</div>
  <div>
    <?php
    $dsn = 'mysql:dbname=g128kato;host=localhost';
    $user = 'root';
    $password = 'ERYHH64gO4Mj7c5p';

    try{
      $dbh = new PDO($dsn, $user, $password);
      $place = $_POST['place'];
      $number_person = $_POST['number_person'];
      $time = $_POST['time'];
      $cost = $_POST['cost'];
      $share = $_POST['share'];

      $q = $dbh->query("SELECT action FROM list WHERE place LIKE '%$place%'
        AND number_person LIKE '%$number_person%' AND time LIKE '%$time%'
        AND cost LIKE '%$cost%' AND share LIKE '%$share%' ORDER BY RAND()");

        foreach ($q as $row) {
          if ($row != null){
            print '<p class="do">あなたがするのは…</p>';
            print '<p class="deci">'.$row["action"].'<p>';
            print '<p class="do">です！</p>';
            break;
          }
        }
        if($row == null){
          print '<p class="do">当てはまるものがありません</p>';
        }
      } catch (PDOException $e) {
        echo "接続失敗: ".$e->getMessage()."\n";
        exit();
      }
      ?>
    </div>
    <form>
       <input class="btn" type="button" onclick="location.href='./detail.php'" value="やり直し">
       <input class="btn" type="button" onclick="location.href='./home.php'" value="TOP">
     </form>
    <body>
