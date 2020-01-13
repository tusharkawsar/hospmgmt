drop table docprescribes;
drop table pdhistory;
drop table patientbed;
drop table patient;
drop table bed;
drop table docschedule;
drop table nurseschedule;
drop table ward;
drop table doctor;
drop table pres;
drop table medicine;
drop table nurse;
drop table empschedule;
drop table emp;
drop table workplace;
drop table block;









create table patient
(
	pid char(4) constraint pk_patient primary key,
	pass varchar2(15),
	name varchar2(20),
	address varchar2(50),
	age number(3),
	phone number(15),
	blood_group char(4),
	status char(10),
	email varchar2(30),
	ptype char(10),
	due number(10, 2)
);
insert into patient values('p001', 'p001', 'A', 'Elephant Road', 31, 01682980422, 'A+ve', 'current', 'a@a.com', 'indoor', 0.0);
insert into patient values('p002', 'p002', 'A', 'Elephant Road', 31, 01682980422, 'A+ve', 'current', 'a@a.com', 'indoor', 0.0);
insert into patient values('p003', 'p003', 'A', 'Elephant Road', 31, 01682980422, 'A+ve', 'current', 'a@a.com', 'indoor', 0.0);
insert into patient values('p004', 'p004', 'A', 'Elephant Road', 31, 01682980422, 'A+ve', 'current', 'a@a.com', 'indoor', 0.0);
insert into patient values('p005', 'p005', 'A', 'Elephant Road', 31, 01682980422, 'A+ve', 'current', 'a@a.com', 'indoor', 0.0);




create table doctor
(
	did char(4) constraint pk_doctor primary key,
	pass varchar2(15),
	name varchar2(20),
	address varchar2(50),
	phone number(15),
	age number(3),
	status char(10),
	email varchar2(30),
	qualification varchar2(50),
	specialization varchar2(50),
	salary number(8, 2)
);
insert into doctor values('d001', 'd001', 'Dr. A', 'Elephant Road', 01682980423, 31, 'current', 'a@a.com', 'MBBS', 'heart', 20000);
insert into doctor values('d002', 'd002', 'Dr. B', 'Elephant Road', 01682980424, 31, 'current', 'a@a.com', 'MBBS', 'heart', 20000);
insert into doctor values('d003', 'd003', 'Dr. C', 'Elephant Road', 01682980425, 31, 'current', 'a@a.com', 'MBBS', 'heart', 20000);
insert into doctor values('d004', 'd004', 'Dr. D', 'Elephant Road', 01682980426, 31, 'current', 'a@a.com', 'MBBS', 'heart', 20000);
insert into doctor values('d005', 'd005', 'Dr. E', 'Elephant Road', 01682980427, 31, 'onleave', 'a@a.com', 'MBBS', 'heart', 20000);



create table pdhistory
(
	summary varchar2(200),
	pid char(4),
	did char(4),
	startdate date,
	enddate date
);
alter table pdhistory add constraint fk1_pdhistory foreign key(pid) references patient(pid) on delete set null;
alter table pdhistory add constraint fk2_pdhistory foreign key(did) references doctor(did) on delete set null;
alter table pdhistory add constraint pk_pdhistory primary key(pid, did, startdate);

insert into pdhistory(pid, did, startdate, enddate) values('p001', 'd001', '16-mar-2014', null);
insert into pdhistory(pid, did, startdate, enddate) values('p001', 'd001', '06-mar-2013', '26-mar-2013');
insert into pdhistory(pid, did, startdate, enddate) values('p001', 'd002', '16-mar-2004', null);
insert into pdhistory(pid, did, startdate, enddate) values('p002', 'd002', '16-mar-1994', null);
insert into pdhistory(pid, did, startdate, enddate) values('p003', 'd003', '16-jan-2014', null);

create or replace trigger fk1_pdhistory_update
	after update of pid on patient
	for each row
	begin
		update pdhistory set pdhistory.pid=:new.pid where :old.pid=pdhistory.pid;
	end;
/

create or replace trigger fk2_pdhistory_update
	after update of did on doctor
	for each row
	begin
		update pdhistory set pdhistory.did=:new.did where :old.did=pdhistory.did;
	end;
/




create table medicine
(
	medid char(6) constraint pk_medicine primary key,
	name varchar2(20),
	pharmaceuticalname varchar2(20),
	amount char(10),
	manufacturer char(10),
	summary varchar2(200)
);
insert into medicine(medid,name,pharmaceuticalname,amount,manufacturer) 
	values ('med001','Napa','Paracitamol BP','10mg','Beximco');
insert into medicine(medid,name,pharmaceuticalname,amount,manufacturer) 
	values('med002','Ace','Paracitamol BP','5mg','ACI');
insert into medicine(medid,name,pharmaceuticalname,amount,manufacturer)
    values('med003','Histacin','Histacin','50mg','AAA');






create table pres
(
	presid char(7) constraint pk_pres primary key,
	dosage char(10),
	numbertaken char(10),
	cmnt varchar2(100),
	duration char(10),
	begindate date,
	medid char(6)
);
alter table pres add constraint fk_pres foreign key(medid) references medicine(medid);

