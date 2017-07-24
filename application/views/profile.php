<?php
include('../../application/models/session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Your Home Page</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="profile">
            <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
            <b id="logout"><a href="../../application/controllers/logout.php">Log Out</a></b>
        </div>
    </body>
</html>