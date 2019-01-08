create table quiz (id int AUTO_INCREMENT primary key not null, question VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option1 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option2 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option3 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, option4 VARCHAR (255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, answer text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL) ENGINE = MyISAM;

CREATE TABLE quiz_result (id INT NOT NULL, right_answer INT NOT NULL, play_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);

then

run tabla_quiz.php
