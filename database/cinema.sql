-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 21, 2017 at 06:33 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_bookings`
--

CREATE TABLE `advance_bookings` (
  `advance_b_id` int(11) NOT NULL,
  `advance_b_customer_name` varchar(32) NOT NULL,
  `advance_b_phone` varchar(32) NOT NULL,
  `advance_b_user_email` varchar(32) NOT NULL,
  `advance_b_showtime_id` varchar(32) NOT NULL,
  `advance_b_ticket_id` varchar(32) NOT NULL,
  `advance_b_ticket_type` varchar(32) NOT NULL,
  `advance_b_showtime_key` varchar(32) NOT NULL,
  `advance_b_seats_number` text NOT NULL,
  `advance_b_seat_qty` varchar(32) NOT NULL,
  `advance_b_price` varchar(32) NOT NULL,
  `advance_b_date` varchar(32) NOT NULL,
  `advance_b_iscomp` varchar(32) NOT NULL,
  `advance_b_movie` varchar(32) NOT NULL,
  `advance_b_distributer` varchar(32) NOT NULL,
  `advance_b_status` varchar(32) NOT NULL,
  `advance_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_showtime_id` varchar(64) NOT NULL,
  `booking_user` varchar(32) NOT NULL,
  `booking_ticket_id` varchar(32) NOT NULL,
  `booking_ticket_type` varchar(32) NOT NULL,
  `booking_iscomplimentary` varchar(32) NOT NULL,
  `booking_seats_number` text NOT NULL,
  `booking_seats` varchar(32) NOT NULL,
  `booking_seat_qty` varchar(32) NOT NULL,
  `booking_price` varchar(64) NOT NULL,
  `booking_date` varchar(32) NOT NULL,
  `booking_movie` varchar(32) NOT NULL,
  `booking_screen` varchar(32) NOT NULL,
  `booking_showtime` varchar(32) NOT NULL,
  `booking_showdate` date NOT NULL,
  `booking_distributer` varchar(32) NOT NULL,
  `booking_showtime_key` varchar(32) NOT NULL,
  `booking_cancel` varchar(32) NOT NULL,
  `booking_cancel_time` date NOT NULL,
  `booking_cancel_user` varchar(32) NOT NULL,
  `booking_cancel_remarks` text NOT NULL,
  `booking_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check_showtime`
--

CREATE TABLE `check_showtime` (
  `check_showtime_id` int(11) NOT NULL,
  `check_showtime_select_id` varchar(32) NOT NULL,
  `check_showtime_select_value` varchar(32) NOT NULL,
  `check_showtime_select_movie` varchar(32) NOT NULL,
  `check_showtime_select_screen` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concession_bookings`
--

