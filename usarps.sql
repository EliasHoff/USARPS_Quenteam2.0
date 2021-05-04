DROP DATABASE usarps;
CREATE OR REPLACE DATABASE usarps;
USE usarps;

CREATE TABLE game(
    pk_game_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    player1 VARCHAR(40),
    player2 VARCHAR(40),
    date DATE
);

CREATE TABLE round(
    pk_round_id INTEGER PRIMARY KEY AUTO_INCREMENT,
    fk_pk_game_id INTEGER,
    symbol1 VARCHAR(40),
    symbol2 VARCHAR(40),
    winner INTEGER,
    time TIME,
    CONSTRAINT game FOREIGN KEY (fk_pk_game_id) REFERENCES game(pk_game_id)
);

INSERT INTO game(player1, player2, date) 
VALUES ("Elias", "Hasan", '2020-05-04');

INSERT INTO game(player1, player2, date) 
VALUES ("Samuel", "Elias", '2020-05-04');



INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (1, "rock", "paper", 2, '14:31:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (1, "rock", "paper", 2, '14:33:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (1, "paper", "rock", 1, '14:35:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (1, "rock", "scissors", 1, '14:36:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (1, "paper", "rock", 1, '14:38:00');


INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "scissors", "paper", 1, '15:12:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "paper", "paper", 0, '15:14:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "scissors", "rock", 2, '15:15:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "rock", "scissors", 1, '15:17:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "scissors", "rock", 2, '15:18:00');

INSERT INTO round(fk_pk_game_id, symbol1, symbol2, winner, time)
VALUES (2, "rock", "scissors", 1, '15:20:00');