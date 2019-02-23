
CREATE TABLE Computers(
    ID      SERIAL PRIMARY KEY,
    Name    VARCHAR(120),
    IP      VARCHAR(15)
);


CREATE TABLE PatchCycle(
    ID       SERIAL PRIMARY KEY,
    Name     VARCHAR(120),
    Note     VARCHAR(200)
);


CREATE TABLE PatchSchedlue(
    ID                 SERIAL PRIMARY KEY,
    PatchCycle_ID      INT REFERENCES PatchCycle(ID),
    PatchDate          DATE, -- yyy-mm-dd
    PatchTime          TIME   -- HH:MM:SS
);


CREATE TABLE Patching(
    ID                 SERIAL PRIMARY KEY,
    Computers_id       INT REFERENCES Computers(ID),
    PatchSchedlue_id   INT REFERENCES PatchSchedlue(ID)
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
INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-02-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch2'),
    '2018-04-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch1'),
    '2018-05-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2018-06-28',
    '07:00:00'
);


INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2019-02-26',
    '07:00:00'
);


INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch3'),
    '2019-03-28',
    '07:00:00'
);

INSERT INTO PatchSchedlue(PatchCycle_ID,PatchDate,PatchTime)
VALUES(
    (SELECT ID FROM PatchCycle WHERE Name = 'Patch1'),
    '2019-03-15',
    '07:00:00'
);

--Patching

--Patch 1
INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch1')
     AND PatchSchedlue.PatchDate = '2018-05-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch1')
     AND PatchSchedlue.PatchDate = '2019-03-15')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'webapp1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch1')
     AND PatchSchedlue.PatchDate = '2018-05-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'dnsserver2'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch1')
     AND PatchSchedlue.PatchDate = '2018-05-28')
);

--Patch 2
INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch2')
     AND PatchSchedlue.PatchDate = '2018-04-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'webapp3'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch2')
     AND PatchSchedlue.PatchDate = '2018-04-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'adserver1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch2')
     AND PatchSchedlue.PatchDate = '2018-04-28')
);

--Patch 3
INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2018-06-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2019-02-26')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2019-03-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server2'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2018-06-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server1'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2018-02-28')
);


INSERT INTO Patching(Computers_id,PatchSchedlue_id)
VALUES(
    (SELECT ID FROM Computers WHERE Name = 'Server2'),
    (SELECT PatchSchedlue.ID FROM PatchSchedlue
     WHERE PatchSchedlue.PatchCycle_ID =(SELECT ID FROM
     PatchCycle WHERE Name = 'Patch3')
     AND PatchSchedlue.PatchDate = '2018-02-28')
);

--Query

SELECT * FROM PatchCycle;

--Display All patchcycles by date
SELECT PatchSchedlue.ID AS scheduleID,PatchSchedlue.patchdate,
       PatchSchedlue.patchtime,PatchCycle.Name,PatchCycle.ID AS patchID
FROM PatchSchedlue
JOIN PatchCycle ON PatchSchedlue.PatchCycle_ID = PatchCycle.ID
ORDER BY PatchSchedlue.patchdate;

--Display All patchcycles by date from a certain month and year
SELECT PatchSchedlue.ID AS scheduleID,
			EXTRACT(YEAR FROM PatchSchedlue.patchdate) AS YEAR,
			EXTRACT(MONTH FROM PatchSchedlue.patchdate) AS MONTH,
			EXTRACT(DAY FROM PatchSchedlue.patchdate) AS DAY,
			PatchSchedlue.patchtime,PatchCycle.Name,
			PatchCycle.ID AS patchID
FROM PatchSchedlue
JOIN PatchCycle ON PatchSchedlue.PatchCycle_ID = PatchCycle.ID
WHERE EXTRACT(MONTH FROM PatchSchedlue.patchdate) = '05'
AND EXTRACT(YEAR FROM PatchSchedlue.patchdate) ='2018';


SELECT * FROM Computers WHERE Name ='%1%' OR IP = '%1%';


SELECT DISTINCT PatchCycle.ID, PatchCycle.Name
FROM Patching
JOIN PatchSchedlue ON PatchSchedlue.ID = Patching.PatchSchedlue_id
JOIN PatchCycle ON PatchCycle.ID = PatchSchedlue.PatchCycle_ID
WHERE Patching.Computers_id ='$serverID';


SELECT DISTINCT Computers.ID, Computers.Name
FROM Patching
JOIN Computers ON Computers.ID = Patching.Computers_id
JOIN PatchSchedlue ON PatchSchedlue.ID = Patching.PatchSchedlue_id
WHERE PatchSchedlue.PatchCycle_ID ='$patchID';

