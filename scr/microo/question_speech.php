<?php
include("header.php");
include("connect.php");
?>
<div id="top_section" class=" banner_main">
   <div class="container">
      <div class="row d_flex">
         <div class="col-md-6">
            <div class="airmic">
               <h1>Speaking exercise</h1>
               <?php
               $id = $_GET['id'];
               $sql = "SELECT * FROM question WHERE id = $id";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                      echo '<div style="color: white;font-size:18px;padding-bottom:15px">' . $row["question"] . '</div>';
                  }
              }
               ?>
               <form action="" method="post">
                  <div>
                     <input type="submit" id="start" name="start" onclick="startRecording()" value="Start" class="read_more">
                  </div>
                  <div>
                     <input type="submit" id="stop" name="stop" value="Convert" class="read_more">
                  </div>
                  <div>
                     <input type="submit" id="complete" name="complete" value="Done" class="read_more">
                  </div>
                  <div>
                     <audio controls id="myAudio">
                        <source src="output.wav" type="audio/mpeg">
                     </audio>
                  </div>
               </form>
            </div>
         </div>
         <div class="col-md-6 change">
            <div class="airmic">
               <div id="result-container">
                  <?php
                  if (isset($_POST['stop'])) {
                     $change = escapeshellcmd('speech_to_text.py');
                     $audioFilePath = 'output.wav';

                     $out = shell_exec("python $change $audioFilePath");
                     $result = json_decode($out, true);

                     echo '<div id="result-container">';
                     if ($result !== null) {
                        echo "<div style='color: white; display: inline-block; background: #ffffff; color: #000; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;'>";
                        echo 'Text from audio: ' . $result['result'];
                        echo '</div>';
                     } else {
                        echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 400px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                        No audio or the audio is too low, please try again </div>';
                     }
                     echo '</div>';
                  }
                  if (isset($_POST['start'])) {
                     echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 200px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                     Recording completed </div>';
                     $command = escapeshellcmd('record.py');
                  
                     $output = shell_exec("python $command");
                  }
                  
                  if (isset($_POST['complete'])) {
                     $change = escapeshellcmd('speech_to_text.py');
                     $audioFilePath = 'output.wav';
                  
                     $out = shell_exec("python $change $audioFilePath");
                     $kq = json_decode($out, true);
                     $sql = "SELECT * FROM question WHERE id = $id";
                     $result = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $anwser = $row["anwser"];
                            if ($kq['result'] ==  $anwser ) {
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