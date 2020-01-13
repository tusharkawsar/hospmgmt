DROP TABLE DOCPRESCRIBES;
DROP TABLE PDHISTORY;
DROP TABLE PDAPPOINT;
DROP TABLE PATIENTBED;
DROP TABLE PATIENT;
DROP TABLE BED;
DROP TABLE DOCSCHEDULE;
DROP TABLE NURSESCHEDULE;
DROP TABLE WARD;
DROP TABLE DOCTOR;
DROP TABLE PRES;
DROP TABLE MEDICINE;
DROP TABLE NURSE;
DROP TABLE EMPSCHEDULE;
DROP TABLE EMP;
DROP TABLE WORKPLACE;
DROP TABLE BLOCK;
DROP TABLE LOGIN;

CREATE TABLE PATIENT
(
	PID CHAR(4) CONSTRAINT PK_PATIENT PRIMARY KEY,
	NAME VARCHAR2(20),
	ADDRESS VARCHAR2(50),
	AGE NUMBER(3),
	PHONE VARCHAR2(15),
	BLOOD_GROUP CHAR(5),
	STATUS CHAR(10),
	EMAIL VARCHAR2(30),
	PTYPE CHAR(10)
);


CREATE TABLE DOCTOR
(
	DID CHAR(4) CONSTRAINT PK_DOCTOR PRIMARY KEY,
	NAME VARCHAR2(20),
	ADDRESS VARCHAR2(50),
	PHONE VARCHAR2(15),
	AGE NUMBER(3),
	STATUS CHAR(10),
	EMAIL VARCHAR2(30),
	QUALIFICATION VARCHAR2(50),
	SPECIALIZATION VARCHAR2(50),
	SALARY NUMBER(8, 2)
);

CREATE TABLE PDHISTORY
(
	PID CHAR(4),
	DID CHAR(4),
	STARTDATE DATE,
	ENDDATE DATE,
	SUMMARY VARCHAR2(200)
);
ALTER TABLE PDHISTORY ADD CONSTRAINT FK1_PDHISTORY FOREIGN KEY(PID) REFERENCES PATIENT(PID) ON DELETE SET NULL;
ALTER TABLE PDHISTORY ADD CONSTRAINT FK2_PDHISTORY FOREIGN KEY(DID) REFERENCES DOCTOR(DID) ON DELETE SET NULL;
ALTER TABLE PDHISTORY ADD CONSTRAINT PK_PDHISTORY PRIMARY KEY(PID, DID, STARTDATE);

CREATE TABLE PDAPPOINT
(
	PID CHAR(4),
	DID CHAR(4),
	APPOINTDATE DATE
);
ALTER TABLE PDAPPOINT ADD CONSTRAINT FK1_PDAPPOINT FOREIGN KEY(PID) REFERENCES PATIENT(PID) ON DELETE SET NULL;
ALTER TABLE PDAPPOINT ADD CONSTRAINT FK2_PDAPPOINT FOREIGN KEY(DID) REFERENCES DOCTOR(DID) ON DELETE SET NULL;
ALTER TABLE PDAPPOINT ADD CONSTRAINT PK_PDAPPOINT PRIMARY KEY(PID, DID, APPOINTDATE);


CREATE TABLE MEDICINE
(
	MEDID CHAR(6) CONSTRAINT PK_MEDICINE PRIMARY KEY,
	NAME VARCHAR2(20),
	PHARMACEUTICALNAME VARCHAR2(20),
	AMOUNT CHAR(10),
	MANUFACTURER CHAR(20),
	SUMMARY VARCHAR2(200)
);

CREATE TABLE PRES
(
	PRESID CHAR(7) CONSTRAINT PK_PRES PRIMARY KEY,
	MEDID CHAR(6),
	BEGINDATE DATE,
	NUMBERTAKEN CHAR(10),
	CMNT VARCHAR2(100),
	DURATION NUMBER,
	ENDDATE DATE
);
ALTER TABLE PRES ADD CONSTRAINT FK_PRES FOREIGN KEY(MEDID) REFERENCES MEDICINE(MEDID);


CREATE TABLE DOCPRESCRIBES 
(
	PID CHAR(4),
	DID CHAR(4),
	PRESID CHAR(7)		
);
ALTER TABLE DOCPRESCRIBES ADD CONSTRAINT FK1_DOCPRESCRIBES FOREIGN KEY(PID) REFERENCES PATIENT(PID) ON DELETE SET NULL;
ALTER TABLE DOCPRESCRIBES ADD CONSTRAINT FK2_DOCPRESCRIBES FOREIGN KEY(DID) REFERENCES DOCTOR(DID) ON DELETE SET NULL;
ALTER TABLE DOCPRESCRIBES ADD CONSTRAINT FK3_DOCPRESCRIBES FOREIGN KEY(PRESID) REFERENCES PRES(PRESID) ON DELETE SET NULL;
ALTER TABLE DOCPRESCRIBES ADD CONSTRAINT PK_DOCPRESCRIBES PRIMARY KEY (PID,DID,PRESID);


CREATE TABLE NURSE
(
	NID CHAR(4) CONSTRAINT PK_NURSE PRIMARY KEY,
	NAME VARCHAR2(20),
	ADDRESS VARCHAR2(50),
	AGE NUMBER(3),
	PHONE VARCHAR2(15),
	STATUS CHAR(10),
	EMAIL VARCHAR2(30),
	QUALIFICATION VARCHAR2(50),
	SALARY NUMBER(8, 2)
);