insert into pres(presid, medid, dosage, duration, begindate,numbertaken) 
	values('pres001', 'med001','1+0+1','7','21-JAN-2014','1');
insert into pres(presid, medid, dosage, duration, begindate,numbertaken) 
	values('pres002', 'med002','1+0+1','7','21-JAN-2014','1');
insert into pres(presid, medid, dosage, duration, begindate,numbertaken) 
	values('pres003', 'med003','1+0+1','7','21-JAN-2014','1');
insert into pres(presid, medid, dosage, duration, begindate,numbertaken) 
	values('pres004', 'med001','1+0+1','7','21-JAN-2014','1');
insert into pres(presid, medid, dosage, duration, begindate,numbertaken) 
	values('pres005', 'med002','1+0+1','7','21-JAN-2014','1');


create or replace trigger fk_pres_update
	after update of medid on medicine
	for each row
	begin
		update pres set pres.medid=:new.medid where :old.medid=pres.medid;
	end;
/




create table docprescribes 
(
	pid char(4),
	did char(4),
	presid char(7)		
);
alter table docprescribes add constraint fk1_docprescribes foreign key(pid) references patient(pid) on delete set null;
alter table docprescribes add constraint fk2_docprescribes foreign key(did) references doctor(did) on delete set null;
alter table docprescribes add constraint fk3_docprescribes foreign key(presid) references pres(presid) on delete set null;
alter table docprescribes add constraint pk_docPrescribes primary key (pid,did,presid);


insert into docprescribes values('p001', 'd001', 'pres001');
insert into docprescribes values('p001', 'd002', 'pres002');
insert into docprescribes values('p002', 'd002', 'pres003');


create or replace trigger fk1_docprescribes_update
	after update of pid on patient
	for each row
	begin
		update docprescribes set docprescribes.pid=:new.pid where :old.pid=docprescribes.pid;
	end;
/

create or replace trigger fk2_docprescribes_update
	after update of did on doctor
	for each row
	begin
		update docprescribes set docprescribes.did=:new.did where :old.did=docprescribes.did;
	end;
/



create table nurse
(
	nid char(4) constraint pk_nurse primary key,
	pass varchar2(15),
	name varchar2(20),
	address varchar2(50),
	age number(3),
	phone number(15),
	status char(10),
	email varchar2(30),
	qualification varchar2(50),
	salary number(8, 2)
);
insert into nurse(nid, pass) values('n001', 'n001');
insert into nurse(nid, pass) values('n002', 'n002');
insert into nurse(nid, pass) values('n003', 'n003');





create table block
(
	blockid char(8) constraint pk_block primary key,
	blocktype varchar2(10),
	name varchar2(20),
	numberofwards number(2)
);
insert into block(blockid) values('block001');
insert into block(blockid) values('block002');
insert into block(blockid) values('block003');


create table ward
(
	wardid char(4) constraint pk_ward primary key,
	blockid char(8),
	wardtype varchar2(10),
	name varchar2(20),
	numberofbeds number(2)
);
alter table ward add constraint fk_ward foreign key(blockid) references block(blockid) on delete set null;

insert into ward(wardid, blockid) values('w001', 'block001');
insert into ward(wardid, blockid) values('w002', 'block001');
insert into ward(wardid, blockid) values('w003', 'block002');

create or replace trigger fk_ward_update
	after update of blockid on block
	for each row
	begin
		update ward set ward.blockid=:new.blockid where :old.blockid=ward.blockid;
	end;
/


create table bed
(
	bedid char(6) constraint pk_bedid primary key,
	wardid char(4),
	rent number(6, 2),
	bedtype varchar2(10)
);
alter table bed add constraint fk_bed foreign key(wardid) references ward(wardid);

insert into bed(bedid, wardid) values('bed001', 'w001');
insert into bed(bedid, wardid) values('bed002', 'w001');
insert into bed(bedid, wardid) values('bed003', 'w002');

create or replace trigger fk_bed_update
	after update of wardid on ward
	for each row
	begin
		update bed set bed.wardid=:new.wardid where :old.wardid=bed.wardid;
	end;
/


create table patientbed
(
	pid char(4),
	bedid char(6),
	startdate date,
	enddate date
);
alter table patientbed add constraint pk_patientbed primary key(pid, bedid, startdate);
alter table patientbed add constraint fk1_patientbed foreign key(pid) references patient(pid) on delete set null;
alter table patientbed add constraint fk2_patientbed foreign key(bedid) references bed(bedid) on delete set null;

insert into patientbed(pid, bedid, startdate) values('p001', 'bed001', '16-mar-2014');
insert into patientbed(pid, bedid, startdate) values('p001', 'bed002', '14-mar-2014');
insert into patientbed(pid, bedid, startdate) values('p002', 'bed002', '16-mar-2014');
insert into patientbed(pid, bedid, startdate) values('p002', 'bed002', '20-mar-2014');

create or replace trigger fk1_patientbed_update
	after update of pid on patient
	for each row
	begin
		update patientbed set patientbed.pid=:new.pid where :old.pid=patientbed.pid;
	end;
