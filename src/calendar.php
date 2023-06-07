<?php
include "config.php";

class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = []; // Initialize Event Variable
    private $categories = []; // Initialize Category Variable

    // Build innitial Calendar
    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    // Query Events From Database
    public function get_events_from_databases(){
        global $connection;

        $sql = "SELECT * FROM event";
        $result =  $connection->query($sql);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            // Loop Through The Rows and Add The Events to The Calendar
            while ($row = $result->fetch_assoc()) {
                $EventDate = $row['EventDate'];
                $CategoryID = $row['CategoryID'];

                // Add The Event to The Calendar
                $this->add_event('', $EventDate, 1, $CategoryId, );
            }
        }
    }
    // Add The Events to be Generated in The Calendar 
    public function add_event($txt, $date, $days = 1, $CategoryID) {
        $this->events[] = [$txt, $date, $days, $CategoryID];
    }

        // Query Events From Database
        public function get_category_from_databases(){
            global $connection;
    
            $sql = "SELECT * FROM Category";
            $result =  $connection->query($sql);
            $rows = mysqli_num_rows($result);
    
            if ($rows > 0) {
                // Loop Through The Rows and Add The Events to The Calendar
                while ($row = $result->fetch_assoc()) {
                    $CategoryName = $row['CategoryName'];
                    $CategoryID = $row['CategoryID'];
    
                    // Add The Event to The Calendar
                    $this->add_category($CategoryName, $CategoryID);
                }
            }
        }

    // Add The Categories to be Generated in The Calendar 
    public function add_category($name, $CategoryID) {
        $this->categories[] = [$name, $CategoryID];
    }

    // Create Calendar
    public function __toString() {
        global $connection;
        $currentdate = date("Y-m-d"); //Innitiate current date as default
        $this->current_year = $currentdate != null ? date('Y', strtotime($currentdate)) : date('Y'); // Year
        $this->current_month = $currentdate != null ? date('m', strtotime($currentdate)) : date('m'); // Month
        $this->current_day = $currentdate != null ? date('d', strtotime($currentdate)) : date('d'); // Date

        // Month Query
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the selected month & year option
            $selectedMonth = $_POST['dropdown'];
            $selectedYear = $_POST['year'];
          
            // Process the selected month option
            if (!empty($selectedMonth)) {
                $this->active_month = $selectedMonth;
            }
            
            // Process the selected month option
            if (!empty($selectedYear) && !empty($selectedMonth)) {
                $this->active_year = $selectedYear;
            }
        }
        
        // Calendar Day Calculation
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';

        $html .= '<div class = "container">';
        // Month Selection Option
        $html .= '<form method="POST">';
        $html .= '<select name="dropdown" onchange="this.form.submit()" class="custom" >';
        $html .= '<option value=""> '. date('F', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)) .' </option>';
        $html .= '<option value="01" ' . ($this->active_month == '01' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 1 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="02" ' . ($this->active_month == '02' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 2 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="03" ' . ($this->active_month == '03' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 3 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="04" ' . ($this->active_month == '04' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 4 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="05" ' . ($this->active_month == '05' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 5 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="06" ' . ($this->active_month == '06' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 6 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="07" ' . ($this->active_month == '07' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-07-' . $this->active_day)) . '</option>';
        $html .= '<option value="08" ' . ($this->active_month == '08' ? 'selected' : '') . '> '. date('F', strtotime($this->active_year . '-' . 8 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="09" ' . ($this->active_month == '09' ? 'selected' : '') . '>'. date('F', strtotime($this->active_year . '-' . 9 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="10" ' . ($this->active_month == '10' ? 'selected' : '') . '>'. date('F', strtotime($this->active_year . '-' . 10 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="11" ' . ($this->active_month == '11' ? 'selected' : '') . '>'. date('F', strtotime($this->active_year . '-' . 11 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="12" ' . ($this->active_month == '12' ? 'selected' : '') . '>'. date('F', strtotime($this->active_year . '-' . 12 . '-' . $this->active_day)) .'</option>';
        $html .= '</select>';
        $html .= '<input type="text" name="year" onchange="this.form.submit()" class="custom" value="' . date('Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)) . '">';
        $html .= '</form>';
        $html .= '</div>';

        // List The Events That Occur On Spesific Date
        $html .= '<div class="events-container" id="event-list">';
        $html .= '</div>';

        $html .= '<div class="categories-container">';
        // Query the Categories
        $html .= 'Category <br>';

        // Show All Saved Category
        if($this->categories!= NULL){
        foreach ($this->categories as $category) {
              $categoryName = $category[0];
              $categoryId = $category[1];
              $html .= '<div class="element category">';
              $html .= " $categoryName ";
              $html .= '<div class="dots category-' . $categoryId . '">';
              $html .= '</div>';
              $html .= '<button class="delete-category" data-category-id="' . $categoryId . '">Delete</button>';
              $html .= '</div>';
        } 
    }

        $UserID = $_SESSION['UserID'];
        $categoryQuery = "SELECT * FROM category WHERE UserID='$UserID'";
        $categoryResult = $connection->query($categoryQuery);    

        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
          while ($row = mysqli_fetch_assoc($categoryResult)) {
            $categoryName = $row['CategoryName'];
            $categoryId = $row['CategoryID'];
            $html .= '<div class="element category">';
            $html .= " $categoryName ";
            $html .= '<div class="dots category-' . $categoryId . '">';
            $html .= '</div>';
            $html .= '<button class="delete-category" data-category-id="' . $categoryId . '">Delete</button>';
            $html .= '</div>';
            }
        }
        
        $html .= '<button class="add-button" id="add-category-button">+</button>';
        $html .= '</div>';
        $html .= '</div>';

        $html .= '<div class="pop-up-overlay-category"></div>';
        $html .= '<div class="pop-up-form-category" id="popUpFormCategory">';
        $html .= '<form>';
        $html .= '<label>Category Name:</label>';
        $html .= '<input type="text" name="CategoryName">';
        $html .= '</form>';
        $html .= '</div>';

        // Display Days' name
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        // Show Dates from The Previous Month
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    <span> ' . ($num_days_last_month-$i+1) . ' </span>
                </div>
            ';
        }
        // Show the Dates for The Current/Selected Month
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = ''; // Initialize Selected Date Variable
            // Check Whether There is Today's Date on The Calendar or Not
            if ($i == date("d") && $this->current_year == $this->active_year && $this->current_month == $this->active_month ) {
                $selected = ' selected';
            }
            
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            
            // Show Events on The Date If There's Any
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event category-' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }  
                }
            } 

            // Adding Event Function
            $html .= '</div>';          
            $html .= '<div class="pop-up-overlay"></div>';
            $html .= '<div class="pop-up-form" id="popUpForm' . $i . '">';
            $html .= '<form>';
            $html .= '<label>Date: ' . $i . '-' . $this->active_month . '-' . $this->active_year . '</label>';
            $html .= '<input type="hidden" name="EventDate" value="'. $this->active_year . '-' . $this->active_month . '-' . $i . '">';
            $html .= '<label>Event Name:</label>';
            $html .= '<input type="text" name="EventName">';
            $html .= '<label>Event Description:</label>';
            $html .= '<input type="text" name="EventDesc">';
            $html .= '<label>Time:</label>';
            $html .= '<input type="text" name="EventTime">';
            $html .= '<label>Category:</label>';
            $html .= '<input type="text" name="CategoryName">';
            $html .= '<input type="submit" value="Add Event">';
            $html .= '</form>';
            $html .= '</div>';
                }
        
        // Show The Remaining Date From Next Month to Fill The Empty Slot
        for ($i = 1; $i <= (35-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    <span> ' . $i . ' </span>
                </div>
            ';
        }
        return $html;
    }

}
?>
