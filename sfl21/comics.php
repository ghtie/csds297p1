<H1> Get Comics by Date</H1>
<h3> Enter the date you wish to get comics for! </h3>

<?php
        echo "<form action='comics.php' method='GET'>";
        echo "<label>Date:</label><br>";
        echo "<input type='date' id='date' name='date'>";
        echo "<input type=submit>";
        echo "</form>";

        if (!empty($_GET["date"])) {
            $date=$_GET['date'];
            shell_exec("echo $date > date.txt");
            shell_exec('./comics.sh');
            echo "<br><h3>Comic for $date:</h3>";
            $file = 'comiclinks.txt';
            $links = file($file);
            foreach($links as $line) {
                echo "<img src=$line alt='No comic for that date'>";
                echo "<br><br><br><br>";
            }
        
	}

?>
