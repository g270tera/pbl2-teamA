<?php
session_start();
require('../library.php');

if (isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])){
    $form = $_SESSION['form'];
} else {
    $form = [
        'name' => '',
        'user_id' => '',
        'password' => '',
    ];
}
$error = [];


/*フォームの内容をチェック */
if ($_SERVER['REQUEST_METHOD'] === 'POST'){ /*初回じゃいないかチェック */
    $form['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if ($form['name'] === '') {
        $error['name'] = 'blank';
    }

    $form['user_id'] = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
    if ($form['user_id'] === ''){
        $error['user_id'] = 'blank';
    } else {
        $db = dbconnect();
        $stmt = $db->prepare('select count(*) from members where user_id=?');
        if (!$stmt) {
            die($db->error);
        }
        $stmt->bind_param('s', $form['user_id']);
        $success = $stmt->execute();
        if (!$success) {
            die($db->error);
        }

        $stmt->bind_result($cnt);
        $stmt->fetch();
        if ($cnt > 0) {
            $error['user_id'] = 'duplicate';
        }
    }

    $form['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if ($form['password'] == ''){
        $error['password'] = 'blank';
    } else if (strlen($form['password']) < 4){
        $error['password'] = 'length';
    }

    if (empty($error)){
        $_SESSION['form'] = $form;

        header('Location: check.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>会員登録</title>

    <link rel="stylesheet" href="../style.css"/>
</head>

<body>
<div>
    <div>
        <h1>会員登録</h1>
    </div>

    <div>
        <p>次のフォームに必要事項をご記入ください。</p>
        <form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>ニックネーム</dt>
                <dd>
                    <input type="text" name="name" size="35" maxlength="255" value="<?php echo h($form['name']); ?>"/>
                    <?php if (isset($error['name']) && $error['name'] === 'blank'): ?>
                        <p class="error">* ニックネームを入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>ID</dt>
                <dd>
                    <input type="text" name="user_id" size="35" maxlength="255" value="<?php echo h($form['user_id']); ?>"/>
                    <?php if (isset($error['user_id']) && $error['user_id'] ==='blank'): ?>
                        <p class="error">* IDを入力してください</p>
                    <?php endif; ?>
                    <?php if (isset($error['user_id']) && $error['user_id'] === 'duplicate'): ?>
                        <p class="error">* 指定されたIDはすでに登録されています</p>
                    <?php endif; ?>
                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20" value="<?php echo h($form['password']); ?>"/>
                    <?php if (isset($error['password']) && $error['password'] === 'blank'): ?>
                        <p class="error">* パスワードを入力してください</p>
                    <?php endif; ?>
                    <?php if (isset($error['password']) && $error['password'] === 'length'): ?>
                        <p class="error">* パスワードは4文字以上で入力してください</p>
                    <?php endif; ?>
                </dd>
            </dl>
            <div><input type="submit" value="入力内容を確認する"/></div>
        </form>
    </div>
</body>

</html>