<?php include "config.php";?>
<?php include "head/head.php";?>
<title>Bloging || System</title>
</head>
<body>
<?php include "header.php";?>
<!-- pagination -->
<?php 
if(!isset($_GET['page'])){
    $page = 1;
}else{
    $page= $_GET['page'];
}
// 2) limit of post per page.
$limit = 2;
// 5) find offset and set limit in select query.
$offset = ($page - 1)*$limit;
?>
<!-- pagination -->
<!-- ====================================== -->

<div class="container flex mx-auto">
    <div class="w-[20%] min-h-screen bg-orange-100">
        <h2 data-aos="flip-down" class="text-lg text-2xl bg-teal-50 text-gray-600 text-center font-bold leading-[4rem]">Recent | Titles</h2>  
        <?php
            $sql = "SELECT * FROM blog ORDER BY postDate DESC";
            $query = mysqli_query($conn , $sql);
            $rows = mysqli_num_rows($query);
            if($rows)
            {   
                while($rows = mysqli_fetch_assoc($query))
                { ?>
                    <!-- Recent Post -->
                    <ul class="w-[85%] mx-auto bg-teal-50 p-3 my-3">
                        <li data-aos="flip-right" class="text-lg break-words font-bold leading-4 "><?= $rows['blogTitle']; ?></li>
                    </ul>
                    
                <?php
                }
            }
        ?>
    </div>
    <div class="w-[80%]">
    <?php 
        if(isset($_POST['cat'])){   
            $sql = "SELECT * FROM blog WHERE blogCategories='{$_POST['cat']}'";
            $query = mysqli_query($conn , $sql);
            $rows = mysqli_num_rows($query);
            $count = 1;
            if($rows)
            {   
                while($rows = mysqli_fetch_assoc($query))
                { ?>
                    <!-- Post box -->
                    <div data-aos="<?php if($count%2 == 0){echo'fade-left';}else{ echo 'fade-right';} $count++; ?>" class="w-[70%] mx-auto p-5 bg-blue-50 rounded-md my-3">
                        <h3 class="text-xl bg-blue-100 p-2 rounded-md font-bold leading-8 pb-3"><?php echo $rows['blogTitle']; ?></h3>
                        <span class="block bg-blue-100 p-2 rounded-md italic text-gray-500">Posted on: <?php echo date('d-M-Y', strtotime($rows['postDate'])); ?></span>
                        <p class="text-gray-500 py-9 border-t-2 border-blue-800"><?php echo $rows['blogDesc']; ?></p>
                        <a href="blog.php?blogId=<?php echo $rows['blogId']; ?>" class="bg-blue-200 p-2 border-2 border-blue-300 rounded-md font-bold hover:bg-blue-300">Read More</a>
                        <span class="mx-2 bg-blue-100 p-2 rounded-md italic text-gray-500">Categories: <?php echo $rows['blogCategories']; ?></span>
                    </div>
                <?php
                }
            }
        }else if(isset($_GET['Search'])){  
            $keyword = $_GET['keyword'];
            $sql = "SELECT * FROM blog WHERE blogTitle LIKE '%$keyword%' OR blogContent LIKE '%$keyword%' OR blogCategories LIKE '%$keyword%' OR blogDesc LIKE '%$keyword%'";
            $query = mysqli_query($conn , $sql);
            $rows = mysqli_num_rows($query);
            $count = 1;
            if($rows)   
            {   
                while($rows = mysqli_fetch_assoc($query))
                { ?>
                    <!-- Post box -->
                    <div data-aos="<?php if($count%2 == 0){echo'fade-left';}else{ echo 'fade-right';} $count++; ?>" class="w-[70%] mx-auto p-5 bg-blue-50 rounded-md my-3">
                        <h3 class="text-xl bg-blue-100 p-2 rounded-md font-bold leading-8 pb-3"><?php echo $rows['blogTitle']; ?></h3>
                        <span class="block bg-blue-100 p-2 rounded-md italic text-gray-500">Posted on: <?php echo date('d-M-Y', strtotime($rows['postDate'])); ?></span>
                        <p class="text-gray-500 py-9 border-t-2 border-blue-800"><?php echo $rows['blogDesc']; ?></p>
                        <a href="blog.php?blogId=<?php echo $rows['blogId']; ?>" class="bg-blue-200 p-2 border-2 border-blue-300 rounded-md font-bold hover:bg-blue-300">Read More</a>
                        <span class="mx-2 bg-blue-100 p-2 rounded-md italic text-gray-500">Categories: <?php echo $rows['blogCategories']; ?></span>
                    </div>
                <?php
                }
            }
        }else{
            $sql = "SELECT * FROM blog ORDER BY postDate DESC LIMIT $offset,$limit";
            $query = mysqli_query($conn , $sql);
            $rows = mysqli_num_rows($query);
            $count = 1;
            if($rows)
            {   
                while($rows = mysqli_fetch_assoc($query))
                { ?>
                    <!-- Post box -->
                    <div data-aos="<?php if($count%2 == 0){echo'fade-left';}else{echo 'fade-right';} $count++; ?>" class="w-[70%] mx-auto p-5 bg-blue-50 rounded-md my-3">
                        <h3 class="text-xl bg-blue-100 p-2 rounded-md font-bold leading-8 pb-3"><?php echo $rows['blogTitle']; ?></h3>
                        <span class="block bg-blue-100 p-2 rounded-md italic text-gray-500">Posted on: <?php echo date('d-M-Y', strtotime($rows['postDate'])); ?></span>
                        <p class="text-gray-500 py-9 border-t-2 border-blue-800"><?php echo $rows['blogDesc']; ?></p>
                        <a href="blog.php?blogId=<?php echo $rows['blogId']; ?>" class="bg-blue-200 p-2 border-2 border-blue-300 rounded-md font-bold hover:bg-blue-300">Read More</a>
                        <span class="mx-2 bg-blue-100 p-2 rounded-md italic text-gray-500">Categories: <?php echo $rows['blogCategories']; ?></span>
                    </div>
                <?php
                }
            } 
        }
        
    ?>
<!-- pagination begin -->
<?php 
    $pagination = "SELECT * FROM blog";
    $run = mysqli_query($conn , $pagination);
    // 1) find total post in db.
    $tota_post = mysqli_num_rows($run);
    // 3) count no. of page in pagination according to limit.
    $pages = ceil($tota_post / $limit); 
    // 4) Display pagination number using for loop.
    // 6) Set active class
    ?>       
    <nav aria-label="Page navigation example ">
        <ul class="flex -space-x-px py-5 justify-center">
        <?php for ($i=1; $i <= $pages; $i++) {?>
            <li>
                <a href="index.php?page=<?=$i?>" class="visited:<?=($i == $page) ? $active="bg-blue-700 text-white": "";?> px-3 py-2 leading-tight bg-white border border-gray-300 hover:bg-blue-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i?></a>
            </li>
        <?php } ?>
        </ul>
    </nav>
    <!-- pagination end -->
    </div>
</div>
<!-- ====================================== -->
<?php  include "foot/footer.php";?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/addAosLib.js"></script>
<script>
    // setTimeout(() => {
    //     window.alert("लग चुकी है तलब मंजिल की \nखुद को आग में झोंक देंगे \nठोकरे कहती है मारा जाएगा हौसले कहते हैं \nदेख लेंगे..!!");
    // }, 10000);
    setTimeout(() => {
        window.alert("चलो अपनी तकदीर को एक नया मोड देते हैं \nजी तोड़ मेहनत से मंजिल की कठिनाई को तोड़ देते हैं..!!");
    }, 30000);
</script>
</body>
</html>
