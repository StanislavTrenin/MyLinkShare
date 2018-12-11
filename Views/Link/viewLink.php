<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">






                <?php if (isset($links)): ?>

                    <?php foreach($links as $link):?>

                        <?php if($link['privacy'] == 1):?>
                            <?php if(!ACL::check(['class' => 'link', 'method' => 'viewPrivate', 'params' => [$link['link_id']]])): ?>

                                <?php header('location: http://testlinkshare.com/link/viewPrivate/'.$link['link_id']); ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <h4><?php echo $link['title']?></h4>
                        <?php echo $link['description']?><br/>
                        <?php echo $link['link']?><br/>

            <div class="row">
                <div class="btn-group mr-2" role="group" aria-label="First group">
                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'edit', 'params' => [$link['link_id']]])): ?>
                            <a href=http://testlinkshare.com/link/edit/<?php echo $link['link_id']?> id="submit" class="btn btn-primary">Edit link</a>

                        <?php endif; ?>
                </div>
                <div class="btn-group mr-2" role="group" aria-label="Second group">
                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'delete', 'params' => [$link['link_id']]])): ?>

                            <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $link['link_id'] ?>" data-target="#editModal<?php echo $link['link_id'] ?>"><strong>Delete</strong> </button>
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
                </div>
            </div>




                    <?php endforeach; ?>
                    <?php unset($_SESSION['links']); ?>
                <?php endif; ?>



        </div>

    </div>

</div>
<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>