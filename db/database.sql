SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_project`
--

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL,
  `own_id` int(11) NOT NULL,
  `project` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_project`
--

INSERT INTO `tbl_project` (`id`, `own_id`, `project`, `description`, `created_on`, `updated_on`) VALUES
(1, 2, 'Primeiro projeto', '', '2016-04-11 20:00:00', '2016-04-11 20:00:00');


-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_task`
--

CREATE TABLE `tbl_task` (
  `id` int(11) NOT NULL,
  `own_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` set('new','open','onhold','wontfix','invalid','closed','resolved') NOT NULL,
  `priority` set('high','average','low') NOT NULL,
  `kind` set('bug','implementation','change','task','proposal') NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_task`
--

INSERT INTO `tbl_task` (`id`, `own_id`, `project_id`, `task`, `description`, `status`, `priority`, `kind`, `create_on`, `updated_on`) VALUES
(1, 1, 1, 'Essa é uma tarefa', 'Descrição DescriçãoDescriçãoDescrição', 'closed', 'average', 'implementation', '2016-04-12 00:45:59', '2016-04-12 00:45:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `created_on`, `updated_on`) VALUES
(1, 'Webmaster', 'webmaster@meuprojeto.com.br', '$2y$10$rvVCYEL4BQzFJ8aE.QhID.R6XlTfn6a6rqkKfdBMiqWGklYoa8nhi', '2016-04-11 20:00:00', '2016-04-11 20:00:00'),
(2, 'Cliente', 'cliente@meuprojeto.com.br', '$2y$10$rvVCYEL4BQzFJ8aE.QhID.R6XlTfn6a6rqkKfdBMiqWGklYoa8nhi', '2016-04-11 20:00:00', '2016-04-11 20:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_user_rel_project`
--

CREATE TABLE `tbl_user_rel_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission` set('see','edit','admin') NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_user_rel_project`
--

INSERT INTO `tbl_user_rel_project` (`id`, `project_id`, `user_id`, `permission`, `block`, `updated_on`, `created_on`) VALUES
(1, 1, 1, 'admin', 0, '2016-04-28 03:03:16', '2016-04-28 03:03:16');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`id`,`own_id`),
  ADD KEY `own_id` (`own_id`);

--
-- Indexes for table `tbl_task`
--
ALTER TABLE `tbl_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_rel_project`
--
ALTER TABLE `tbl_user_rel_project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_task`
--
ALTER TABLE `tbl_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_rel_project`
--
ALTER TABLE `tbl_user_rel_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;