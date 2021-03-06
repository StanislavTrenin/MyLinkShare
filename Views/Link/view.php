<!DOCTYPE html>
<html>
<body>
<div id="results"></div>

<div id = total align="center" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <div style = "width:1000px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">


            <div class="jumbotron">
                <h1 class="display-4">Hello <?php if (isset($_SESSION['user_login'])):  ?><?php echo $_SESSION['user_login']; ?><?php endif; ?>!
                </h1>
                <p class="lead">This is a simple website, where you can store and share you links with all World!</p>
                <?php if (ACL::check(['class' => 'link', 'method' => 'create', 'params' => [$_SESSION['user_id'], 0]])):  ?>
                    <p class="lead">
                        <a href="http://testlinkshare.com/link/create/<?php echo $_SESSION['user_id']?>/" id="submit" class="btn btn-primary">Create new link</a>
                    </p>
                <?php endif; ?>
            </div>

            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>

                    <?php if ( (!$link['privacy']) || ($_SESSION['user_id'] == $link['author_id']) || ACL::check(['class' => 'link', 'method' => 'viewPrivate', 'params' => [$link['link_id']]])): ?>

                        <div class="card" style="width: 48rem;">


                            <div class="card-header">
                                <h4><a href = "http://testlinkshare.com/link/viewLink/<?php echo $link['link_id']?>" id="title<?php echo $link['link_id']?>"><?php echo $link['title']?></a></h4>
                            </div>

                            <div class="card-body">
                                <p class="card-text" id="description<?php echo $link['link_id']?>"><?php echo substr($link['description'], 0, 50)?></p><br/>
                                <p id="link<?php echo $link['link_id']?>"><?php echo $link['link']?></p><br/>

                                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'edit', 'params' => [$link['link_id']]])): ?>
                                <button class="btn btn-primary" value="click">Edit</button>
                                                <div class="hidden" id="hidden<?php echo $link['link_id']?>" style="display: none;">
                                                    <br/>
                                                    <form action = "" method = "post" id = "form<?php echo $link['link_id']?>">
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input id="title<?php echo $link['link_id']?>" type = "text" name = "title" class="form-control" value = "<?php echo $link['title']?>" required/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="text">Description</label>
                                                            <p><textarea id="text<?php echo $link['link_id']?>" rows="10" class="form-control" name="description" required><?php echo $link['description']?></textarea></p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">Link</label>
                                                            <input id="link<?php echo $link['link_id']?>" type = "text" name = "link" class="form-control" value = "<?php echo $link['link']?>" required/>
                                                        </div>
                                                        <?php if($link['privacy']):?>
                                                            <div class="form-check">
                                                                <input id="check<?php echo $link['link_id']?>" type="checkbox" name="private" class="form-check-input<?php echo $link['link_id']?>" checked/>
                                                                <label for="check">Private</label>
                                                            </div>
                                                        <?php endif; ?>
                                                        <?php if(!$link['privacy']):?>
                                                            <div class="form-check">
                                                                <input id="check<?php echo $link['link_id']?>" type="checkbox" name="private" class="form-check-input<?php echo $link['link_id']?>"/>
                                                                <label for="check">Private</label>
                                                            </div>
                                                        <?php endif; ?>
                                                    <input type = "button" name = "edit_confirm" class="btn btn-primary" value = " Submit " id = "submit<?php echo $link['link_id']?>"/>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <br/><br/>
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
                        </div><br/>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php unset($_SESSION['links']); ?>
            <?php endif; ?>

            <?php if (isset($pages)): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php if($pages['page'] != $pages['first']):?>
                            <li class="page-item">
                                <a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['first']?>">
                                    <div style="font-size: 15px;">
                                        <i class="fas fa-angle-double-left fa-lg">

                                        </i>
                                    </div>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($pages['page'] >= 3):?>
                            <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['pprev']?>"><?php echo $pages['pprev']?></a></li>
                        <?php endif; ?>
                        <?php if($pages['page'] != $pages['first']):?>
                            <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['prev']?>"><?php echo $pages['prev']?></a></li>
                        <?php endif; ?>

                        <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['page']?>"><?php echo $pages['page']?></a></li>

                        <?php if($pages['page'] != $pages['last']):?>
                            <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['next']?>"><?php echo $pages['next']?></a></li>
                        <?php endif; ?>
                        <?php if($pages['page'] <= $pages['last'] - 2):?>
                            <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['nnext']?>"><?php echo $pages['nnext']?></a></li>
                        <?php endif; ?>
                        <?php if($pages['page'] != $pages['last']):?>
                            <li class="page-item"><a class="page-link" href = "http://testlinkshare.com/link/<?php echo $method; ?><?php if($method == 'viewByUser'): echo '/'.$_SESSION['user_id']; endif;?>/?page=<?php echo $pages['last']?>"><div style="font-size: 15px;"><i class="fas fa-angle-double-right fa-lg"></i></div></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

            <?php endif;?>

        </div>


    </div>
</div><br/><br/>

</body>
</html>