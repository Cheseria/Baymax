$html .= '<div class = plan>';
foreach ($this->events as $event) {
    for ($d = 0; $d <= ($event[2]-1); $d++) {
        if (date('y-m', strtotime($this->active_year . '-' . $this->active_month)) == date('y-m', strtotime($event[1]))) {
            $html .= '<div class="event">'; 
            $html .= $event[0] . " " . date('d', strtotime($event[1]));
        
            $html .= '<div class= "dots category-' . $event[3] . '">';
            $html .= '</div>';
            $html .= '</div>';
        }  
    }
}
$html .= '</div>';

if($i<10){
                $html .= '<span>' . "0" . $i . '</span>';
            }else{
            $html .= '<span>' . $i . '</span>';
            }