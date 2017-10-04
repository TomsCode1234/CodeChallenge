<?php
    require("./backend.php");
    $carIdArray = atStartCars();
    $modelIdArray = atStartModels();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Car Veiwer</title>
        <link type="text/css" rel="stylesheet" href="index.css" >
    </head>
    <body>
        <Div id="Header">
            
            <h3>Search for car: </h3>
            <form id="carInput">
                <lable>Enter Car ID: </lable>
                <input id="carSearch" list="carDropDown">
                <datalist name="cars" id="carDropDown">
                
                </datalist><br>
                <lable>Enter Model: </lable>
                <input id="modelSearch" list="modelDropDown">
                <datalist name="cars" id="modelDropDown">
                
                </datalist><br>
                <button>Filter Results</button>
            </form>
        </Div>
        
        <div id="Results"></div>
        
        <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
        </script>      
        <script>
            var carIdArray = <?php echo $carIdArray ?>;
            var modelIdArray = <?php echo $modelIdArray?>;
        </script>
        <script src="index.js"></script>
    </body>
</html>