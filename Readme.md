# Happy Birthday Message

## User API
This API developed using PHP with CodeIgniter 3 framework. The endpoints :
* `/customers` : retrieve list of user/customer that the birtday date is today and 9 AM at their location

### How to use
* Copy the restful-api folder to server folder. If you use XAMPP, put it on xampp/htdocs folder
* Open URL http://[domain]/restful-api

## Birthday-Message-Simple-Application
This application is used to get list of birthday user/customer, and then send the birthday message to them. It is developed using PHP Native.

### How to use
* Make sure you have installed `php` in your environment. You can test this applications using command line / terminal by entering the application folder then execute `php index.php`
* Deploy and run the **Node Scheduling** application below

## Node Scheduling
This one is used to run the birthday-message-simple-application every hour. It is developed using NodeJS.

### How to use
* Install the package using `npm install`
* Open `index.js`
* Adjust the `simple_birthday_app_path` variable with the Birthday-Message-Simple-Application path
* Save the changes
* Run the apps using `node index.js`