# Bank Account Management App

![Bank App Screenshot](https://i.postimg.cc/JnK92D5J/transfer.png)

## Description

This is a simple web application for managing bank accounts and performing transfers between them. It allows users to create accounts, check their balances, and initiate transfers.

## Features

- 💼 Account Creation: Users can create new bank accounts by providing their personal information such as name, identification, and initial balance.

![Account Creation](https://i.postimg.cc/tJtDMhzN/accounts.png)

- 📜 Account Listing: The application displays a list of all created bank accounts, including their names and balances.
- 🔄 Account Transfer: Users can initiate transfers between two bank accounts by specifying the source account, destination account, and the transfer amount.

![Account Listing](https://i.postimg.cc/JnK92D5J/transfer.png)

- 🕒 Transaction History: The app keeps a record of all transfers, including the source and destination accounts and the transfer amounts.

![Transaction History](https://i.postimg.cc/gcQ6Cw7v/reports.png)

- 📈 Interest Calculation: The application calculates interest on accounts based on the number of monthly transactions. If a user performs at least 10 transactions in a month, the interest rate increases by 0.2%. Otherwise, it decreases by 0.2%.

## Technologies Used

- Laravel: A PHP web application framework used for backend development.
- Livewire: A Laravel library for building dynamic user interfaces.
- MySQL: A relational database management system for storing account and transaction data.

## Installation

1. Clone the repository to your local machine.

👉 `https://github.com/ingberrio/web-banco-app.git`

2. Navigate to the project directory.

👉 `cd bank-account-app`

3. Install PHP dependencies using Composer.

👉 `composer install`

4. Create a `.env` file by copying the `.env.example` file and configure your database settings.

👉 `cp .env.example .env`

5. Generate an application key.

👉 `php artisan key:generate`

6. Migrate the database.

👉 `php artisan migrate`

7. Start the development server and front.

👉 `php artisan serve`

👉 `npm run dev`


8. Access the application in your web browser at `http://localhost:8000`.

## Usage

1. Visit the homepage and click on "Create Account" to create a new bank account.

2. Fill in the required information, including name, identification, and initial balance.

3. Click "Add Bank Account" to create the account.

4. Once the account is created, you can view it in the list of accounts on the homepage.

5. To initiate a transfer, click the "Transfer" button next to the source account.

6. Fill in the destination account's identification and the transfer amount.

7. Click "Accept" to complete the transfer.

8. The application will calculate interest based on the number of monthly transactions for each account.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Thanks to the Laravel and Livewire communities for their excellent documentation and support.

