<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">

            <?php if (isset($_SESSION['user_login'])):  ?>

                <h2><?php echo 'Hello '.$_SESSION['user_login'].'!'; ?></h2>

                <form action = "http://testlinkshare.com/link/create/" method = "post">
                    <input type = "submit" name = "submit" value = " Create new link "/>
                </form>
            <?php endif; ?>

            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>
                    <?php if ( (!$link['privacy']) || ($_SESSION['user_id'] == $link['author_id'])): ?>

                        <h4><a href = "http://testlinkshare.com/link/viewLink/<?php echo $link['link_id']?>"><?php echo $link['title']?></a></h4>
                        <?php echo substr($link['description'], 0, 50)?><br/>
                        <?php echo $link['link']?><br/>

                        <?php if ($_SESSION['user_id'] == $link['author_id']): ?>
                            <form action = "http://testlinkshare.com/link/edit/<?php echo $link['link_id']?>" method = "post">
                                <input type = "submit" name = "submit" value = "Edit"/>
                            </form>
                            <form action = "" method = "post">
                                <input type = "submit" name = "submit" value = "Delete"/>
                            </form>
                        <?php endif; ?><br/>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['links']); ?>
            <?php endif; ?>


        </div>

    </div>

</div>
<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>