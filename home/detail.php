<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="detail.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="title">やることを決めよう！</div>
  <br>
  <form action="decision1.php" method="POST">
    <div class="action">絞り込み</div>
    <hr>
    <table align="center">
      <tr>
        <th>場所</th><td><input type="radio" name="place" value="in">イン</td><td><input type="radio" name="place" value="out">アウト</td>
      </tr>
      <tr>
        <th>人数</th><td><input type="radio" name="number_person" value="one">一人</td><td><input type="radio" name="number_person" value="many">複数</td>
      </tr>
      <tr>
        <th>時間</th><td><input type="radio" name="time" value="hour">1時間</td><td><input type="radio" name="time" value="day">1日</td>
      </tr>
      <tr>
        <th>コスト</th><td><input type="radio" name="cost" value="no">なし</td><td><input type="radio" name="cost" value="low">低</td><td><input type="radio" name="cost" value="high">高</td>
      </tr>
      <tr>
        <th>共有</th><td><input type="radio" name="share" value="no">なし</td><td><input type="radio" name="share" value="yes">あり</td>
      </tr>
    </table>
    <hr>
    <input class="btn" type="submit" value="決定">
    <input class="btn" type="button" value="戻る" onclick="location.href='./home.php'">
  </form>
</body>
