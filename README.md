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
### To run this project, you must have installed a Web server, MySQL for the database, and the project itself.
#### Web Server & Database Installation On Windows
1. Download & Install [XAMPP](https://www.apachefriends.org/download.html)
2. Click the word "XAMPP" above, it will direct you to the download page of XAMPP.
3. Find "XAMPP for Windows" and choose the version you want to download.
4. After the download is finished, just follow the installation manual inside the setup and wait until it's completed.
5. You may tick the box if you want to start the control panel right away.
#### Running The Project
1. Download The Project by clicking the code above, and select download zip <img src="/src/img/Download.png" alt="Download">
2. Extract the zip files to htdocs folder inside XAMPP Folder (C:/xampp/htdocs/)
3. To Access the project on the Browser, you need to start the services for both the Web Server and Database by Clicking the start button for both Apache and MySQL modules. <br> (If both modules has the green color as the background or the start button has changed into stop it means it already started)
4. Open your browser, and typed in http://localhost/phpmyadmin/
5. On the left sidebar, click on New.
6. Create the Database by filling the name under Create database form with baymax and click create
7. It will refer you to the content of newly created database as shown below <img src="/src/img/Database.png" alt="If the display is not the same, you can click on 'baymax' on the left sidebar and it should refer you to the same display" >
8. Select the Import option above, select the Choose File and select the calendar.sql of the project (C:/xampp/htdocs/Baymax-main/src/calendar.sql). Scroll down and click on the import button.
9. <img src="/src/img/Success.png" alt="If Imported Successfully, it should look like this">
10. Now, you can run the project on the browser by typing in http://localhost/Baymax-main/
11. You should directed to the login.php

## User Manual:
1. If it is the user's first time using the app and the user does not possess a account ,they would be prompted by a please register message , if the user ,however, already has an account the user should use his or her  login info  (user name and password) to gain access to the main calender page.
2. The user will then be sent to the welcome to the calendar page .
3. if the user wishes  to add an event they can choose the date they desire  and then select it, the suer will also have the option of being able to  delete the event if they so desire.
4. The user will then be given the option to add an event location  and time if the user deems that the event is of a special nature or of special import the user can also add a  deadline
5. If the user wishes to see the event which they have created on the calender and its details they can simply press the date and the corresponding information will be displayed for them to see
6. Located to the top of the calender the user will be able to select an event for the future (three month) option which will enable the user to " jump forward " to that month
