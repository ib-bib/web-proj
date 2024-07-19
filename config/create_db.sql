/*
Author: Talal
Created: July 18th
Modified: July 18th
*/

/*
 * NEW USER
*/

CREATE USER IF NOT EXISTS 'webproju'@'localhost' IDENTIFIED BY 'pass123';

/*
 * DATABASE 
*/

CREATE DATABASE IF NOT EXISTS project_db;

/* GRANT ALL PRIVILEGES TO WEB USER */

GRANT ALL PRIVILEGES ON project_db.* TO 'webproju'@'localhost';

/*
 * TABLES
*/

CREATE TABLE IF NOT EXISTS project_db.service (  
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description VARCHAR(1024) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS project_db.tier (  
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS project_db.service_tier (  
  id INT NOT NULL AUTO_INCREMENT,
  tier_id INT NOT NULL,
  service_id INT NOT NULL,
  price FLOAT(4) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (tier_id) REFERENCES tier(id)
);

CREATE TABLE IF NOT EXISTS project_db.service_tier_feature (  
  id INT NOT NULL AUTO_INCREMENT,
  service_tier_id INT NOT NULL,
  description VARCHAR(100) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (service_tier_id) REFERENCES service_tier(id)
);

CREATE TABLE IF NOT EXISTS project_db.service_images (
	id INT NOT NULL AUTO_INCREMENT,
	image_url VARCHAR(255) NOT NULL,
	image_name VARCHAR(255),
	service_id INT NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (service_id) REFERENCES service(id)
);

CREATE TABLE IF NOT EXISTS project_db.service_order (
  id INT NOT NULL AUTO_INCREMENT,
  client_email VARCHAR(100) NOT NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'Processing',
  reference_id VARCHAR(255) NOT NULL,
  service_tier_id INT NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (service_tier_id) REFERENCES service_tier(id)
);

CREATE TABLE IF NOT EXISTS project_db.messages (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  subject VARCHAR(100) NOT NULL,
  message VARCHAR(1024) NOT NULL,
  PRIMARY KEY (id)
);


/*
 * INSERT DATA
*/

/* Tiers */
INSERT INTO project_db.tier (name) VALUES ('Basic');
INSERT INTO project_db.tier (name) VALUES ('Pro');
INSERT INTO project_db.tier (name) VALUES ('Premium');

/* Services */
INSERT INTO project_db.service (name, description) VALUES ('UI/UX Design', 'Design a UI/UX for your web application, or mobile application.');
INSERT INTO project_db.service (name, description) VALUES ('Frontend', 'Frontend is the soul of every web application, we specialize in building a fast and easy to use Frontends.');
INSERT INTO project_db.service (name, description) VALUES ('Backend', 'We develop fast and optimized backend for your web application.');
INSERT INTO project_db.service (name, description) VALUES ('Fullstack', 'Full web application development, with great UI/UX and a fast backend.');
INSERT INTO project_db.service (name, description) VALUES ('Mobile App', 'We make mobile applications using Flutter, Kotlin, and native Java.');

/* Service tier prices */
/* Service: UI/UX */
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (1, 1, 9.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (2, 1, 19.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (3, 1, 49.99);

/* Service: Frontend */
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (1, 2, 29.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (2, 2, 36.00);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (3, 2, 59.99);

/* Service: Backend */
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (1, 3, 29.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (2, 3, 49.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (3, 3, 99.99);

/* Service: Fullstack */
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (1, 4, 49.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (2, 4, 79.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (3, 4, 159.99);

/* Service: Mobile Apps */
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (1, 5, 29.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (2, 5, 39.99);
INSERT INTO project_db.service_tier (tier_id, service_id, price) VALUES (3, 5, 99.99);

/* Service images */
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ui-1.jpg', 'UI/UX', 1);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ui-2.jpg', 'UI/UX', 1);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ui-3.jpg', 'UI/UX', 1);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fe-1.jpg', 'Front-End', 2);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fe-2.jpg', 'Front-End', 2);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fe-3.jpg', 'Front-End', 2);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/be-1.jpg', 'Back-End', 3);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/be-2.jpg', 'Back-End', 3);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/be-3.jpg', 'Back-End', 3);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fs-1.jpg', 'Full-Stack', 4);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fs-2.jpg', 'Full-Stack', 4);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/fs-3.jpg', 'Full-Stack', 4);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ma-1.jpg', 'Mobile App Dev', 5);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ma-2.jpg', 'Mobile App Dev', 5);
INSERT INTO project_db.service_images (image_url, image_name, service_id) VALUES ('/assets/images/ma-3.jpg', 'Mobile App Dev', 5);

/* Service Tier Features */
-- UI/UX
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (1, "Basic wireframing and mockups");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (1, "Usability testing and feedback");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (1, "Initial design consultations");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (2, "Advanced wireframing and prototypes");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (2, "In-depth usability analysis");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (2, "Iterative design refinements");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (3, "Comprehensive user experience strategy");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (3, "High-fidelity prototypes");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (3, "Full design system development");

-- Front-end
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (4, "Basic HTML/CSS development");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (4, "Responsive design for mobile");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (4, "Basic JavaScript interactions");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (5, "Advanced CSS animations and transitions");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (5, "Cross-browser compatibility testing");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (5, "JavaScript framework integration");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (6, "Custom front-end architecture");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (6, "Performance optimization and SEO");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (6, "Full accessibility compliance");

-- Back-end
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (7, "Basic API development");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (7, "Database schema design");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (7, "Basic authentication and authorization");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (8, "Advanced API integrations");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (8, "Database optimization and indexing");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (8, "Role-based access control");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (9, "Microservices architecture");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (9, "Real-time data processing");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (9, "Advanced security protocols");

-- Full-stack
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (10, "Basic front-end and back-end setup");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (10, "Integration of front-end with back-end APIs");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (10, "Basic user authentication");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (11, "Advanced front-end and back-end features");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (11, "Enhanced performance optimization");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (11, "Advanced user management system");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (12, "End-to-end full-stack solution");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (12, "Scalable application architecture");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (12, "Comprehensive security measures");

-- Mobile Apps
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (13, "Basic app development for iOS/Android");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (13, "App store submission assistance");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (13, "Basic user interface design");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (14, "Advanced app features and functionalities");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (14, "Integration with third-party services");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (14, "Advanced UI/UX design");

INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (15, "Custom mobile app solutions");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (15, "Real-time app updates and maintenance");
INSERT INTO project_db.service_tier_feature (service_tier_id, description) VALUES (15, "Comprehensive app security and performance optimization");
