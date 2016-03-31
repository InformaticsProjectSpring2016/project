-- tables
-- Table Employers
Drop Table if exists Employers, PaycheckData, Permissions, Users, UsersEmployment, WageDataEntries;
CREATE TABLE Employers (
    Name varchar(55)  NOT NULL,
    Location varchar(55)  NOT NULL,
    EmployerID int  NOT NULL,
    CONSTRAINT Employers_pk PRIMARY KEY (Name)
);

-- Table PaycheckData
CREATE TABLE PaycheckData (
    PaycheckID int  NOT NULL  AUTO_INCREMENT,
    PayPeriodStart date  NOT NULL,
    PayPeriodEnd date  NOT NULL,
    HoursPaid decimal(5,3)  NOT NULL,
    AmountPaid decimal(8,3)  NOT NULL,
    UserID int  NOT NULL,
    CONSTRAINT PaycheckData_pk PRIMARY KEY (PaycheckID)
);

-- Table Permissions
CREATE TABLE Permissions (
    Permission varchar(55)  NOT NULL,
    UserID int  NOT NULL,
    CONSTRAINT Permissions_pk PRIMARY KEY (Permission)
);

-- Table Users
-- DateJoined date  NOT NULL,
CREATE TABLE Users (
    UserID int  NOT NULL  AUTO_INCREMENT,
    FirstName varchar(55)  NOT NULL,
    LastName varchar(55)  NOT NULL,
    Username varchar(55)  NOT NULL,
    UserPassword varchar(255)  NOT NULL,
    Email varchar(55)  NOT NULL,
	Age int NOT NULL,
    Phone int  NOT NULL,
    LastLoggedIn timestamp  NULL ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE INDEX Username (Username),
    CONSTRAINT Users_pk PRIMARY KEY (UserID)
);

-- Table UsersEmployment
CREATE TABLE UsersEmployment (
    EmployerID int  NOT NULL  AUTO_INCREMENT,
    HourlyWage decimal(5,5)  NOT NULL,
    TypeofPay varchar(55)  NOT NULL,
    StandardHours decimal(5,3)  NOT NULL,
    UserID int  NOT NULL,
    CONSTRAINT UsersEmployment_pk PRIMARY KEY (EmployerID)
);

-- Table WageDataEntries
CREATE TABLE WageDataEntries (
    EntryID int  NOT NULL  AUTO_INCREMENT,
    UserID int  NOT NULL,
    EmployerID int  NOT NULL,
    Date date  NOT NULL,
    HoursWorked decimal(5,3)  NOT NULL,
    EntryDateTime timestamp  NOT NULL   ON UPDATE CURRENT_TIMESTAMP,
    AmountReceived decimal(5,5)  NOT NULL,
    CONSTRAINT WageDataEntries_pk PRIMARY KEY (EntryID)
);


-- foreign keys
-- Reference:  WageDataEntries_Users (table: WageDataEntries)

ALTER TABLE WageDataEntries ADD CONSTRAINT WageDataEntries_Users FOREIGN KEY DataEntries_Users (UserID)
    REFERENCES Users (UserID)
    ON DELETE CASCADE;
-- Reference:  Employers_Employment (table: Employers)

ALTER TABLE Employers ADD CONSTRAINT Employers_Employment FOREIGN KEY Employers_Employment (EmployerID)
    REFERENCES UsersEmployment (EmployerID)
    ON DELETE CASCADE;
-- Reference:  Employment_Users (table: UsersEmployment)

ALTER TABLE UsersEmployment ADD CONSTRAINT Employment_Users FOREIGN KEY Employment_Users (UserID)
    REFERENCES Users (UserID)
    ON DELETE CASCADE;
-- Reference:  Users_PaycheckData (table: PaycheckData)

ALTER TABLE PaycheckData ADD CONSTRAINT Users_PaycheckData FOREIGN KEY Users_PaycheckData (UserID)
    REFERENCES Users (UserID)
    ON DELETE CASCADE;
-- Reference:  Users_Permissions (table: Permissions)

ALTER TABLE Permissions ADD CONSTRAINT Users_Permissions FOREIGN KEY Users_Permissions (UserID)
    REFERENCES Users (UserID)
    ON DELETE CASCADE;



-- End of file.

