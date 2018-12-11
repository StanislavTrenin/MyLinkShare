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
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Log in</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <div class="form-group">
                    <label for='login' >Login name</label>
                    <input id ='login' type = "text" name = "login" class = "form-control" placeholder="Enter login" required/>
                </div>
                <div class="form-group">
                    <label for='password'>Password</label>
                    <input id = 'password' type = "password" name = "password" class = "form-control"  placeholder="Password" aria-describedby="passwordHelp" required/>
                    <small id="passwordHelp" class="form-text text-muted">Never share your email with anyone else.</small>
                </div>
                <input type = "submit" name = "submit" class="btn btn-primary" value = " Submit "/>
            </form>
        </div>

    </div>

</div>

<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>
