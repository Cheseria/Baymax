<?php
class Calendar {

    private $active_year, $active_month, $active_day;
    private $events = [];

    // Build innitial Calendar
    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    // Create Calendar
    public function __toString() {
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
            echo "test: " . $this->active_month . $this->active_year; 
        }
        
        // Calendar Day Calculation
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';

        // Month Selection Option
        $html .= '<form method="post">';
        $html .= '<select name="dropdown" onchange="this.form.submit()" class="custom">';
        $html .= '<option value=""> '. date('F', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)) .' </option>';
        $html .= '<option value="01"> '. date('F', strtotime($this->active_year . '-' . 1 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="02">'. date('F', strtotime($this->active_year . '-' . 2 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="03">'. date('F', strtotime($this->active_year . '-' . 3 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="04">'. date('F', strtotime($this->active_year . '-' . 4 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="05">'. date('F', strtotime($this->active_year . '-' . 5 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="06">'. date('F', strtotime($this->active_year . '-' . 6 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="07" ' . ($this->active_month == '07' ? 'selected' : '') . '>' . date('F', strtotime($this->active_year . '-07-' . $this->active_day)) . '</option>';
        $html .= '<option value="08">'. date('F', strtotime($this->active_year . '-' . 8 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="09">'. date('F', strtotime($this->active_year . '-' . 9 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="10">'. date('F', strtotime($this->active_year . '-' . 10 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="11">'. date('F', strtotime($this->active_year . '-' . 11 . '-' . $this->active_day)) .'</option>';
        $html .= '<option value="12">'. date('F', strtotime($this->active_year . '-' . 12 . '-' . $this->active_day)) .'</option>';
        $html .= '</select>';
        $html .= '<input type="text" name="year" onchange="this.form.submit()" class="custom" value="' . date('Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)) . '">';
        $html .= '</form>';
        $html .= '</div>';

        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    <span> ' . ($num_days_last_month-$i+1) . ' </span>
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == date("d") && $this->current_year == $this->active_year && $this->current_month == $this->active_month ) {
                $selected = ' selected';
            }
            
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (35-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    <span> ' . $i . ' </span>
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
?>
