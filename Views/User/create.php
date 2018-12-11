


<div align = "center">
    <?php if (isset($_SESSION['error'])):  ?>
        <div style="width: 600px;" class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error'];?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])):  ?>
        <div style="width: 600px;" class="alert alert-success" role="alert">
            <?php echo $_SESSION['success'];?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;">
            <?php if(ACL::get_role_id() == 3): ?>
                <b>Create user</b>
            <?php endif; ?>
            <?php if(ACL::get_role_id() == 4): ?>
                <b>Registration</b>
            <?php endif; ?>
        </div>



        <div style = "margin:30px">

            <form action = "" method = "post">
                <div class="form-group">
                    <label for="login">Login name</label>
                    <input id ="login" type = "text" name = "login" class = "form-control" aria-describedby="loginHelp" placeholder="Enter login" required/>
                    <small id="loginHelp" class="form-text text-muted">It will be shown for other users.</small>
                </div>
                <div class="form-group">
                    <label for="mail">Mail address</label>
                    <input id="mail" type = "text" name = "mail" class = "form-control" aria-describedby="mailHelp" placeholder="Enter mail address" required/>
                    <small id="mailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="pswd">Password</label>
                    <input id="pswd" type = "password" name = "password" class = "form-control" aria-describedby="pswdHelp" placeholder="Password" required/>
                    <small id="pswdHelp" class="form-text text-muted">Never share your password with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="cnf">Confirm</label>
                    <input id="cnf" type = "password" name = "confirm" class = "form-control" aria-describedby="cnflHelp" placeholder="Password" required/>
                    <small id="cnfHelp" class="form-text text-muted">Please repeat your password once more.</small>
                </div>
                <div class="form-group">
                    <label for="fname">First name</label>
                    <input id="fname" type = "text" name = "first_name" class = "form-control" aria-describedby="fnameHelp" placeholder="Enter your first name" required/>
                    <small id="fnameHelp" class="form-text text-muted">Only admins can see this.</small>
                </div>
                <div class="form-group">
                    <label for="sname">Second name</label>
                    <input id="sname" type = "text" name = "second_name" class = "form-control" aria-describedby="snameHelp" placeholder="Enter your second name" required/>
                    <small id="snameHelp" class="form-text text-muted">Only admins can see this.</small>
                </div>

                <input type = "submit" name = "submit" class="btn btn-primary" value = " Submit "/>
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

<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>
