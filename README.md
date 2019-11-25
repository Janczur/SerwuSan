<!-- PROJECT LOGO -->
<br />
<div align="center">

  <h1 align="center">SerwuSan</h1>

  <p align="center">
    An application supporting the work of a telecommunications company
  </p>
</div>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Installation](#installation)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)



<!-- ABOUT THE PROJECT -->
## About The Project

The application was created to accelerate the operation of a telecommunications company. Currently, it only helps in calculating the amount to be paid for monthly billings from a csv file.

### Built With
* [Bootstrap](https://getbootstrap.com)
* [JQuery](https://jquery.com)
* [Laravel](https://laravel.com)



<!-- GETTING STARTED -->
## Getting Started

To install the application you will need:

* PHP >= 7.1.3
* git
* composer

### Installation

1. Go to the folder where you want to create the project and clone the repository
```sh
git clone https://github.com/StBlackJesus/SerwuSan.git
```
2. Install application and dependencies
```sh
composer install
```
3. Connect your database  
rename ".env.example" file to ".env" and provide valid credentials
```sh
DB_DATABASE=your_database_name
DB_USERNAME=username
DB_PASSWORD=password
```
4. migrate database
```sh
php artisan migrate
```

### Testing

In the main project directory run command, and make sure everything is green :smile:
```sh
php vendor/phpunit/phpunit/phpunit
```

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

Jan Przybysz - [@twitter](https://twitter.com/St_BlackJesus) - jan.j.przybysz@gmail.com


<!-- ACKNOWLEDGEMENTS -->
## Acknowledgements
* [Animate.css](https://daneden.github.io/animate.css)
* [Font Awesome](https://fontawesome.com)
