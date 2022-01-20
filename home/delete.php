<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="delete.css" type="text/css"  rel="stylesheet">
</head>
<body>
  <div class="title">こんなことしたくないよ！</div>
  <div class="subtitle">いらないものを選択しよう</div>
  <?php
  //接続設定(サーバー・データーベース・ユーザー・パスワード)
  $dsn = 'mysql:dbname=g128kato;host=localhost';
  $user = 'root';
  $password = 'ERYHH64gO4Mj7c5p';

  try{
    $dbh = new PDO($dsn, $user, $password);

    //削除するデータを取得する
    if(@$_POST["c1"]){
      //削除対象データを取得する
      $c1 = $_POST["c1"];

      //SQLを組み立てる
      $sql = "DELETE FROM list WHERE (action_id IN (";
        for($i =0; $i<count($c1); $i++){
        $sql .= intval($c1[$i]);
        if($i< count($c1) -1){
        $sql .=", ";
        }
        else{
        $sql .= "))";
      }
    }
    $dbh->query($sql) or die("データ削除エラー");
  }

  //データを取り出す
  $sql = "SELECT action_id, action FROM list ORDER BY action_id";
  $res = $dbh->query($sql) or die("データ出力エラー");

  echo '<table align="center" border="1">';
  echo "<tr>";
  echo "<td></td>";
  echo "<th>名前</th>";
  echo "</tr>";
  echo '<form method="POST" action="">';
  while($row = $res ->fetch(PDO::FETCH_ASSOC)){
    echo "<tr>";
    echo "<td><input type=\"checkbox\" name=\"c1[]\" value=\"".$row["action_id"]."\"></td>";
    echo "<td>".$row["action"]."</td>";
    echo "</tr>";
  }
  echo "<tr>";
  echo '<td colspan="2" class="no"><input class="btn" type="submit" value="削除"></td>';
  echo "</form>";
  echo "</tr>";
  echo '<form method="POST" action="home.php">';
  echo '<tr>';
  echo '<td colspan="2" class="no"><input class="btn" type="submit" value="TOP"></td>';
  echo "</form>";
  echo '</tr>';
  echo "</table>";

} catch (PDOException $e) {
  echo "接続失敗: ".$e->getMessage()."\n";
  exit();
}
?>
</body>
</html>
