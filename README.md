# TechCity Library Management System

A professional, 3-tier Library Management System built with PHP 8.2, focusing on Object-Oriented Programming (OOP) principles, Design Patterns, and ACID Transactions.

## 🏗️ Technical Architecture

The project follows a **Separation of Concerns** architecture:

- **src/Models:** Encapsulated objects representing Books, Authors, and Members.
- **src/Repositories:** Data Access Layer (DAL) using the **Singleton Pattern**.
- **src/Services:** Business Logic Layer handling complex ACID transactions.
- **src/Interfaces & Exceptions:** Standardized contracts and custom error handling.
- **public:** The web-accessible entry point for the application.

## 📂 Project Structure

```text
Library system/
├── database/         # SQL scripts and migrations
├── docs/             # UML diagrams and Cahier de Charge
├── public/           # Web-accessible files (index.php, borrow.php)
├── src/              # Core Application Logic
│   ├── Exceptions/   # Custom Error handling
│   ├── Interfaces/   # Code contracts
│   ├── Models/       # OOP Entities (Inheritance/Polymorphism)
│   ├── Repositories/ # Database Persistence
│   └── Services/     # Transactional Business Logic
├── tests/            # Integration and Unit tests
├── vendor/           # Composer Autoloader
└── README.md         # Project Documentation

🛠️ Requirements & Rules
Entity	Max Books	Loan Period
Student	3 Books	14 Days
Faculty	10 Books	30 Days
💻 Setup

    Database: Import files from /database into MySQL.

    Autoloading: Ensure composer dump-autoload is run to map the src/ namespace.

    Access: Navigate to http://localhost/Library%20system/public/index.php.
```
