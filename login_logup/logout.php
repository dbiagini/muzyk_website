<?php

setcookie('username', '', time()-60*60*24*365, '/', 'musicmarket.xtreemhost.com');
setcookie('password', '', time()-60*60*24*365, '/', 'musicmarket.xtreemhost.com');

header('Location: ../index.php');

?>