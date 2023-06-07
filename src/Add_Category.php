<?php
include 'config.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username and password
        if (isset($_POST['CategoryName'])) {
                $Category = $_POST['CategoryName'];
        }
        if(isset($_SESSION['UserID'])){
            $UserID = $_SESSION['UserID'];
            $sql1 = "INSERT INTO Category (CategoryName, UserID) VALUES (?,?);";
            $stmt = $connection->prepare($sql1);
            $stmt->bind_param('si', $Category, $UserID);
            
            $result = $stmt->execute();
            
            echo '<script>window.location.href = "index.php";</script>';

        // Generate CSS rules
        header('Content-Type: text/css');

        ob_start();

        $sql1 = "SELECT * FROM Category";
        $result1 = $connection->query($sql1);
        
        $categories = [];
        while ($row = $result1->fetch_assoc()) {
        $categories[] = $row;
        }
        
        foreach ($categories as $category) {
            $CategoryID = $category['CategoryID'];
            $colorCode = '#' . dechex(random_int(0, 16777215));
        
            // Output the dynamic CSS rule for the category
            echo ".category-$CategoryID { background-color: $colorCode; } \n";
        }
        
        $cssContent = ob_get_clean();
        
        // Write the dynamic CSS styles to a file
        $file = fopen('css/dynamic_styles.css', 'w');
        fwrite($file, $cssContent);
        fclose($file);
    }
}
?>