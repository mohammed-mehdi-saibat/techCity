CREATE DATABASE IF NOT EXISTS techcity_library;

USE techcity_library;

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    biography TEXT,
    nationality VARCHAR(100),
    birth_date DATE,
    primary_genre VARCHAR(100)
);

CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    publication_year INT,
    category VARCHAR(100),
    status ENUM(
        'Available',
        'Checked Out',
        'Reserved',
        'Under Maintenance'
    ) DEFAULT 'Available'
);

CREATE TABLE book_authors (
    isbn VARCHAR(20),
    author_id INT,
    PRIMARY KEY (isbn, author_id),
    FOREIGN KEY (isbn) REFERENCES books (isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors (id) ON DELETE CASCADE
);

CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(255),
    contact_info VARCHAR(100)
);

CREATE TABLE inventory (
    isbn VARCHAR(20),
    branch_id INT,
    total_copies INT DEFAULT 1,
    available_copies INT DEFAULT 1,
    PRIMARY KEY (isbn, branch_id),
    FOREIGN KEY (isbn) REFERENCES books (isbn) ON DELETE CASCADE,
    FOREIGN KEY (branch_id) REFERENCES branches (id) ON DELETE CASCADE
);

CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    member_type ENUM('Student', 'Faculty') NOT NULL,
    membership_expiry DATE NOT NULL,
    unpaid_fees DECIMAL(10, 2) DEFAULT 0.00
);

CREATE TABLE borrow_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    isbn VARCHAR(20),
    branch_id INT,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE NULL,
    late_fee DECIMAL(10, 2) DEFAULT 0.00,
    FOREIGN KEY (member_id) REFERENCES members (id),
    FOREIGN KEY (isbn) REFERENCES books (isbn),
    FOREIGN KEY (branch_id) REFERENCES branches (id)
);