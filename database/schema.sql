-- Create Database
CREATE DATABASE IF NOT EXISTS product360_db;
USE product360_db;

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    brand VARCHAR(100),
    short_desc VARCHAR(500),
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    original_price DECIMAL(10,2),
    featured TINYINT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active',
    colors JSON,
    features JSON,
    specifications JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_featured (featured)
);

-- Product Images Table (for 360° rotation)
CREATE TABLE IF NOT EXISTS product_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    image_path VARCHAR(500) NOT NULL,
    frame_order INT DEFAULT 0,
    is_main TINYINT DEFAULT 0,
    angle_degree INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_product (product_id),
    INDEX idx_order (frame_order)
);

-- Insert Sample Categories
INSERT INTO categories (name, slug, description, status) VALUES
('Watches', 'watches', 'Premium luxury watches', 1),
('Shoes', 'shoes', 'Designer footwear collection', 1),
('Bags', 'bags', 'Luxury handbags and accessories', 1),
('Electronics', 'electronics', 'Premium gadgets and devices', 1);

-- Insert Sample Products
INSERT INTO products (category_id, name, slug, brand, short_desc, description, price, original_price, featured, status, colors, features) VALUES
(1, 'Chronos Heritage', 'chronos-heritage', 'Chronos', 'Elegant mechanical watch with 360° view', 'The Chronos Heritage features automatic movement, sapphire crystal, and genuine leather strap. Experience the craftsmanship from every angle.', 29999, 39999, 1, 'active', '["#C9A84C","#2C2C2C","#FFFFFF"]', '["Automatic Movement","Sapphire Crystal","Water Resistant 50m","Genuine Leather Strap"]'),
(2, 'Velocity Racer', 'velocity-racer', 'Velocity', 'Performance running shoes for professionals', 'Ultra-light carbon fiber sole, breathable mesh upper, and responsive cushioning system for maximum performance.', 8999, 12999, 1, 'active', '["#1A1A2E","#E8303A","#FFFFFF"]', '["Carbon Fiber Sole","Breathable Mesh","Anti-slip Grip","Memory Foam Insole"]'),
(3, 'Apex Leather Backpack', 'apex-backpack', 'Apex', 'Premium genuine leather backpack', 'Handcrafted from full-grain Italian leather, featuring multiple compartments and a padded laptop sleeve.', 15999, 21999, 1, 'active', '["#8B4513","#2C2C2C","#A0522D"]', '["Full-grain Leather","Laptop Compartment","Water Resistant","Anti-theft Design"]');

-- Insert Sample Images
INSERT INTO product_images (product_id, image_path, frame_order, is_main, angle_degree) VALUES
(1, 'watch_front.jpg', 0, 1, 0),
(1, 'watch_angle1.jpg', 1, 0, 30),
(1, 'watch_side.jpg', 2, 0, 60),
(1, 'watch_back.jpg', 3, 0, 90),
(2, 'shoe_front.jpg', 0, 1, 0),
(2, 'shoe_side.jpg', 1, 0, 45),
(2, 'shoe_back.jpg', 2, 0, 90),
(3, 'bag_front.jpg', 0, 1, 0),
(3, 'bag_side.jpg', 1, 0, 60);