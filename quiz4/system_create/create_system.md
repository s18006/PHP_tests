CREATE TABLE quiz4 (id int AUTO_INCREMENT primary key not null, question_type VARCHAR(20) NOT NULL, question_difficulty VARCHAR(20) NOT NULL, question TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option1 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option2 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option3 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option4 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option5 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,  option6 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, answer text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, answer_length VARCHAR(20) NOT NULL, checkbox_length int(3) NOT NULL, checkbox_options int(3) NOT NULL) ENGINE = MyISAM;


CREATE TABLE quiz_result (user_id VARCHAR(255) NOT NULL, id INT NOT NULL, right_answer INT(3) NOT NULL, question VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, user_answer VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, play_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE = MyISAM;

CREATE TABLE game_summary (user_name VARCHAR(255) NOT NULL,quiz_name VARCHAR(255) NOT NULL, id INT PRIMARY KEY AUTO_INCREMENT NOT NULL, total_answers INT NOT NULL, right_answers INT NOT NULL, reg_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

then

run tabla_quiz.php

hash method of variable elements:
    - number: hash('sha256', json_encode(***)),
    - japanese character: hash('sha256', json_encode('***')),
    - alphabetical character: hash('sha256', json_encode(strtolower('***')))


newQuestion Upload table
CREATE TABLE IF NOT EXISTS `temp_table` (user_id int NOT NULL, id int AUTO_INCREMENT PRIMARY KEY NOT NULL, database_type VARCHAR(20) NOT NULL, question_type VARCHAR(20) NOT NULL, question TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, right_answer VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, right_answer2 VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, right_answer3 VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option1 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option2 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option3 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option4 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option5 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, answer text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, answer_length VARCHAR(20) NOT NULL, checkbox_length int(3) NOT NULL, checkbox_options int(3) NOT NULL, reg_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE = MyISAM;

users table for login
CREATE TABLE users (id int NOT NULL PRIMARY KEY AUTO_INCREMENT, username VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL);


