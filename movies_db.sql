-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 09:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getmovies_genre` (IN `genre` VARCHAR(20))   BEGIN
    select movies.id, movies.title, movies.actor, movies.producer, movies.director
    from movies JOIN genre ON movies.genre=genre.id WHERE genre.title = genre;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getmovies_review` (IN `movie` VARCHAR(20))   BEGIN
    select movies.id, movies.title, review.id, review.review
    from movies JOIN review ON movies.id=review.movie_id WHERE movies.title = movie;
    end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_movie_likes` ()   BEGIN
	DECLARE done INTEGER DEFAULT 0;
    DECLARE movie_id int;
    DECLARE movie_title varchar(10);
    DECLARE no_likes int;
	DEClARE curlikes CURSOR FOR SELECT movies.id, movies.title, COUNT(likes) FROM movies JOIN review ON movies.id=review.movie_id GROUP BY movies.id;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

	OPEN curlikes;

	LABLE: LOOP
	FETCH curlikes INTO movie_id, movie_title, no_likes;
	IF done = 1 THEN 
	LEAVE LABLE;
	END IF;
	INSERT INTO movies_likes VALUES(movie_id, movie_title, no_likes);
	END LOOP;

	CLOSE curlikes;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `eligible` (`AGE` INTEGER) RETURNS VARCHAR(20) CHARSET utf8mb4 DETERMINISTIC BEGIN
    IF age > 12 THEN
    RETURN ("yes");
    ELSE
    RETURN ("No");
    END IF;
    end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `username`, `password`) VALUES
(5, 'ADMIN', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `img_name` varchar(255) DEFAULT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `title`, `img_name`, `featured`, `active`) VALUES
(4, 'Thriller', 'genere_175.jpg', 'No', 'Yes'),
(5, 'Romance', 'genere_540.jpg', 'Yes', 'Yes'),
(6, 'Children', 'genere_693.jpg', 'Yes', 'Yes'),
(7, 'Comedies', 'genere_773.jpg', 'No', 'Yes'),
(8, 'Crime', 'genere_103.jpg', 'No', 'Yes'),
(9, 'Documentries', 'genere_150.jpg', 'Yes', 'Yes'),
(10, 'Drama', 'genere_749.jpg', 'No', 'Yes'),
(11, 'Suspense', 'genere_167.jpg', 'No', 'Yes'),
(12, 'Feel-Good', 'genere_542.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `age_req` varchar(10) DEFAULT NULL,
  `genre` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `revenue` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `actor` varchar(100) DEFAULT NULL,
  `producer` varchar(100) DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `featured` varchar(10) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `age_req`, `genre`, `description`, `revenue`, `title`, `image_name`, `actor`, `producer`, `director`, `featured`, `active`) VALUES
(6, '16', 4, 'The plot revolves around a father (Krasinski) and a mother who struggle to survive and rear their children in a post-apocalyptic world inhabited by blind monsters with an acute sense of hearing.', 20000000, 'A-quiet-place | Year:2018', 'content_5657.jpg', 'John Krasinski  ', 'Michael Bay ', 'John Krasinski', 'Yes', 'Yes'),
(7, '12', 4, 'The film stars Natalie Portman, Vincent Cassel, Mila Kunis, Barbara Hershey, and Winona Ryder, and revolves around a production of Tchaikovskys Swan Lake by the New York City Ballet company.', 230000000, 'Black-swan | Year:2010', 'content_5076.jpg', 'Natali Portman ', 'Mike Medavoy', 'Darren Aronofsky', 'No', 'Yes'),
(8, '16', 5, 'It is based on accounts of the sinking of the RMS Titanic and stars Kate Winslet and Leonardo DiCaprio as members of different social classes who fall in love aboard the ship during its ill-fated maiden voyage.', 540000000, 'Titanic | Year:1997', 'content_6527.jpg', 'Leonardo Decaprio ', 'James Cameron', '	James Cameron', 'No', 'Yes'),
(9, '12', 5, 'American romantic musical comedy drama film . The film stars Ryan Gosling and Emma Stone as a struggling jazz pianist and an aspiring actress, who meet and fall in love while pursuing their dreams in Los Angeles.', 8000000, 'La La land | Year:2016', 'content_8825.jpg', 'Ryan', 'Fred', 'Damien Chazelle', 'Yes', 'Yes'),
(10, '6', 6, 'Despicable Me is a computer-animated media franchise centering on Gru, a reformed super-villain (who later becomes a father, husband, and secret agent), and his yellow-colored Minions. ', 26300000, 'Despicable-Me | Year:2010', 'content_6534.jpg', 'Gru ', 'Chris Meledandri', 'Chris Renaud  ', 'No', 'Yes'),
(11, '6', 6, 'When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister Anna teams up with a mountain man.', 78000000, 'Frozen | Year:2013', 'content_9128.jpg', 'Kristen Bell', '	Peter Del Vecho', 'Chris Buck', 'Yes', 'Yes'),
(12, '16', 10, 'In 2003, Harvard undergrad and computer genius Mark Zuckerberg (Jesse Eisenberg) begins work on a new concept that eventually turns into the global social network known as Facebook.', 65005000, 'The-Social-Network | Year:2010', 'content_2049.jpg', 'Jesse Eisenberg', 'Scott Rudin', 'David Fincher', 'Yes', 'Yes'),
(13, '16', 10, 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more. A nameless first person narrator attends support groups in attempt to subdue his emotional state.', 37090000, 'Fight-Club | Year:1999', 'content_9394.jpg', 'Brad Pitt', 'Art Linson ', 'David Fincher ', 'No', 'Yes'),
(14, '16', 11, 'In Carthage, former New York-based writer Nick Dunne and his glamorous wife Amy present a portrait of a blissful marriage to the public. However, when Amy goes missing on the couples fifth wedding anniversary.', 53826490, 'Gone-Girl | Year:2014', 'content_8068.jpg', 'Ben Affleck', 'Arnon Milchan', '	David Fincher', 'Yes', 'Yes'),
(15, '16', 11, 'In 1954, a U.S. Marshal investigates the disappearance of a murderer who escaped from a hospital for the criminally insane. In 1954, up-and-coming U.S. marshal Teddy Daniels is assigned to investigate.', 2147483647, 'Shutter-Island | Year:2010', 'Food-Name-5196.jpg', 'Leonardo Decaprio ', 'Mike Medavoy ', 'Martin Scorsese ', 'Yes', 'Yes'),
(16, '16', 7, 'The show centers around the Griffins, a dysfunctional family consisting of parents Peter and Lois; their children, Meg, Chris, and Stewie; and their anthropomorphic pet dog,Brian.', 976026671, 'Family-Guy | Year:1999', 'content_1621.jpg', 'Peter ', 'Shannon Smith', '	Seth MacFarlane', 'Yes', 'Yes'),
(17, '14', 7, 'The Office is an American mockumentary sitcom television series that depicts the everyday work lives of office employees at the Scranton, Pennsylvania, branch of the fictional Dunder Mifflin Paper Company.', 274874299, 'The Office | Year:2005', 'content_2217.jpg', 'Steve Carell', 'Greg Daniels', '	Greg Daniels', 'Yes', 'Yes'),
(18, '18', 8, 'Filmed over a 10-year period, Steven Avery, a DNA exoneree who, while in the midst of exposing corruption in local law enforcement, finds himself the prime suspect in a grisly new crime.', 42000000, 'Making-a-Murderer | Year:2015', 'content_9803.jpg', 'Steven Avery', 'Laura Ricciardi', '	Laura Ricciardi', 'Yes', 'Yes'),
(19, '18', 8, 'In film, a view of a scene that is shot from a considerable distance, so that people appear as indistinct shapes. An extreme long shot is a view from an even greater distance, in which people appear as small dots.', 420420420, 'Long-Shot | Year:2019', 'content_4360.jpg', 'Seth Rogen', 'Charlize Theron', 'Jonathan Levine', 'No', 'Yes'),
(20, '12', 12, 'Forrest Gump, American film, released in 1994, that chronicled 30 years of the life of a intellectually disabled man in an unlikely fable that earned critical praise,and six Academy Awards.', 53547888, 'Forest-Gump | Year:1994', 'content_6982.jpg', 'Tom Hanks', 'Wendy Finerman', 'Robert Zemeckis', 'Yes', 'Yes'),
(21, '12', 12, 'After being kicked out of his rock band, Dewey Finn becomes a substitute teacher of an uptight elementary private school, only to try and turn his class into a rock band.', 79366600, 'School-of-rock | Year:2013', 'content_3156.jpg', 'Jack Black', 'Scott Rudin', 'Richard Linklater', 'Yes', 'Yes'),
(22, '14', 9, 'Amanda Knox is a 2016 American documentary film about Amanda Knox, twice convicted and later acquitted of the 2007 murder of Meredith Kercher,featuring interviews with Amanda Knox, her ex-boyfriend Raffaele Sollecito.', 34520000, 'Amanda Knox | Year:2016', 'content_5592.jpg', 'Matt Damon', '	Rod Blackhurst', 'Rod Blackhurst', 'Yes', 'Yes'),
(23, '14', 9, 'Former CIA SAD/SOG officer John W. Creasy visits his old friend Paul Rayburn in Mexico. Rayburn convinces him to take a bodyguard position with Samuel Ramos, whose young daughter requires a bodyguard.', 47290090, 'Man On Wire | Year:2004', 'content_6096.jpg', 'Denzel Washington ', 'Lucas Foster ', 'Tony Scott ', 'No', 'Yes'),
(24, '16', 4, 'A mentally troubled stand-up comedian embarks on a downward spiral that leads to the creation of an iconic villain. Arthur Fleck works as a clown and is an aspiring stand-up comic.', 590000000, 'Joker | Year:2019', 'content_5818.jpg', 'Joaquin Pheonix ', 'Todd Phillips', '	Todd Phillips ', 'No', 'Yes'),
(25, '16', 4, 'Petty thief Louis "Lou" Bloom is caught stealing from a Los Angeles construction site by a security guard. He attacks the guard, steals his watch and leaves with stolen material.', 2147483647, 'Night Crawler | Year:2014', 'content_6851.jpg', 'Jake Gyllenhaal', 'Michel Litvak', '	Dan Gilroy', 'No', 'Yes'),
(26, '16', 4, 'In 1986,25-year-old FBI trainee Clarice Starling is pulled from her regimen at the Quantico, Virginia FBI Academy by Jack Crawford of the Bureaus Behavioral Science Unit.', 21876381, 'The silence of the Lambs | Year:1991', 'Food-Name-600.jpg', 'Jodie Foster', 'Kenneth Utt ', '	Jonathan Demme', 'No', 'Yes');
-- --------------------------------------------------------

--
-- Table structure for table `movies_likes`
--

CREATE TABLE `movies_likes` (
  `movie_id` int(11) DEFAULT NULL,
  `movie_title` varchar(60) DEFAULT NULL,
  `no_likes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies_likes`
--

INSERT INTO `movies_likes` (`movie_id`, `movie_title`, `no_likes`) VALUES
(6, 'A-quiet-pl', '1'),
(7, 'Black-swan', '3'),
(6, 'A-quiet-pl', '4'),
(7, 'Black-swan', '6'),
(8, 'Titanic', '1'),
(9, 'La La land', '1'),
(6, 'A-quiet-pl', '4'),
(7, 'Black-swan', '6'),
(8, 'Titanic', '1'),
(9, 'La La land', '1');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `likes`, `dislikes`, `review`, `movie_id`, `user_id`) VALUES
(36, 1, 0, 'Heart Touching<3', 8, 10),
(38, 0, 1, 'i dont like the movie', 7, 11),
(41, 1, 0, 'nice movie', 6, 13),
(42, 1, 0, 'Classy', 24, 14);


--
-- Triggers `review`
--
DELIMITER $$
CREATE TRIGGER `review_validation` BEFORE INSERT ON `review` FOR EACH ROW BEGIN
    DECLARE error_msg VARCHAR(300);
    SET error_msg = ("Review filed is empty");
    IF new.review = ' ' THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = error_msg;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `sub_price` int(11) DEFAULT NULL,
  `sub_name` varchar(255) DEFAULT NULL,
  `active` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `sub_price`, `sub_name`, `active`) VALUES
(1, 1000, 'Monthly', 'Yes'),
(2, 3000, 'Quarterly', 'Yes'),
(3, 4500, 'Half-Yealy', 'Yes'),
(4, 9000, 'Yearly', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `F_name` varchar(30) DEFAULT NULL,
  `L_name` varchar(30) DEFAULT NULL,
  `age_req` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `subscription` int(11) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `F_name`, `L_name`, `age_req`, `email`, `username`, `gender`, `subscription`, `password`) VALUES
(10, 'Abhishek', 'Adithya S K', 20, 'abhi@gmail.com', 'abhi', 'Male', 2, 'd76f3d05cc9ac98f1f9160274a39fe33'),
(11, 'Akash', 'Roy', 13, 'aka@gmail.com', 'akash', 'Male', 4, '94754d0abb89e4cf0a7f1c494dbb9d2c'),
(13, 'Anand', 'Mudhol', 17, 'ana@gmail.com', 'anand', 'Male', 2, '8bda8e915e629a9fd1bbca44f8099c81'),
(14, 'Arjun', 'Hegde', 18, 'arj@gmail.com', 'arjun', 'Male', 1, '7626d28b710e7f9e98d9dfbe9bf0d123');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `age_validation` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE error_msg VARCHAR(300);
    SET error_msg = ("Age of the user should be 12 or more");
    IF new.age_req < 12 THEN 
    SIGNAL SQLSTATE '45000'
    SET MESSAGE_TEXT = error_msg;
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscription` (`subscription`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genre` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`subscription`) REFERENCES `subscription` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
