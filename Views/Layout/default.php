<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
    $('#submit').click(function(){
    /* when the submit button in the modal is clicked, submit the form */
    alert('submitting');
    $('#formfield').submit();
    });

    function ShowModal(id)
    {
        //var modal = document.getElementById(id);
        modal.style.display = "block";
    }

    </script>




    <title>TestLinkShare</title>

    <style>


        body {
            padding-top: 1rem;
        }
        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }





    </style>
</head>
<body>
<nav class="navbar fixed-top navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>


    <?php if (ACL::check(['class' => 'user', 'method' => 'create', 'params' => []])):  ?>
        <a href="http://testlinkshare.com/user/create/"  id="submit" class="nav-item nav-link">Create account</a><br/><br/>
    <?php endif; ?>

    <?php if (ACL::check(['class' => 'user', 'method' => 'login', 'params' => []])):  ?>
        <a href="http://testlinkshare.com/user/login/"  id="submit" class="nav-item nav-link">Login</a><br/><br/>
    <?php endif; ?>

    <a href="http://testlinkshare.com/link/index/<?php echo $_SESSION['user_id']?>/1" id="submit" class="nav-item nav-link">View links</a><br/><br/>


    <?php if (ACL::check(['class' => 'link', 'method' => 'viewByUser', 'params' => [$_SESSION['user_id'], 1]])):  ?>
        <a href="http://testlinkshare.com/link/viewByUser/<?php echo $_SESSION['user_id']?>/1" id="submit" class="nav-item nav-link">View you own links</a><br/><br/>
    <?php endif; ?>

    <?php if (ACL::check(['class' => 'user', 'method' => 'editSelf', 'params' => [$_SESSION['user_id'], 0]])):  ?>
        <a href="http://testlinkshare.com/user/editSelf/<?php echo $_SESSION['user_id']?>/" id="submit" class="nav-item nav-link">Edit profile</a><br/><br/>
    <?php endif; ?>

    <?php if (ACL::check(['class' => 'user', 'method' => 'view', 'params' => [$_SESSION['user_id'], 0]])):  ?>
        <a href="http://testlinkshare.com/user/view/<?php echo $_SESSION['user_id']?>/" id="submit" class="nav-item nav-link">View list of users</a><br/><br/>
    <?php endif; ?>

    <?php if (ACL::check(['class' => 'user', 'method' => 'logout', 'params' => [$_SESSION['user_id'], 0]])):  ?>
        <a href="http://testlinkshare.com/user/logout/<?php echo $_SESSION['user_id']?>/" id="submit" class="nav-item nav-link">Logout</a><br/><br/>
    <?php endif; ?>


</nav>

<main role="main" class="container">

    <div class="starter-template">



    </div>

</main>





</body>
</html>