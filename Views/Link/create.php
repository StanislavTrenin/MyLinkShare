<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create new link</b></div>

        <div style = "margin:60px">

            <form action = "" method = "post">
                <label>Title  :</label><input type = "text" name = "title" class = "box" required/><br /><br />
                <label>Description :</label><p><textarea rows="10" cols="50" name="description" required></textarea></p><br /><br />
                <label>Link :</label><input type = "text" name = "link" class = "box" required/><br/><br />
                <label>Private :</label><input type="checkbox" name="private"  /><br/><br />

                <input type = "submit" name = "create" class="btn btn-primary" value = " Create "/>
            </form>
            <?php if (isset($_SESSION['error'])):  ?>
                <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                    <div><?php echo $_SESSION['error']; ?></div>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>

    </div>

</div>
<h2><a href = "<?php echo $_SESSION['previous_page']; ?>">Go back</a></h2>