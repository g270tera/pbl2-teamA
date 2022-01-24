<?php
session_start();
require('library.php');
$error = [];
$user_id = '';
$password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if ($user_id === '' || $password === '') {
        $error['login'] = 'blank';
    } else {
        $db = dbconnect();
        $stmt = $db->prepare('select id, name, password from members where user_id=? limit 1');
        if (!$stmt) {
            die($db->error);
        }

        $stmt->bind_param('s', $user_id);
        $success = $stmt->execute();
        if (!$success) {
            die($db->error);
        }

        $stmt->bind_result($id, $name, $hash);
        $stmt->fetch();
        
        if (password_verify($password, $hash)) {
            //ログイン成功
            session_regenerate_id();
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            header('Location: index.php');
        } else {
            $error['login'] = 'failed';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="style.css"/>
    <title>ログインする</title>
    <link rel="stylesheet" href="style.css">
</head>

<body bgcolor="669933">
<div class="logtop">
<p>
    <div class="title">You柔不断</div>
    <div class="subtitle">～今日は何する？～</div>
</p>
<form action="" method="post">
<p>
    <input type="text" name="user_id" size="35" maxlength="255" placeholder="メールアドレス" value="<?php echo h($user_id); ?>"/>
    <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
    <p class="error">* IDとパスワードをご記入ください</p>
    <?php endif; ?>
    <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
    <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
    <?php endif; ?>
</p>
<p>
<input type="password" name="password" size="35" maxlength="255" placeholder="パスワード" value="<?php echo h($password); ?>"/>
</p>
<p>
    <button class="logbtn", id="logbtn", type="submit">ログイン</button>
</p>
</p>
</form>
</div>
</body>
</html>
