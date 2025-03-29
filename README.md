# Custom Auth Laravel - Starter Kit
Deploy your own Laravel website in minutes with a full custom system and design.

## Intro
This repository provides a solid foundation for starting Laravel projects with fully customizable authentication systems. <br>
Perfect for those who prefer not to use pre-existing packages like Fortify or Breeze and want to build a tailored solution from scratch.

## Features
<ul>
  <li>
    User Registration
  </li>
  <li>
    Email Verification on Registration
  </li>
  <li>
    Password Recovery via Email
  </li>
  <li>
    Password Change
  </li>
  <li>
    Soft Deletes and Hard Deletes for Account
  </li>
  <li>
    Middleware for Authorization
  </li>
  <li>
    Custom Error Handling
  </li>
  <li>
    Unique Email Enforcement
  </li>
</ul>

## Setup

### 1. Install Dependencies  
Run the following command in the project root to install PHP and JavaScript dependencies:  
```bash
composer install && npm install
```


### 2. Configure Environment
Create a .env file based on the contents of .env.example: 
```bash
cp .env.example .env
```

Make sure to configure your environment variables as needed. Don't forget to put a value for APP_KEY:
```bash
php artisan key:generate
```


### 3. Start the Database
The project uses PostgreSQL as the database, managed via Docker for convenience. To start the database, run:
```bash
docker-compose up -d
```
⚠️ Feel free to use a different database if preferred, but ensure your .env file is configured accordingly.

### 4. Run Migrations 
Apply the database migrations:
```bash
php artisan migrate
```

If the database does not exist, only select 'yes' to create it.

### 5. Start Website
To run the website, both the frontend and backend need to be running simultaneously in separate terminals:
```bash
npm run dev
```

```bash
php artisan serve
```

## How to View Emails?
For convenience, all generated emails will be logged in the Laravel log file located at storage/logs/laravel.log. You can check this file to see the email content generated during the application process.

However, if you want to see it working in practice and send actual emails, you can configure an email service that best suits your needs. Laravel supports various email services, such as SMTP, Resend, Mailgun, SendGrid, etc. You can configure the .env file to set up your preferred email service.

Once configured, emails will be sent through the service, and you can see them in your inbox.

## About the Error Messages

The input field error messages are currently set in Brazilian Portuguese, but you can easily switch them to any language.

If you prefer English messages, simply remove the second array from the validate method. By default, Laravel will use English messages when no language array is provided.


## 🚀 Coming Soon

### Future Features

- [ ] *Account Reactivation* – Ability for users to reactivate their accounts after a soft delete.
- [ ] *Login Rate Limiting* – Implement rate limiting for login attempts to enhance security.
- [ ] *Social Login Providers Integration* – Ability for users to log in using third-party services like Google, Facebook, etc., via OAuth authentication.

These features will be added in upcoming versions to improve the functionality and security of the application.

##

[![Buy Me a Coffee](https://www.buymeacoffee.com/assets/img/custom_images/yellow_img.png)](https://buymeacoffee.com/aadev)
