-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 12:12 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloging`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `Email`, `Pass`) VALUES
(1, 'Bhawna', 'bvishwakarma1008@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogId` int(11) NOT NULL,
  `blogTitle` text NOT NULL,
  `blogDesc` text NOT NULL,
  `blogContent` longtext NOT NULL,
  `blogCategories` text NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogId`, `blogTitle`, `blogDesc`, `blogContent`, `blogCategories`, `postDate`) VALUES
(10, 'Submit html form on dropdown menu value selection or change using Javascript', 'If you have a html or (HTML5, JSP, PHP, ASP) pages with a form element containing select option and you want to submit the form once a option is selected from the list of the dropdown then you can make use of javascript . We do this using javascript onchange eventand submitting the form using this.form.submit()', '<p><strong>File: example.html</strong></p><pre><code class=\"language-html\">\r\n&lt;html&gt;\r\n&lt;head&gt;\r\n&lt;title&gt;Submit form on Dropdown list select&lt;/title&gt;\r\n&lt;/head&gt;\r\n\r\n&lt;body&gt;\r\n&lt;form method=\"get\"&gt;\r\n\r\nName : &lt;input type=\"text\" id=\"name\" name=\"name\" /&gt;\r\n&lt;br /&gt;&lt;br /&gt;\r\n\r\nOption : \r\n\r\n&lt;select onchange=\"this.form.submit()\" id=\"option\" name=\"option\"&gt;\r\n	&lt;option&gt;Select Option&lt;/option&gt;\r\n	&lt;option&gt;Add&lt;/option&gt;\r\n	&lt;option&gt;Delete&lt;/option&gt;\r\n	&lt;option&gt;Update&lt;/option&gt;\r\n&lt;/select&gt;\r\n&lt;/form&gt;\r\n&lt;/body&gt;\r\n&lt;/html&gt;</code></pre>', 'Html', '2022-12-29 12:39:19'),
(12, 'mysqli_real_escape_string() function', 'The mysqli_real_escape_string() function is an inbuilt function in PHP which is used to escape all special characters for use in an SQL query. It is used before inserting a string in a database, as it removes any special characters that may interfere with the query operations. \r\nWhen simple strings are used, there are chances that special characters like backslashes and apostrophes are included in them (especially when they are getting data directly from a form where such data is entered). These are considered to be part of the query string and interfere with its normal functioning. ', '<pre><code class=\"language-php\">&lt;?php \r\nif((isset($_POST[\'blogSubmit\']))){\r\n    $blogTitle = mysqli_real_escape_string($conn ,$_POST[\'blogTitle\']);\r\n    $blogDesc = mysqli_real_escape_string($conn ,$_POST[\'blogDesc\']);\r\n    $blogContent = mysqli_real_escape_string($conn ,$_POST[\'blogContent\']);\r\n    $blogCategories = mysqli_real_escape_string($conn ,$_POST[\'blogCategories\']);\r\n\r\n    $sql = \"INSERT INTO blog( blogTitle, blogDesc, blogContent, blogCategories)\r\n     VALUES(\'{$blogTitle}\',\'{$blogDesc}\',\'{$blogContent}\',\'{$blogCategories}\')\";\r\n    \r\n    if(mysqli_query($conn , $sql))\r\n    {\r\n        header(\"location: adminDashbord.php\");\r\n        echo \"&lt;p class=\'container mx-auto bg-blue-200 p-3\'&gt;Blog Successfully Added&lt;/p&gt;\";\r\n    }else{\r\n        header(\"location: adminDashbord.php\");\r\n        echo \"&lt;p class=\'container mx-auto bg-blue-200 p-3\'&gt;Blog Not Added&lt;/p&gt;\".mysqli_error($conn);\r\n    }\r\n}\r\n?&gt;</code></pre>', 'php', '2022-12-29 12:44:08'),
(13, 'Write query to search in database ?', 'There is a simple way to search any word in database using php mysql.', '<h3><strong>Query is that:&nbsp;</strong></h3><pre><code class=\"language-php\">$sql = \"SELECT * FROM blog WHERE blogTitle LIKE \'%$keyword%\' OR blogContent LIKE \'%$keyword%\'\r\nOR blogCategories LIKE \'%$keyword%\' OR blogDesc LIKE \'%$keyword%\'\";\r\n</code></pre>', 'php', '2022-12-28 13:59:29'),
(14, 'How to add pagination in tailwind CSS using PHP MySQL.', 'There are 5 steps needed to create pagination-\r\n\r\n1) find total post in db.\r\n2) limit of post per page.\r\n3) count no. of page in pagination according to limit.\r\n4) Display pagination number using for loop.\r\n5) find offset and set limit in select query.\r\n6) Set active class\r\n\r\nit\'s done.', '<pre><code class=\"language-php\">//code for Top of the page\r\n&lt;?php \r\nif(!isset($_GET[\'page\'])){\r\n    $page = 1;\r\n}else{\r\n    $page= $_GET[\'page\'];\r\n}\r\n// 2) limit of post per page.\r\n$limit = 2;\r\n// 5) find offset and set limit in select query.\r\n$offset = ($page - 1)*$limit;\r\n?&gt;\r\n\r\n//where show query exist\r\n$sql = \"SELECT * FROM blog ORDER BY postDate DESC LIMIT $offset,$limit\";\r\n            $query = mysqli_query($conn , $sql);\r\n            $rows = mysqli_num_rows($query);\r\n            $count = 1;\r\n            if($rows)\r\n            {   \r\n                while($rows = mysqli_fetch_assoc($query))\r\n                { ?&gt;\r\n                    &lt;!-- Post box --&gt;\r\n                    &lt;div data-aos=\"&lt;?php if($count%2 == 0){echo\'fade-left\';}else{echo \'fade-right\';} $count++; ?&gt;\" class=\"w-[70%] mx-auto p-5 bg-pink-50 rounded-md my-3\"&gt;\r\n                        &lt;h3 class=\"text-xl bg-pink-100 p-2 rounded-md font-bold leading-8 pb-3\"&gt;&lt;?php echo $rows[\'blogTitle\']; ?&gt;&lt;/h3&gt;\r\n                        &lt;span class=\"block bg-pink-100 p-2 rounded-md italic text-gray-500\"&gt;Posted on: &lt;?php echo date(\'d-M-Y\', strtotime($rows[\'postDate\'])); ?&gt;&lt;/span&gt;\r\n                        &lt;p class=\"text-gray-500 py-9 border-t-2 border-pink-800\"&gt;&lt;?php echo $rows[\'blogDesc\']; ?&gt;&lt;/p&gt;\r\n                        &lt;a href=\"blog.php?blogId=&lt;?php echo $rows[\'blogId\']; ?&gt;\" class=\"bg-pink-200 p-2 border-2 border-pink-300 rounded-md font-bold hover:bg-pink-300\"&gt;Read More&lt;/a&gt;\r\n                        &lt;span class=\"mx-2 bg-pink-100 p-2 rounded-md italic text-gray-500\"&gt;Categories: &lt;?php echo $rows[\'blogCategories\']; ?&gt;&lt;/span&gt;\r\n                    &lt;/div&gt;\r\n                &lt;?php\r\n                }\r\n            }\r\n                       \r\n    \r\n //code for where you want to add paginaion\r\n &lt;?php \r\n    $pagination = \"SELECT * FROM blog\";\r\n    $run = mysqli_query($conn , $pagination);\r\n    // 1) find total post in db.\r\n    $tota_post = mysqli_num_rows($run);\r\n    // 3) count no. of page in pagination according to limit.\r\n    $pages = ceil($tota_post / $limit); \r\n    // 4) Display pagination number using for loop.\r\n    // 6) Set active class\r\n    ?&gt;       \r\n    &lt;nav aria-label=\"Page navigation example \"&gt;\r\n        &lt;ul class=\"flex -space-x-px py-5 justify-center\"&gt;\r\n        &lt;?php for ($i=1; $i &lt;= $pages; $i++) {?&gt;\r\n            &lt;li&gt;\r\n                &lt;a href=\"index.php?page=&lt;?=$i?&gt;\" class=\"visited:&lt;?=($i == $page) ? $active=\"bg-blue-700 text-white\": \"\";?&gt; px-3 py-2 leading-tight bg-white border border-gray-300 hover:bg-blue-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white\"&gt;&lt;?= $i?&gt;&lt;/a&gt;\r\n            &lt;/li&gt;\r\n        &lt;?php } ?&gt;\r\n        &lt;/ul&gt;\r\n    &lt;/nav&gt;\r\n?&gt;       \r\n    </code></pre>', 'php', '2022-12-31 10:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catId` int(30) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catId`, `catName`) VALUES
(1, 'Html'),
(13, 'Tailwind'),
(18, 'php'),
(19, 'CPP');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
