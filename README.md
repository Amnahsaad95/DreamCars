<h1 align="center">Dream Cars</h1>

## Project Screenshots

### Screenshot 1
![Screenshot 1](https://github.com/Amnahsaad95/DreamCars/blob/main/public/images/DreamCars-Home.png)

### Screenshot 2
![Screenshot 2](https://github.com/Amnahsaad95/DreamCars/blob/main/public/images/carmarket.png)

### Screenshot 3
![Screenshot 3](https://github.com/Amnahsaad95/DreamCars/blob/main/public/images/Dashboard.jpg)

## About Dream Cars

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:Dream Cars was founded with the goal of making car buying and selling easier and faster for everyone.

Our platform allows sellers to showcase their cars easily, while providing buyers with a smooth and direct experience to find the car they want.

We’re here to make the car buying and selling process more transparent, offering a wide range of options to suit all needs.

Whether you’re a seller or a buyer, we provide everything you need in one place. We aim to offer an innovative platform that helps sellers display their cars with ease, while providing buyers with a unique experience to discover and compare cars with complete transparency.

## Main Features

- Easy car listing for sellers.
- Advanced search & filters for buyers.
- Detailed car information & gallery.
- Compare cars feature.
- Secure user authentication & authorization.
- Responsive design for mobile, tablet, and desktop.
- Modern & fast UI using:
  1. Laravel Livewire
  2. Alpine.js
  2. Tailwind CSS

## How to Run the Project Locally

1 — Clone the Project

`git clone https://github.com/Amnahsaad95/DreamCars.git`
`cd DreamCars`

2 — Install Dependencies

`composer install`

3 — Environment Configuration

`cp .env.example .env`
`php artisan key:generate`

Update .env file with your database information.

4 — Database Migration

`php artisan migrate`

Seed Dummy Data:

`php artisan db:seed`

5 — Storage

After cloning the project and setting up, you need to create a symbolic link to access uploaded files.

Run the following command in your terminal:

`php artisan storage:link`

6 — Run the Project

`php artisan serve`

Visit the website:

`http://localhost:8000`

7 — For Login as Admin

Email `admin@dreamcar.com`
Password `password123`

## Technologies Used

- Laravel
- Laravel Livewire
- Tailwind CSS
- Alpine.js
- MySQL Database

## Project Flow Diagram
User → Register/Login → Browse Cars → Search & Filter → View Details → Contact Seller


