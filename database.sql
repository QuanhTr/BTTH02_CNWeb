
USE onlinecourse;

-------------------------------------------------------
-- Bảng users
-------------------------------------------------------
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    fullname VARCHAR(255),
    role INT COMMENT '0: student, 1: instructor, 2: admin',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-------------------------------------------------------
-- Bảng categories
-------------------------------------------------------
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-------------------------------------------------------
-- Bảng courses
-------------------------------------------------------
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    instructor_id INT,
    category_id INT,
    price DECIMAL(10,2),
    duration_weeks INT,
    level VARCHAR(50),
    image VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (instructor_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-------------------------------------------------------
-- Bảng enrollments
-------------------------------------------------------
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    student_id INT,
    enrolled_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50),
    progress INT,
    
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (student_id) REFERENCES users(id)
);

-------------------------------------------------------
-- Bảng lessons
-------------------------------------------------------
CREATE TABLE lessons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT,
    title VARCHAR(255),
    content LONGTEXT,
    video_url VARCHAR(255),
    `order` INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-------------------------------------------------------
-- Bảng materials
-------------------------------------------------------
CREATE TABLE materials (
    id INT PRIMARY KEY AUTO_INCREMENT,
    lesson_id INT,
    filename VARCHAR(255),
    file_path VARCHAR(255),
    file_type VARCHAR(50),
    uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (lesson_id) REFERENCES lessons(id)
);
