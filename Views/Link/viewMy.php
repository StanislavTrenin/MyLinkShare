<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View my links</b></div>

        <div style = "margin:30px">
            <?php if (isset($_SESSION['user_login'])):  ?>

                <h2><div><?php echo 'Hello '.$_SESSION['user_login'].'!'; ?></div></h2>

                <form action = "http://testlinkshare.com/link/create/" method = "post">
                    <input type = "submit" name = "submit" value = " Create new link "/>
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['links'])): ?>
                <?php foreach($_SESSION['links'] as $link):?>
                    <b><?php echo $link['title']?></b><br/>
                    <?php echo $link['description']?><br/>
                    <?php echo $link['link']?><br/>
                    <h3><a href = "http://testlinkshare.com/link/edit/">Edit</a></h3>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>

</div>
<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>