<?php
include("header.php");
include("connect.php");
?>
<div id="top_section" class=" banner_main">
   <div class="container">
      <div class="row d_flex">
         <div class="col-md-6">
            <div class="airmic">
               <h1>Speaking<br> exercise</h1>
               <?php
               $sql = "SELECT * FROM question";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {   
                      echo '<a href="question_speech.php?id=' . $row["id"] . '" 
                      style="color: white;  display: inline-block;
                      background: #ffffff;
                      color: #000;
                      max-width: 200px;
                      height: 61px;
                      line-height: 61px;
                      width: 100%;
                      font-size: 17px;
                      text-align: center;
                      font-weight: 500;
                      border-radius: 10px;
                      transition: ease-in all 0.5s;
                      margin: 10px 0px;">Exercise ' . $row["id"] . '</a>'.'<br>';                    
                  }
              }
               ?>       
            </div>
         </div>
         <div class="col-md-6">
            <div class="airmic">
               <h1>Listening <br> exercise</h1>
               <?php
               $sql = "SELECT * FROM question";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<a href="question_text.php?id=' . $row["id"] . '" style="color: white;  display: inline-block;
                      background: #ffffff;
                      color: #000;
                      max-width: 200px;
                      height: 61px;
                      line-height: 61px;
                      width: 100%;
                      font-size: 17px;
                      text-align: center;
                      font-weight: 500;
                      border-radius: 10px;
                      transition: ease-in all 0.5s;
                      margin: 10px 0px;">Exercise ' . $row["id"] . '</a>'.'<br>';
                  }
              }
               ?>       
            </div>
         </div>
      </div>
   </div>
</div>
<?php
include('footer.php');
?>
