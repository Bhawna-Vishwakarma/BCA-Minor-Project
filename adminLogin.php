<?php  include "config.php";?>
<?php  include "head/head.php";?>
<title>Admin || Login</title>
</head>
<body>
<div data-aos="fade-up" data-aos-anchor-placement="top-center" class="container mx-auto flex justify-center">
    <form method="POST" class="inline-block bg-teal-200 rounded-md mt-8 p-5 w-6/12">
        <h2 class="font-bold text-center mb-4"> Admin login! </h2>
        <input name="adminEmail" class="block rounded-md w-full mb-4 p-3" type="text" placeholder="Enter your email" required/>
        <input name="adminPass" class="block rounded-md w-full mb-4 p-3" type="password" placeholder="Enter your password" required/>
        <input name="loginBtn" class="block rounded-md cursor-pointer w-full mb-4 bg-teal-400 px-5 py-3" type="submit" value="login">    
    <?php 
    if(isset($_POST['loginBtn'])){
        $sql = "SELECT Email,Name,Pass FROM admin";
        $data = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($data);
        $Email = mysqli_real_escape_string($conn, $_POST["adminEmail"]);
        $Pass = mysqli_real_escape_string($conn, $_POST["adminPass"]);
        if(($result['Email'] == $Email) && ($result['Pass'] == $Pass)){
            session_start();
            $_SESSION["admin"] = $result['Name'];
            header("Location: adminDashbord.php");
        }else{
            echo "<p class='font-bold text-center py-3 bg-red-300 mb-4'>Invalid email/Password</p>";
        }
    }
    ?>
    </form>
</div> 
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/addAosLib.js"></script>   
</body>
</html>