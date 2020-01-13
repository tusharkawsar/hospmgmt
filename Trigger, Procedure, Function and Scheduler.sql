CREATE OR REPLACE TRIGGER AUTO_INCR_PID
	BEFORE INSERT ON PATIENT
	FOR EACH ROW
	DECLARE
		MAXID CHAR(4);
		ID CHAR(4);
		NUM NUMBER;	
		CNT NUMBER;
	BEGIN
		SELECT COUNT(*) INTO CNT FROM PATIENT;
		IF CNT < 1 THEN
			ID := 'P001';
		ELSE
			SELECT PID INTO MAXID FROM PATIENT 
			WHERE TO_NUMBER(SUBSTR(PID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(PID, 2)) FROM PATIENT);
			SELECT TO_NUMBER(SUBSTR(PID, 2)) INTO NUM FROM PATIENT WHERE PID=MAXID;
			NUM := NUM+1;
			IF NUM<10 THEN
				ID := 'P00'||TO_CHAR(NUM);
			ELSIF NUM<100 THEN
				ID := 'P0'||TO_CHAR(NUM);
			ELSE
				ID := 'P'||TO_CHAR(NUM);
			END IF;
		END IF;
		:NEW.PID := ID;
	END;
/


CREATE OR REPLACE TRIGGER SET_PATIENT_STATUS
	BEFORE INSERT ON PATIENT
	FOR EACH ROW
	BEGIN
		:NEW.STATUS := 'CURRENT';
	END;
/


CREATE OR REPLACE TRIGGER AUTO_INCR_DID
	BEFORE INSERT ON DOCTOR
	FOR EACH ROW
	DECLARE
		MAXID CHAR(4);
		ID CHAR(4);
		NUM NUMBER;	
		CNT NUMBER;
	BEGIN
		SELECT COUNT(*) INTO CNT FROM DOCTOR;
		IF CNT < 1 THEN
			ID := 'D001';
		ELSE
			SELECT DID INTO MAXID FROM DOCTOR 
			WHERE TO_NUMBER(SUBSTR(DID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(DID, 2)) FROM DOCTOR);
			SELECT TO_NUMBER(SUBSTR(DID, 2)) INTO NUM FROM DOCTOR WHERE DID=MAXID;
			NUM := NUM+1;
			IF NUM<10 THEN
				ID := 'D00'||TO_CHAR(NUM);
			ELSIF NUM<100 THEN
				ID := 'D0'||TO_CHAR(NUM);
			ELSE
				ID := 'D'||TO_CHAR(NUM);
			END IF;
		END IF;
		:NEW.DID := ID;
	END;
/

CREATE OR REPLACE TRIGGER SET_DOCTOR_STATUS
	BEFORE INSERT ON DOCTOR
	FOR EACH ROW
	BEGIN
		:NEW.STATUS := 'CURRENT';
	END;
/


CREATE OR REPLACE TRIGGER FK1_PDHISTORY_UPDATE
	AFTER UPDATE OF PID ON PATIENT
	FOR EACH ROW
	BEGIN
		UPDATE PDHISTORY SET PDHISTORY.PID=:NEW.PID WHERE :OLD.PID=PDHISTORY.PID;
	END;
/


CREATE OR REPLACE TRIGGER FK2_PDHISTORY_UPDATE
	AFTER UPDATE OF DID ON DOCTOR
	FOR EACH ROW
	BEGIN
		UPDATE PDHISTORY SET PDHISTORY.DID=:NEW.DID WHERE :OLD.DID=PDHISTORY.DID;
	END;
/


CREATE OR REPLACE TRIGGER FK1_PDAPPOINT_UPDATE
	AFTER UPDATE OF PID ON PATIENT
	FOR EACH ROW
	BEGIN
		UPDATE PDAPPOINT SET PDAPPOINT.PID=:NEW.PID WHERE :OLD.PID=PDAPPOINT.PID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_PDAPPOINT_UPDATE
	AFTER UPDATE OF DID ON DOCTOR
	FOR EACH ROW
	BEGIN
		UPDATE PDAPPOINT SET PDAPPOINT.DID=:NEW.DID WHERE :OLD.DID=PDAPPOINT.DID;
	END;
/




CREATE OR REPLACE TRIGGER FK_PRES_UPDATE
	AFTER UPDATE OF MEDID ON MEDICINE
	FOR EACH ROW
	BEGIN
		UPDATE PRES SET PRES.MEDID=:NEW.MEDID WHERE :OLD.MEDID=PRES.MEDID;
	END;
/



