<?php
    include "conn.php";

    $sql = mysqli_query($conn, "SELECT * FROM state");
    $data = mysqli_fetch_array($sql);

    $relay = $data['relay'];
    $lampu = $data['lampu'];
?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>IOT Kontrol Relay dan Lampu</title>

    <!-- Javascript for Button Switch --> 
    <script type="text/javascript">
        function ubahstatus(value){
            if(value==true) value="ON";
            else value="OFF";
            document.getElementById('status').innerHTML = value;
            
            //Ajax for Change Value Relay
            var xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange = function()
            {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    //Get Data from Web, after Completed to change Value 
                    document.getElementById('status').innerHTML = xmlhttp.responseText;                    
                }
            }
            //Execute PHP Script, for change value in MySQL
            xmlhttp.open("GET","relay.php?stat=" + value, true)
            xmlhttp.send();
        }
    </script>

    <!-- Javascript for Range Lampu --> 
    <script type="text/javascript">
        function ubahnilai(value){
            document.getElementById('nilai').innerHTML = value;
        
        //Ajax for Change Value Lampu
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                //Get Data from Web, after Completed to change Value 
                document.getElementById('nilai').innerHTML = xmlhttp.responseText;                    
            }
        }
        //Execute PHP Script, for change value in MySQL
        xmlhttp.open("GET","lampu.php?num=" + value, true)
        xmlhttp.send();

        }
    </script>

  </head>
  <body>

    <!-- Title Page -->
    <div class="container" style="text-align:center; padding-top:20px">
        <h2>Control Relay Example ESP8266 Bootstrap Edition <br> with PHP & MySQl</h2>
    </div>

    <!-- Card Class -->
    <div class="container" style="display:flex; justify-content:center; padding-top:20px">

        <!-- Relay Card -->
        <div class="card text-black mb-3" style="width: 20rem;margin-right:10px">
            <div class="card-header" style="font-size:30px; text-align:center; background-color:#778899; color:white">Relay</div>
            <div class="card-body">
                <!-- Switch -->
                <div class="form-check form-switch" style="font-size:50px; text-align:center;">
                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)" <?php if($relay==1) echo"checked"; ?> >
                    <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status"><?php if($relay==1) echo"ON"; else echo "OFF"; ?></span> </label>
                </div>
                <!-- Switch Footer-->
            </div>
        </div>
        <!-- Relay Card Footer-->

        <!-- Lampu Card -->
        <div class="card text-black mb-3" style="width: 20rem;">
            <div class="card-header" style="font-size:30px; text-align:center; background-color:#FA8072; color:white">Lampu</div>
            <div class="card-body">
                <!-- Range/Slider -->
                <div style="text-align:center; font-size:18px">
                    <label for="customRange1" class="form-label">Intensitas Cahaya: <span id="nilai"><?php echo $lampu;?></span> </label>
                    <input type="range" class="form-range" id="customRange1" min="0" max="100" step="20" value="<?php echo $lampu;?>" onchange="ubahnilai(this.value)">
                </div>
                <!-- Range/Slider Footer-->
            </div>
        </div>
        <!-- Lampu Card Footer-->

    </div>
    <!-- Card Class Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>