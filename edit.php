<?php 
    session_start();
    if(!(isset($_SESSION["admin"]))){
        header("location: adminLogin.php");
    }
include "config.php"; 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create || Blog</title>
    <style>
        body, html{
            padding: 0;
            margin: 0;
        }
        .container{
            width: 1200px;
            margin: 0 auto;
            background: #f9f9f9;
        }
        h1{
            text-align: center;
            padding: 20px 0;
        }
        fieldset{
            width: 60%;
            margin: 0 auto 15px;
            border: 2px solid #bbf7d0;
        }
        legend{
            margin-left: 20px;
            font-size: 18px;
        }
        input, textarea, select{
            box-sizing: border-box;
            display: block;
            width: 100%;
            outline: none;
            border: none;
            padding: 10px;
            background: none;
        }
        input[type="submit"]{
            width: 60%;
            padding: 15px 10px;
            margin: 0 auto;
            font-size: 18px;
            font-weight: bold;
            background: #bbf7d0;
        }
        .editorContainer{
            width: 62%;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>
<title>Edit || Blog || Categories</title>
</head>
<body>
<?php
//  for categories updation 
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
            
            <div class="container">
                <h1>Update Post</h1>
                <form method="post">      
                    <fieldset>
                        <legend>Enter Title</legend>
                        <input type='text' name='blogTitle' value="<?php echo($data['blogTitle']) ?>"/>
                    </fieldset>
                    <fieldset>
                        <legend>Enter Description</legend>
                        <textarea type='text' name='blogDesc'><?php echo($data['blogDesc']) ?></textarea>
                    </fieldset>
                    <fieldset>
                        <legend>Select Categories</legend>
                        <select name="blogCategories">
                            <option value="<?php echo($data['blogCategories']) ?>"><?php echo($data['blogCategories']) ?></option>
                            <?php 
                                $sql = "SELECT * FROM categories";
                                $query = mysqli_query($conn , $sql);
                                $rows = mysqli_num_rows($query);
                                if($rows)
                                {   
                                    while($rows = mysqli_fetch_assoc($query))
                                    { ?>
                                        <option value="<?= $rows['catName'] ?>"><?= $rows['catName'] ?></option>
                                    <?php
                                    }
                                }
                            ?>
                        </select>
                    </fieldset>
                    <div class="editorContainer">
                        <textarea class="editor" name='blogContent'><?php echo($data['blogContent']) ?></textarea>
                    </div>
                    <input type='submit' name='blogUpdate' value="Update" />            
                </form>
            </div>
        <?php
        }
    }
?>
<?php
    if(isset($_POST['blogUpdate']))
    {
        $blogTitle = mysqli_real_escape_string($conn ,$_POST['blogTitle']);
        $blogDesc = mysqli_real_escape_string($conn ,$_POST['blogDesc']);
        $blogContent = mysqli_real_escape_string($conn ,$_POST['blogContent']);
        $blogCategories = mysqli_real_escape_string($conn ,$_POST['blogCategories']);
        $postDate= date('Y-m-d H:i:s');
        $sql="UPDATE blog SET blogTitle='$blogTitle',
        blogDesc='$blogDesc', blogContent='$blogContent', 
        blogCategories='$blogCategories', postDate='$postDate' WHERE blogId='$blogId'";       
            if(mysqli_query($conn, $sql))
            {
                $_SESSION['blogUpdaed'] = "blog Updated.";
                header("location: adminDashbord.php");
            }else{
                $_SESSION['blogNotUpdaed'] = "blog Not Updated.";
                header("location: adminDashbord.php");
            }
    }
}
?>
<!-- for categories updation -->
<?php
if(isset($_GET['catId']))
{
    $catId = $_GET['catId'];
?>
    <h1 class="container  mx-auto bg-green-100 text-center p-4 font-bold text-lg my-3">Update Categories</h1>
    <form method="post">
        <fieldset>
            <legend>Enter Title</legend>
            <input name='catfield' type='text' value='<?php echo $_GET['catName'];?>' required/>
        </fieldset>
        <input name='catUpdate' type='submit' value="Update" />            
    </form>
<?php
    if(isset($_POST['catUpdate'])){
    $catName = mysqli_real_escape_string($conn, $_POST['catfield']);
    $sql="UPDATE categories SET catName='$catName' WHERE catId='$catId'";       
        if(mysqli_query($conn, $sql))
        {
            $_SESSION['catUpdaed'] = "Categories Updated.";
            header("location: adminDashbord.php");
        }else{
            $_SESSION['catNotUpdaed'] = "Categories Not Updated.";
            header("location: adminDashbord.php");
        }
    }
}
?>
<script src="ck-Editor/build/ckeditor.js"></script>
<script>
    ClassicEditor
		.create( document.querySelector( '.editor' ))
		.catch( error => {
			console.error( error );
		});
</script>
</body>
</html>