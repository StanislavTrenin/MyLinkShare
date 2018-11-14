<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>

        <div style = "margin:30px">

            <h1>Create user</h1>
            <form action = "" method = "post">
                <label>Login name  :</label><input type = "text" name = "login" class = "box" required/><br /><br />
                <label>Mail address :</label><input type = "text" name = "mail" class = "box" required/><br/><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" required/><br/><br />
                <label>Confirm  :</label><input type = "password" name = "confirm" class = "box" required/><br/><br />
                <label>First name  :</label><input type = "text" name = "first_name" class = "box" required/><br/><br />
                <label>Second name  :</label><input type = "text" name = "second_name" class = "box" required/><br/><br />

                <input type = "submit" name = "submit" value = " Submit "/>
            </form>
            <?php if (isset($_SESSION['error'])):  ?>
                <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                    <div><?php echo $_SESSION['error']; ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

    </div>

</div>
<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>