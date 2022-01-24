<?php
session_start();
require('../library.php');

if (isset($_SESSION['form'])) {
	$form = $_SESSION['form'];
} else {
	header('Location: index.php');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$db = dbconnect();
	$stmt = $db->prepare('insert into members (name, user_id, password) VALUES (?, ?, ?)');
	if (!$stmt) {
		die($db->error);
	}
	$password = password_hash($form['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $form['name'], $form['user_id'], $password);
	$success = $stmt->execute();
	if (!$success) {
		die($db->error);
	}

	unset($_SESSION['form']);
	header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<title>会員登録</title>
	<link rel="stylesheet" href="../style.css" />
</head>

<body bgcolor="669933">
<div class="logtop">
    <p>
        <div class="title">You柔不断</div>
        <div class="subtitle">～今日は何する？～</div>
        <form action="" method="post">
        <p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
				<dl>
					<dt>ニックネーム</dt>
					<dd><?php echo $form['name']; ?></dd>
					<dt>ID</dt>
					<dd><?php echo h($form['user_id']); ?></dd>
					<dt>パスワード</dt>
					<dd>
						【表示されません】
					</dd>
				</dl>
				<div>
                    <a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a>
                    <button class="newac", id="newac"><ruby>登録<rt>とうろく</rt></ruby></button>
                </div>
			</form>
    </p>
</div>
</body>

</html>