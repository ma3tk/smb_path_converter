<?php
if (isset($_GET['q'])) {
    $str = $_GET['q'];
    if (mb_strpos($str, 'smb://') === 0) {
        // For Unix
        $str = preg_replace('/smb:/', '', preg_replace('/\//', '\\', $str));
    } else {
        // For Windows
        $str = 'smb:' . preg_replace('/\/\//', '/', preg_replace('/\\\\/', '/', $str));
    }
}

$result = array(
    'time' => date("Y-m-d H:i:s"),
    'path' => empty($str) ? '' : htmlspecialchars($str, ENT_QUOTES),
);
header("Content-Type: text/javascript; charset=utf-8");
echo json_encode($result);