CREATE TABLE BLOCK
(
	BLOCKID CHAR(8) CONSTRAINT PK_BLOCK PRIMARY KEY,
	BLOCKTYPE VARCHAR2(10),
	NAME VARCHAR2(20),
	NUMBEROFWARDS NUMBER(2)
);


CREATE TABLE WARD
(
	WARDID CHAR(4) CONSTRAINT PK_WARD PRIMARY KEY,
	BLOCKID CHAR(8),
	WARDTYPE VARCHAR2(10),
	NAME VARCHAR2(20),
	NUMBEROFBEDS NUMBER(2)
);
ALTER TABLE WARD ADD CONSTRAINT FK_WARD FOREIGN KEY(BLOCKID) REFERENCES BLOCK(BLOCKID) ON DELETE SET NULL;

CREATE TABLE BED
(
	BEDID CHAR(6) CONSTRAINT PK_BEDID PRIMARY KEY,
	WARDID CHAR(4),
	RENT NUMBER(6, 2),
	BEDTYPE VARCHAR2(15)
);
ALTER TABLE BED ADD CONSTRAINT FK_BED FOREIGN KEY(WARDID) REFERENCES WARD(WARDID);


CREATE TABLE PATIENTBED
(
	PID CHAR(4),
	BEDID CHAR(6),
	STARTDATE DATE,
	ENDDATE DATE
);
ALTER TABLE PATIENTBED ADD CONSTRAINT PK_PATIENTBED PRIMARY KEY(PID, BEDID, STARTDATE);
ALTER TABLE PATIENTBED ADD CONSTRAINT FK1_PATIENTBED FOREIGN KEY(PID) REFERENCES PATIENT(PID) ON DELETE SET NULL;
ALTER TABLE PATIENTBED ADD CONSTRAINT FK2_PATIENTBED FOREIGN KEY(BEDID) REFERENCES BED(BEDID) ON DELETE SET NULL;


CREATE TABLE NURSESCHEDULE
(
	WARDID CHAR(4),
	NID CHAR(4),
	STARTDATE DATE,
	ENDDATE DATE
);
ALTER TABLE NURSESCHEDULE ADD CONSTRAINT FK1_NURSESCHEDULE FOREIGN KEY(WARDID) REFERENCES WARD(WARDID) ON DELETE SET NULL;
ALTER TABLE NURSESCHEDULE ADD CONSTRAINT FK2_NURSESCHEDULE FOREIGN KEY(NID) REFERENCES NURSE(NID) ON DELETE SET NULL;
ALTER TABLE NURSESCHEDULE ADD CONSTRAINT PK_NURSESCHEDULE PRIMARY KEY(WARDID, NID, STARTDATE);

CREATE TABLE DOCSCHEDULE
(
	WARDID CHAR(4),
	DID CHAR(4),
	STARTDATE DATE,
	ENDDATE DATE
);
ALTER TABLE DOCSCHEDULE ADD CONSTRAINT FK1_DOCSCHEDULE FOREIGN KEY(WARDID) REFERENCES WARD(WARDID) ON DELETE SET NULL;
ALTER TABLE DOCSCHEDULE ADD CONSTRAINT FK2_DOCSCHEDULE FOREIGN KEY(DID) REFERENCES DOCTOR(DID) ON DELETE SET NULL;
ALTER TABLE DOCSCHEDULE ADD CONSTRAINT PK_DOCSCHEDULE PRIMARY KEY(WARDID, DID, STARTDATE);

CREATE TABLE EMP
(
	EID CHAR(4) CONSTRAINT PK_EMP PRIMARY KEY,
	NAME VARCHAR2(20),
	ADDRESS VARCHAR2(50),
	PHONE VARCHAR2(15),
	AGE NUMBER(3),
	STATUS CHAR(10),
	EMAIL VARCHAR2(30),
	QUALIFICATION VARCHAR2(50),
	TYPE VARCHAR2(20),
	SALARY NUMBER(8, 2)
);

CREATE TABLE WORKPLACE
(
	PLACEID CHAR(8) CONSTRAINT PK_WORKPLACE PRIMARY KEY,
	PFLOOR NUMBER(2),
	NAME VARCHAR2(20),
	BLOCKID CHAR(10),			
	ROOMNUMBER NUMBER(3) 
);


CREATE TABLE EMPSCHEDULE
(
	PLACEID CHAR(8),
	EID CHAR(4),
	STARTDATE DATE,
	ENDDATE DATE
);
ALTER TABLE EMPSCHEDULE ADD CONSTRAINT FK1_EMPSCHEDULE FOREIGN KEY(PLACEID) REFERENCES WORKPLACE(PLACEID) ON DELETE SET NULL;
ALTER TABLE EMPSCHEDULE ADD CONSTRAINT FK2_EMPSCHEDULE FOREIGN KEY(EID) REFERENCES EMP(EID) ON DELETE SET NULL;
ALTER TABLE EMPSCHEDULE ADD CONSTRAINT PK_EMPSCHEDULE PRIMARY KEY(PLACEID, EID, STARTDATE);

CREATE TABLE LOGIN(
	USERNAME VARCHAR2(10) CONSTRAINT PK_PERSON PRIMARY KEY,
	PASSWORD VARCHAR2(12),
	TYPE VARCHAR2(10)
);