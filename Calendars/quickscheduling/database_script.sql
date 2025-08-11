CREATE TABLE users (
  userID int(11) NOT NULL auto_increment,
  userName varchar(50) NOT NULL,
  password char(20) binary NOT NULL,
  userRoleID int(11) NOT NULL,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  mail varchar(50) NOT NULL,
  PRIMARY KEY  (userID),
  UNIQUE KEY userID (userID)
) TYPE=MyISAM;

CREATE TABLE userRoles (
  userRoleID int(11) NOT NULL auto_increment,
  userRole varchar(50) NOT NULL,
  description varchar(50) NULL,
  PRIMARY KEY  (userRoleID),
  UNIQUE KEY userRoleID (userRoleID)
) TYPE=MyISAM;


CREATE TABLE calendar_tasks (
  taskID int(11) NOT NULL auto_increment,
  userID int(11) NOT NULL,
  description varchar(200) NOT NULL,
  startDateTime datetime NOT NULL,
  endDateTime datetime NOT NULL,
  priority varchar(10) NOT NULL,
  isCompleted tinyint NULL,
  PRIMARY KEY (taskID),
  UNIQUE KEY taskID (taskID)
) TYPE=MyISAM;

INSERT INTO userRoles values(1, 'Admin', 'Administrator');

INSERT INTO userRoles values(2, 'User', 'Regular user');

INSERT INTO users values (1, 'admin', password('admin'), 1, 'Default Admin', 'Default Admin', 'a@b.com');