<?php 
    session_start();
    if(!(isset($_SESSION["admin"]))){
        header("location: adminLogin.php");
    }
?>
<?php include "config.php"; ?>
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
<div class="container">
    <h1>Create Post</h1>
    <form method="post">      
        <fieldset>
            <legend>Enter Title</legend>
            <input type='text' name='blogTitle' required/>
        </fieldset>
        <fieldset>
            <legend>Enter Description</legend>
            <textarea type='text' name='blogDesc' required></textarea>
        </fieldset>
        <fieldset>
            <legend>Select Categories</legend>
            <select name="blogCategories">
                <option value="">Choose Blog Categories</option>
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
            <textarea class="editor" name='blogContent'></textarea>
        </div>
        
        <input type='submit' name='blogSubmit' value="Post" />            
    </form>
</div>
<?php 
if((isset($_POST['blogSubmit']))){
    $blogTitle = mysqli_real_escape_string($conn ,$_POST['blogTitle']);
    $blogDesc = mysqli_real_escape_string($conn ,$_POST['blogDesc']);
    $blogContent = mysqli_real_escape_string($conn ,$_POST['blogContent']);
    $blogCategories = mysqli_real_escape_string($conn ,$_POST['blogCategories']);

    $sql = "INSERT INTO blog( blogTitle, blogDesc, blogContent, blogCategories)
     VALUES('{$blogTitle}','{$blogDesc}','{$blogContent}','{$blogCategories}')";
    
    if(mysqli_query($conn , $sql))
    {
        header("location: adminDashbord.php");
        echo "<p class='container mx-auto bg-blue-200 p-3'>Blog Successfully Added</p>";
    }else{
        header("location: adminDashbord.php");
        echo "<p class='container mx-auto bg-blue-200 p-3'>Blog Not Added</p>".mysqli_error($conn);
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