<?php
/*htmlspecialcharsを短縮 */
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}

/*DBの接続 */
function dbconnect() {
    $db = new mysqli('localhost:8889', 'root', 'root', 'pbl2');
	if (!$db) {
		die($db->error);
	}
    return $db;
}
?>