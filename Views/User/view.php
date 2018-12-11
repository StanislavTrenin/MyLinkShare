<div align = "center">





    <?php if (isset($users)): ?>


        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>

                    <th>#</th>
                    <th>Login</th>
                    <th>Mail</th>
                    <th>First name</th>
                    <th>Second name</th>
                    <th>Activate</th>
                    <th>Role ID</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <?php foreach($users as $user):?>
                <tr>
                    <td><?php echo $user['user_id']?></td>
                    <td><?php echo $user['login']?></td>
                    <td><?php echo $user['mail']?></td>
                    <td><?php echo $user['first_name']?></td>
                    <td><?php echo $user['second_name']?></td>
                    <td><?php echo $user['active']?></td>
                    <td><?php echo $user['role_id']?></td>
                    <td>
                        <a href="http://testlinkshare.com/user/editSelf/<?php echo $user['user_id']?>"  id="submit" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $user['user_id'] ?>" data-target="#editModal<?php echo $user['user_id'] ?>"><strong>Delete</strong> </button>
                            <div id="editModal<?php echo $user['user_id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title">Are You really want to delete <?php echo $user['first_name'] ?> ?</h4><br>
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

<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>