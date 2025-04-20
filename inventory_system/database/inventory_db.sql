CREATE DATABASE IF NOT EXISTS inventory_db;
USE inventory_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact_person VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(15),
    address TEXT
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    category_id INT,
    supplier_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

-- Insert sample data
INSERT INTO categories (name, description) VALUES
('Electronics', 'Electronic devices and accessories'),
('Clothing', 'Apparel and fashion items'),
('Home & Kitchen', 'Home appliances and kitchen utensils');

INSERT INTO suppliers (name, contact_person, email, phone, address) VALUES
('Tech Supplies Inc.', 'John Doe', 'john@techsupplies.com', '123-456-7890', '123 Tech St, Silicon Valley'),
('Fashion World', 'Jane Smith', 'jane@fashionworld.com', '987-654-3210', '456 Fashion Ave, New York'),
('Home Essentials', 'Bob Johnson', 'bob@homeessentials.com', '555-123-4567', '789 Home Blvd, Chicago');

INSERT INTO products (name, description, price, stock, category_id, supplier_id) VALUES
('Smartphone X', 'Latest smartphone with advanced features', 799.99, 50, 1, 1),
('Laptop Pro', 'High-performance laptop for professionals', 1299.99, 30, 1, 1),
('T-shirt Basic', 'Cotton basic t-shirt', 19.99, 100, 2, 2),
('Jeans Classic', 'Classic blue jeans', 49.99, 75, 2, 2),
('Coffee Maker', 'Automatic coffee maker with timer', 89.99, 25, 3, 3),
('Blender', 'High-speed blender for smoothies', 69.99, 40, 3, 3);
