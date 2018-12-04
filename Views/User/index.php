<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">

        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Welcome to TestLinkShare</b></div>

        <div style = "margin:30px">
            <div class="jumbotron">
                <h1 class="display-4">Hello <?php if (isset($_SESSION['user_login'])):  ?><?php echo $_SESSION['user_login']; ?><?php endif; ?>!
                </h1>
                <p class="lead">This is a simple website, where you can store and share you links with all World!</p>
            </div>


            <div class="mx-auto" style="width: 200px;">

                <?php if (ACL::check(['class' => 'user', 'method' => 'create', 'params' => []])):  ?>
                <a href="http://testlinkshare.com/user/create/"  id="submit" class="btn btn-primary">Create account</a><br/><br/>
                <?php endif; ?>

                <?php if (ACL::check(['class' => 'user', 'method' => 'login', 'params' => []])):  ?>
                    <a href="http://testlinkshare.com/user/login/"  id="submit" class="btn btn-primary">Login</a><br/><br/>
                <?php endif; ?>

                <a href="http://testlinkshare.com/link/index/<?php echo $_SESSION['user_id']?>/1" id="submit" class="btn btn-primary">View links</a><br/><br/>


                <?php if (ACL::check(['class' => 'link', 'method' => 'viewByUser', 'params' => [$_SESSION['user_id'], 1]])):  ?>
                    <a href="http://testlinkshare.com/link/viewByUser/<?php echo $_SESSION['user_id']?>/1" id="submit" class="btn btn-primary">View you own links</a><br/><br/>
                <?php endif; ?>

                <?php if (ACL::check(['class' => 'user', 'method' => 'editSelf', 'params' => [$_SESSION['user_id'], 0]])):  ?>
                    <a href="http://testlinkshare.com/user/editSelf/<?php echo $_SESSION['user_id']?>/" id="submit" class="btn btn-primary">Edit profile</a><br/><br/>
                <?php endif; ?>

                <?php if (ACL::check(['class' => 'user', 'method' => 'view', 'params' => [$_SESSION['user_id'], 0]])):  ?>
                    <a href="http://testlinkshare.com/user/view/<?php echo $_SESSION['user_id']?>/" id="submit" class="btn btn-primary">View list of users</a><br/><br/>
                <?php endif; ?>

                <?php if (ACL::check(['class' => 'user', 'method' => 'logout', 'params' => [$_SESSION['user_id'], 0]])):  ?>
                    <a href="http://testlinkshare.com/user/logout/<?php echo $_SESSION['user_id']?>/" id="submit" class="btn btn-primary">Logout</a><br/><br/>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div><br/><br/>

