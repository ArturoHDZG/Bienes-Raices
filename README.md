# Bienes-Raíces

![Bienes Raíces](https://github.com/ArturoHDZG/Bienes-Raices/assets/110303654/a91a8c99-2443-4bb5-801c-890aeff9680f)


## Visit site [here](https://ticocasas.domcloud.io/)

This is the code repository for the "Web Bienes Raíces" project created by ArturoHDZG.

## Technologies Used

- **SASS**
- **JavaScript**
  - *Gulp*
  - *Modernizr*
- **PHP**
  - *Composer*
  - *Intervention Image*
- **MySQL**
  - *Apache*

## Recent Updates

- We have started using **Composer**, **Gulp**, and **Intervention Image** to improve workflow and dependency management.
- The project is being migrated to an **MVC** architecture to improve code organization and scalability.

## Installation Guide

### Prerequisites

Before installing this project, make sure you have the following software installed on your system:

- **PHP** version **8.2.3** or higher
- **MySQL Server** version **8.0.32** or higher
- **Apache** version **2.4** or higher
- **Node.js** version **18.12.1** or higher
- **Composer** version **2.5.5** or higher

### Installation Steps

1. Clone the repository from GitHub.
2. Navigate to the project directory and run `composer install` to install the PHP dependencies.
3. Run `npm install` to install the Node.js dependencies specified in the `package.json` file.
4. Open the `php.ini` file and modify the following settings:
    - `max_execution_time = 300`
    - `max_input_time = 60`
    - `memory_limit = 128M`
    - `post_max_size = 20M`
    - `default_charset = "UTF-8"`
    - `file_uploads = On`
    - `upload_max_filesize = 20M`
    - `max_file_uploads = 20`
    - Uncomment the following extensions:
        - `extension=curl`
        - `extension=fileinfo`
        - `extension=gd`
        - `extension=mbstring`
        - `extension=mysqli`
        - `extension=openssl`
        - `extension=pdo_mysql`
        - `extension=pdo_pgsql`
        - `extension=pgsql`

### Importing the Database

To import the database, follow these steps:

1. Open your database client and connect to your local database server.
2. Create a new database with the name `tico_casas_db`.
3. Select the newly created database and run the `tico_casas_db.sql` file to import the data.

### Running the Project

1. Serve the project by navigating to the `/public` directory and running the command `php -S localhost:3000`.
2. In a separate terminal, run the command `npx gulp` to compile SASS and execute other dependencies.

After completing these steps, your project should be up and running.

### Acknowledgments

“This [Padawan](https://github.com/ArturoHDZG) would like to extend special thanks to his brother-in-law and Jedi Master [Sergio Arellano](https://github.com/sarellanomx) for his invaluable guidance, support, and teachings in this project and in my learning journey in general.”

If you encounter any issues during installation or execution, please create an issue in one of my GitHub repositories and mention me using "@" followed by my username. I will be notified and will respond to your issue as soon as possible.
