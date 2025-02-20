CREATE DATABASE Slicettes;
USE Slicettes;

--
-- id is VARCHAR(30) because I am already using uniqueid to generate the ID.
-- title is 211 chars long to account for Lopado­temacho­selacho­galeo­kranio­leipsano­drim­hypo­trimmato­silphio­karabo­melito­katakechy­meno­kichl­epi­kossypho­phatto­perister­alektryon­opte­kephallio­kigklo­peleio­lagoio­siraio­baphe­tragano­pterygon
-- nbPortions has a length of 2 to account for a dish with up to 99 portions, which should never happen as the max is 10.
-- difficulty: 0 represents easy, 2 - hard.
--
CREATE TABLE Recipe (
    id VARCHAR(30) UNIQUE PRIMARY KEY,
    title VARCHAR(211) NOT NULL,
    description TEXT,
    nbPortions INT(2) NOT NULL,
    difficulty INT(1) NOT NULL
);

--
-- Password named out of laziness, and privileges granted withought much thought.
--
CREATE USER 'slicettes_user'@'%' IDENTIFIED BY 'slicettes_password';
GRANT ALL PRIVILEGES ON Slicettes.* TO 'slicettes_user'@'%' WITH GRANT OPTION;