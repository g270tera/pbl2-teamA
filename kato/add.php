<!DOCTYPE html>
<html lang="ja">
<head>
  <meta "charset=UTF-8">
  <title>You柔不断</title>
  <link href="add.css" type="text/css" rel="stylesheet">
</head>
<body>
  <div class="title" align="center">これもしたいよ！</div>
  <div class="subtitle">やりたいことを追加しよう</div>
  <form action="home.php" method="POST">
    <div align="center">
    <input class="text" type="text" name="action"  placeholder="やることを入力">
  </div>
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
    <input class="btn" type="submit" value="追加">
  </form>
  <form action="home.php" method="POST">
    <input class="btn" type="submit" value="TOP">
  </form>
</body>
