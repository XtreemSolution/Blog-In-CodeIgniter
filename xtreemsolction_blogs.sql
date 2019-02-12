-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 12, 2019 at 12:29 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xtreemsolction_blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs`
--

CREATE TABLE `tbl_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `add_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blogs`
--

INSERT INTO `tbl_blogs` (`id`, `title`, `content`, `image_name`, `status`, `add_date`) VALUES
(11, 'Skint Dad', '<p>So when I talk about coming at a niche from a different angle, this example is exactly what I mean. Skint Dad is a site that helps young / new dads save money and be more frugal in their day to day living. There&rsquo;s also a section on their that shows guys how to make a little more cash on top of their monthly day job wage, which is vital in some cases just to keep your head above water. &nbsp;A lot of new dads have the added stress of not having their wives&rsquo; or girlfriends&rsquo; wage coming in each month, due to&nbsp;the temporary career change in being a full time mum of a baby. So having some content around how they can make a few extra &ldquo;Ps&rdquo; in their wallet each month, can ease the burden somewhat.</p>\n\n<p>&nbsp;</p>\n\n<p>&nbsp;</p>\n\n<p>A great site, which is highly useful and inspirational for people wanting to change their 9 to 5 lives for something that will allow them to live a little and spend more time with the family. The site is really simple, and something you could build yourself on WordPress in a matter of day, but the content is where this site excels. Podcasts, tools, tutorials and blog posts that target a specific niche is where this guy makes his money. His podcasts are really popular and when you have content that gets a lot of ears and eyes to it, then so will the advertising income.</p>\n\n<p>It&rsquo;s the same with written content. If you have a popular page that get&rsquo;s tens of thousands of views a month, then potentially you can sell ad space on those pages for hundreds of dollars a month, if not more</p>', 'c19c54925ef40aff922daab3ea0a5cfc.jpg', 'Active', '2019-02-12 16:57:40'),
(12, 'MyWifeQuitHerJob.com', '<p>A great site, which is highly useful and inspirational for people wanting to change their 9 to 5 lives for something that will allow them to live a little and spend more time with the family. The site is really simple, and something you could build yourself on WordPress in a matter of day, but the content is where this site excels. Podcasts, tools, tutorials and blog posts that target a specific niche is where this guy makes his money. His podcasts are really popular and when you have content that gets a lot of ears and eyes to it, then so will the advertising income.</p>\n\n<p>It&rsquo;s the same with written content. If you have a popular page that get&rsquo;s tens of thousands of views a month, then potentially you can sell ad space on those pages for hundreds of dollars a month, if not more.</p>', '261e99882ea9cbacad3c24ac573f28e8.jpg', 'Active', '2019-02-12 16:59:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
