-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 20 2013 г., 11:25
-- Версия сервера: 5.5.25
-- Версия PHP: 5.2.12

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: 'newdatabase'
--

-- --------------------------------------------------------

--
-- Структура таблицы 'lectures'
--

CREATE TABLE IF NOT EXISTS 'lectures' (
  'lect_id' int(11) NOT NULL AUTO_INCREMENT,
  'lect_login' longtext NOT NULL,
  'lect_pass' char(10) NOT NULL,
  'lect_surname' text NOT NULL,
  'lect_name' text NOT NULL,
  'lect_middlename' text NOT NULL,
  PRIMARY KEY ('lect_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы 'lect_subj'
--

CREATE TABLE IF NOT EXISTS 'lect_subj' (
  'lect_id' int(11) NOT NULL,
  'subj_id' int(11) NOT NULL,
  PRIMARY KEY ('lect_id','subj_id'),
  KEY 'FK_Relationship_4' ('subj_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы 'marks'
--

CREATE TABLE IF NOT EXISTS 'marks' (
  'stud_id' int(11) DEFAULT NULL,
  'subj_id' int(11) DEFAULT NULL,
  'mark' int(11) DEFAULT NULL,
  KEY 'FK_Relationship_1' ('stud_id'),
  KEY 'FK_Relationship_2' ('subj_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы 'students'
--

CREATE TABLE IF NOT EXISTS 'students' (
  'stud_id' int(11) NOT NULL AUTO_INCREMENT,
  'stud_login' longtext NOT NULL,
  'stud_pass' char(10) NOT NULL,
  'stud_surname' text NOT NULL,
  'stud_name' text NOT NULL,
  'stud_middlename' text NOT NULL,
  'course' decimal(6,0) NOT NULL,
  'groupe' decimal(25,0) NOT NULL,
  PRIMARY KEY ('stud_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы 'subjects'
--

CREATE TABLE IF NOT EXISTS 'subjects' (
  'subj_id' int(11) NOT NULL AUTO_INCREMENT,
  'subj_name' text NOT NULL,
  PRIMARY KEY ('subj_id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы 'lect_subj'
--
ALTER TABLE 'lect_subj'
  ADD CONSTRAINT 'FK_Relationship_5' FOREIGN KEY ('lect_id') REFERENCES 'lectures' ('lect_id'),
  ADD CONSTRAINT 'FK_Relationship_4' FOREIGN KEY ('subj_id') REFERENCES 'subjects' ('subj_id');

--
-- Ограничения внешнего ключа таблицы 'marks'
--
ALTER TABLE 'marks'
  ADD CONSTRAINT 'FK_Relationship_2' FOREIGN KEY ('subj_id') REFERENCES 'subjects' ('subj_id'),
  ADD CONSTRAINT 'FK_Relationship_1' FOREIGN KEY ('stud_id') REFERENCES 'students' ('stud_id');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
