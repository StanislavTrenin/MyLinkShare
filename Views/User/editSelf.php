<div align = "center">
    <div style = "width:1000px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit profile</b></div>

        <div style = "margin:30px">

            <?php if (isset($users)): ?>
                <?php foreach($users as $user):?>
                <form action = "" method = "post">
                    <div class="form-group">
                        <label for="login">Login name</label>
                        <input id ="login" type = "text" name = "login" class = "form-control" aria-describedby="loginHelp" value = "<?php echo $user['login']?>" required readonly/>
                        <small id="loginHelp" class="form-text text-muted">It will be shown for other users.</small>
                    </div>
                    <div class="form-group">
                        <label for="mail">Mail address</label>
                        <input id="mail" type = "text" name = "mail" class = "form-control" aria-describedby="mailHelp" value = "<?php echo $user['mail']?>" required/>
                        <small id="mailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="pswd">Password</label>
                        <input id="pswd" type = "password" name = "password" class = "form-control" aria-describedby="pswdHelp" placeholder="Password"/>
                        <small id="pswdHelp" class="form-text text-muted">Never share your password with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="cnf">Confirm</label>
                        <input id="cnf" type = "password" name = "confirm" class = "form-control" aria-describedby="cnflHelp" placeholder="Password"/>
                        <small id="cnfHelp" class="form-text text-muted">Please repeat your password once more.</small>
                    </div>
                    <div class="form-group">
                        <label for="fname">First name</label>
                        <input id="fname" type = "text" name = "first_name" class = "form-control" aria-describedby="fnameHelp" value = "<?php echo $user['first_name']?>" required/>
                        <small id="fnameHelp" class="form-text text-muted">Only admins can see this.</small>
                    </div>
                    <div class="form-group">
                        <label for="sname">Second name</label>
                        <input id="sname" type = "text" name = "second_name" class = "form-control" aria-describedby="snameHelp" value = "<?php echo $user['second_name']?>" required/>
                        <small id="snameHelp" class="form-text text-muted">Only admins can see this.</small>
                    </div>

                    <?php if(ACL::check(['class' => 'user', 'method' => 'activate', 'params' => []])):?>
                        <?php if($user['active']):?>
                            <div class="form-check">
                                <input id="check" type="checkbox" name="active" class="form-check-input" checked/>
                                <label for="check">Active</label>
                            </div>
                        <?php endif; ?>
                        <?php if(!$user['active']):?>
                            <div class="form-check">
                                <input id="check" type="checkbox" name="active" class="form-check-input"/>
                                <label for="check">Active</label>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if(ACL::check(['class' => 'user', 'method' => 'changeRole', 'params' => []])):?>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" name='role_id' class="form-control">
                                <option value='1' <?php if($user['role_id'] == 3): echo'selected = select'; endif;?>>User</option>
                                <option value='2' <?php if($user['role_id'] == 2): echo'selected = select'; endif;?>>Editor</option>
                                <option value='3' <?php if($user['role_id'] == 3): echo'selected = select'; endif;?>>Admin</option>
                            </select>
                    </div>
                    <?php endif; ?>

                    <?php endforeach; ?>
            <?php endif; ?>
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
<h2><a href = "<?php echo $_SESSION['previous_page']; ?>">Go back</a></h2>