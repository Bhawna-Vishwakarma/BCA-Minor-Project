<?php 
    session_start();
    if(!(isset($_SESSION["admin"]))){
        header("location: adminLogin.php");
    }
?>
<?php 
    include "config.php"; 
    include "head/head.php"; 
?>
<title>Admin || Dashbord</title>
</head>
<body>
<?php
    include "header.php";
    if(isset($_POST['logout'])){
        session_destroy();
        header("location: adminLogin.php");
    }
?>
<div class="container py-5 mx-auto flex">
    <div class="w-[20%] min-h-[75vh] bg-cyan-50 text-center p-5 font-bold">
        <form method="post" class="border-b-2 border-blue-300">
            <button class="p-3 w-full hover:bg-blue-200" name="addBlog">Add Blog</button>
        </form>
        <form method="post" class="border-b-2 border-blue-300">
            <button class="p-3 w-full hover:bg-blue-200" name="addCategories">Add Categories</button>
        </form>
        <form method="post" class="border-b-2 border-blue-300">
            <button class="p-3 w-full hover:bg-blue-200" name="showBlogs">Show Blogs</button>
        </form>
        <form method="post" class="border-b-2 border-blue-300">
            <button class="p-3 w-full hover:bg-blue-200" name="showCategories">Show Categories</button>
        </form>
    </div>
    <div class="w-[80%] py-5">
        <?php  
            if(isset($_POST['addBlog'])){
                header("location: createBlog.php");
            }
            if(isset($_POST['addCategories'])){
            ?>  <form action="#" method="post">
                    <input name='catfield' type='text' class='block mx-auto border-2 outline-0 border-green-200 rounded-md w-[50%] mb-4 p-3' placeholder='Enter categories' required/>
                    <input name='catSubmit' type='submit' value="submit" class='block mx-auto rounded-md cursor-pointer w-[50%] mb-4 bg-green-300 px-5 py-3'/>            
                </form>
            <?php
            } 
            if(isset($_POST['showBlogs'])){
            ?>  <table class='border-[1px] bg-red-50 my-3 border-red-300 w-[80%] mx-auto'>
                    <thead>
                        <tr class='bg-blue-100 text-lg'>
                            <th class='p-2 border-2 border-blue-200'>Sno.</th>
                            <th class='p-2 border-2 border-blue-200'>Title</th>
                            <th class='p-2 border-2 border-blue-200'>Categories</th>
                            <th class='p-2 border-2 border-blue-200'>Date</th>
                            <th class='p-2 border-2 border-blue-200'>Update</th>
                            <th class='p-2 border-2 border-blue-200'>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM blog";
                            $query = mysqli_query($conn , $sql);
                            $rows = mysqli_num_rows($query);
                            $count = 0;
                            if($rows)
                            {   
                                while($rows = mysqli_fetch_assoc($query))
                                { ?>
                                    <tr class='text-center'>
                                        <td class='p-2 border-2 border-red-200'><?= ++$count ?></td>
                                        <td class='p-2 border-2 border-red-200'><?= $rows['blogTitle'] ?></td>
                                        <td class='p-2 border-2 border-red-200'><?= $rows['blogCategories'] ?></td>
                                        <td class='p-2 border-2 border-red-200'><?= date('d-M-Y', strtotime($rows['postDate'])) ?></td>
                                        <td class='p-2 border-2 border-red-200'>
                                            <a href="edit.php?blogId=<?= $rows['blogId']?>" class='bg-blue-200 p-2 border-2 border-blue-400'>Edit</a>
                                        </td>
                                        <td class='p-2 border-2 border-red-200'>
                                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this Blog ?')">
                                                <input class="w-[0px]" type="hidden" name="blogId" value="<?= $rows['blogId'] ?>">
                                                <input type="submit" name="blogDelete" class='bg-red-200 p-2 border-2 border-red-400' value="Delete"/>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            }
            if(isset($_POST['showCategories'])){
            ?>
                <table class='border-[1px] bg-red-50 my-3 border-red-300 w-[80%] mx-auto'>
                    <thead>
                        <tr class='bg-blue-100 text-lg'>
                            <th class='p-2 border-2 border-blue-200'>Sno.</th>
                            <th class='p-2 border-2 border-blue-200'>Categories</th>
                            <th class='p-2 border-2 border-blue-200'>Update</th>
                            <th class='p-2 border-2 border-blue-200'>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM categories";
                            $query = mysqli_query($conn , $sql);
                            $rows = mysqli_num_rows($query);
                            $count = 0;
                            if($rows)
                            {   
                                while($rows = mysqli_fetch_assoc($query))
                                { ?>
                                    <tr class='text-center'>
                                        <td class='p-2 border-2 border-red-200'><?= ++$count ?></td>
                                        <td class='p-2 border-2 border-red-200'><?= $rows['catName'] ?></td>
                                        <td class='p-2 border-2 border-red-200'>
                                            <a href="edit.php?catId=<?= $rows['catId']?>&catName=<?= $rows['catName']?>" class='bg-blue-200 p-2 border-2 border-blue-400'>Edit</a>
                                        </td>
                                        <td class='p-2 border-2 border-red-200'>
                                            <form action="#" method="post" onsubmit="return confirm('Are you sure you want to delete this categories ?')">
                                                <input class="w-[0px]" type="hidden" name="catId" value="<?= $rows['catId'] ?>">
                                                <input type="submit" name="catDelete" class='bg-red-200 p-2 border-2 border-red-400' value="Delete"/>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            <?php
            }
        ?>
    </div>
</div>
<?php 
//for adding categories
if((isset($_POST['catSubmit'])))
{
    $sql = "INSERT INTO categories(catName) VALUES ('".mysqli_real_escape_string($conn, $_POST['catfield'])."')";
    if(mysqli_query($conn, $sql))
    {
        echo "<p class='container mx-auto bg-blue-100 p-3'>Categories added.</p>";
    }else{
        echo "<p class='container mx-auto bg-blue-100 p-3'>Categories Not added.</p>".mysqli_error($conn);
    }
}
// for Deleting Blog
if(isset($_POST['blogDelete']))
{
    $id= $_POST['blogId'];
    $sql = "DELETE FROM blog WHERE blogId='$id'";
    if(mysqli_query($conn, $sql))
    {
        echo "<p class='container mx-auto bg-blue-100 p-3'>Blog Deleted.</p>";
    }else{
        echo "<p class='container mx-auto bg-blue-100 p-3'>Blog Not Deleted.</p>".mysqli_error($conn);
    }
}
// for Deleting Categories
if(isset($_POST['catDelete']))
{
    $id= $_POST['catId'];
    $sql = "DELETE FROM categories WHERE catId='$id'";
    if(mysqli_query($conn, $sql))
    {
        echo "<p class='container mx-auto bg-blue-100 p-3'>Categories Deleted.</p>";
    }else{
        echo "<p class='container mx-auto bg-blue-100 p-3'>Categories Not Deleted.</p>".mysqli_error($conn);
    }
}
// message for Updating Categories
if(isset($_SESSION['catUpdated'])){
    echo "<p class='container mx-auto bg-blue-100 p-3'>Categories Updated.</p>";
}
if(isset($_SESSION['catNotUpdated'])){
    echo "<p class='container mx-auto bg-blue-100 p-3'>Categories Not Updated.</p>";
}
// message for Updating blog
if(isset($_SESSION['blogUpdated'])){
    echo "<p class='container mx-auto bg-blue-100 p-3'>blog Updated.</p>";
}
if(isset($_SESSION['blogNotUpdated'])){
    echo "<p class='container mx-auto bg-blue-100 p-3'>blog Not Updated.</p>";
}
?>
<?php include "foot/footer.php";?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/addAosLib.js"></script>
</body>
</html>
