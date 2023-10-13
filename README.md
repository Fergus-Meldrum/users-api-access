## Package Installation

This package has not yet been submitted to Packagist and is only available 
via public remote repository.

To use it in your project add the following to your composer.json file:

   "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/Fergus-Meldrum/users-api-access.git"
        }
    ],

    "require": {
        "fergusmeldrum/api-users-package": "dev-main"
    },

## Information on project submission

There are no useful tests for this project as I ran out of time to
implement a method of mocking http calls to the external api.

    - I was not able to find a way of using Http:fake() 
    (as I did in the first submission) without importing the
    entire laravel framework to the package.