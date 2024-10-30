# Laravel Project Installation with Sail

This guide provides instructions on how to set up and run this Laravel project using **Laravel Sail**.

## Prerequisites

- **Docker**: Ensure Docker is installed and running on your machine. [Get Docker here](https://www.docker.com/get-started).

## Installation Steps

### 1. Clone the Repository

Clone this repository to your local machine:

```bash
git clone https://github.com/jopbogers/Swap-a-Phant.git
cd Swap-a-Phant
```

### 2. Set Up Environment Variables

Create a `.env` file by copying the `.env.example` file:

```bash
cp .env.example .env
```

### 3. Install Composer Dependencies

Laravel Sail provides a convenient way to run Composer without having it installed locally. Run the following command to install dependencies:

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

### 4. Start Laravel Sail

To start the development environment, run:

```bash
./vendor/bin/sail up -d
```

This command starts the Docker containers in detached mode. To see real-time logs, you can use `./vendor/bin/sail up` without `-d`.

### 5. Generate the Application Key

After Sail is up, run the following command to generate the application key:

```bash
./vendor/bin/sail artisan key:generate
```

### 6. Create a Storage Symlink

To make files in the `storage` directory accessible via the browser, create a symbolic link from `public/storage` to `storage/app/public`:

```bash
./vendor/bin/sail artisan storage:link
```

### 7. Run Migrations and Seed the Database

If the project requires database setup, run migrations and seed data using:

```bash
./vendor/bin/sail artisan migrate --seed
```

### 8. Access the Application

Once everything is set up, open your browser and go to:

```
http://localhost
```

The default Sail configuration uses port `80`, so no additional port specification is needed.

## Common Sail Commands

Here are a few common Sail commands you may find helpful:

- **Stop Sail**: `./vendor/bin/sail down`
- **Run Artisan Commands**: `./vendor/bin/sail artisan <command>`
- **Run Composer Commands**: `./vendor/bin/sail composer <command>`
- **Run NPM Commands**: `./vendor/bin/sail npm <command>`

## Troubleshooting

If you encounter issues, check the following:
- **Docker is Running**: Ensure Docker is running before starting Sail.
- **Environment Variables**: Double-check your `.env` file, especially database credentials and any required API keys.
