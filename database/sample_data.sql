USE techcity_library;

INSERT INTO
    branches (name, location, contact_info)
VALUES (
        'Main Campus',
        'Central Hub',
        '555-0001'
    ),
    (
        'Science North',
        'Sector 7',
        '555-0002'
    ),
    (
        'Tech South',
        'Innovation Park',
        '555-0003'
    ),
    (
        'Medical East',
        'Hospital Zone',
        '555-0004'
    ),
    (
        'Arts West',
        'Gallery Way',
        '555-0005'
    );

INSERT INTO
    authors (
        name,
        nationality,
        primary_genre
    )
VALUES (
        'Robert C. Martin',
        'American',
        'Computer Science'
    ),
    (
        'Andrew Hunt',
        'British',
        'Computer Science'
    ),
    (
        'David Thomas',
        'British',
        'Computer Science'
    ),
    (
        'J.K. Rowling',
        'British',
        'Literature'
    );

INSERT INTO
    books (
        isbn,
        title,
        publication_year,
        category
    )
VALUES (
        '978-0132350884',
        'Clean Code',
        2008,
        'Computer Science'
    ),
    (
        '978-0201616224',
        'The Pragmatic Programmer',
        1999,
        'Computer Science'
    ),
    (
        '978-0747532743',
        'Harry Potter',
        1997,
        'Literature'
    );

INSERT INTO
    book_authors (isbn, author_id)
VALUES ('978-0132350884', 1),
    ('978-0201616224', 2),
    ('978-0201616224', 3),
    ('978-0747532743', 4);

INSERT INTO
    inventory (
        isbn,
        branch_id,
        total_copies,
        available_copies
    )
VALUES ('978-0132350884', 1, 5, 5),
    ('978-0201616224', 2, 1, 1),
    ('978-0747532743', 5, 10, 0);

INSERT INTO
    members (
        full_name,
        email,
        member_type,
        membership_expiry,
        unpaid_fees
    )
VALUES (
        'John Student',
        'john@tech.edu',
        'Student',
        '2026-12-31',
        0.00
    ),
    (
        'Prof. Jane',
        'jane@tech.edu',
        'Faculty',
        '2028-01-01',
        0.00
    ),
    (
        'Expired Sam',
        'sam@tech.edu',
        'Student',
        '2023-01-01',
        0.00
    ),
    (
        'Debt Dave',
        'dave@tech.edu',
        'Student',
        '2026-12-31',
        15.00
    );