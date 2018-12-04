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

                        <?php if ($_SESSION['user_id'] == $link['author_id']): ?>
                            <form action = "http://testlinkshare.com/link/edit/<?php echo $link['link_id']?>" method = "post">
                                <input type = "submit" name = "submit" value = "Edit"/>
                            </form>
                            <form action = "" method = "post">
                                <input type = "submit" name = "submit" value = "Delete"/>
                            </form>
                        <?php endif; ?><br/>




                    <?php endforeach; ?>
                    <?php unset($_SESSION['links']); ?>
                <?php endif; ?>



        </div>

    </div>

</div>
<h2><a href = "<?php echo $_SESSION['previous_page']; ?>">Go back</a></h2>