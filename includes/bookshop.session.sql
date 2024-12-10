-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

-- Table for books
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publication_date DATE,
    isbn13 VARCHAR(13) NOT NULL UNIQUE,
    description TEXT,
    cover_image VARCHAR(255),
    price FLOAT NOT NULL DEFAULT 0,
    stock_quantity INT DEFAULT 0,
    currency CHAR(3) NOT NULL DEFAULT 'GBP' 
);

--Table shopping cart
CREATE TABLE cart {
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CUURENT_TIMESTAMP, 
    --Foreign keys
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE, --links to users table
    FOREIGN KEY(book_id) REFERENCES books(id) ON DELETE CASCADE -- links to the book table
};

DROP TABLE books; 

SELECT * FROM users; 

--delete all records in users 
TRUNCATE TABLE users;

--delete one row 
DELETE FROM users WHERE id =2; ALTER

--insert into table 
INSERT INTO users (username, password, role)
VALUES ('admin', 'p455w0rd', 'admin')

SELECT * FROM books;

DELETE FROM books where id = 4; 

