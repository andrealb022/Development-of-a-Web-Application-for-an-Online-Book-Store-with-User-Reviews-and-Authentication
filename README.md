# Development-of-a-Web-Application-for-an-Online-Book-Store-with-User-Reviews-and-Authentication
This project involves the design and implementation of a web application for an online store, where users can view product information and leave reviews. The system supports both anonymous and authenticated users, with authenticated users having access to a personal area. The application includes user authentication, a search feature, and review management, ensuring secure and efficient interactions. For the frontend, HTML and CSS are used to create the user interface, while JavaScript is employed to enhance interactivity. On the backend, PHP is utilized to manage database interactions and handle authentication, product details, and review functionality. The backend database efficiently stores and manages user, product, and review data.


# Reviewendo Website - Local Setup Guide

## Introduction

This project is a local setup for the **Reviewendo** website, which showcases book covers and provides book reviews. The website is designed to run on a local server and contains an example folder of book covers located in the `Reviewendo/Copertine` directory. The books's data are stored in a database created by executing `Script creazione e popolamento database.sql`

## Requirements

- **PHP**: You need to have PHP installed to run the website locally.
- **Apache Server**: Recommended if you are using `mod_userdir` or want a local server environment for testing.
- Alternatively, you can use **XAMPP**, **WAMP**, or **MAMP** for a complete local development stack.
  
### Steps to Run the Website Locally

1. **Install Apache and PHP**  
   Ensure you have **Apache** and **PHP** installed on your machine. If you don’t have them, you can install a stack like **XAMPP** or **MAMP** that comes with both.

2. **Download the Project Files**  
   Download or clone the `Reviewendo` project files to your local machine.

   - If you cloned the repository, navigate to the project folder:
     ```bash
     cd path/to/Reviewendo
     ```

3. **Place the Files in the Correct Directory**  
   Ensure the project files are in the proper directory to be served by Apache. If you're using **XAMPP** or similar, you should place the files in the appropriate folder:
   
   - For **XAMPP** (Windows): `C:\xampp\htdocs\Reviewendo`
   - For **MAMP** (MacOS): `/Applications/MAMP/htdocs/Reviewendo`

4. **Access the Website Locally**  
   - **If you're using `mod_userdir` (Apache configuration)**, you can access the website by navigating to:
     ```bash
     http://localhost/~yourusername/Reviewendo/
     ```
     Replace `yourusername` with your system’s username.

   - **If you're using Apache without `mod_userdir`**, the URL will be:
     ```bash
     http://localhost/Reviewendo/
     ```

5. **Test the Homepage**  
   The homepage will be served automatically as **`index.php`**. Just visit the URL above, and it will load the homepage (`index.php`).

6. **View Book Covers**  
   You can find the example book covers in the `Reviewendo/Copertine` directory. The covers are stored as image files and displayed on the homepage. Feel free to modify or add more covers to this folder.