CREATE TABLE `concession_bookings` (
  `con_booking_id` int(11) NOT NULL,
  `con_booking_order_id` varchar(32) NOT NULL,
  `con_booking_type` varchar(32) NOT NULL,
  `con_booking_type_id` varchar(32) NOT NULL,
  `con_booking_price` varchar(64) NOT NULL,
  `con_booking_qty` varchar(32) NOT NULL,
  `con_booking_amount` varchar(64) NOT NULL,
  `con_booking_cancel` varchar(32) NOT NULL,
  `con_booking_cancel_date` date NOT NULL,
  `con_booking_user` varchar(32) NOT NULL,
  `con_booking_time` varchar(64) NOT NULL,
  `con_booking_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `concession_order`
--

CREATE TABLE `concession_order` (
  `concession_order_id` int(11) NOT NULL,
  `concession_order_detail` varchar(32) NOT NULL,
  `concession_order_user` varchar(32) NOT NULL,
  `concession_order_amount` varchar(32) NOT NULL,
  `concession_order_cancel_by` varchar(32) NOT NULL,
  `concession_order_cancel_date` date NOT NULL,
  `concession_order_cancel_remarks` text NOT NULL,
  `concession_order_cancel` varchar(32) NOT NULL,
  `concession_order_date` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributers`
--

CREATE TABLE `distributers` (
  `dist_id` int(11) NOT NULL,
  `dist_name` varchar(32) NOT NULL,
  `dist_description` text,
  `dist_established_year` varchar(32) DEFAULT NULL,
  `distributer_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `expense_amount` varchar(32) NOT NULL,
  `expense_name` varchar(32) NOT NULL,
  `expense_detail` varchar(32) NOT NULL,
  `expense_user` varchar(32) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foodstalls`
--

CREATE TABLE `foodstalls` (
  `foodstall_id` int(11) NOT NULL,
  `foodstall_name` varchar(32) NOT NULL,
  `foodstall_size` varchar(32) NOT NULL,
  `foodstall_contract_type` varchar(32) NOT NULL,
  `foodstall_contract_amount` varchar(32) NOT NULL,
  `foodstall_date` varchar(32) NOT NULL,
  `foodstall_desc` text NOT NULL,
  `foodstall_status` varchar(32) NOT NULL,
  `foodstall_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_categories`
--

CREATE TABLE `food_categories` (
  `food_category_id` int(11) NOT NULL,
  `food_category_name` varchar(32) NOT NULL,
  `food_category_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_categories`
--

INSERT INTO `food_categories` (`food_category_id`, `food_category_name`, `food_category_ts`) VALUES
(1, 'drink', '2015-08-29 12:47:22'),
(2, 'combos', '2015-08-31 06:12:15'),
(3, 'food', '2015-08-31 06:12:15'),
(6, 'deals', '2015-08-31 06:12:51'),
(8, 'beaverages', '2015-08-31 06:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_small_decs` varchar(32) NOT NULL,
  `item_measuring_unit` varchar(32) NOT NULL,
  `item_category` varchar(64) NOT NULL,
  `item_default_price` varchar(32) NOT NULL,
  `item_cost_price` varchar(32) NOT NULL,
  `item_img` text,
  `item_display_order` int(32) NOT NULL,
  `item_bg` varchar(32) NOT NULL,
  `item_status` varchar(32) NOT NULL,
  `item_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locked_seats`
--

CREATE TABLE `locked_seats` (
  `locked_seat_id` int(11) NOT NULL,
  `locked_seat_showtime_id` varchar(32) NOT NULL,
  `locked_seat_name` text NOT NULL,
  `locked_seat_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_title` varchar(32) NOT NULL,
  `movie_distributer_id` int(32) NOT NULL,
  `movie_rating` varchar(32) DEFAULT NULL,
  `movie_release_date` varchar(32) DEFAULT NULL,
  `movie_genre` varchar(32) DEFAULT NULL,
  `movie_duration` varchar(32) NOT NULL,
  `movie_national_code` varchar(64) DEFAULT NULL,
  `movie_format` varchar(32) DEFAULT NULL,
  `movie_contract_type` varchar(32) DEFAULT NULL,
  `movie_rental_charges` varchar(32) NOT NULL,
  `movie_dist_seats` varchar(32) NOT NULL,
  `movie_contract_start_date` varchar(64) DEFAULT NULL,
  `movie_actors` varchar(128) DEFAULT NULL,
  `movie_actors_role` varchar(128) DEFAULT NULL,
  `movie_poster` text,
  `movie_synopsis` text NOT NULL,
  `movie_trailor` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `movie_status` varchar(32) NOT NULL,
  `movie_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_persons`
--

CREATE TABLE `movie_persons` (
  `movie_person_id` int(11) NOT NULL,
  `movie_person_name` varchar(32) NOT NULL,
  `movie_persons_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(64) NOT NULL,
  `package_desc` varchar(32) NOT NULL,
  `package_measuring_unit` varchar(32) NOT NULL,
  `package_category` varchar(32) NOT NULL,
  `package_price` varchar(32) NOT NULL,
  `package_cost_price` varchar(32) NOT NULL,
  `package_item_name` text,
  `package_item_price` text,
  `package_item_qty` text,
  `package_img` text,
  `package_order_no` int(32) NOT NULL,
  `package_bg` varchar(32) NOT NULL,
  `package_status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `payroll_id` int(11) NOT NULL,
  `payroll_amount` varchar(32) NOT NULL,
  `payroll_emp_id` varchar(32) NOT NULL,
  `payroll_for_date` varchar(32) NOT NULL,
  `payroll_status` varchar(32) NOT NULL,
  `payroll_date` date NOT NULL,
  `payroll_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `printed_tickets`
--

CREATE TABLE `printed_tickets` (
  `printed_ticket_id` int(11) NOT NULL,
  `printed_ticket_booking_id` varchar(32) NOT NULL,
  `printed_ticket_unique_id` varchar(32) NOT NULL,
  `printed_ticket_showtime_id` varchar(32) NOT NULL,
  `printed_ticket_showtime` varchar(32) NOT NULL,
  `printed_ticket_movie_id` varchar(32) NOT NULL,
  `printed_ticket_screen_id` varchar(32) NOT NULL,
  `printed_ticket_seat_id` varchar(32) NOT NULL,
  `printed_ticket_price` varchar(32) NOT NULL,
  `printed_ticket_terminal_user_id` varchar(32) NOT NULL,
  `printed_ticket_terminal_user_name` varchar(32) NOT NULL,
  `printed_ticket_cancel` varchar(32) NOT NULL,
  `printed_ticket_batch_id` varchar(32) NOT NULL,
  `printed_ticket_terminal_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `screen_id` int(11) NOT NULL,
  `screen_name` varchar(32) NOT NULL,
  `screen_total_seats` varchar(32) NOT NULL,
  `screen_house_seats` varchar(32) DEFAULT NULL,
  `screen_wheel_chair_seats` varchar(32) DEFAULT NULL,
  `screen_seat_layout_diagram` text,
  `screen_rows` text NOT NULL,
  `screen_row_column` text NOT NULL,
  `screen_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`screen_id`, `screen_name`, `screen_total_seats`, `screen_house_seats`, `screen_wheel_chair_seats`, `screen_seat_layout_diagram`, `screen_rows`, `screen_row_column`, `screen_ts`) VALUES
(1, 'Cinema 1', '137', '0', '', NULL, '["N","M","L","K","J","H","G","F","E","D","C","B","A"]', '["11","10","11","10","11","10","11","10","11","10","11","10","11"]', '2015-12-03 08:56:01'),
(2, 'Cinema 2', '68', '0', '', NULL, '["J","H","G","F","E","D","C","B","A"]', '["8","7","8","7","8","7","8","7","8"]', '2015-12-03 08:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(64) NOT NULL,
  `setting_name` varchar(64) NOT NULL,
  `setting_value` text NOT NULL,
  `settings_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_value`, `settings_ts`) VALUES
(1, 'global_timings', '["0","0","0"]', '2015-09-23 09:20:58'),
(2, 'logo', '41974cineplex-logo.png', '2015-11-30 10:09:17'),
(3, 'popups', 'no', '2016-02-17 06:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `showtime_id` int(11) NOT NULL,
  `showtime_movie_id` int(32) NOT NULL,
  `showtime_screen_id` int(32) NOT NULL,
  `showtime_datetime` varchar(32) NOT NULL,
  `showtime_status` varchar(32) NOT NULL,
  `showtime_trailer_duration` varchar(32) DEFAULT NULL,
  `showtime_cleanup` varchar(32) DEFAULT NULL,
  `showtime_interval` varchar(32) NOT NULL,
  `showtime_ticket_type` varchar(32) DEFAULT NULL,
  `showtime_voucher_type` varchar(32) DEFAULT NULL,
  `showtime_complimentry_seats` varchar(32) NOT NULL,
  `showtime_key` varchar(32) NOT NULL,
  `showtime_color` varchar(32) DEFAULT NULL,
  `showtime_date` date NOT NULL,
  `showtime_day` varchar(32) NOT NULL,
  `show_sales` varchar(32) NOT NULL,
  `showtime_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_img`) VALUES
(1, '3880918.jpg'),
(2, '10065live-spinosaurus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_title` varchar(32) NOT NULL,
  `ticket_desc` varchar(64) DEFAULT NULL,
  `ticket_class` varchar(32) NOT NULL,
  `ticket_adult_price` varchar(64) NOT NULL,
  `ticket_child_price` varchar(32) NOT NULL,
  `ticket_ischild` varchar(32) DEFAULT NULL,
  `ticket_type` varchar(32) NOT NULL,
  `ticket_status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_title`, `ticket_desc`, `ticket_class`, `ticket_adult_price`, `ticket_child_price`, `ticket_ischild`, `ticket_type`, `ticket_status`) VALUES
(1, 'Standard', '', 'silver', '400', '400', 'no', 'standard', 'active'),
(2, '2D & E TKT', '', 'silver', '500', '500', 'no', 'standard', 'active'),
(3, '600', '', 'gold', '600', '600', 'yes', 'standard', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(32) NOT NULL,
  `user_lname` varchar(32) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `user_name` varchar(32) NOT NULL,
  `user_pass` varchar(256) NOT NULL,
  `user_mobile` varchar(32) NOT NULL,
  `user_city` varchar(32) NOT NULL,
  `user_salary` varchar(32) NOT NULL,
  `user_img` text NOT NULL,
  `user_capabilities` text NOT NULL,
  `user_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_name`, `user_pass`, `user_mobile`, `user_city`, `user_salary`, `user_img`, `user_capabilities`, `user_datetime`) VALUES
(5, 'admin', 'admin', 'info@webnet.com.pk', 'admin', '21232f297a57a5a743894a0e4a801fc3', '03008239166', 'Karachi', '2000', '29770admin_img.png', '["add_user","add_film","add_distributer","add_screen","add_sowtime","add_timing","add_ticket","add_voucher","add_concession","add_foodstall","book_ticket","cancel_ticket","cancel_old_ticket","cancel_lock_seats","book_adv_ticket","book_concession","cancel_concession","view_terminal","add_settings","view_reports","seat_booking_by_day","current_booking_by_day","adv_booking_by_day","ticket_sale_by_movie","num_ticket_sale_by_movie","adv_ticket_sale_by_movie","num_adv_ticket_sale_by_movie","cash_by_all_user","cash_by_user","cancel_tickets_report","item_sale_r","single_item_sale_r","item_sale_u","package_sale","single_package_sale","package_sale_u","con_can_r","con_sale_u"]', '2015-11-30 11:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `voucher_id` int(11) NOT NULL,
  `voucher_title` varchar(32) NOT NULL,
  `voucher_desc` varchar(64) NOT NULL,
  `voucher_price` varchar(32) NOT NULL,
  `voucher_startdate` varchar(32) NOT NULL,
  `voucher_enddate` varchar(32) NOT NULL,
  `voucher_is_package` varchar(32) NOT NULL,
  `voucher_package_item_name` text NOT NULL,
  `voucher_package_item_price` text NOT NULL,
  `voucher_package_item_qty` text NOT NULL,
  `voucher_ticket_type` varchar(32) NOT NULL,
  `voucher_package_ticket_name` text NOT NULL,
  `voucher_package_ticket_price` text NOT NULL,
  `voucher_package_ticket_qty` text NOT NULL,
  `voucher_status` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_bookings`
--

CREATE TABLE `voucher_bookings` (
  `voucher_id` int(11) NOT NULL,
  `voucher_unique_id` varchar(64) NOT NULL,
  `voucher_type_id` varchar(32) NOT NULL,
  `voucher_seat_num` varchar(32) NOT NULL,
  `voucher_show_id` varchar(32) NOT NULL,
  `voucher_movie_id` varchar(32) NOT NULL,
  `voucher_dist_id` varchar(32) NOT NULL,
  `voucher_screenid` varchar(32) NOT NULL,
  `voucher_datetime` varchar(32) NOT NULL,
  `voucher_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_bookings`
--
ALTER TABLE `advance_bookings`
  ADD PRIMARY KEY (`advance_b_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `check_showtime`
--
ALTER TABLE `check_showtime`
  ADD PRIMARY KEY (`check_showtime_id`);

--
-- Indexes for table `concession_bookings`
--
ALTER TABLE `concession_bookings`
  ADD PRIMARY KEY (`con_booking_id`);

--
-- Indexes for table `concession_order`
--
ALTER TABLE `concession_order`
  ADD PRIMARY KEY (`concession_order_id`);

--
-- Indexes for table `distributers`
--
ALTER TABLE `distributers`
  ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `foodstalls`
--
ALTER TABLE `foodstalls`
  ADD PRIMARY KEY (`foodstall_id`);

--
-- Indexes for table `food_categories`
--
ALTER TABLE `food_categories`
  ADD PRIMARY KEY (`food_category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `locked_seats`
--
ALTER TABLE `locked_seats`
  ADD PRIMARY KEY (`locked_seat_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movie_persons`
--
ALTER TABLE `movie_persons`
  ADD PRIMARY KEY (`movie_person_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`payroll_id`);

--
-- Indexes for table `printed_tickets`
--
ALTER TABLE `printed_tickets`
  ADD PRIMARY KEY (`printed_ticket_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`screen_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`showtime_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `voucher_bookings`
--
ALTER TABLE `voucher_bookings`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_bookings`
--
ALTER TABLE `advance_bookings`
  MODIFY `advance_b_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `check_showtime`
--
ALTER TABLE `check_showtime`
  MODIFY `check_showtime_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `concession_bookings`
--
ALTER TABLE `concession_bookings`
  MODIFY `con_booking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `concession_order`
--
ALTER TABLE `concession_order`
  MODIFY `concession_order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `distributers`
--
ALTER TABLE `distributers`
  MODIFY `dist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `foodstalls`
--
ALTER TABLE `foodstalls`
  MODIFY `foodstall_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `food_categories`
--
ALTER TABLE `food_categories`
  MODIFY `food_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `locked_seats`
--
ALTER TABLE `locked_seats`
  MODIFY `locked_seat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `movie_persons`
--
ALTER TABLE `movie_persons`
  MODIFY `movie_person_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `printed_tickets`
--
ALTER TABLE `printed_tickets`
  MODIFY `printed_ticket_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `screen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `showtime_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `voucher_bookings`
--
ALTER TABLE `voucher_bookings`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
