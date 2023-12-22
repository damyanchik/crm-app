# MiCRM Project
I present a CRM project that I made myself in PHP (Laravel) and JavaScript (JQuery). I came up with the idea to create a simple, small CRM with the most important options. I think that sometimes I will continue improving the project with new ideas. I called it "micrm", a little pun on 'micro' + 'crm'. ;) I think the project is done well and will showcase my skills in the portfolio.

## About the Project
The project was created on the Laravel framework and it was on the PHP code that I focused most during my work.

I love order in code, so I tried to stick to the most important principles of the Object – Oriented Programming paradigm - SOLID, KISS, DRY, YAGNI and also used architectural design patterns for extensive functionalities. The classes created by me have less than 100 rows, and the methods in the classes are limited to 15-20 rows. PHP, Blade, JS code has been separated from each other.

In addition, I have used JavaScript packages in my work (Bootstrap 5, Select2, Chart.js, Calendar.js) and PHP (Spatie, Pusher, League / csv, Guzzle, Laravel-dopdf).

## Structure and features
* Dashboard - welcome screen, shows statistics of the last week and compares with the week before and the year, as well as the calendar of the month with events.
* Zamówienia (Orders) - contains functionalities for creating, deleting and editing offers, turning offers into orders, creating invoices. It is possible to create an order using a CSV file with the product code and its price and quantity.
* Produkty (Products) - the ability to manage products, brands and product categories. A mechanism has been created that allows you to add products en masse or update prices and stock levels via a CSV file.
* Klienci (Clients) - the ability to manage clients, client profiles.
* Pracownicy (Employees) - a list of employees with their profiles, company chat.
* Kalendarz (Calendar) - calendar with the ability to manage events.
* Admin - management of company data, employees, permissions and settings of the entire CRM.

## Run
```html
    git clone https://github.com/damyanchik/crm-app.git
    composer install
    php artisan migrate:fresh --seed
    php artisan serve
```

```html
    Login: admin@example.com
    Password: password
```

## Technologies
* PHP 8
* Laravel
* SQL
* JavaScript
* JQuery
* Composer
* Bootstrap 5
* HTML
* CSS
