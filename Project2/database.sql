-- Create the database
CREATE DATABASE IF NOT EXISTS student_db;
USE student_db;

-- Create the registrations table (exactly matching your form)
CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    address TEXT NOT NULL,
    city VARCHAR(50) NOT NULL,
    pincode VARCHAR(10) NOT NULL,
    state VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL DEFAULT 'India',
    hobbies TEXT,
    course VARCHAR(20) NOT NULL,
    
    -- Qualification fields
    board1 VARCHAR(100) NOT NULL,
    percent1 VARCHAR(10) NOT NULL,
    year1 VARCHAR(4) NOT NULL,
    
    board2 VARCHAR(100) NOT NULL,
    percent2 VARCHAR(10) NOT NULL,
    year2 VARCHAR(4) NOT NULL,
    
    board3 VARCHAR(100),
    percent3 VARCHAR(10),
    year3 VARCHAR(4),
    
    board4 VARCHAR(100),
    percent4 VARCHAR(10),
    year4 VARCHAR(4),
    
    -- Timestamp for when record was created
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Indexes for better performance
    INDEX idx_email (email),
    INDEX idx_mobile (mobile),
    INDEX idx_course (course)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: Create a view to see complete student information
CREATE OR REPLACE VIEW student_full_info AS
SELECT 
    id,
    CONCAT(first_name, ' ', last_name) AS full_name,
    dob,
    TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age,
    email,
    mobile,
    gender,
    address,
    city,
    pincode,
    state,
    country,
    hobbies,
    course,
    CONCAT(board1, ' - ', percent1, '% (', year1, ')') AS class_x,
    CONCAT(board2, ' - ', percent2, '% (', year2, ')') AS class_xii,
    CASE 
        WHEN board3 IS NOT NULL AND board3 != '' 
        THEN CONCAT(board3, ' - ', percent3, '% (', year3, ')')
        ELSE 'N/A'
    END AS graduation,
    CASE 
        WHEN board4 IS NOT NULL AND board4 != '' 
        THEN CONCAT(board4, ' - ', percent4, '% (', year4, ')')
        ELSE 'N/A'
    END AS masters,
    created_at
FROM registrations;

-- Display success message
SELECT 'Database setup complete!' AS message;