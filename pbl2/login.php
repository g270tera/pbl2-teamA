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
   <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>You 柔不断</title>
<style type="text/css">
 .title{
 color: white;
 font-size: 50px;
 text-align: center;
 margin-top: 100px;
 }
 .subtitle{
 color: white;
 font-size: 25px;
 text-align: center;
 margin-bottom: 70px;
 }
 .logbtn, .newac{
 display: flex;
 font-size: 30px;
 margin:15px auto;
 cursor: pointer;
 border-color: black;
 border: 2px;
 border-radius: 5px;
 background-color: white;
 color: #669933;
 width: 200px;
 justify-content: center;
 -webkit-box-sizing: border-box;
 -moz-box-sizing: border-box;
 box-sizing: border-box;
 -webkit-transition: all .3s;
 transition: all .3s;
 }
 .logbtn:hover, .newac:hover{
 background-color: white;
 color: black;
 }
.pi{
 color: white;
 text-align: center;
}
.submit{
 color: white;
 font-size: 25px;
 text-align: center;
 font-weight: bold;
 }
.button{
text-align: center;
 }
.error{
 text-align: center;
 color: white;
}
 </style>
</head>

<body bgcolor="669933">
<div>
    <div>
        <p><div class="title">You 柔不断</div>
 <div class="subtitle">～今日は何する？～</div>
    </div>
    <div>
        <div class="pi">
            <p>メールアドレスとパスワードを記入してログインしてください。</p>
            <p>入会手続きがまだの方はこちらからどうぞ。</p>
            <p>&raquo;<a href="join/">入会手続きをする</a></p>
        </div>
        <form action="" method="post">
            <dl>
                <div class="submit"><dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="user_id" size="35" maxlength="255" value="<?php echo h($user_id); ?>"/>
                    <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
                    </div>
                    <p class="error">* IDとパスワードをご記入ください</p>
                    <?php endif; ?>
                    <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
                    <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
                    <?php endif; ?>
                </dd><div class="submit">
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="35" maxlength="255" value="<?php echo h($password); ?>"/>
                </dd>
            </dl></div>
            <div class="button">
                <input type="submit" value="ログインする"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>
