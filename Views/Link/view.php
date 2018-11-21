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
                            <form action = "http://testlinkshare.com/link/delete/<?php echo $link['link_id']?>" method = "post" >
                                <input type = "submit" name = "submit" onclick="confSubmit(this.form);" value = "Delete"/>
                            </form>
                        <?php endif; ?><br/>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['links']); ?>
            <?php endif; ?>

            <?php if (isset($pages)): ?>
                <?php if($pages['page'] != $pages['first']):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['first']?>"><<</a> |
                <?php endif; ?>
                <?php if($pages['page'] >= 3):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['pprev']?>"><?php echo $pages['pprev']?></a> |
                <?php endif; ?>
                <?php if($pages['page'] != $pages['first']):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['prev']?>"><?php echo $pages['prev']?></a> |
                <?php endif; ?>

                <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['page']?>"><?php echo $pages['page']?></a> |

                <?php if($pages['page'] != $pages['last']):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['next']?>"><?php echo $pages['next']?></a> |
                <?php endif; ?>
                <?php if($pages['page'] <= $pages['last'] - 2):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['nnext']?>"><?php echo $pages['nnext']?></a> |
                <?php endif; ?>
                <?php if($pages['page'] != $pages['last']):?>
                    <a href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['last']?>">>></a>
                <?php endif; ?>

            <?php endif;?>

        </div>

    </div>
</div>



<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>