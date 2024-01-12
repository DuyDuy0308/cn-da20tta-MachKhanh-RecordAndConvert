<?php
include("header.php");
include("connect.php");
?>
<div id="top_section" class=" banner_main">
   <div class="container">
      <div class="row d_flex">
         <div class="col-md-6">
            <div class="airmic">
               <h1>Listening exercise</h1>
               <div> <h2 class="title"> Listen and type </h2>
                     <audio controls id="myAudio">
                        <source src="chuyen.mp3" type="audio/mpeg">
                     </audio>
                  </div>
               <form action="" method="post">
                  <div>  
                     <input type="text" id="anwser" name="anwser" placeholder="Type...."> <br>
                     <input type="submit" id="complete" name="complete" value="Done" class="read_more">
                  </div>
                  
               </form>
            </div>
         </div>
         <div class="col-md-6 change">
            <div class="airmic">
               <div id="result-container">   
                  <?php
                 
                     $id = $_GET['id'];
                     $sql = "SELECT * FROM question WHERE id = $id";
                     $result = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($result) > 0) {                      
                        while ($row = mysqli_fetch_assoc($result)) {
                            $text = $row["anwser"];
                            $command = "python text_to_speech.py \"" . $text . "\"";
                            exec($command, $output, $return_var);
                        }                  
                  }
                  if (isset($_POST['complete'])) {
                     $anwser = $_POST['anwser'];
                     $sql = "SELECT * FROM question WHERE id = $id";
                     $result = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {         
                            if ($anwser == $row["anwser"]  ) {
                              echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 200px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                            Correct</div>';
                          } else {
                           echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 200px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                            Incorrect</div>';
                          }
                        }
                    } else {
                        echo "No data";
                    }
                  }
                  ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
include('footer.php');
?>