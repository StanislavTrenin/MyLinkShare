<div align="center" xmlns="http://www.w3.org/1999/html">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">

            <?php if (ACL::check(['class' => 'link', 'method' => 'create', 'params' => [$_SESSION['user_id'], 0]])):  ?>

                <div class="jumbotron">
                    <h1 class="display-4">Hello <?php if (isset($_SESSION['user_login'])):  ?><?php echo $_SESSION['user_login']; ?><?php endif; ?>!
                    </h1>
                    <p class="lead">This is a simple website, where you can store and share you links with all World!</p>
                    <p class="lead">
                        <a href=http://testlinkshare.com/link/create/<?php echo $_SESSION['user_id']?>/" id="submit" class="btn btn-primary">Create new link</a>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>

                    <?php if ( (!$link['privacy']) || ($_SESSION['user_id'] == $link['author_id']) || ACL::check(['class' => 'link', 'method' => 'viewPrivate', 'params' => [$link['link_id']]])): ?>


                        <h4><a href = "http://testlinkshare.com/link/viewLink/<?php echo $link['link_id']?>"><?php echo $link['title']?></a></h4>
                        <?php echo substr($link['description'], 0, 50)?><br/>
                        <?php echo $link['link']?><br/>

                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'edit', 'params' => [$link['link_id']]])): ?>
                            <form action = "http://testlinkshare.com/link/edit/<?php echo $link['link_id']?>" method = "post">
                                <input type = "submit" name = "submit" class="btn btn-primary" value = "Edit"/>
                            </form>
                        <?php endif; ?>

                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'delete', 'params' => [$link['link_id']]])): ?>

                            <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $link['link_id'] ?>" data-target="#editModal<?php echo $link['link_id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <strong>Delete</strong> </button>
                            <div id="editModal<?php echo $link['link_id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title">Are You really want to delete this link?</h4><br>
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
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if($pages['page'] != $pages['first']):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['first']?>"><<</a></li>
                    <?php endif; ?>
                    <?php if($pages['page'] >= 3):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['pprev']?>"><?php echo $pages['pprev']?></a></li>
                    <?php endif; ?>
                    <?php if($pages['page'] != $pages['first']):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['prev']?>"><?php echo $pages['prev']?></a></li>
                    <?php endif; ?>

                    <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['page']?>"><?php echo $pages['page']?></a></li>

                    <?php if($pages['page'] != $pages['last']):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['next']?>"><?php echo $pages['next']?></a></li>
                    <?php endif; ?>
                    <?php if($pages['page'] <= $pages['last'] - 2):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['nnext']?>"><?php echo $pages['nnext']?></a></li>
                    <?php endif; ?>
                    <?php if($pages['page'] != $pages['last']):?>
                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?>/<?php echo $_SESSION['user_id']?>/<?php echo $pages['last']?>">>></a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <?php endif;?>

        </div>

    </div>
</div>



<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>