CREATE OR REPLACE TRIGGER AUTO_INCR_PRESID
	BEFORE INSERT ON PRES
	FOR EACH ROW
	DECLARE
		MAXID CHAR(7);
		ID CHAR(7);
		NUM NUMBER;	
		CNT NUMBER;
	BEGIN
		SELECT COUNT(*) INTO CNT FROM PRES;
		IF CNT < 1 THEN
			ID := 'PRES001';
		ELSE
			SELECT PRESID INTO MAXID FROM PRES 
			WHERE TO_NUMBER(SUBSTR(PRESID, 5)) >= ALL(SELECT TO_NUMBER(SUBSTR(PRESID, 5)) FROM PRES);
			SELECT TO_NUMBER(SUBSTR(PRESID, 5)) INTO NUM FROM PRES WHERE PRESID=MAXID;
			NUM := NUM+1;
			IF NUM<10 THEN
				ID := 'PRES00'||TO_CHAR(NUM);
			ELSIF NUM<100 THEN
				ID := 'PRES0'||TO_CHAR(NUM);
			ELSE
				ID := 'PRES'||TO_CHAR(NUM);
			END IF;
		END IF;
		:NEW.PRESID := ID;
	END;
/



CREATE OR REPLACE TRIGGER FK1_DOCPRESCRIBES_UPDATE
	AFTER UPDATE OF PID ON PATIENT
	FOR EACH ROW
	BEGIN
		UPDATE DOCPRESCRIBES SET DOCPRESCRIBES.PID=:NEW.PID WHERE :OLD.PID=DOCPRESCRIBES.PID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_DOCPRESCRIBES_UPDATE
	AFTER UPDATE OF DID ON DOCTOR
	FOR EACH ROW
	BEGIN
		UPDATE DOCPRESCRIBES SET DOCPRESCRIBES.DID=:NEW.DID WHERE :OLD.DID=DOCPRESCRIBES.DID;
	END;
/


CREATE OR REPLACE TRIGGER AUTO_INCR_NID
	BEFORE INSERT ON NURSE
	FOR EACH ROW
	DECLARE
		MAXID CHAR(4);
		ID CHAR(4);
		NUM NUMBER;	
		CNT NUMBER;
	BEGIN
		SELECT COUNT(*) INTO CNT FROM NURSE;
		IF CNT < 1 THEN
			ID := 'N001';
		ELSE
			SELECT NID INTO MAXID FROM NURSE 
			WHERE TO_NUMBER(SUBSTR(NID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(NID, 2)) FROM NURSE);
			SELECT TO_NUMBER(SUBSTR(NID, 2)) INTO NUM FROM NURSE WHERE NID=MAXID;
			NUM := NUM+1;
			IF NUM<10 THEN
				ID := 'N00'||TO_CHAR(NUM);
			ELSIF NUM<100 THEN
				ID := 'N0'||TO_CHAR(NUM);
			ELSE
				ID := 'N'||TO_CHAR(NUM);
			END IF;
		END IF;
		:NEW.NID := ID;
	END;
/


CREATE OR REPLACE TRIGGER SET_NURSE_STATUS
	BEFORE INSERT ON NURSE
	FOR EACH ROW
	BEGIN
		:NEW.STATUS := 'CURRENT';
	END;
/


CREATE OR REPLACE TRIGGER FK_WARD_UPDATE
	AFTER UPDATE OF BLOCKID ON BLOCK
	FOR EACH ROW
	BEGIN
		UPDATE WARD SET WARD.BLOCKID=:NEW.BLOCKID WHERE :OLD.BLOCKID=WARD.BLOCKID;
	END;
/



CREATE OR REPLACE TRIGGER FK_BED_UPDATE
	AFTER UPDATE OF WARDID ON WARD
	FOR EACH ROW
	BEGIN
		UPDATE BED SET BED.WARDID=:NEW.WARDID WHERE :OLD.WARDID=BED.WARDID;
	END;
/


CREATE OR REPLACE TRIGGER FK1_PATIENTBED_UPDATE
	AFTER UPDATE OF PID ON PATIENT
	FOR EACH ROW
	BEGIN
		UPDATE PATIENTBED SET PATIENTBED.PID=:NEW.PID WHERE :OLD.PID=PATIENTBED.PID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_PATIENTBED_UPDATE
	AFTER UPDATE OF BEDID ON BED
	FOR EACH ROW
	BEGIN
		UPDATE PATIENTBED SET PATIENTBED.BEDID=:NEW.BEDID WHERE :OLD.BEDID=PATIENTBED.BEDID;
	END;
