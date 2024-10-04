-- added insert ignore into so that no duplicates would be made
-- Insert Users
INSERT IGNORE INTO Users (User_id, Username, Password, Email, Address) VALUES (219502, 'Brana', 'xP6~*~rutl9b+e~_', 'bcassely0@netscape.com', '64 Independence Lane');
INSERT IGNORE INTO Users (User_id, Username, Password, Email, Address) VALUES (648401, 'Dulcie', 'yJ6{S(qT', 'dfarans1@businessinsider.com', '5 Lyons Lane');
INSERT IGNORE INTO Users (User_id, Username, Password, Email, Address) VALUES (358907, 'Meyer', 'vY3>QyW/Py1', 'mcorney2@google.pl', '544 Ruskin Trail');
INSERT IGNORE INTO Users (User_id, Username, Password, Email, Address) VALUES (185191, 'Arnaldo', 'sL8{=>zGr=', 'abonhill3@artisteer.com', '3 Chive Crossing');
INSERT IGNORE INTO Users (User_id, Username, Password, Email, Address) VALUES (600960, 'Theresina', 'rF3*_Qn0cJmF', 'tguild4@marketwatch.com', '7 Lunder Hill');

-- Insert Books
INSERT IGNORE INTO Books (Book_id, Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (1927408439, 'donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in', 'Amos Warbys', 'Fiction', '422266226-7', 'Unavailable', 11.59, 1);
INSERT IGNORE INTO Books (Book_id, Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (1442349208, 'ut dolor morbi vel lectus in quam', 'Adara McKearnen', 'Non-Fiction', '534704586-8', 'Unavailable', 13.12, 0);
INSERT IGNORE INTO Books (Book_id, Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (1522508797, 'fermentum justo nec condimentum neque sapien placerat ante nulla justo', 'Marcille Reeds', 'Fantasy', '043267713-5', 'Unavailable', 35.67, 4);
INSERT IGNORE INTO Books (Book_id, Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (291617167, 'eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula', 'Danni Storm', 'Horror', '302677277-1', 'Available', 19.57, 3);
INSERT IGNORE INTO Books (Book_id, Title, Author, Genre, ISBN, Book_Status, Borrow_Price, Stock_Available) VALUES (964036726, 'vel sem sed sagittis nam congue risus semper porta volutpat quam pede', 'Link Quartly', 'Mystery', '502117000-7', 'Unavailable', 19.25, 2);

-- Insert Checkout
INSERT IGNORE INTO Checkout (Checkout_id, User_id, Checkout_date, Return_date, Delivery_id, Return_delivery_id, Expected_delivery_date) VALUES (636868479, 219502, '2004-02-28', '2008-07-18', 557915912, 933838147, '2016-11-02');
INSERT IGNORE INTO Checkout (Checkout_id, User_id, Checkout_date, Return_date, Delivery_id, Return_delivery_id, Expected_delivery_date) VALUES (614015249, 358907, '2007-05-29', '2018-02-24', 805218582, 815760641, '2015-11-06');
INSERT IGNORE INTO Checkout (Checkout_id, User_id, Checkout_date, Return_date, Delivery_id, Return_delivery_id, Expected_delivery_date) VALUES (356965805, 185191, '2015-08-11', '2013-10-14', 676154028, 198308586, '2010-08-29');
INSERT IGNORE INTO Checkout (Checkout_id, User_id, Checkout_date, Return_date, Delivery_id, Return_delivery_id, Expected_delivery_date) VALUES (288728501, 600960, '2018-10-20', '2014-10-12', 711734046, 957566345, '2002-07-21');
INSERT IGNORE INTO Checkout (Checkout_id, User_id, Checkout_date, Return_date, Delivery_id, Return_delivery_id, Expected_delivery_date) VALUES (659729274, 648401, '2016-11-07', '2016-11-16', 479216169, 759981246, '2012-10-22');

-- Insert Checkout_Items
INSERT IGNORE INTO Checkout_Items (Checkout_item_id, Checkout_id, Book_id) VALUES (1, 636868479, 1927408439);
INSERT IGNORE INTO Checkout_Items (Checkout_item_id, Checkout_id, Book_id) VALUES (2, 614015249, 1522508797);
INSERT IGNORE INTO Checkout_Items (Checkout_item_id, Checkout_id, Book_id) VALUES (3, 356965805, 291617167);
INSERT IGNORE INTO Checkout_Items (Checkout_item_id, Checkout_id, Book_id) VALUES (4, 288728501, 964036726);
INSERT IGNORE INTO Checkout_Items (Checkout_item_id, Checkout_id, Book_id) VALUES (5, 659729274, 1442349208);

-- Insert Deliveries
INSERT IGNORE INTO Deliveries (Delivery_id, Delivery_date, Delivery_address, Delivery_status, Delivery_type) VALUES (502175462, '3939-07-29', '9 Kropf Center', 'Delivered', 'Returning');
INSERT IGNORE INTO Deliveries (Delivery_id, Delivery_date, Delivery_address, Delivery_status, Delivery_type) VALUES (190359181, '8663-08-26', '29875 Towne Trail', 'Delivered', 'Borrowing');
INSERT IGNORE INTO Deliveries (Delivery_id, Delivery_date, Delivery_address, Delivery_status, Delivery_type) VALUES (815760641, '8918-01-17', '29 Shoshone Street', 'Failed', 'Returning');
INSERT IGNORE INTO Deliveries (Delivery_id, Delivery_date, Delivery_address, Delivery_status, Delivery_type) VALUES (2031692406, '6774-01-27', '510 5th Alley', 'Failed', 'Returning');
INSERT IGNORE INTO Deliveries (Delivery_id, Delivery_date, Delivery_address, Delivery_status, Delivery_type) VALUES (479216169, '4724-11-22', '2154 High Crossing Way', 'Failed', 'Returning');

-- Insert Reviews
INSERT IGNORE INTO Reviews (Review_id, Book_id, User_id, Rating, Review_date, Comment) VALUES (309, 1442349208, 9547, 5, '2013-03-25', 'bifurcated');
INSERT IGNORE INTO Reviews (Review_id, Book_id, User_id, Rating, Review_date, Comment) VALUES (5236, 3772, 332, 5, '2004-12-18', '3rd generation');
INSERT IGNORE INTO Reviews (Review_id, Book_id, User_id, Rating, Review_date, Comment) VALUES (1761, 9941, 358907, 4, '2005-12-09', 'emulation');
INSERT IGNORE INTO Reviews (Review_id, Book_id, User_id, Rating, Review_date, Comment) VALUES (3731, 8113, 883, 5, '2016-09-21', 'Synergized');
INSERT IGNORE INTO Reviews (Review_id, Book_id, User_id, Rating, Review_date, Comment) VALUES (3113, 7554, 2759, 5, '2018-12-19', 'executive');
