<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8">

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


<main role="main" class="container">

    <div class="starter-template">

        <?php
        echo $content_for_layout;
        ?>

    </div>

</main>

</body>
</html>