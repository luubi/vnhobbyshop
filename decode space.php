<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$s =".smoke-base{position:fixed;top:0;left:0;bottom:0;right:0;visibility:hidden;opacity:0}.smoke-base.smoke-visible{opacity:1;visibility:visible}.smokebg{position:fixed;top:0;left:0;bottom:0;right:0}.smoke-base .dialog{position:absolute}.dialog-prompt{margin-top:15px;text-align:center}.dialog-buttons{margin:20px 0 5px}.smoke{font-family:Menlo,'Andale Mono',monospace;text-align:center;font-size:22px;line-height:150%}.dialog-buttons button{display:inline-block;vertical-align:baseline;cursor:pointer;font-family:Menlo,'Andale Mono',monospace;font-style:normal;text-decoration:none;border:0;outline:0;margin:0 5px;-webkit-background-clip:padding-box;font-size:13px;line-height:13px;font-weight:400;padding:9px 12px}.dialog-prompt input{margin:0;outline:0;font-family:Menlo,'Andale Mono',monospace;border:1px solid #aaa;width:75%;display:inline-block;background-color:transparent;font-size:16px;padding:8px}.smoke-base{background:rgba(0,0,0,.3);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#90000000, endColorstr=#900000000)}.smoke-base .dialog{top:25%;width:40%;left:50%;margin-left:-20%}.smoke-base .dialog-inner{padding:15px;color:#202020}.smoke{background-color:rgba(255,255,255,.95);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffffff, endColorstr=#ffffff);box-shadow:0 2px 8px #666}.dialog-buttons button{background-color:rgba(0,0,0,.85);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#222222, endColorstr=#222222);border-radius:0;color:#fff}button.cancel{background-color:rgba(0,0,0,.4);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#444444, endColorstr=#444444)}.queue{display:none}";
$temp = str_replace("{","{ "."<br/> &nbsp;",$s);
$temp = str_replace(";","; "."<br/> &nbsp;&nbsp;&nbsp;&nbsp;",$temp);
$temp = str_replace("}","} "."<br/>",$temp);
echo "<p>".$temp."</p>";
?>
</body>
</html>