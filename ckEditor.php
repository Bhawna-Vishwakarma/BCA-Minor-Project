<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>CKEditor 5 ClassicEditor build</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container{
            width: 70%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <form method="post">
        <!-- <div class="container"> -->
            <textarea class="editor" name="content"></textarea>
        <!-- </div> -->
        <div class="container">
            <input type="submit" name="blogSubmit" value="post" />
        </div>
    </form>
	<?php 
        if((isset($_POST['blogSubmit']))){
            // $sql = "INSERT INTO blog( blogTitle, blogDesc, blogContent, blogCategories)
            // VALUES('{$_POST['blogTitle']}','{$_POST['blogDesc']}','{$_POST['blogContent']}','{$_POST['blogCategories']}')";
            echo $_POST['content'];
            // if(mysqli_query($conn , $sql))
            // {
            //     header("location:adminDashbord.php");
            //     echo "<p class='container mx-auto bg-blue-200 p-3'>Blog Successfully Added</p>";
            // }else{
            //     header("location:adminDashbord.php");
            //     echo "<p class='container mx-auto bg-blue-200 p-3'>Blog Not Added</p>".mysqli_error($conn);
            // }
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