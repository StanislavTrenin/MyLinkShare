<div align="center" xmlns="http://www.w3.org/1999/html">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">

            <?php if (isset($_SESSION['user_login'])):  ?>

                <h2><?php echo 'Hello '.$_SESSION['user_login'].'!'; ?></h2>

                <form action = "http://testlinkshare.com/link/create/<?php echo $_SESSION['user_id']?>/" method = "post">
                    <input type = "submit" name = "submit" value = " Create new link "/>
                </form>
            <?php endif; ?>

            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>

                    <?php if ( (!$link['privacy']) || ($_SESSION['user_id'] == $link['author_id']) || $_SESSION['user_acl'] == 2): ?>


                        <h4><a href = "http://testlinkshare.com/link/viewLink/<?php echo $link['link_id']?>"><?php echo $link['title']?></a></h4>
                        <?php echo substr($link['description'], 0, 50)?><br/>
                        <?php echo $link['link']?><br/>

                        <?php if ($_SESSION['user_id'] == $link['author_id'] || $_SESSION['user_acl'] == 2): ?>
                            <form action = "http://testlinkshare.com/link/edit/<?php echo $link['link_id']?>" method = "post">
                                <input type = "submit" name = "submit" value = "Edit"/>
                            </form>

                            <input type="button" name="btn" value="Delete" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-primary" /><br/>
                            <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Confirm Submit
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the following link?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                                            <a href="http://testlinkshare.com/link/delete/<?php echo $link['link_id']?>" id="submit" class="btn btn-primary">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
            <hr size="30" color="blue" ></br>
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