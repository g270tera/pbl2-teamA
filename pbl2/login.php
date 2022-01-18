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
</head>

<body>
<div>
    <div>
        <h1>ログインする</h1>
    </div>
    <div>
        <div>
            <p>メールアドレスとパスワードを記入してログインしてください。</p>
            <p>入会手続きがまだの方はこちらからどうぞ。</p>
            <p>&raquo;<a href="join/">入会手続きをする</a></p>
        </div>
        <form action="" method="post">
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="user_id" size="35" maxlength="255" value="<?php echo h($user_id); ?>"/>
                    <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
                    <p class="error">* IDとパスワードをご記入ください</p>
                    <?php endif; ?>
                    <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
                    <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
                    <?php endif; ?>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="35" maxlength="255" value="<?php echo h($password); ?>"/>
                </dd>
            </dl>
            <div>
                <input type="submit" value="ログインする"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>
