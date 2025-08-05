# TaniMaju

**Website Management Hasil Panen Desa**

TaniMaju is a web-based platform designed to help village communities manage and showcase the results of their agricultural harvests. Built using PHP and Blade, this system streamlines the process of recording, displaying, and reporting village produce, enabling transparency and ease of access for both community members and buyers.

## Features

- **Harvest Management:** Add, edit, and delete records of village harvests.
- **Product Showcase:** Display harvest results with images and descriptions.
- **Reporting:** Generate reports on harvest quantities and sales.
- **User Roles:** Support for admin and regular users with tailored permissions.
- **Responsive Design:** Optimized for desktop and mobile devices.

## Tech Stack

- **Backend:** PHP
- **Frontend:** Blade templating (Laravel)
- **Database:** MySQL (recommended)
- **Other:** HTML, CSS, JavaScript

## Installation

1. **Clone the Repository**
    ```bash
    git clone https://github.com/sealabtelu/TaniMaju.git
    cd TaniMaju
    ```

2. **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3. **Setup Environment**
    - Copy `.env.example` to `.env` and configure database and other settings.
    - Generate application key:
      ```bash
      php artisan key:generate
      ```

4. **Run Migrations**
    ```bash
    php artisan migrate
    ```

5. **Serve the Application**
    ```bash
    php artisan serve
    ```
    Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Usage

- Login or register as a user.
- Add new harvest records via the dashboard.
- Browse, edit, or delete harvest entries.
- Generate and export harvest reports.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for any improvements or bug fixes.

## License

This project is licensed under the MIT License.

## Contact

For questions or support, open an issue or contact the maintainer at [github.com/sealabtelu/TaniMaju/issues](https://github.com/sealabtelu/TaniMaju/issues).

---
**TaniMaju** - Empowering Villages, Connecting Communities
