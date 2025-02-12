<header class="container mx-auto text-gray-600 rounded bg-orange-200">
  <div class="flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <span data-aos="flip-up" class="ml-3 text-xl">Bloging-System</span>
    </a>
    <nav class="md:mr-auto md:ml-4 md:py-1 md:pl-4 md:border-l md:border-gray-400 flex flex-wrap items-center text-base justify-center">
      <a href="index.php" class="mr-5 active:text-gray-900">Home</a>
      <form method="post" action="#">
        <button type="submit" name="allBlog" class="mr-5 active:text-gray-900">Blogs</button>
      </form>
      <div class="flex mr-5">
        <form method="post" action="#">
        <select onchange="this.form.submit()" name="cat" class="bg-orange-200">
          <option>Select Categories</option>
          <?php 
            $sql = "SELECT * FROM categories";
            $query = mysqli_query($conn , $sql);
            $rows = mysqli_num_rows($query);
            if($rows)
            {   
                while($rows = mysqli_fetch_assoc($query))
                { ?>
                      <option value="<?= $rows['catName'] ?>"><?= $rows['catName'] ?></option>
                      <!-- <input type="submit" name="<?php //$rows['catName'] ?>" class="mr-5 active:text-gray-900" value="<?//= $rows['catName'] ?>" /> -->
                  <?php
                }
            }
          ?>
          </select>
          </form>
      </div>
      <form method="get" action="index.php">
        <input type="search" name="keyword" class="p-1 rounded"/>
        <input type="submit" name="Search" value="Search" class='inline-flex items-center bg-blue-300 border-1 border-cyan-400 py-1 px-3 focus:outline-none hover:bg-teal-400 rounded font-bold text-base mt-4 md:mt-0' />
      </form>
    </nav>
    <?php if(!(isset($_SESSION['admin']))){ ?>
        <a href="#" class='inline-flex items-center bg-blue-300 border-1 border-cyan-400 py-1 px-3 focus:outline-none hover:bg-teal-400 rounded font-bold text-base mt-4 md:mt-0'>User Login</a>
        <?php }else{ ?>
        <?php echo "<span class='px-5 font-bold text-blue-900'> Welcome ".$_SESSION['admin'] ."</span>" ?>
        <form method="POST">
            <button type="submit" name="logout" class='inline-flex items-center bg-blue-300 border-1 border-cyan-400 py-1 px-3 focus:outline-none hover:bg-teal-400  rounded font-bold text-base mt-4 md:mt-0'>Logout</button>
        </form>
    <?php } ?>
  </div>
</header>