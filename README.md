# hospmgmt
A simple hospital management system built with CodeIgniter and SQL

Hospital has many patients.  Each Patient is identified by a patient id. The other information that are needed to store in the database regarding patient are name, username, address (House no., Street, District), phone number, mobile number, email, password, and status(current/previous). All these information are stored in PatientInfo. A patient is associated with exactly one doctor.

The hospital has many blocks identified by block number. The descriptive attributes for each ward are type, number of beds and doctor in charge of the ward. 

There are many doctors and nurses for a ward. Each doctor is identified by a doctor id and nurse is identified by nurse id. A doctor is associated with exactly one Block. An employee is associated with exactly one Block. These identifiers are unique in the Hospital. The common information for both doctors and nurses are name, username, address (House no., Street, District), phone number, mobile number, email, password, and status (current/previous). The other information that are need to store for doctors are specialization and qualification.  Doctor information is stored in DoctorInfo.

A patient is must be assigned to a bed in a ward but a bed can remain empty. A bed is identified by bed number which is unique in a ward. Each bed has a rent per day, color and height. The patient may change from one bed to another during his stay at the hospital. 

A patient must be assigned one or more doctors. This information is saved in a relationship PDHistory, which is a many-many relation between PatientInfo and DoctorInfo. Attributes of PDHistory are startDate, endDate and summary. One doctor can supervise zero or more patients.

A patient is given a prescription by zero or more of his doctors. Similarly a doctor can prescribe zero or more of his patients. These information are saved with help of a relationship called Prescription.

Doctors are scheduled to visit their patients on certain times. A doctor can visit zero or more patients; similarly, a patient can have visit from zero or more of his doctor(s). These information are saved in a relationship called PatientScheduleList.

A patient and a Block one-one
