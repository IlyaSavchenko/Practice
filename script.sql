INSERT INTO `students`(`stud_id`, `course`, `groupe`,`stud_login`, `stud_pass`, 
					   `stud_surname`, `stud_name`, `stud_middlename`) 
VALUES 
(1,1,3, 'ivanov_p_s','ivanov','ivanov','petr','surovich'),
(2,1,3, 'petrov_v_v','petrov','petrov','vasily','vasilievich'),
(3,1,3, 'gubarev_i_s', 'gubarev', 'gubarev', 'ivan', 'sergeevich'),

(4,2,4, 'kurochkin_a_a', 'kurochkin', 'kurochkin', 'alex', 'alexsich'),
(5,2,4, 'sobakov_e_e', 'sobakov', 'sobakov', 'elim', 'elimovich'),
(6,2,4, 'koshechkin_b_b', 'koshechkin', 'koshechkin', 'boris', 'borisovich'),

(7,3,1, 'rozov_w_w', 'rozov', 'rozov', 'wahtang', 'wahtangovich'),
(8,3,1, 'pionov_p_p', 'pionov', 'pionov', 'petr', 'petrovich'),
(9,3,1, 'fialkov_v_v', 'fialkov', 'fialkov', 'viktor', 'viktorovich'),

(10,4,2, 'odeyal_t_t', 'odeyal', 'odeyal', 'toha', 'tohovich'),
(11,4,2, 'pled_y_y', 'pled', 'pled', 'yop', 'yopovich'),
(12,4,2, 'podushk_v_v', 'podushk', 'podushk', 'vladimir', 'vladimirovich');


INSERT INTO `lectures`(`lect_id`, `lect_login`, `lect_pass`, `lect_surname`, `lect_name`, `lect_middlename`) 
VALUES 
(1, 'antonov_a_a', 'antonov', 'antonov', 'anton', 'antonovich'),
(2, 'vasilyev_v_v', 'vasilyev', 'vasilyev', 'vasily', 'vasilyevich'),
(3, 'sergeev_s_s', 'sergeev', 'sergey', 'sergey', 'sergeevich'),
(4, 'andreev_a_a', 'andreev', 'andreev', 'andrey', 'andreevich'),
(5, 'mikhailov_m_m', 'mikhailov', 'mikhailov', 'mikhail', 'mikhailovich');


INSERT INTO `subjects`(`subj_id`, `subj_name`) 
VALUES
(1,  'sclyadnevoznanie'),
(2,  'takoop'),
(3,  'voronsisharp'),
(4,  'vyrim'),
(5,  'syinform'),
(6,  'lavlhistory'),
(7,  'belbd'),
(8,  'shevaisp'),
(9,  'makstrpo'),
(10, 'kryrmat');


INSERT INTO `lect_subj`(`lect_id`, `subj_id`) 
VALUES 
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10);


INSERT INTO `marks`(`stud_id`, `subj_id`, `mark`) 
VALUES 
(1,  1,  100),
(1,  10, 15),
(2,  3,  50),
(2,  7,  79),
(3,  2,  85),
(3,  8,  NULL),
(4,  4,  30),
(4,  5,  30),
(5,  9,  29),
(5,  6,  NULL),
(6,  5,  55),
(6,  5,  70),
(7,  9,  NULL),
(7,  3,  60),
(8,  7,  50),
(8,  1,  45),
(9,  10, 90),
(9,  4,  100),
(10, 4,  NULL),
(10, 8,  48),
(11, 2,  64),
(11, 6,  77),
(12, 1,  1),
(12, 3,  NULL);