<html>
<head>
	<title>Global Headlines</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"rel="stylesheet">
</head>
<body>
<div class="bg-image" style=" background-image: url('news.jpg'); height:100vh; opacity:0.8;">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="bg-light text-dark">
                <div class="col-10 col-md-8 col-lg-6" style="padding:40px;">

			<?php
			    echo "<form action='news.php' method='post'>";
			    echo "<h1>RECENT GLOBAL HEADLINES</h1>";
			    echo "<h2>" .  date('m-d-Y') . "</h2>";

			    echo "<br><label for='category'>Category:</label><br>";	
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='business'> Business<br>";
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='entertainment'> Entertainment<br>";
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='general'> General<br>";
			    echo "<input type='checkbox' class='category' name='checkbox[]' value='health'> Health<br>";
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='science'> Science<br>";
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='sports'> Sports<br>";
  			    echo "<input type='checkbox' class='category' name='checkbox[]' value='technology'> Technology<br><br>";
  			    echo "<input type='submit' class='btn btn-primary' name='submit' value='Submit'>";
			    echo "</form>";

			    if(isset($_POST['submit'])){
    				if(!empty($_POST['checkbox'])){
				    $cgi_link = "cgi-bin/p1.sh?";
				    foreach($_POST['checkbox'] as $category){
					$cgi_link .= "$category,";
				    }
				    header("Location: $cgi_link");
				}
			    }
			?>
		</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>