/

create or replace trigger fk2_patientbed_update
	after update of bedid on bed
	for each row
	begin
		update patientbed set patientbed.bedid=:new.bedid where :old.bedid=patientbed.bedid;
	end;
/



create table nurseschedule
(
	wardid char(4),
	nid char(4),
	startdate date,
	enddate date
);
alter table nurseschedule add constraint fk1_nurseschedule foreign key(wardid) references ward(wardid) on delete set null;
alter table nurseschedule add constraint fk2_nurseschedule foreign key(nid) references nurse(nid) on delete set null;
alter table nurseschedule add constraint pk_nurseschedule primary key(wardid, nid, startdate);

insert into nurseschedule values('w001', 'n001', '16-mar-2014', null);
insert into nurseschedule values('w001', 'n002', '16-mar-2014', null);
insert into nurseschedule values('w002', 'n002', '15-mar-2014', null);

create or replace trigger fk1_nurseschedule_update
	after update of wardid on ward
	for each row
	begin
		update nurseschedule set nurseschedule.wardid=:new.wardid where :old.wardid=nurseschedule.wardid;
	end;
/

create or replace trigger fk2_nurseschedule_update
	after update of nid on nurse
	for each row
	begin
		update nurseschedule set nurseschedule.nid=:new.nid where :old.nid=nurseschedule.nid;
	end;
/



create table docschedule
(
	wardid char(4),
	did char(4),
	startdate date,
	enddate date
);
alter table docschedule add constraint fk1_docschedule foreign key(wardid) references ward(wardid) on delete set null;
alter table docschedule add constraint fk2_docschedule foreign key(did) references doctor(did) on delete set null;
alter table docschedule add constraint pk_docschedule primary key(wardid, did, startdate);

insert into docschedule values('w001', 'd001', '16-mar-2014', null);
insert into docschedule values('w001', 'd002', '16-mar-2014', null);
insert into docschedule values('w002', 'd002', '15-mar-2014', null);

create or replace trigger fk1_docschedule_update
	after update of wardid on ward
	for each row
	begin
		update docschedule set docschedule.wardid=:new.wardid where :old.wardid=docschedule.wardid;
	end;
/

create or replace trigger fk2_docschedule_update
	after update of did on doctor
	for each row
	begin
		update docschedule set docschedule.did=:new.did where :old.did=docschedule.did;
	end;
/



create table emp
(
	eid char(4) constraint pk_emp primary key,
	pass varchar2(15),
	name varchar2(20),
	address varchar2(50),
	phone number(7),
	age number(3),
	status char(10),
	email varchar2(30),
	qualification varchar2(50),
	type varchar2(10),
	salary number(8, 2)
);
insert into emp(eid) values('e001');
insert into emp(eid) values('e002');
insert into emp(eid) values('e003');



create table workplace
(
	placeid char(8) constraint pk_workplace primary key,
	pfloor number(2),
	name varchar2(20),
	blockID char(10),			
	roomnumber number(3) 
);
insert into workplace(placeid) values('place001');
insert into workplace(placeid) values('place002');
insert into workplace(placeid) values('place003');



create table empschedule
(
	placeid char(8),
	eid char(4),
	startdate date,
	enddate date
);
alter table empschedule add constraint fk1_empschedule foreign key(placeid) references workplace(placeid) on delete set null;
alter table empschedule add constraint fk2_empschedule foreign key(eid) references emp(eid) on delete set null;
alter table empschedule add constraint pk_empschedule primary key(placeid, eid, startdate);

insert into empschedule values('place001', 'e001', '16-mar-2014', null);
insert into empschedule values('place001', 'e002', '16-mar-2014', null);
insert into empschedule values('place002', 'e002', '15-mar-2014', null);

create or replace trigger fk1_empschedule_update
	after update of placeid on workplace
	for each row
	begin
		update empschedule set empschedule.placeid=:new.placeid where :old.placeid=empschedule.placeid;
	end;
/

create or replace trigger fk2_empschedule_update
	after update of eid on emp
	for each row
	begin
		update empschedule set empschedule.eid=:new.eid where :old.eid=empschedule.eid;
	end;
/







create table login
(
	id varchar2(8) constraint login primary key,
	pass varchar2(15),
	type char(1)
);
insert into login values('p001', 'p001', 'p');
insert into login values('p002', 'p002', 'p');
insert into login values('p003', 'p003', 'p');
insert into login values('p004', 'p004', 'p');
insert into login values('p005', 'p005', 'p');
insert into login values('d001', 'd001', 'd');
insert into login values('d002', 'd002', 'd');
insert into login values('d003', 'd003', 'd');
insert into login values('d004', 'd004', 'd');
insert into login values('d005', 'd005', 'd');
insert into login values('n001', 'n001', 'n');
insert into login values('n001', 'n001', 'n');
insert into login values('n001', 'n001', 'n');
insert into login values('e001', 'e001', 'e');
insert into login values('e002', 'e002', 'e');
insert into login values('e003', 'e003', 'e');