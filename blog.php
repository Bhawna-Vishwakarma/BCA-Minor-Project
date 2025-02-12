<?php include "config.php";?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloging || System</title>
    <style>
        .postBox{
            width: 70%;
            margin: 10px auto;
            padding: 20px;
            background: #f6f6f6;
            border-radius: 10px;
        }
        .subPostBox{
            margin: 10px 0;
            border-bottom: 2px solid green;
            background: #bbf7d0;
            border-radius: 10px;
        }
        .h3{
            padding: 10px 20px;
            border-radius: 10px;
        }
        .subPostBox2{
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
        }
        .subPostBox2 .span{
            font-style: italic;
            color: gray;
        }
        .blogBox{
            padding: 0 20px;
        }
        .blogBox .p{
            margin: 20px 0;
        }
        .blog{
            padding: 20px 10px;
            word-wrap: break-word;
            word-break: break-all;
        }
    </style>
</head>
<body>
<?php //include "header.php";?>

<!-- ====================================== -->
<?php
if(isset($_GET['blogId']))
{
    $blogId = $_GET['blogId'];
    $sql = "SELECT * FROM blog WHERE blogId='$blogId'";
    $query = mysqli_query($conn , $sql);
    $data = mysqli_num_rows($query);
    if($data)
    {
        while($data = mysqli_fetch_assoc($query))
        {?>
            <div data-aos="flip-up" class="postBox">
                <div class="subPostBox">
                    <h3 class="h3">
                        <?php echo($data['blogTitle']) ?>
                    </h3>
                    <div class="subPostBox2">
                        <span class="span">Posted on: <?php echo date('d-M-Y', strtotime($data['postDate'])); ?></span>
                        <span class="span">Categories: <?php echo($data['blogCategories']) ?></span>
                    </div>
                </div>
                <div class="blogBox">
                    <p class="p">
                        <?php echo($data['blogDesc']) ?>
                    </p>
                    <div class="blog">
                        <?php echo($data['blogContent']) ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}
?>
<!-- ====================================== -->
<?php  //include "foot/footer.php";?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/addAosLib.js"></script>
</body>
</html>