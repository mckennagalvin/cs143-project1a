<html>
<body style="font-family: Open Sans;font-weight: 400;">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    
    <div align="center" style="margin-top:200px">
    
    <h3 style="margin-bottom: 30px; font-size: 40px; font-weight: 300;">
        Body Mass Index Calculator
    </h3>
    
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        
        <p style="margin-bottom: 30px;">
        Height (m): <input type="text" name="height" size="4" maxlength="4">
        Weight (Kg): <input type="text" name="weight" size="4" maxlength="4">
        </p>
        
        <p>
        <input type="submit" name="submit" value="Calculate your BMI!">
        </p>
        
    </form>

    <hr>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $height = $_POST['height'];
            $weight = $_POST['weight'];
            $bmi    = $weight/($height * $height);
            
            // handle error
            if (empty($height))
                echo "You must enter a height!";
            else if (empty($weight))
                echo "You must enter a weight!";
            else if ($height < 0 || $weight < 0)
                echo "You may not have any negative values!";
            else {
                echo "Your BMI is $bmi.\n";
                if ($bmi <= 18.5)
                    echo "You are underweight.";
                else if ($bmi <= 24.9)
                    echo "You are normal weight.";
                else if ($bmi <= 29.9)
                    echo "You are overweight.";
                else if ($bmi <= 39.9)
                    echo "You are obese.";
                else
                    echo "You are morbidly obese.";
            }
        }
    ?>

    
   
    </div>
    
</body>
</html>