
<?php
if (isset($_POST['str'])) {
    $str = $_POST['str'];
    if (strpos($_POST['str'], "smb://") === 0) {
        // if smb, for mac param
        $str_before = $str;
        // \\fileserverpath\abc\def\
        $str = preg_replace("/smb:/", "", preg_replace("/\//", "\\", $str));
    } else {
        // if for windows param
        $str_before = preg_replace("/\/\//", "\\", preg_replace("/\\\\/", "/", $str));
        // smb:// 
        $str = "smb:" . preg_replace("/\/\//", "/", preg_replace("/\\\\/", "/", $str));
    }
}

?>
<html>
<head>
<title>File Server Path Converter</title>
</head>
<body>
<div stle="border-radius: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; border: 5px dotted #999;">
<h3>How to?</h3>
<ul>
<li>input like below
    <ul>
        <li>\\fileserverpath\dev\local\file_name</li>
        <li>smb://fileserverpath/dev/local/file_name</li>
    </ul>
</li>
<li>enter!</li>
<li>Plz do not try security check</li>
</ul>
</div>
<br><br>
<form name="form" id="form" action="./replace.php" method="POST">
<input type="text" value="<?php if(isset($str_before)) echo $str_before;?>" name="str" size="200" placeholder="input here!">
<br>
<input type="submit" value="replace">
</form>
<?php
if (isset($str)) {
    echo "<br> Result<br>";
    echo "<input type=text value='" . $str . "' size='200' id=result onmousemove='this.select(0,this.value.length)'><br>";
}
?>
</body>
</html>
