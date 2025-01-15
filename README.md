# MangaStore

MangaStore is a web-based platform designed for manga enthusiasts, providing a comprehensive solution for browsing, purchasing, and engaging with manga content. Built with PHP, HTML5, and CSS, it offers a user-friendly interface for customers and robust management tools for administrators.

## Features

### For Customers

- **Browse Manga**: Explore a wide selection of manga titles with detailed descriptions and cover images.
- **Ordering System**: Seamlessly add desired manga to the shopping cart and proceed through a secure checkout process.
- **Rating and Commenting**: Share your thoughts by rating and commenting on manga titles, fostering a community of manga lovers.

### For Administrators

- **Listing Management**: Easily add, update, or remove manga listings to keep the catalog current.
- **Order Tracking**: Monitor and manage customer orders to ensure timely processing and delivery.
- **Category Management**: Organize manga titles into categories for improved navigation and user experience.
- **Comment Moderation**: Oversee user comments to maintain a respectful and engaging community environment.

## Installation

1. **Clone the Repository**:


   git clone https://github.com/rahahq/Mangastore.git
   cd Mangastore


2. **Set Up the Database**:

   - Create a MySQL database named `mangastore`.
   - Import the provided SQL file to set up the necessary tables:

     
     mysql -u your_username -p mangastore < mangastore.sql
    

3. **Configure the Application**:

   - Update the `config.php` file with your database credentials:

   
     <?php
     $dbHost = 'localhost';
     $dbUsername = 'your_username';
     $dbPassword = 'your_password';
     $dbName = 'mangastore';
     ?>
  

4. **Deploy the Application**:

   - Ensure your server supports PHP and has access to the configured MySQL database.
   - Place the application files in your server's web directory.
   - Access the application through your web browser.

## Usage

- **Home Page**: View featured manga and navigate through the platform.
- **User Registration/Login**: Create an account or log in to purchase manga and participate in the community.
- **Manga Listings**: Browse and search for manga titles available for purchase.
- **Shopping Cart**: Add desired manga to your cart and proceed to checkout.
- **Admin Panel**: (For administrators) Manage users, manga listings, orders, and comments.

## Contributing

We welcome contributions to enhance MangaStore. Please follow these steps:

1. Fork the repository.
2. Create a new branch:

   
   git checkout -b feature-name
  

3. Make your changes and commit them with descriptive messages.
4. Push to your forked repository:

   
   git push origin feature-name
  

5. Open a pull request detailing your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
