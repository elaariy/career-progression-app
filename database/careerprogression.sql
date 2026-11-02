CREATE DATABASE career_progression
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE career_progression;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE career_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE levels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    level_code VARCHAR(10) NOT NULL UNIQUE,
    description TEXT
);

CREATE TABLE positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    career_type_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    description TEXT,

    FOREIGN KEY (career_type_id)
        REFERENCES career_types(id)
);

CREATE TABLE level_positions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level_id INT NOT NULL,
    position_id INT NOT NULL,

    FOREIGN KEY (level_id)
        REFERENCES levels(id),

    FOREIGN KEY (position_id)
        REFERENCES positions(id),

    UNIQUE (level_id, position_id)
);

CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE level_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    level_id INT NOT NULL,
    skill_id INT NOT NULL,

    FOREIGN KEY (level_id)
        REFERENCES levels(id),

    FOREIGN KEY (skill_id)
        REFERENCES skills(id),

    UNIQUE (level_id, skill_id)
);

CREATE TABLE resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    url VARCHAR(500),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    career_type_id INT,
    current_level_position_id INT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    experience_years INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (career_type_id) REFERENCES career_types(id),
    FOREIGN KEY (current_level_position_id) REFERENCES level_positions(id)
);

CREATE TABLE user_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    skill_id INT NOT NULL,
    progress_percent INT DEFAULT 0,
    is_completed BOOLEAN DEFAULT FALSE,
    last_updated_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (skill_id) REFERENCES skills(id),
    UNIQUE (user_id, skill_id)
);

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(30) DEFAULT 'planned',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE project_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    user_id INT NOT NULL,
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (project_id) REFERENCES projects(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (project_id, user_id)
);

CREATE TABLE career_progressions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    level_position_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (level_position_id) REFERENCES level_positions(id)
);


CREATE TABLE progression_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    from_level_position_id INT NOT NULL,
    to_level_position_id INT NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    reason TEXT,
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reviewed_at TIMESTAMP NULL,
    reviewed_by INT,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (from_level_position_id) REFERENCES level_positions(id),
    FOREIGN KEY (to_level_position_id) REFERENCES level_positions(id),
    FOREIGN KEY (reviewed_by) REFERENCES users(id)
);

CREATE TABLE progression_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    progression_request_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (progression_request_id) REFERENCES progression_requests(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE user_resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    resource_id INT NOT NULL,
    saved_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (resource_id) REFERENCES resources(id),

    UNIQUE (user_id, resource_id)
);

INSERT INTO roles (name, description)
VALUES
('admin', 'System administrator'),
('cto', 'Chief Technology Officer'),
('employee', 'Regular employee'),
('techlead', 'Technical team leader');

INSERT INTO career_types (name, description)
VALUES
('Software Development', 'Frontend, Backend and Fullstack development'),
('DevOps', 'Infrastructure, deployment and automation'),
('Quality Assurance', 'Software testing and quality assurance');

INSERT INTO positions (name, career_type_id, description)
VALUES
(
    'Frontend Engineer',
    (SELECT id FROM career_types WHERE name = 'Software Development' LIMIT 1),
    'Frontend application development'
),
(
    'Backend Engineer',
    (SELECT id FROM career_types WHERE name = 'Software Development' LIMIT 1),
    'Backend application development'
),
(
    'Fullstack Engineer',
    (SELECT id FROM career_types WHERE name = 'Software Development' LIMIT 1),
    'Frontend and backend development'
),
(
    'DevOps Engineer',
    (SELECT id FROM career_types WHERE name = 'DevOps' LIMIT 1),
    'Infrastructure and deployment'
),
(
    'QA Engineer',
    (SELECT id FROM career_types WHERE name = 'Quality Assurance' LIMIT 1),
    'Software testing'
);

INSERT INTO levels (name, level_code, description)
VALUES
('Frontend Engineer 1', 'FR1', 'Frontend Level 1'),
('Frontend Engineer 2', 'FR2', 'Frontend Level 2'),
('Frontend Engineer 3', 'FR3', 'Frontend Level 3'),
('Frontend Engineer 4', 'FR4', 'Frontend Level 4'),

