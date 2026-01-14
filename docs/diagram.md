# Technical Diagrams

## Class Diagram

This diagram represents the Object-Oriented structure of the Library System, including the implementation of Inheritance, Polymorphism, and the Service Layer.

```mermaid
classDiagram
    direction BT

    %% Models
    class Book {
        -string isbn
        -string title
        -string category
        -int publicationYear
        -string status
        -array authors
        +getIsbn() string
        +getTitle() string
        +getCategory() string
        +isAvailable() bool
        +getStatus() string
    }

    class Author {
        -int id
        -string name
        +getName() string
    }

    %% Inheritance for Members
    class Member {
        <<abstract>>
        #int id
        #string name
        #string email
        #float fees
        #string expiryDate
        +isEligible() bool
        +getLoanPeriod()* int
        +getMaxBooks()* int
    }

    class StudentMember {
        +getLoanPeriod() 14
        +getMaxBooks() 3
    }

    class FacultyMember {
        +getLoanPeriod() 30
        +getMaxBooks() 10
    }

    %% Relationships
    Member <|-- StudentMember
    Member <|-- FacultyMember
    Book "1" *-- "many" Author : has

    %% Infrastructure & Services
    class DatabaseConnection {
        -static instance
        -pdo db
        +getInstance() DatabaseConnection
    }

    class BookRepository {
        -db
        +findByIsbn(isbn) Book
        +search(query) array
    }

    class BorrowingService {
        -db
        +borrowBook(Member, isbn, branchId) bool
    }

    %% Service dependencies
    BorrowingService ..> DatabaseConnection : uses
    BookRepository ..> DatabaseConnection : uses
    BorrowingService --> Member : validates
    BorrowingService --> Book : updates status
```