/




CREATE OR REPLACE TRIGGER MAKE_BED_AVAILABLE
	AFTER UPDATE OF STATUS ON PATIENT
	FOR EACH ROW
	DECLARE
		BEDID1 CHAR(6);
	BEGIN
		SELECT BEDID INTO BEDID1 FROM PATIENTBED WHERE PID=:NEW.PID AND ENDDATE IS NULL;
		IF :NEW.STATUS='FORMER' AND :OLD.STATUS='CURRENT' THEN
			UPDATE BED SET BEDTYPE='AVAILABLE' WHERE BEDID=BEDID1;
			UPDATE PATIENTBED SET ENDDATE=SYSDATE WHERE PID=:NEW.PID AND ENDDATE IS NULL;
			UPDATE PDHISTORY SET ENDDATE=SYSDATE WHERE PID=:NEW.PID AND ENDDATE IS NULL;
		END IF;
	END;
/

CREATE OR REPLACE TRIGGER MAKE_BED_UNAVAILABLE
	AFTER INSERT ON PATIENTBED
	FOR EACH ROW
	BEGIN
		UPDATE BED SET BEDTYPE='NOT AVAILABLE' WHERE BED.BEDID=:NEW.BEDID;
		UPDATE PATIENT SET PTYPE='INDOOR' WHERE PATIENT.PID=:NEW.PID;
	END;
/


CREATE OR REPLACE TRIGGER FK1_NURSESCHEDULE_UPDATE
	AFTER UPDATE OF WARDID ON WARD
	FOR EACH ROW
	BEGIN
		UPDATE NURSESCHEDULE SET NURSESCHEDULE.WARDID=:NEW.WARDID WHERE :OLD.WARDID=NURSESCHEDULE.WARDID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_NURSESCHEDULE_UPDATE
	AFTER UPDATE OF NID ON NURSE
	FOR EACH ROW
	BEGIN
		UPDATE NURSESCHEDULE SET NURSESCHEDULE.NID=:NEW.NID WHERE :OLD.NID=NURSESCHEDULE.NID;
	END;
/


CREATE OR REPLACE TRIGGER FK1_DOCSCHEDULE_UPDATE
	AFTER UPDATE OF WARDID ON WARD
	FOR EACH ROW
	BEGIN
		UPDATE DOCSCHEDULE SET DOCSCHEDULE.WARDID=:NEW.WARDID WHERE :OLD.WARDID=DOCSCHEDULE.WARDID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_DOCSCHEDULE_UPDATE
	AFTER UPDATE OF DID ON DOCTOR
	FOR EACH ROW
	BEGIN
		UPDATE DOCSCHEDULE SET DOCSCHEDULE.DID=:NEW.DID WHERE :OLD.DID=DOCSCHEDULE.DID;
	END;
/


CREATE OR REPLACE TRIGGER AUTO_INCR_EID
	BEFORE INSERT ON EMP
	FOR EACH ROW
	DECLARE
		MAXID CHAR(4);
		ID CHAR(4);
		NUM NUMBER;	
		CNT NUMBER;
	BEGIN
		SELECT COUNT(*) INTO CNT FROM EMP;
		IF CNT < 1 THEN
			ID := 'E001';
		ELSE
			SELECT EID INTO MAXID FROM EMP 
			WHERE TO_NUMBER(SUBSTR(EID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(EID, 2)) FROM EMP);
			SELECT TO_NUMBER(SUBSTR(EID, 2)) INTO NUM FROM EMP WHERE EID=MAXID;
			NUM := NUM+1;
			IF NUM<10 THEN
				ID := 'E00'||TO_CHAR(NUM);
			ELSIF NUM<100 THEN
				ID := 'E0'||TO_CHAR(NUM);
			ELSE
				ID := 'E'||TO_CHAR(NUM);
			END IF;
		END IF;
		:NEW.EID := ID;
	END;
/

CREATE OR REPLACE TRIGGER SET_EMP_STATUS
	BEFORE INSERT ON EMP
	FOR EACH ROW
	BEGIN
		:NEW.STATUS := 'CURRENT';
	END;
/

CREATE OR REPLACE TRIGGER FK1_EMPSCHEDULE_UPDATE
	AFTER UPDATE OF PLACEID ON WORKPLACE
	FOR EACH ROW
	BEGIN
		UPDATE EMPSCHEDULE SET EMPSCHEDULE.PLACEID=:NEW.PLACEID WHERE :OLD.PLACEID=EMPSCHEDULE.PLACEID;
	END;
/

