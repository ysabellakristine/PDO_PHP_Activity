-- NOT NULL = ensures that user must fill this in
-- UNIQUE = no two email can be the same
-- changed to create table if not exists since i create the database within the dbConfig file

CREATE TABLE IF NOT EXISTS Users (
    User_id INTEGER PRIMARY KEY,
    Username VARCHAR(50) NOT NULL,
    Password VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE, 
    Address TEXT
);

CREATE TABLE IF NOT EXISTS Books (
    Book_id INTEGER PRIMARY KEY,
    Title VARCHAR(500),
    Author VARCHAR(250),
    Genre VARCHAR(100), 
    ISBN VARCHAR(13) UNIQUE,
    Book_Status VARCHAR(50),
    Borrow_Price DECIMAL(5,2),
    Stock_Available INTEGER
);

CREATE TABLE IF NOT EXISTS Checkout (
    Checkout_id INTEGER PRIMARY KEY,
    User_id INTEGER,
    Checkout_date DATE,
    Return_date DATE,
    Delivery_id INTEGER,
    Return_delivery_id INTEGER,
    Expected_delivery_date DATE,
    FOREIGN KEY (User_id) REFERENCES Users(User_id),  -- Foreign key reference to Users
    FOREIGN KEY (Delivery_id) REFERENCES Deliveries(Delivery_id),  -- Foreign key reference to Deliveries
    FOREIGN KEY (Return_delivery_id) REFERENCES Deliveries(Delivery_id)  -- Foreign key reference to Deliveries
);

CREATE TABLE IF NOT EXISTS Checkout_Items (
    Checkout_item_id INTEGER PRIMARY KEY,
    Checkout_id INTEGER,
    Book_id INTEGER,
    FOREIGN KEY (Checkout_id) REFERENCES Checkout(Checkout_id),  -- Foreign key reference to Checkout
    FOREIGN KEY (Book_id) REFERENCES Books(Book_id)  -- Foreign key reference to Books
);

CREATE TABLE IF NOT EXISTS Deliveries (
    Delivery_id INTEGER PRIMARY KEY,
    Delivery_date DATE,
    Delivery_address TEXT,
    Delivery_status TEXT,
    Delivery_type TEXT
);

CREATE TABLE IF NOT EXISTS Reviews (
    Review_id INTEGER PRIMARY KEY,
    Book_id INTEGER,
    User_id INTEGER,
    Rating INTEGER,
    Comment TEXT,
    Review_date DATE,
    FOREIGN KEY (Book_id) REFERENCES Books(Book_id),  -- Foreign key reference to Books
    FOREIGN KEY (User_id) REFERENCES Users(User_id)  -- Foreign key reference to Users
);
