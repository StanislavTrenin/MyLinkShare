<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View links</b></div>

        <div style = "margin:30px">



            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>
                    <h4><?php echo $link['title']?></h4>
                    <?php echo $link['description']?><br/>
                    <?php echo $link['link']?><br/>


                <?php endforeach; ?>
                <?php unset($_SESSION['links']); ?>
            <?php endif; ?>

            <?php if ($_SESSION['user_id'] == $link['author_id']): ?>
                <form action = "http://testlinkshare.com/link/edit/<?php echo $link['link_id']?>" method = "post">
                    <input type = "submit" name = "submit" value = "Edit"/>
                </form>
                <form action = "" method = "post">
                    <input type = "submit" name = "submit" value = "Delete"/>
                </form>
            <?php endif; ?><br/>


        </div>

    </div>

</div>
<h2><a href = "http://testlinkshare.com/link/index/<?php echo $_SESSION['user_id']?>/1">Go back</a></h2>