CREATE OR REPLACE TRIGGER FK2_EMPSCHEDULE_UPDATE
	AFTER UPDATE OF EID ON EMP
	FOR EACH ROW
	BEGIN
		UPDATE EMPSCHEDULE SET EMPSCHEDULE.EID=:NEW.EID WHERE :OLD.EID=EMPSCHEDULE.EID;
	END;
/


CREATE OR REPLACE PROCEDURE P_UNDER_DID(DID1 CHAR) AS
	CURSOR CRSR IS SELECT DISTINCT PID FROM PDHISTORY WHERE DID=DID1;
	DNAME VARCHAR2(20);
	BEGIN
		SELECT NAME INTO DNAME FROM DOCTOR WHERE DID=DID1;
		DBMS_OUTPUT.PUT_LINE('ALL PATIENTS UNDER DOCTOR '||DNAME||' ARE: ');
		FOR I IN CRSR LOOP
			DBMS_OUTPUT.PUT_LINE(I.PID);
		END LOOP;
	END;
/


CREATE OR REPLACE PROCEDURE CURRENT_P_UNDER_DID(DID1 CHAR) AS
	CURSOR CRSR IS SELECT DISTINCT PID FROM PDHISTORY WHERE DID=DID1 AND ENDDATE IS NULL;
	DNAME VARCHAR2(20);
	BEGIN
		SELECT NAME INTO DNAME FROM DOCTOR WHERE DID=DID1;
		DBMS_OUTPUT.PUT_LINE('ALL PATIENTS UNDER DOCTOR '||DNAME||' ARE: ');
		FOR I IN CRSR LOOP
			DBMS_OUTPUT.PUT_LINE(I.PID);
		END LOOP;
	END;
/



CREATE OR REPLACE PROCEDURE P_UNDER_DNAME(DNAME VARCHAR2) AS
	CURSOR CRSR IS SELECT DISTINCT PID FROM PDHISTORY, DOCTOR 
	WHERE PDHISTORY.DID=DOCTOR.DID AND DOCTOR.NAME LIKE '%'||DNAME||'%';
	BEGIN
		DBMS_OUTPUT.PUT_LINE('ALL PATIENTS UNDER DOCTOR '||DNAME||' ARE: ');
		FOR I IN CRSR LOOP
			DBMS_OUTPUT.PUT_LINE(I.PID);
		END LOOP;
	END;
/


CREATE OR REPLACE PROCEDURE SIMUL_P_UNDER_DID(DID1 CHAR, STARTDATE1 DATE) AS
	CURSOR CRSR IS SELECT DISTINCT PID FROM PDHISTORY WHERE DID=DID1;
	DNAME VARCHAR2(20);
	BEGIN
		SELECT NAME INTO DNAME FROM DOCTOR WHERE DID=DID1;
		DBMS_OUTPUT.PUT_LINE('ALL PATIENTS UNDER DOCTOR '||DNAME||' STARTING ON '||TO_CHAR(STARTDATE1)||' ARE: ');
		FOR I IN CRSR LOOP
			DBMS_OUTPUT.PUT_LINE(I.PID);
		END LOOP;
	END;
/


CREATE OR REPLACE PROCEDURE INSERT_PATIENT(NAME1 VARCHAR2) AS
	MAXID CHAR(4);
	ID CHAR(4);
	DNAME VARCHAR2(20);
	NUM NUMBER;
	BEGIN
		SELECT PID INTO MAXID FROM PATIENT 
		WHERE TO_NUMBER(SUBSTR(PID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(PID, 2)) FROM PATIENT);
		SELECT TO_NUMBER(SUBSTR(PID, 2)) INTO NUM FROM PATIENT WHERE PID=MAXID;
		NUM := NUM+1;
		IF NUM<10 THEN
			ID := 'P00'||TO_CHAR(NUM);
		ELSIF NUM<100 THEN
			ID := 'P0'||TO_CHAR(NUM);
		ELSE
			ID := 'P'||TO_CHAR(NUM);
		END IF;
		INSERT INTO PATIENT(PID, NAME) VALUES(ID, NAME1);
	END;
/