('Backend Engineer 1', 'BA1', 'Backend Level 1'),
('Backend Engineer 2', 'BA2', 'Backend Level 2'),
('Backend Engineer 3', 'BA3', 'Backend Level 3'),
('Backend Engineer 4', 'BA4', 'Backend Level 4'),

('Fullstack Engineer 1', 'FU1', 'Fullstack Level 1'),
('Fullstack Engineer 2', 'FU2', 'Fullstack Level 2'),
('Fullstack Engineer 3', 'FU3', 'Fullstack Level 3'),
('Fullstack Engineer 4', 'FU4', 'Fullstack Level 4'),

('DevOps Engineer 1', 'DE1', 'DevOps Level 1'),
('DevOps Engineer 2', 'DE2', 'DevOps Level 2'),
('DevOps Engineer 3', 'DE3', 'DevOps Level 3'),
('DevOps Engineer 4', 'DE4', 'DevOps Level 4'),

('QA Engineer 1', 'QA1', 'QA Level 1'),
('QA Engineer 2', 'QA2', 'QA Level 2'),
('QA Engineer 3', 'QA3', 'QA Level 3'),
('QA Engineer 4', 'QA4', 'QA Level 4');



INSERT INTO level_positions (level_id, position_id)
SELECT l.id, p.id
FROM levels l
JOIN positions p
    ON l.name LIKE CONCAT(p.name, ' %');

INSERT INTO skills (name, description)
VALUES
('Basic HTML/CSS knowledge', 'HTML and CSS fundamentals'),
('JavaScript fundamentals', 'Basic JavaScript programming'),
('Basic PHP understanding', 'Introduction to PHP'),
('Version control with Git', 'Git and version control'),
('Simple database queries', 'Basic SQL queries'),
('Advanced CSS (Flexbox, Grid)', 'Advanced CSS layouts'),
('JavaScript ES6+ features', 'Modern JavaScript features'),
('Laravel basics', 'Laravel framework fundamentals'),
('Angular components and services', 'Angular fundamentals'),
('RESTful API development', 'Building REST APIs'),
('Advanced database queries', 'Complex SQL queries'),
('Advanced Angular patterns', 'Advanced Angular development'),
('Laravel advanced features', 'Advanced Laravel concepts'),
('Performance optimization', 'Application performance optimization'),
('Complex database design', 'Advanced database architecture'),
('Mentoring junior developers', 'Supporting junior developers'),
('CI/CD implementation', 'Continuous integration and deployment'),
('Architecture design', 'Software architecture'),
('Tech leadership', 'Technical team leadership'),
('Advanced security practices', 'Application security'),
('Scalability solutions', 'Designing scalable applications'),
('Team management', 'Managing development teams'),
('Project planning', 'Software project planning'),
('Agile/Scrum knowledge', 'Agile and Scrum methodologies');

INSERT INTO level_skills (level_id, skill_id)
SELECT l.id, s.id
FROM levels l
CROSS JOIN skills s
WHERE l.level_code = 'FR1'
AND s.name IN (
    'Basic HTML/CSS knowledge',
    'JavaScript fundamentals',
    'Basic PHP understanding',
    'Version control with Git',
    'Simple database queries',
    'Agile/Scrum knowledge'
);
INSERT INTO level_skills (level_id, skill_id)
SELECT l.id, s.id
FROM levels l
CROSS JOIN skills s
WHERE l.level_code = 'FR2'
AND s.name IN (
    'Advanced CSS (Flexbox, Grid)',
    'JavaScript ES6+ features',
    'Angular components and services',
    'RESTful API development',
    'Advanced database queries',
    'Laravel basics'
);
INSERT INTO level_skills (level_id, skill_id)
SELECT l.id, s.id
FROM levels l
CROSS JOIN skills s
WHERE l.level_code = 'FR3'
AND s.name IN (
    'Advanced Angular patterns',
    'Laravel advanced features',
    'Performance optimization',
    'Complex database design',
    'Mentoring junior developers',
    'CI/CD implementation'
);
INSERT INTO level_skills (level_id, skill_id)
SELECT l.id, s.id
FROM levels l
CROSS JOIN skills s
WHERE l.level_code = 'FR4'
AND s.name IN (
    'Architecture design',
    'Tech leadership',
    'Advanced security practices',
    'Scalability solutions',
    'Team management',
    'Project planning'
);

