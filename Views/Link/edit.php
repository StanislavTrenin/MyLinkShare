<div align = "center">
    <?php if (isset($_SESSION['error'])):  ?>
        <div style="width: 600px;" class="alert alert-danger" role="alert">
            <?php echo $_SESSION['error'];?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit link</b></div>

        <div style = "margin:60px">


            <?php if (isset($links)): ?>
                <?php foreach($links as $link):?>
                <form action = "" method = "post">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type = "text" name = "title" class="form-control" value = "<?php echo $link['title']?>" required/>
                    </div>
                    <div class="form-group">
                        <label for="text">Description</label>
                        <p><textarea id="text" rows="10" class="form-control" name="description" required><?php echo $link['description']?></textarea></p>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input id="link" type = "text" name = "link" class="form-control" value = "<?php echo $link['link']?>" required/>
                    </div>
                    <?php if($link['privacy']):?>
                        <div class="form-check">
                            <input id="check" type="checkbox" name="private" class="form-check-input" checked/>
                            <label for="check">Private</label>
                        </div>
                    <?php endif; ?>
                    <?php if(!$link['privacy']):?>
                        <div class="form-check">
                            <input id="check" type="checkbox" name="private" class="form-check-input"/>
                            <label for="check">Private</label>
                        </div>
                    <?php endif; ?>


                    <input type = "submit" name = "edit" class="btn btn-primary" value = " Edit " onclick="editLink(<?php echo $link['link_id']?>)"/>
            </form>

                <?php endforeach; ?>
            <?php endif; ?>

            </div>

    </div>

</div>
<h2><a href = "<?php echo $_SESSION['previous_page']; ?>">Go back</a></h2>