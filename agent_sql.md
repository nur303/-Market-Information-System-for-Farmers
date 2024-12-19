<!-- agent_bid_create_db -->
CREATE TABLE agent_bid_create_db (
	bid_id VARCHAR(50) PRIMARY KEY,
	crop_id VARCHAR(50) NOT NULL,
	farmer_id VARCHAR(50) NOT NULL,
	min_bid_price DECIMAL(10, 2) NOT NULL,
	quantity INT NOT NULL,
	location VARCHAR(255) NOT NULL,
	bid_end_date DATE NOT NULL
);

INSERT INTO agent_bid_create_db (bid_id, crop_id, farmer_id, min_bid_price, quantity, location, bid_end_date)
VALUES
('BID001', 'CROP001', 'FARMER001', 500.00, 100, 'New York', '2024-12-31'),
('BID002', 'CROP002', 'FARMER002', 750.00, 200, 'California', '2024-12-25'),
('BID003', 'CROP003', 'FARMER003', 1000.00, 150, 'Texas', '2024-12-28');


<!-- agent_data_collection -->
CREATE TABLE agent_data_collection_db (
	farmer_id VARCHAR(50) PRIMARY KEY,
	crop_id VARCHAR(50),
	crop_quantity INT,
	location VARCHAR(255),
	expected_price DECIMAL(10, 2)
);

INSERT INTO agent_data_collection_db (farmer_id, crop_id, crop_quantity, location, expected_price) VALUES
('F001', 'RICE01', 1500, 'Nueva Ecija', 18.50),
('F002', 'CORN02', 2000, 'Isabela', 15.75),
('F003', 'RICE01', 1200, 'Pangasinan', 19.00),
('F004', 'CORN02', 1800, 'Cagayan', 16.25),
('F005', 'RICE01', 2500, 'Tarlac', 18.75),
('F006', 'CORN02', 1600, 'Ilocos Norte', 15.50),
('F007', 'RICE01', 1750, 'Bulacan', 19.25),
('F008', 'CORN02', 2200, 'La Union', 16.00),
('F009', 'RICE01', 1900, 'Pampanga', 18.25),
('F010', 'CORN02', 1400, 'Batangas', 15.25);


sales directory 
CREATE TABLE agent_sales_db (
    sale_id VARCHAR(50) PRIMARY KEY,
    harvest_date DATE,
    date_sold DATE,
    quantity INT,
    sold_price DECIMAL(10,2),
    production_expense DECIMAL(10,2),
    farmer_profit DECIMAL(10,2)
);

-- First, insert some realistic dummy data
INSERT INTO agent_sales_db 
(sale_id, harvest_date, date_sold, quantity, sold_price, production_expense, farmer_profit) 
VALUES 
('SALE-2024-001', '2024-01-15', '2024-01-20', 500, 25000.00, 15000.00, 10000.00),
('SALE-2024-002', '2024-01-25', '2024-02-01', 750, 37500.00, 20000.00, 17500.00),
('SALE-2024-003', '2024-02-10', '2024-02-15', 300, 15000.00, 8000.00, 7000.00),
('SALE-2024-004', '2024-02-20', '2024-02-25', 1000, 50000.00, 30000.00, 20000.00),
('SALE-2024-005', '2024-03-05', '2024-03-10', 600, 30000.00, 18000.00, 12000.00),
('SALE-2024-006', '2024-03-15', '2024-03-20', 450, 22500.00, 13500.00, 9000.00),
('SALE-2024-007', '2024-03-25', '2024-03-30', 800, 40000.00, 24000.00, 16000.00),
('SALE-2024-008', '2024-04-05', '2024-04-10', 550, 27500.00, 16500.00, 11000.00),
('SALE-2024-009', '2024-04-15', '2024-04-20', 900, 45000.00, 27000.00, 18000.00),
('SALE-2024-010', '2024-04-25', '2024-04-30', 650, 32500.00, 19500.00, 13000.00);

-- Add some more recent transactions
INSERT INTO agent_sales_db 
(sale_id, harvest_date, date_sold, quantity, sold_price, production_expense, farmer_profit) 
VALUES 
('SALE-2024-011', '2024-05-05', '2024-05-10', 700, 35000.00, 21000.00, 14000.00),
('SALE-2024-012', '2024-05-15', '2024-05-20', 850, 42500.00, 25500.00, 17000.00),
('SALE-2024-013', '2024-05-25', '2024-05-30', 400, 20000.00, 12000.00, 8000.00),
('SALE-2024-014', '2024-06-05', '2024-06-10', 950, 47500.00, 28500.00, 19000.00),
('SALE-2024-015', '2024-06-15', '2024-06-20', 550, 27500.00, 16500.00, 11000.00);
