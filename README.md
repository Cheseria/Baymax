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
2. Extract the zip files and copy the main project folder (Baymax-main: parent folder to src, doc, index.php README.md) to htdocs folder inside XAMPP Folder (C:/xampp/htdocs/)
3. To Access the project on the Browser, you need to start the services for both the Web Server and Database by Open XAMPP Control Panel and Click the start button for both Apache and MySQL modules. <br> (If both modules has the green color as the background or the start button has changed into stop, it means it already started)
4. If you have previously created the database called baymax, you can skip no 5-10.
5. Open your browser, and typed in http://localhost/phpmyadmin/
6. On the left sidebar, click on New.
7. Create the Database by filling the name under Create database form with "baymax" and click create
8. It will refer you to the content of newly created database as shown below <img src="/src/img/Database.png" alt="If the display is not the same, you can click on 'baymax' on the left sidebar and it should refer you to the same display" >
9. Select the Import option above, select the Choose File and select the calendar.sql of the project (C:/xampp/htdocs/Baymax-main/src/calendar.sql). Scroll down and click on the import button.
10. <img src="/src/img/Success.png" alt="If Imported Successfully, it should look like this">
11. Now, you can run the project on the browser by typing in http://localhost/Baymax-main/
12. You should directed to the login.php

## User Manual:
### User Data Registration & Login :
1. If it is the user's first time using the app and the user does not possess an account, they would be prompted by "Username or Password invalid! Register if you haven't already" message , if the user ,however, already has an account the user should use his or her login info (username and password) to gain access to the main calendar page.
2. The user will then be sent to the calendar page, with the active month calendar displayed on the screen, and the current date circled in the date number.
### Change Calendar View :
3. To change the calendar month and year, simply click on the name of the month on the left side of the calendar and choose the desired month. To change the year, user have to typed in the year they want to see.
### Adding Event & Category
4. Before adding any events to the calendar, User must first add category by clicking the + button on the left side of the calendar display. Type in the name for the category and hit enter with your keyboard.
5. Next, if the user wishes to add an event, they can clicked on the date number they desire and a pop up form will show up and user need to fill in the name of the event, category which the event belongs to. additionally, you can also specified the time and the description for the event in their respective text field.
6. The Event name then later will show up in the calendar, with the background color of the category linked.
7. By Clicking the Square area of each date, it will show all the events listed on each date. If there is no Event "No Event" will be printed on the left side, otherwise, it will show the list of event on that date. To see the details of the event, Click the name of the event you want to see, and the information will be shown below the name of the event alongside a delete button.
### Deleting Event & Category
8. To delete event, simply press the delete button within the same area of the name of the event.
9. To delete category (make sure there is no event registered), then click on the name of the category on the lower left side of the calendar, a delete button will be shown. Simply tap it to delete category.
