# Notes

### How to run

Take a look at `run.sh`. Fill environment variables with proper values and execute the script - it should do all 
necessary work. If your local system doesn't match the requirements, you see the error message with instructions given
by `composer`.

CSV file importing process takes about 15 seconds on my pretty average machine.

Example output in terminal:

    This script will clean "database" database on your DB server "localhost:3306". Are you sure? (y/N) y
    Loading composer repositories with package information
    Installing dependencies from lock file
    Nothing to install or update
    Generating autoload files
    Processing file 'app/data/db.sql'... OK!
    
    CSV Importer: [2017-01-22 21:34:09] Process started...
    CSV Importer: [2017-01-22 21:34:09] Skip header line
    CSV Importer: [2017-01-22 21:34:21] Process finished
    PHP 7.0.13-0ubuntu0.16.04.1 Development Server started at Sun Jan 22 21:34:21 2017
    Listening on http://localhost:8081

### How to run tests

You can run unit tests by using `run-tests.sh`. It doesn't need any environment variables since for now it doesn't 
have any integration / MySQL DBUnit tests.

### Charts meaning (just as a reminder, copied from email)

- “Anchor Text” grouped by values converted to lowercase (word / tag cloud chart)
- “Link Status” (pie or donut chart)
- “From URL” grouped by host (pie or donut chart)
- “BLdom” grouped by defined classes [0|1 - 10|11 - 100|\\< 1,000|\\< 10,000|\\< 100,000|\\> 100,000] \(bar chart\)

### Note about docker/ subdirectory

This is my current docker configuration used for development purposes. Left just as an example. Distributed according to 
WTFPL license.