CREATE OR REPLACE PROCEDURE INSERT_PATIENT(NAME1 VARCHAR2) AS
	MAXID CHAR(4);
	ID CHAR(4);
	DNAME VARCHAR2(20);
	NUM NUMBER;
	BEGIN
		SELECT PID INTO MAXID FROM PATIENT 
		WHERE TO_NUMBER(SUBSTR(PID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(PID, 2)) FROM PATIENT);
		SELECT TO_NUMBER(SUBSTR(PID, 2)) INTO NUM FROM PATIENT WHERE PID=MAXID;
		NUM := NUM+1;
		IF NUM<10 THEN
			ID := 'P00'||TO_CHAR(NUM);
		ELSIF NUM<100 THEN
			ID := 'P0'||TO_CHAR(NUM);
		ELSE
			ID := 'P'||TO_CHAR(NUM);
		END IF;
		INSERT INTO PATIENT(PID, NAME) VALUES(ID, NAME1);
	END;
/


CREATE OR REPLACE PROCEDURE INSERT_DOCTOR(NAME1 VARCHAR2) AS
	MAXID CHAR(4);
	ID CHAR(4);
	DNAME VARCHAR2(20);
	NUM NUMBER;
	BEGIN
		SELECT DID INTO MAXID FROM DOCTOR 
		WHERE TO_NUMBER(SUBSTR(DID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(DID, 2)) FROM DOCTOR);
		SELECT TO_NUMBER(SUBSTR(DID, 2)) INTO NUM FROM DOCTOR WHERE DID=MAXID;
		NUM := NUM+1;
		IF NUM<10 THEN
			ID := 'D00'||TO_CHAR(NUM);
		ELSIF NUM<100 THEN
			ID := 'D0'||TO_CHAR(NUM);
		ELSE
			ID := 'D'||TO_CHAR(NUM);
		END IF;
		INSERT INTO DOCTOR(DID, NAME) VALUES(ID, NAME1);
	END;
/



CREATE OR REPLACE PROCEDURE INSERT_NURSE(NAME1 VARCHAR2) AS
	MAXID CHAR(4);
	ID CHAR(4);
	NNAME VARCHAR2(20);
	NUM NUMBER;
	BEGIN
		SELECT NID INTO MAXID FROM NURSE 
		WHERE TO_NUMBER(SUBSTR(NID, 2)) >= ALL(SELECT TO_NUMBER(SUBSTR(NID, 2)) FROM NURSE);
		SELECT TO_NUMBER(SUBSTR(NID, 2)) INTO NUM FROM NURSE WHERE NID=MAXID;
		NUM := NUM+1;
		IF NUM<10 THEN
			ID := 'N00'||TO_CHAR(NUM);
		ELSIF NUM<100 THEN
			ID := 'N0'||TO_CHAR(NUM);
		ELSE
			ID := 'N'||TO_CHAR(NUM);
		END IF;
		INSERT INTO NURSE(NID, NAME) VALUES(ID, NAME1);
	END;
/



BEGIN
  DBMS_SCHEDULER.CREATE_JOB (
    JOB_NAME        => 'TEST_FULL_JOB_DEFINITION1',
    JOB_TYPE        => 'PLSQL_BLOCK',
    JOB_ACTION      => 'BEGIN FOR I IN (SELECT * FROM BED) LOOP UPDATE BED SET RENT=RENT*1.1 WHERE I.BEDID=BED.BEDID END FOR; FOR I IN (SELECT * FROM DOCTOR) LOOP UPDATE DOCTOR SET SALARY=SALARY*1.1 WHERE I.DID=DOCTOR.DID END FOR; FOR I IN (SELECT * FROM NURSE) LOOP UPDATE NURSE SET SALARY=SALARY*1.1 WHERE I.NID=NURSE.NID END FOR; END;',
    START_DATE      => SYSTIMESTAMP,
    REPEAT_INTERVAL => 'FREQ=YEARLY; BYMONTH=DEC; BYMONTHDAY=31;',
    END_DATE        => NULL,
    ENABLED         => TRUE,
    COMMENTS        => 'JOB DEFINED ENTIRELY BY THE CREATE JOB PROCEDURE; EXECUTES ON A YEARLY BASIS');
END;
/

BEGIN
  DBMS_SCHEDULER.CREATE_JOB (
    JOB_NAME        => 'TEST_FULL_JOB_DEFINITION4',
    JOB_TYPE        => 'PLSQL_BLOCK',
    JOB_ACTION      => 'BEGIN INSERT INTO DATETEST VALUES(SYSTIME); DBMS_OUTPUT.PUT_LINE(SYSTIME); END; /',
    START_DATE      => SYSTIMESTAMP,
    REPEAT_INTERVAL => 'FREQ=MINUTELY;INTERVAL=5;',
    END_DATE        => NULL,
    ENABLED         => TRUE,
    COMMENTS        => 'JOB DEFINED ENTIRELY BY THE CREATE JOB PROCEDURE; EXECUTES ON A YEARLY BASIS');
END;
/