-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 12:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookvault`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBooks` ()   BEGIN
    SELECT * FROM book;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUsers` ()   BEGIN
    SELECT * FROM users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserSignUpLogin` (IN `mode` VARCHAR(50), IN `userId` INT, IN `name` VARCHAR(50), IN `email` VARCHAR(50), IN `contact_number` TEXT, IN `address` VARCHAR(50), IN `birthday` DATE, IN `age` INT, IN `username` VARCHAR(50), IN `password` VARCHAR(50))   BEGIN
    IF mode = 'signup' THEN
        INSERT INTO users (name, email, contact_number, address, birthday, age, username, password)
        VALUES (name, email, contact_number, address, birthday, age, username, password);
        SELECT 'Record Successfully Saved' AS message;
    ELSE
        -- Add login logic here
        SELECT 'Login mode not implemented' AS message;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `summary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `genre`, `summary`) VALUES
(1, 'We (A Dystopian Science Fiction Classic) ', 'Yevgeny Zamyatin', 'Dystopian Fiction', 'We is a dystopian novel which is set in a dystopian future police state. D-503 lives in the One State, an urban nation constructed almost entirely of glass, which allows the secret police/spies to inform on and supervise the public more easily. The structure of the state is analogous to the prison design concept developed by Jeremy Bentham commonly referred to as the Panopticon. '),
(2, 'Flipped', 'Wendelin Van Draanen\r\n', 'Romance; Adult Romance', 'The first time Juli Baker saw Bryce Loski, she flipped. The first time Bryce saw Juli, he ran.'),
(3, 'Flipped', 'Wendelin Van Draanen\r\n', 'Romance; Adult Romance', 'The first time Juli Baker saw Bryce Loski, she flipped. The first time Bryce saw Juli, he ran.'),
(4, 'The Lovely Bones', 'Alice Sebold', 'Mystery', '\"My name was Salmon, like the fish; first name, Susie. I was fourteen when I was murdered on December 6, 1973.\"'),
(5, 'The Lovely Bones', 'Alice Sebold', 'Mystery', '\"My name was Salmon, like the fish; first name, Susie. I was fourteen when I was murdered on December 6, 1973.\"'),
(6, 'Dune', 'Frank Herbert', 'Science Fiction', 'Dune is set in the distant future in a feudal interstellar society in which various noble houses control planetary fiefs. It tells the story of young Paul Atreides, whose family accepts the stewardship of the planet Arrakis. While the planet is an inhospitable and sparsely populated desert wasteland, it is the only source of melange, or \"spice\", a drug that extends life and enhances mental abilities. Melange is also necessary for space navigation, which requires a kind of multidimensional awareness and foresight that only the drug provides. As melange can only be produced on Arrakis, control of the planet is a coveted and dangerous undertaking. The story explores the multilayered interactions of politics, religion, ecology, technology, and human emotion as the factions of the empire confront each other in a struggle for the control of Arrakis and its spice.'),
(7, 'We Haunt the Flame', 'Hafsah Faizal', 'Fantasy', 'Zafira is the Hunter, disguising herself as a man when she braves the cursed forest of the Arz to feed her people. Nasir is the Prince of Death, assassinating those foolish enough to defy his autocratic father, the sultan. If Zafira was exposed as a girl, all of her achievements would be rejected; if Nasir displayed his compassion, his father would punish him in the most brutal of ways. Both Zafira and Nasir are legends in the kingdom of Arawiya--but neither wants to be.'),
(8, 'The Ruins', 'Scott Smith', 'Horror', 'Four American tourists — Eric, his girlfriend Stacy, her best friend and former roommate Amy, and Amy\'s boyfriend Jeff, a medical student — are vacationing in Mexico. They befriend a German tourist named Mathias, and a trio of Greeks who go by the Spanish nicknames Pablo, Juan, and Don Quixote. Jeff volunteers the group to accompany Mathias as he attempts to find his brother Henrich, who went missing after having followed a girl he\'d met to an archaeological dig. As they leave the hotel, Pablo joins them, leaving a note and a map for Juan and Don Quixote.'),
(9, 'The Book Thief', 'Markus Zusak', 'Historical Fiction', 'It is 1939. Nazi Germany. The country is holding its breath. Death has never been busier, and will be busier still.'),
(10, 'A Calamity of Souls', 'David Baldacci\r\n', 'Adventure; Historical Adult', 'Set in the tumultuous year of 1968 in southern Virginia, a racially-charged murder case sets a duo of white and Black lawyers against a deeply unfair system as they work to defend their wrongfully-accused Black defendants in this courtroom drama from #1 New York Times bestselling author David Baldacci.'),
(11, 'Pride and Prejudice', 'Jane Austine', 'Classic Fiction', 'The long road that the quick-witted, sharp-tongued Elizabeth Bennet and the haughty Darcy travel from mutual disdain to unfulfilled longing and finally to love and marriage is beset with obstacles in the form of Elizabeth\'s insufferable mother, irrepressible younger sister, and Darcy\'s own secret pain.In Pride and Prejudice, Austen has captured not only the frivolous sensibilities of early-nineteenth-century provincial England, but also the hearts and minds of anyone who has loved outside of social expectations and aspired to a happiness beyond mere propriety.'),
(12, 'The Honey Witch', 'Sydney J. Shields\r\n', 'Fantasy', 'The Honey Witch of Innisfree can never find true love. That is her curse to bear. But when a young woman who doesn’t believe in magic arrives on her island, sparks fly in this deliciously sweet debut novel of magic, hope, and love overcoming all.\r\n '),
(13, 'The Lottery ', 'Shirley Jackson', 'Short Story', 'The lottery, its preparations, and its execution are all described in detail, though it is not revealed until the end what actually happens to the person selected by the random lottery: the selected member of the community is stoned to death by the other townspeople.'),
(14, 'Happy Place', 'Emily Henry', 'Romance', 'Harriet and Wyn have been the perfect couple since they met in college—they go together like salt and pepper, honey and tea, lobster and rolls. Except, now—for reasons they’re still not discussing—they don’t.\r\n'),
(15, 'The Darkest Minds', 'Alexandra Bracken', 'Dystopian', 'When Ruby woke up on her tenth birthday, something about her had changed. Something alarming enough to make her parents lock her in the garage and call the police. Something that gets her sent to Thurmond, a brutal government “rehabilitation camp.” She might have survived the mysterious disease that’s killed most of America’s children, but she and the others have emerged with something far worse: frightening abilities they cannot control.'),
(16, 'The Three Witches and The Master', 'Max Nowaz', 'Science Fiction', 'When a beautiful naked woman Eve, unexpectedly turns up at his back door, Adam, an amateur wizard, is not sure if it is his good fortune or not. The young woman has an attitude and starts bossing him around straightaway, issuing commands; which strikes Adam as that she may be a practitioner of the black arts, a witch.'),
(17, 'The Paradise Problem', 'The Paradise Problem', 'Romance', 'Christina Lauren, returns with a delicious new romance between the buttoned-up heir of a grocery chain and his free-spirited artist ex as they fake their relationship in order to receive a massive inheritance.'),
(18, 'How to End a Love Story', 'Yulin Kuang ', 'Romance', 'Two writers with a complicated history end up working on the same TV show... Can they write themselves a new ending? A sexy and emotional enemies-to-lovers romance guaranteed to pull on your heartstrings and give you a book hangover from brilliant new voice Yulin Kuang.'),
(19, 'End This War', 'JONAXX', 'Romance', 'Alam mong kalaban pero nagawa mo paring mahalin. Alam mong hindi pwede pero mas lalo ka paring nagpupumilit. Alam mong mali pero ginagawa mong tama. Totoong masarap ang mga bawal. Pero masarap parin ba pag magkasakitan na? Masarap parin ba pag pinaiyak ka na?'),
(20, 'Against the Heart', 'JONAXX', 'Romance', 'Charlotta Yvonna del Real is the queen of Altagracia. Anak ng may-ari ng malaking Azucarera, she has it all - friends, popularity, riches, boys. But well, maybe, not all. May madilim na lihim ang kanyang pamilya. Isang bagay na hindi inaasahan para sa kanila. The deal Real\'s were always the epitome of a perfect family, not until that night.\r\n\r\nInukit sa puso niya ang galit at pagkamuhi para sa mga Castanier. She was sure that when the Lenadro Castanier is back, she would throw them out of Altagracia. Even if it was against her heart.'),
(21, 'A & D', 'Louisse Carreon', 'Adult Young', 'Nerdy Dakota Evans makes the biggest mistake of her life by falling in love with her best friend, Aaron Ford. Despite coming from entirely different cliques in school, will their relationship have a chance?\r\n'),
(22, 'You Like It Darker', 'Stephen King', 'Horror', '“You like it darker? Fine, so do I,” writes Stephen King in the afterword to this magnificent new collection of twelve stories that delve into the darker part of life—both metaphorical and literal. King has, for half a century, been a master of the form, and these stories, about fate, mortality, luck, and the folds in reality where anything can happen, are as rich and riveting as his novels, both weighty in theme and a huge pleasure to read. King writes to feel “the exhilaration of leaving ordinary day-to-day life behind,” and in You Like It Darker, readers will feel that exhilaration too, again and again.'),
(23, 'Hearts Still Beating', 'Brooke Archer', 'Gripping, romantic, and impossible to put down, this dark and immersive post-apocalyptic debut YA no', ''),
(24, 'Lost Ark Dreaming', 'Suyi Davies Okungbowa', 'Dystopian', 'The brutally engineered class divisions of Snowpiercer meets Rivers Solomon’s The Deep in this high-octane post-climate disaster novella written by Nommo Award-winning author Suyi Davies Okungbowa\r\n\r\nOff the coast of West Africa, decades after the dangerous rise of the Atlantic Ocean, the region’s survivors live inside five partially submerged, kilometers-high towers originally created as a playground for the wealthy. Now the towers’ most affluent rule from their lofty perch at the top while the rest are crammed into the dark, fetid floors below sea level.'),
(25, 'The Brides of High Hill', 'Nghi Vo', 'Fantasy', 'The Cleric Chih accompanies a beautiful young bride to her wedding to an aging lord at a crumbling estate situated at the crossroads of dead empires. But they’re forgetting things they ought to remember, and the lord’s mad young son wanders the grounds at night like a hanged ghost.'),
(26, 'Her Body and Other Parties: Stories\r\n\r\n', '0', 'Short Story', 'In Her Body and Other Parties, Carmen Maria Machado blithely demolishes the arbitrary borders between psychological realism and science fiction, comedy and horror, fantasy and fabulism. While her work has earned her comparisons to Karen Russell and Kelly Link, she has a voice that is all her own. In this electric and provocative debut, Machado bends genre to shape startling narratives that map the realities of women\'s lives and the violence visited upon their bodies.\r\n'),
(27, 'And Then? And Then? What Else?', 'Daniel Handler\r\nLemony Snicket', 'Non-Fiction', 'A bold, candid, vulnerable, and entertaining memoir of the literary life of Daniel Handler, the writer otherwise known as Lemony Snicket'),
(28, 'The Chronicles of Narnia', 'C.S. Lewis\r\n', 'Adventure', 'Journeys to the end of the world, fantastic creatures, and epic battles between good and evil—what more could any reader ask for in one book? The book that has it all is The Lion, the Witch and the Wardrobe, written in 1949 by Clive Staples Lewis. But Lewis did not stop there. Six more books followed, and together they became known as The Chronicles of Narnia.\r\n\r\nFor the past fifty years, The Chronicles of Narnia have transcended the fantasy genre to become part of the canon of classic literature. Each of the seven books is a masterpiece, drawing the reader into a land where magic meets reality, and the result is a fictional world whose scope has fascinated generations.'),
(29, 'Harry Potter and the Sorcerer’s Stone', 'J.K. Rowling\r\n', 'Science Fiction', '\"Turning the envelope over, his hand trembling, Harry saw a purple wax seal bearing a coat of arms; a lion, an eagle, a badger and a snake surrounding a large letter \'H\'.\"\r\n\r\nHarry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. Then, on Harry\'s eleventh birthday, a great beetle-eyed giant of a man called Rubeus Hagrid bursts in with some astonishing news: Harry Potter is a wizard, and he has a place at Hogwarts School of Witchcraft and Wizardry. An incredible adventure is about to begin!'),
(30, 'My Darling Dreadful Thing', 'Johanna van Veen\r\n', 'Mystery', 'Roos Beckman has a spirit companion only she can see. Ruth—strange, corpse-like, and dead for centuries—is the only good thing in Roos’ life, which is filled with sordid backroom séances organized by her mother. That is, until wealthy young widow Agnes Knoop attends one of these séances and asks Roos to come live with her at the crumbling estate she inherited upon the death of her husband. The manor is unsettling, but the attraction between Roos and Agnes is palpable. So how does someone end up dead?\r\n'),
(31, 'Crazy Rich Asians', 'Kevin Kwan', 'Family', 'Crazy Rich Asians is the outrageously funny debut novel about three super-rich, pedigreed Chinese families and the gossip, backbiting, and scheming that occurs when the heir to one of the most massive fortunes in Asia brings home his ABC (American-born Chinese) girlfriend to the wedding of the season.\r\n\r\nWhen Rachel Chu agrees to spend the summer in Singapore with her boyfriend, Nicholas Young, she envisions a humble family home, long drives to explore the island, and quality time with the man she might one day marry. What she doesn\'t know is that Nick\'s family home happens to look like a palace, that she\'ll ride in more private planes than cars, and that with one of Asia\'s most eligible bachelors on her arm, Rachel might as well have a target on her back.'),
(32, 'Everything, Everything', 'Nicola Yoon\r\n', 'Young Adult', 'My disease is as rare as it is famous. It’s a form of Severe Combined Immunodeficiency, but basically, I’m allergic to the world. I don’t leave my house, have not left my house in fifteen years. The only people I ever see are my mom and my nurse, Carla.\r\n\r\nBut then one day, a moving truck arrives. New next door neighbors. I look out the window, and I see him. He’s tall, lean and wearing all black—black t-shirt, black jeans, black sneakers and a black knit cap that covers his hair completely. He catches me looking and stares at me. I stare right back. His name is Olly. I want to learn everything about him, and I do. I learn that he is funny and fierce. I learn that his eyes are Atlantic Ocean-blue and that his vice is stealing silverware. I learn that when I talk to him, my whole world opens up, and I feel myself starting to change—starting to want things. To want out of my bubble. To want everything, everything the world has to offer.\r\n'),
(33, 'Love, Lies, and Cherry Pie', 'Jackie Lau', 'Rom-Com', 'A charming rom-com about a young woman’s desperate attempts to fend off her meddling mother…only to find that maybe mother does know best.'),
(34, 'Down Came The Rain', 'Monrosey', 'Contemporary', 'Just when Hudson Caldwell\'s life is finally coming together, an unwavering paranoia threatens to tear it apart. Someone is following her - that\'s the feeling she gets every time she leaves her downtown Chicago apartment. \r\n\r\nAfter a failed attempt to file a police report, Hudson\'s stripper best friend gifts her with an unregistered firearm, but the weapon isn\'t enough to stop an attack in the middle of the night.\r\n\r\nWhen rookie cop, Myles Young, responds to a complaint of gunfire, he instantly falls for Hudson\'s quiet vulnerability and shattered past. He vows to keep her safe - much to the dismay of his case-hardened partner. \r\n\r\nAs their relationship intensifies, the identity of Hudson\'s stalker slowly comes to light. But the closer Myles comes to solving the mystery, the more he realizes he\'s in over his head.'),
(35, 'Dirty Lying Wolves', 'SabrinaBlackburry', 'Werewolfs; Mystery', 'June, a young woman who comes to the rescue of a stranger who seems to be shifting in and out of a monstrous form, finds herself in trouble as she\'s dragged off to Canada after being bitten. Dom, the quiet leader of a pack of rogue wolves, tells June that she will turn into a wolf like the rest of them. She has to face a new reality and decide whether she will fill the role she is meant to fill. Will she be able to become a support beam in her new community, or will her actions end up tearing the pack apart?'),
(36, 'Before She Ruled', 'amelierhys', 'Fantasy', 'Two years ago, Princess Adelaide was forced into hiding after her father, King William IV, was killed in a carriage accident that also took the life of her mother and brother. She suspects that the despicable man now on the throne of England--her uncle, Ernest--is responsible for her family\'s death, so she avoids his watchful eye by working as a maid for the aristocratic families of London. However, when she\'s employed by the dashing Duke of Kingfield, she soon discovers that he not only believes that the princess is alive, but also that she could be the key to saving England. Is Adelaide willing to come out of hiding in order to prove him right? Or are her growing feelings for him worth giving up her claim to the throne?'),
(37, 'Chasing the Sun', 'Inksteady', 'Romance', 'Solene Clemente was a typical Civil Engineering student who struggled to put up with her studies. Kung pwede ngang i-bake na lang ang napakaraming itlog sa test papers niya, ginawa niya na. At a young age, she experienced the harsh reality of life-poverty, abuse, and a broken family.\r\n\r\nBut, as someone who could see the bright side of everything, she knew she could make it with only her mother and best friend, Duke Laurence Sanders, whom she secretly loved.'),
(38, 'Dosage of Seratonin', 'Inksteady', 'Romance', 'Ang hirap magbayad ng bills. Ang hirap suportahan ng pamilyang akala ay isang milyon ang suweldo mo. Ang hirap ngumiti sa nanay na mataas ang tingin sa\'yo pero hindi ka kayang ipagtanggol. Ang hirap tabihan sa hapagkainan ng tatay na pinag-uubusan mo ng pera pero hindi ka maalala. Ang hirap mag-abot ng tulong sa kapatid na baon sa utang. Ang hirap intindihin ng hipag na nakakapagpa-rebond pa kahit kapos na kapos na. Ang hirap pakisamahan ng bunsong halos ilahad ang mga palad tuwing makikita ka. Ang hirap ngitian ng mga taong tanong nang tanong kung bakit hindi ka pa nakakapag-asawa. Ang hirap humarap sa mundong isasampal sa\'yo na mag-isa ka.'),
(39, 'The Four Bad Boys and Me', 'blue_maiden', 'Teen Fiction', 'Gusto ko lang naman ng simpleng buhay; tahimik at malayo sa gulo. Kaso isang araw... nagbago ang lahat.'),
(40, 'Hell University', 'KnightInBlack', 'Teen Fiction', 'A place where everything is mysterious, enchanting, bloody, and shitty. Entering is the other way of suicidal. Just one wrong move and everything will blur. A lot of secrets are being hid.\r\n\r\n'),
(41, 'Greatest Hits', 'Laura Barrnet', 'Fiction', 'One day. Sixteen songs. The soundtrack of a lifetime...\r\n\r\nAlone in her studio, Cass Wheeler is taking a journey back into her past. After a silence of ten years, the singer-songwriter is picking the sixteen tracks that have defined her - sixteen key moments in her life - for a uniquely personal Greatest Hits album.'),
(42, 'Dusk', 'F Sionil José', 'History', 'The first novel in José\'s acclaimed Rosales Saga, which follows the fortunes of one family through 100 years of Philippine history.'),
(43, 'Frankenstein', 'Mary Shelley', 'Horror', 'Another classic horror novel, Frankenstein is widely regarded as the first horror novel in the modern sense. It has been adapted, riffed on, and reprinted countless times, and remains a staple of the horror genre.');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `fav_id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_number` text NOT NULL,
  `address` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `name`, `email`, `contact_number`, `address`, `birthday`, `age`, `username`, `password`) VALUES
(1, 'injel canoy', 'angel@gmail.com', '09123456789', 'gusa', '2004-08-19', 19, 'injel', '123'),
(2, 'angel Llatuna', 'angel@gmail.com', '09754239574', 'gusa', '2004-08-19', 19, 'injel1', '123'),
(3, 'angel Llatuna1', 'angel@gmail.com', '09754239574', 'gusa', '2004-08-19', 19, 'injel2', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`fav_id`),
  ADD KEY `name` (`name`),
  ADD KEY `book` (`book`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
