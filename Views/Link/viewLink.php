<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .collapsible {
            background-color: #0080ff;
            color: white;
            cursor: pointer;
            padding: 12px;
            width: 30%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active, .collapsible:hover {
            background-color: #0080ff;
        }

        .collapsible:after {
            content: '\002B';
            color: white;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }

        .active:after {
            content: "\2212";
        }

        .content {
            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
<div align = "center">
    <div style = "width:1000px; border: solid 1px #333333; " align = "left">
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


                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'edit', 'params' => [$link['link_id']]])): ?>
            <button class="collapsible">Edit link</button>
            <div class="content">
                <p>
                    <form id='edit' action = "" method = "post">

                        <input id="link_id" type = "hidden" name = "link_id" class="form-control" value = "<?php echo $link['link_id']?>" required/>

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

            <input type = "submit" name = "edit" class="btn btn-primary" value = " Edit "/>
            </form>
            </p>
        </div>
                        <?php endif; ?>
                        <?php if ($_SESSION['user_id'] == $link['author_id'] || ACL::check(['class' => 'link', 'method' => 'delete', 'params' => [$link['link_id']]])): ?>

                            <br/><button class="btn btn-danger" data-toggle="modal" data-id="<?php echo $link['link_id'] ?>" data-target="#editModal<?php echo $link['link_id'] ?>"><strong>Delete</strong> </button>
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





                    <?php endforeach; ?>
                    <?php unset($_SESSION['links']); ?>
                <?php endif; ?>



        </div>

    </div>

</div>
<h2><a href = "<?php echo Config::getInstance()->getData()['main_page'];?>">Go to main page</a></h2>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.maxHeight){
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    }
</script>
</body>
