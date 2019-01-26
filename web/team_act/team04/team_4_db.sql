
CREATE TABLE Speaker(
    ID      SERIAL PRIMARY KEY,
    Name    varchar(80)
);


CREATE TABLE Talk(
    ID      SERIAL PRIMARY KEY,
    Name    varchar(80)
);


CREATE TABLE Sessions(
    ID           SERIAL PRIMARY KEY,
    DayofWeek    varchar(25),
    TimeofDay    varchar(25)
);


CREATE TABLE Delivered(
    ID          SERIAL PRIMARY KEY,
    Talk_ID     int REFERENCES Talk(ID),
    Speaker_ID  int REFERENCES Speaker(ID),
    Session_ID  int REFERENCES Sessions(ID),
    Year        varchar(4),
    Month       varchar(10)

);


CREATE TABLE Users(
    ID      SERIAL PRIMARY KEY,
    Name    varchar(80),
    Pass    varchar(80)
);


CREATE TABLE Notes(
    ID          SERIAL PRIMARY KEY,
    Talk_ID     int REFERENCES Talk(ID),
    User_ID     int REFERENCES Users(ID),
    Note        varchar(200)
);


-- show tables
\dt


-- Insert

--Speaker
INSERT INTO Speaker(Name) VALUES('Russell M. Nelson');
INSERT INTO Speaker(Name) VALUES('Henry B. Eyring');
INSERT INTO Speaker(Name) VALUES('Dallin H. Oaks');
INSERT INTO Speaker(Name) VALUES('Dieter F. Uchtdorf');

--Talk
INSERT INTO Talk(Name) VALUES('Opening Remarks'); --Nelson
INSERT INTO Talk(Name) VALUES('Tuth and the Plan'); --Oaks
INSERT INTO Talk(Name) VALUES('Try,Try,Try'); --Eyring

--Sessions
INSERT INTO Sessions(DayofWeek,TimeofDay) VALUES('Saturday','Morning'); --Saturday Morning
INSERT INTO Sessions(DayofWeek,TimeofDay) VALUES('Saturday','Afternoon'); --Saturday Afternoon
INSERT INTO Sessions(DayofWeek,TimeofDay) VALUES('Sunday','Morning'); --Sunday Morning
INSERT INTO Sessions(DayofWeek,TimeofDay) VALUES('Sunday','Afternoon'); --Sunday Afternoon

--dilvered
INSERT INTO Delivered(Talk_ID,Speaker_ID,Session_ID,Year,Month)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Opening Remarks'),
    (SELECT ID FROM Speaker WHERE Name = 'Russell M. Nelson'),
    (SELECT ID FROM Sessions WHERE DayofWeek = 'Saturday' AND TimeofDay = 'Morning'),
    '2018',
    'October'
);


INSERT INTO Delivered(Talk_ID,Speaker_ID,Session_ID,Year,Month)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Try,Try,Try'),
    (SELECT ID FROM Speaker WHERE Name = 'Henry B. Eyring'),
    (SELECT ID FROM Sessions WHERE DayofWeek = 'Sunday' AND TimeofDay = 'Afternoon'),
    '2018',
    'October'
);


INSERT INTO Delivered(Talk_ID,Speaker_ID,Session_ID,Year,Month)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Tuth and the Plan'),
    (SELECT ID FROM Speaker WHERE Name = 'Dallin H. Oaks'),
    (SELECT ID FROM Sessions WHERE DayofWeek = 'Saturday' AND TimeofDay = 'Morning'),
    '2018',
    'October'
);


--Users
INSERT INTO Users(Name,Pass)
VALUES('Bob','notaPassword');


INSERT INTO Users(Name,Pass)
VALUES('Harry','notaPassword');


INSERT INTO Users(Name,Pass)
VALUES('Luke','notaPassword');


--Notes

--Harry
INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Try,Try,Try'),
    (SELECT ID FROM Users WHERE Name = 'Harry'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Tuth and the Plan'),
    (SELECT ID FROM Users WHERE Name = 'Harry'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Opening Remarks'),
    (SELECT ID FROM Users WHERE Name = 'Harry'),
    'Great Talk!'
);


--Bob
INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Try,Try,Try'),
    (SELECT ID FROM Users WHERE Name = 'Bob'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Tuth and the Plan'),
    (SELECT ID FROM Users WHERE Name = 'Bob'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Opening Remarks'),
    (SELECT ID FROM Users WHERE Name = 'Bob'),
    'Great Talk!'
);


--Luke
INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Try,Try,Try'),
    (SELECT ID FROM Users WHERE Name = 'Luke'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Tuth and the Plan'),
    (SELECT ID FROM Users WHERE Name = 'Luke'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Opening Remarks'),
    (SELECT ID FROM Users WHERE Name = 'Luke'),
    'Great Talk!'
);


INSERT INTO Notes(Talk_ID,User_ID,Note)
VALUES(
    (SELECT ID FROM Talk WHERE Name = 'Opening Remarks'),
    (SELECT ID FROM Users WHERE Name = 'Luke'),
    'Best Talk ever!'
);


--Query

SELECT Talk.Name AS Talk, Speaker.Name AS Speaker, Users.Name AS User,
       Notes.Note
       FROM Notes
       JOIN Talk ON Notes.Talk_ID = Talk.ID
       JOIN Users ON Notes.User_ID = Users.ID
       JOIN Delivered ON Notes.Talk_ID = Delivered.Talk_ID
       JOIN Speaker ON Delivered.Speaker_ID = Speaker.ID;


SELECT Talk.Name AS Talk, Speaker.Name AS Speaker, Users.Name AS User,
       Notes.Note
       FROM Notes
       JOIN Talk ON Notes.Talk_ID = Talk.ID
       JOIN Users ON Notes.User_ID = Users.ID
       JOIN Delivered ON Notes.Talk_ID = Delivered.Talk_ID
       JOIN Speaker ON Delivered.Speaker_ID = Speaker.ID
       WHERE Talk.Name = 'Opening Remarks'
       AND Users.Name = 'Luke';





