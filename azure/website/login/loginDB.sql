CREATE DATABASE loginDB;

CREATE TABLE loginInfo(
    personID int NOT NULL AUTO_INCREMENT,
    personname VARCHAR(255),
    email VARCHAR(255),
    passcode VARCHAR(255),

    PRIMARY KEY(personID),
    UNIQUE(email)
)

CREATE TABLE classrooms(
    classID int NOT NULL AUTO_INCREMENT,
    classCode VARCHAR(255),
    adminID VARCHAR(255),
    className VARCHAR(255),

    PRIMARY KEY(classID),
    UNIQUE(classCode)
)

CREATE TABLE tasks(
    taskID int NOT NULL AUTO_INCREMENT,
    classID VARCHAR(255),
    taskName VARCHAR(255),
    taskDescription TEXT(65535),

    PRIMARY KEY(taskID)
)

CREATE TABLE submitted(
    submitID int NOT NULL AUTO_INCREMENT,
    studentID VARCHAR(255),
    taskID VARCHAR(255),
    color VARCHAR(255),
    comment VARCHAR(255),

    PRIMARY KEY(submitID)
)

CREATE TABLE enrolled(
    ID int NOT NULL AUTO_INCREMENT,
    classID int,
    studentID int,
    
    PRIMARY KEY(ID),
    UNIQUE(ID)
    )   
    
-- INSERT INTO loginInfo (personName,email,passcode)
-- VALUES ('Dylan', 'dbutz1@ocdsb.ca', 'monkeys');
