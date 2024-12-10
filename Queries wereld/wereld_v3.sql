CREATE DATABASE wereld 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;
USE wereld;

CREATE TABLE land (
  werelddeelcode varchar(3) NOT NULL,
  landcode varchar(2) NOT NULL,
  landnaam varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO land VALUES
('AZ', 'CH', 'China'),
('EU', 'DE', 'Denemarken'),
('EU', 'DU', 'Duitsland'),
('EU', 'FR', 'Frankrijk'),
('AZ', 'IN', 'India'),
('EU', 'NE', 'Nederland'),
('AZ', 'VI', 'Vietnam');

CREATE TABLE werelddeel (
  werelddeelcode varchar(3) NOT NULL,
  werelddeel varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO werelddeel VALUES
('AZ', 'Azië'),
('EU', 'Europa'),
('NAM', 'Noord Amerika');

ALTER TABLE land
  ADD PRIMARY KEY (landcode);

ALTER TABLE werelddeel
  ADD PRIMARY KEY (werelddeelcode);
