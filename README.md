# Baymax Group Project: Calendar

## Goals:
The main goal of this project is to allow users to properly organise and schedule their day in such a way that allows them to properly navigate through the mundane tasks of everyday life.
## Features :
  ### 1. Calendar :
  To keep track of all events scheduled utilising a date,month ,year format while also being able to generate specific events on the selected days and display the scheduled events without specificity.
  ### 2. Calendar Display :
  Functions in tandem with the calender function in that it generates both daily and monthly view.
  ### 3. Event:
  Allows users to register their desired event and at what time they wish to be reminded and on what day and what month.
  ### 4. Deadline Reminder :
  Allows users to see the upcoming events.
  ### 5. Category:
  Allows the users to generate their own catergorys in order to easily manage multiple scheduled events if desired.
  
## Installation Manual
### To run this project, you must have installed a virtual server, mySQL for the database, and the project itself.
#### Virtual Server & Database Installation On Windows
1. Download & Install [XAMPP](https://www.apachefriends.org/download.html)
2. Click the word "XAMPP" above, it will direct you to the download page of XAMPP.
3. Find "XAMPP for Windows" and choose the version you want to download.
4. After the download is finished, just follow the installation manual inside the setup and wait until it's completed.
5. You may tick the box if you want to start the control panel right away.

#### Virtual Server & Database Installation On Linux
1. 
 
6. Copy the main project folder and paste the file in xampp/htdocs in order to implement the web application
7. Please then proceed to open your preferred browser and then go to the URL http://localhost/phpmyadmin/
8. As a user please  select the database option, create a database called "baymax" and then please select an import tab.
9. Please select the browse file option and simply proceed to import the SQL file (calendar.sql) to the newly created "baymax" database
10. Open localhost/the folder name and you will then be able to navigate and properly utilize the web application after being guided to the main page of the app.
11. You will be able to open a browser and go to the URL http://localhost/Baymax-main/

## User Manual:
1. If it is the user's first time using the app and the user does not possess a account ,they would be prompted by a please register message , if the user ,however, already has an account the user should use his or her  login info  (user name and password) to gain access to the main calender page.
2. The user will then be sent to the welcome to the calendar page .
3. if the user wishes  to add an event they can choose the date they desire  and then select it, the suer will also have the option of being able to  delete the event if they so desire.
4. The user will then be given the option to add an event location  and time if the user deems that the event is of a special nature or of special import the user can also add a  deadline
5. If the user wishes to see the event which they have created on the calender and its details they can simply press the date and the corresponding information will be displayed for them to see
6. Located to the top of the calender the user will be able to select an event for the future (three month) option which will enable the user to " jump forward " to that month
