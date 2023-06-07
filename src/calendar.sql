CREATE TABLE User (
                UserID     INT AUTO_INCREMENT PRIMARY KEY,
                UserName   VARCHAR(250)    NOT NULL,
                Password   VARCHAR(250)    NOT NULL
);


CREATE TABLE Category(
            CategoryID      INT AUTO_INCREMENT PRIMARY KEY,
            CategoryName    VARCHAR(100)   NOT NULL,
            UserID          INT            NOT NULL,
CONSTRAINT Category_FK1 FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Event(
            EventID             INT AUTO_INCREMENT PRIMARY KEY,
            EventName           VARCHAR(100)    NOT NULL,
            EventDescription    VARCHAR(500)            ,
            EventDate           DATE            NOT NULL,
            EventTime           TIME            NOT NULL,
            UserID              INT             NOT NULL,
            CategoryID          INT             NOT NULL,
CONSTRAINT Event_FK1 FOREIGN KEY (UserID) REFERENCES User(UserID),
CONSTRAINT Event_FK2 FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID) ON DELETE CASCADE ON UPDATE CASCADE
);