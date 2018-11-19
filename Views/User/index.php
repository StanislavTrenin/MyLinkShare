<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Welcome to TestLinkShare</b></div>

        <div style = "margin:30px">
            <?php if (isset($_SESSION['user_login'])):  ?>

                <h2><div><?php echo 'Hello '.$_SESSION['user_login'].'!'; ?></div></h2>
            <?php endif; ?>

            <div class="row col-md-12 centered">
                <form action = "http://testlinkshare.com/user/create/" method = "post">
                    <input type = "submit" name = "create" value = " Create new user "/>
                </form>

                <?php if (!isset($_SESSION['user_login'])):  ?>
                    <form action = "http://testlinkshare.com/user/login/" method = "post">
                        <input type = "submit" name = "login" value = "Log in"/>
                    </form>
                <?php endif; ?>

                <form action = "http://testlinkshare.com/link/view/" method = "post">
                    <input type = "submit" name = "view" value = "View links"/>
                </form>

                <?php if (isset($_SESSION['user_login'])):  ?>
                    <form action = "http://testlinkshare.com/link/viewOwn/" method = "post">
                        <input type = "submit" name = "viewOwn" value = "View own links"/>
                    </form>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_login'])):  ?>
                    <form action = "http://testlinkshare.com/user/editSelf/<?php echo $_SESSION['user_id']?>" method = "post">
                        <input type = "submit" name = "edit" value = "Edit profile"/>
                    </form>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_login'])):  ?>
                    <form action = "http://testlinkshare.com/user/logout/" method = "post">
                        <input type = "submit" name = "logout" value = "Log out "/>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>

