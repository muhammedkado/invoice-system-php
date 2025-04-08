# PHP Invoice System

A complete web-based invoice management system built with PHP and MySQL that allows users to create, manage and track invoices.

## Features

- User authentication system
- Create and manage invoices
- Add multiple items to invoices 
- Calculate subtotals, tax and final amounts automatically
- Track payment status (Outstanding, Paid, Late)
- Email invoices directly to customers
- Print invoices as PDF
- Edit and delete existing invoices
- Responsive design that works on desktop and mobile

## Technologies Used

- PHP 8.2
- MySQL/MariaDB 10.4
- JavaScript/jQuery
- Bootstrap 3.3.5
- HTML5/CSS3
- TCPDF Library (for PDF generation)
- PHPMailer (for sending emails)

## Core Components

- User Management
  - Login/logout functionality
  - Session handling
  - Access control

- Invoice Management 
  - Create new invoices
  - Add multiple line items
  - Calculate totals and taxes
  - Track payment status
  - Edit and delete invoices

- PDF Generation
  - Convert invoices to PDF format
  - Professional invoice layout
  - Print or download options

- Email System
  - Send invoices via email
  - HTML email templates
  - SMTP integration

## Database Structure

- `invoice_user` - Stores user account information
- `invoice_order` - Stores invoice header information
- `invoice_order_item` - Stores invoice line items

## Code Organization

```
├── css/                # Stylesheet files
├── js/                 # JavaScript files
├── database/          # SQL database files
├── inc/               # Include files
├── PHPMailer/         # Email library
├── TCPDF/             # PDF library
├── *.php              # PHP source files
```

## Key Files

- `Invoice.php` - Main invoice management class
- `create_invoice.php` - Create new invoices
- `edit_invoice.php` - Edit existing invoices
- `invoice_list.php` - List all invoices
- `print_invoice.php` - Generate PDF invoices
- `sendEmail.php` - Email invoice functionality

## Author 

- Muhammed Kado

## License

This project is open source and available under the [MIT License](LICENSE).