CREATE TABLE Student (
    StudentID int NOT NULL,
    FirstName varchar(255),
    LastName varchar(255),
    DateOfBirth varchar(255),
    Email varchar(255),
    Phone varchar(255),
    PRIMARY KEY (StudentID)
    );

INSERT INTO Student (StudentID, FirstName, LastName, DateOfBirth, Email, Phone)
VALUES (01, "Joshua", "Hong", "December 17, 1990", "josh@gmail.com", "+639376537638");


 CREATE TABLE Course (
    CourseID INT PRIMARY KEY,
    CourseName varchar(255),
    Credits INT
    );
INSERT INTO Course (CourseID, CourseName, Credits)
VALUES (001, "BSIT", 3);

CREATE TABLE Instructor (
    InstructorID INT PRIMARY KEY,
    FirstName varchar(255),
    LastName varchar(255),
    Email varchar(255),
    Phone varchar(255)
    );
INSERT INTO Instructor (InstructorID, FirstName, LastName, Email, Phone) 
VALUES (11, "Leonard", "Reyes", "primusr@gmail.com", "+639874598374"); 

CREATE TABLE Enrollment (     
    EnrollmentID INT PRIMARY KEY,
    StudentID INT,       
    CourseID INT,                 
    EnrollmentDate DATE,
    Grade INT,
    FOREIGN KEY (StudentID) REFERENCES Student(StudentID),
    FOREIGN KEY (StudentID) REFERENCES Course(CourseID)   
    );


INSERT INTO Enrollment (EnrollmentID, StudentID, CourseID, EnrollmentDate, Grade)
(1, 01, 001, "2023-08-12", 99);