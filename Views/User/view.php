<div align = "center">



    <?php if (isset($users)): ?>
        <table border=1 frame=void rules=all>
            <tr>

                <th>ID</th>
                <th>Login</th>
                <th>Mail</th>
                <th>First name</th>
                <th>Second name</th>
            </tr>
            <?php foreach($users as $user):?>
                <tr>
                    <td><?php echo $user['user_id']?></td>
                    <td><?php echo $user['login']?></td>
                    <td><?php echo $user['mail']?></td>
                    <td><?php echo $user['first_name']?></td>
                    <td><?php echo $user['second_name']?></td>
                    <td>
                        <form action = "http://testlinkshare.com/user/editSelf/<?php echo $user['user_id']?>" method = "post">
                            <input type = "submit" name = "edit" value = "Edit profile"/>
                        </form>
                    </td>
                    <td>
                        <?php echo $user['user_id']?>
                        <input type="button" name="btn" value="Delete" id="submitBtn" data-toggle="modal" data-target="#confirm-submit" class="btn btn-primary" /><br/>

                        <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        Confirm Submit
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the following user?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <a href="http://testlinkshare.com/user/delete/<?php echo $user['user_id']?>/<?php echo $_SESSION['user_id']?>" id="submit" class="btn btn-primary">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>


</div>
<h2><a href = "http://testlinkshare.com/user/index/">Go back</a></h2>