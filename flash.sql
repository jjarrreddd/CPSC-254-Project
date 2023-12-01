CREATE DATABASE IF NOT EXISTS flashcard DEFAULT CHARSET = utf8;
USE flashcard;

-- Word and Definition Table

DROP TABLE IF EXISTS Deck;
CREATE TABLE Deck (
	ID INT NOT NULL auto_increment,
    Word TEXT NOT NULL,
    Def TEXT NOT NULL,
    PRIMARY KEY (ID)
);