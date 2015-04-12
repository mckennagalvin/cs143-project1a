<html>
<body style="font-family: Open Sans;font-weight: 400;">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    
    <div align="center" style="margin-top:100px;margin-right:auto;margin-left:auto;width:600px;align:center;">
    
        <h3 style="margin-bottom: 30px; font-size: 40px; font-weight: 300;">
            Calculator
        </h3>

        Type an expression in the following box (e.g., 10.5+20*3/25).
        
        <ul style="font-size:12px;text-align:left;color:#777;">
            <li>Only numbers and +,-,* and / operators are allowed in the expression.</li>
            <li>The evaluation follows the standard operator precedence.</li>
            <li>The calculator does not support parentheses.</li>
            <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.</li>
        </ul>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <p style="margin-bottom: 30px;">
                <input type="text" name="expression">
                <input type="submit" name="submit" value="Calculate">
            </p>
        </form>
        
        

        <div style="background:#eee;padding:20px;text-align:left;">
            
            <h4 style="font-size:30px;margin-bottom:10px;margin-top:0px;font-weight:300;">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                        echo "Result";
                ?>
            </h4>
        
        
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $expression = $_POST['expression'];

                    // handle invalid input
                    $valid = true;
                    //check if the string was empty
                    if ( Trim ( $expression ) === '' ){
                        echo "Empty string";
                        echo "<br>";
                        $valid = false;
                    }
                    //check that the characters are valid
                    else if(!preg_match('/^[0-9\.\-\+\/\* ]+$/', $expression)){
                        echo "Invalid character";
                        echo "<br>";
                        $valid = false;
                    }
                    //checks if a floating point number is an invalid format
                    else if(preg_match('/[^0-9]\.[^0-9]*/', $expression) || 
                        preg_match('/\.[^0-9]/',$expression) ||
                        preg_match('/[^0-9]\.[0-9]/', $expression) || 
                        preg_match('/^\.[0-9]/', $expression)){
                            echo "Invalid decimal";
                        echo "<br>";
                        $valid = false;
                    }

                    //check for division by zero
                    else if(preg_match( '/\/0/', $expression)){
                        echo "Division by zero";
                        echo "<br>";
                        $valid = false;
                    }

                    //check for multiple operators next to one another
                    else if(preg_match('/[\.]{2,}/', $expression) ||
                        preg_match('/[\-]{2,}/', $expression) ||
                        preg_match('/[\+]{2,}/', $expression) ||
                        preg_match('/[\*]{2,}/', $expression) ||
                        preg_match('/[\/]{2,}/', $expression)){
                        echo "Operators may not be adjacent to one another";
                        echo "<br>"; 
                        $valid = false;
                    }
                    if($valid == true){
                        eval( '$result = (' . $expression . ');' );
                        echo $result;
                    }
                }
            ?>

        </div>
        
        
        
    </div>
    
</body>
</html>