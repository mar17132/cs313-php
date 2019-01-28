
CREATE TABLE Computers(
    ID      SERIAL PRIMARY KEY,
    Name    VARCHAR(120),
    IP      VARCHAR(15)
);


CREATE TABLE PatchCycle(
    ID         SERIAL PRIMARY KEY,
    Name       VARCHAR(120),
    Note      VARCHAR(200)
);


CREATE TABLE PatchSchedlue(
    ID                 SERIAL PRIMARY KEY,
    Computer_ID        INT REFERENCES Computers(ID),
    PatchCycle_ID      INT REFERENCES PatchCycle(ID),
    PatchDate          DATE, -- yyy-mm-dd
    PatchTime          TIME  -- HH:MM:SS
);


--Inserts

--Computers
INSERT INTO Computers(Name,IP)
VALUES('Server1','192.168.99.25');


INSERT INTO Computers(Name,IP)
VALUES('Server2','192.168.99.33');


INSERT INTO Computers(Name,IP)
VALUES('webapp1','192.168.99.55');


INSERT INTO Computers(Name,IP)
VALUES('webapp3','192.168.99.66');


INSERT INTO Computers(Name,IP)
VALUES('adserver1','192.168.99.10');


INSERT INTO Computers(Name,IP)
VALUES('dnsserver2','192.168.99.22');


--Patch Cycles
INSERT INTO PatchCycle(Name,Note)
VALUES('Patch1','This will be patch 1');


INSERT INTO PatchCycle(Name,Note)
VALUES('Patch2','This will be patch 2');


INSERT INTO PatchCycle(Name,Note)
VALUES('Patch3','This will be patch 3');


--PatchSchedlue
INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'adserver1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-02-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-02-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server2'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch2'),
    '2018-04-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'webapp3'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch2'),
    '2018-04-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'dnsserver2'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch1'),
    '2018-05-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'webapp1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch1'),
    '2018-05-28',
    '07:00:00'
);



INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'adserver1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch1'),
    '2018-05-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-06-28',
    '07:00:00'
);



INSERT INTO PatchSchedlue(Computer_ID,PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'adserver1'),
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-06-28',
    '07:00:00'
);


