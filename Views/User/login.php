<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Log in</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <label>Login name  :</label><input type = "text" name = "login" class = "box" required/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" required/><br/><br />

                <input type = "submit" name = "submit" class="btn btn-primary" value = " Submit "/>
            </form>
            <?php if (isset($_SESSION['error']) && isset($_POST['submit'])):  ?>
                <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                    <div><?php echo $_SESSION['error']; ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

    </div>

</div>

<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>
