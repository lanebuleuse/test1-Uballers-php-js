-- https://sql.sh/cours/create-table
-- https://stackoverflow.com/questions/2049109/how-do-i-import-sql-files-into-sqlite-3
-- command terminal for import database : cat database/database.sqlite | sqlite3 database/database.sqlite
-- https://www.sqlbook.com/sql/drop-table-if-exists/#:~:text=The%20DROP%20TABLE%20SQL%20statement,(deletion)%20of%20the%20table.
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT PRIMARY KEY NOT NULL,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    login VARCHAR(255),
    password VARCHAR(12),
    gender VARCHAR(10),
    date_of_birth DATETIME
    updated_at DATETIME,
    created_at DATETIME
);