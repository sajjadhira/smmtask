<html>
<head>
    <title>Redirecting...</title>
</head>
<body>
    
<?php

if(isset($_POST['t']) && isset($_POST['h'])){
    $t = $_POST['t'];
    $r = $_POST['h'];
    
    $url = urldecode($r);
    
    ?>
    Redirecting...
    <form method="post" action="<?php echo $url; ?>" id="go">
        <input type="hidden" name="t" value="<?php echo $t; ?>">
    </form>
    <script>
    (function() {
    
    document.getElementById("go").submit();
    
    })();
    </script>
    <?php
}else{
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    ?>
    <script>
    window.location.href = '<?php echo $actual_link; ?>';
    </script>
    <?php
}
?>

</body>
</html>