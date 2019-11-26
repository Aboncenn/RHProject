
RhProjectGame
==============  
Web site with connotation of a role-playing game aimed at revealing users' soft skills.

# Installation

## Requirements

 - [Symfony v5.0.0 ](https://symfony.com/) or higher
 - [Composer v1.9.1](https://getcomposer.org/) or higher

## Install

### Clone repository

Clone the repository [RHProjectGame](https://github.com/Aboncenn/RHProject.git) :

> git clone git@github.com:Aboncenn/RHProject.git

And copy folders into your PHP server (for ex: **wampp**)


### Update dependencies

Use `composer` to update all dependencies :

`composer update` 


### Configuring the Database

The database connection information is stored as an environment variable called `DATABASE_URL`. For development, you can find and customize this inside `.env`:

> DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/projetRH_bdd"

#### Migrations: Create the database

Now that your connection parameters are setup, Doctrine can create the `projetRH_bdd` database for you:

>  php bin/console doctrine:database:create

#### Migrations: Creating the Database Tables/Schema

This command executes all migration files that have not already been run against your database.

>  php bin/console doctrine:migrations:migrate

# Usage  

## How it works

# External libraries
