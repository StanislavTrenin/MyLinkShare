<div align = "center">
    <div style = "width:600px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Confirm registration</b></div>

        <div style = "margin:60px">
        <?php if($rez == 1): ?>
            <?php echo'Yo successfully verify your mail and ready to use TestLinkShare!!!'; ?>
        <?php endif; ?>
        <?php if($rez == 0): ?>
            <?php echo'Some fail in verifying!!! Please contact admins or try again later.'; ?>
        <?php endif; ?>
        </div>
    </div>
</div>
<h2><a href = "http://testlinkshare.com/user/index/">Go to main page</a></h2>


