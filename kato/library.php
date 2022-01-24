<?php
/*htmlspecialcharsを短縮 */
function h($value) {
    return htmlspecialchars($value, ENT_QUOTES);
}

/*DBの接続 */
function dbconnect() {
    $db = new mysqli('localhost', 'root', 'ERYHH64gO4Mj7c5p', 'g128kato');
	if (!$db) {
		die($db->error);
	}
    return $db;
}
?>
