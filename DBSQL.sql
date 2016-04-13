-- tables
-- Table Employers
set foreign_key_checks = 0;
Drop Table if exists Employers, PaycheckData, Permissions, Users, UsersEmployment, WageDataEntries, SMSTokens;
set foreign_key_checks = 1;
CREATE TABLE Employers (
    Name varchar(55)  NOT NULL,
    Location varchar(55)  NOT NULL,
    EmployerID int  NOT NULL,
    PRIMARY KEY (Name)
);

-- Table PaycheckData
CREATE TABLE PaycheckData (
    PaycheckID int  NOT NULL  AUTO_INCREMENT,
    PayPeriodStart date  NOT NULL,
    PayPeriodEnd date  NOT NULL,
    HoursPaid int unsigned NOT NULL,
    AmountPaid int unsigned  NOT NULL,
    UserID int  NOT NULL,
    PRIMARY KEY (PaycheckID)
);

CREATE TABLE SMSTokens(
	Cell bigint not null,
	Token int not null
);

-- Table Users
/* 
Verified 0 is not, 1 is

Account types:
0 :Admin
1 :Non Profit
2 :User */
CREATE TABLE Users (
    UserID int  NOT NULL  AUTO_INCREMENT,
    FirstName varchar(55)  NOT NULL,
    LastName varchar(55)  NOT NULL,
    Username varchar(55)  NOT NULL,
    UserPassword varchar(255)  NOT NULL,
    Email varchar(55)  NOT NULL,
    Age int NOT NULL,
    AccountType int NOT NULL DEFAULT 2,
    Phone bigint  NOT NULL,
    LastLoggedIn timestamp NULL DEFAULT NULL,
    DateJoined timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	Verified int NOT NULL DEFAULT 0,
    PRIMARY KEY (UserID)
);

-- Table UsersEmployment
CREATE TABLE UsersEmployment (
    EmployerID int  NOT NULL,
    HourlyWage int unsigned  NOT NULL,
    TypeofPay varchar(55)  NOT NULL,
    StandardHours int unsigned  NOT NULL,
    UserID int  NOT NULL,
    PRIMARY KEY (EmployerID)
);

-- Table WageDataEntries
CREATE TABLE WageDataEntries (
    EntryID int  NOT NULL  AUTO_INCREMENT,
    UserID int  NOT NULL,
    EmployerID int  NOT NULL,
    Date date  NOT NULL,
    HoursWorked int unsigned  NOT NULL,
    EntryDateTime timestamp  NOT NULL   ON UPDATE CURRENT_TIMESTAMP,
    AmountReceived decimal(5,5)  NOT NULL,
    PRIMARY KEY (EntryID)
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
ALTER TABLE UsersEmployment ADD CONSTRAINT Employment_Employers FOREIGN KEY Employment_Employer (EmployerID)
    REFERENCES Employers(EmployerID)
    ON DELETE CASCADE;

-- Reference:  Users_PaycheckData (table: PaycheckData)

ALTER TABLE PaycheckData ADD CONSTRAINT Users_PaycheckData FOREIGN KEY Users_PaycheckData (UserID)
    REFERENCES Users (UserID)
    ON DELETE CASCADE;


insert into Users (Username, FirstName, LastName, UserPassword, Phone, Age,Email) VALUES ('a','a','a','$1$oxvBpPJm$6qUvF.4OgqvziGk6vMmp11','6308730098','22','a@a.com');

-- End of file.

