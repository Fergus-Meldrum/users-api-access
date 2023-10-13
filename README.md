## Package Installation

This package has not yet been submitted to Packagist and is only available 
via public remote repository.

To use it in your project add the following to your composer.json file:


1. Add the package repository to your `composer.json` file by adding the following lines:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Fergus-Meldrum/users-api-access.git"
        }
    ],
    ```

2. In the same `composer.json` file, add the package to your `require` section:

    ```json
    "require": {
        "fergusmeldrum/api-users-package": "dev-main"
    }
    ```

## Package usage in project

To access package in file:

    ```
    use ApiUsersPackage\UsersAccess;
    ```

Example usage:

    ```
    $package = new UsersAccess();
    $package->createUser('John', 'cleaner');
    ```

## Information on project submission

There are no useful tests for this project as I ran out of time to
implement a method of mocking http calls to the external api.

   - I was not able to find a way of using Http:fake() 
    (as I did in the first submission) without importing the
    entire laravel framework to the package.