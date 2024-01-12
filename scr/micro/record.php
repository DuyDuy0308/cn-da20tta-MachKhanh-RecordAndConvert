<?php
include("header.php");
?>
<div id="top_section" class=" banner_main">
   <div class="container">
      <div class="row d_flex">
         <div class="col-md-6">
            <div class="airmic">
               <h1>Record</h1>
               <form action="" method="post">
                  <input type="submit" id="start" name="start" onclick="startRecording()" value="Start" class="read_more">
               </form>

               <div>
                  <audio controls id="myAudio">
                     <source src="output.wav" type="audio/mpeg">
                  </audio>
               </div>
               <form action="" method="post">
                  <input type="text" id="fileName" name="fileName" placeholder="File name...." required class="input"><br>
                  <select name="chon" id="chon" class="read_more">
                     <option value=".mp3">MP3</option>
                     <option value=".wav">WAV</option>
                  </select><br>
                  <input type="submit" name="submitButton" value="Save" id="submitButton" class="read_more">
               </form>
               <?php
               if (isset($_POST['start'])) {
                  echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 200px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
   Recording completed </div>';
                  $command = escapeshellcmd('record.py');

                  $output = shell_exec("python $command");
               }
               ?>
            </div>
            <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitButton"])) {
               $fileName = $_POST["fileName"];
               $fileExtension = $_POST["chon"];
               $fileName = preg_replace("/[^a-zA-Z0-9_-]/", "", $fileName);
               $uploadDir = 'uploads/';
               $filePath = $uploadDir . $fileName . $fileExtension;
               if (rename('output.wav', $filePath)) {
                  echo "<script>alert('Saved');</script>";
               } else {
                  echo "<script>alert('Error');</script>";
               }
            }
            ?>
         </div>
         <div class="col-md-6 change">
            <div class="airmic">
               <h1>Convert</h1>
               <form action="" method="post">
                  <input type="submit" id="stop" name="stop" value="Start" class="read_more">
               </form>
               <div id="result-container">
                  <?php
                  if (isset($_POST['stop'])) {
                     $change = escapeshellcmd('speech_to_text.py');
                     $audioFilePath = 'output.wav';

                     $out = shell_exec("python $change $audioFilePath");
                     $result = json_decode($out, true);

                     echo '<div id="result-container">';
                     if ($result !== null) {
                        echo "<div style='color: white; display: inline-block; background: #ffffff; color: #000; max-width: 200px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;'>";
                        echo 'Text from audio: ' . $result['result'];
                        echo '</div>';
                     } else {
                        echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000; max-width: 400px; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                        No audio or the audio is too low, please try again </div>';
                     }
                     echo '</div>';
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