<?php
include("header.php");
?>
<div id="top_section" class=" banner_main">
   <div class="container">
      <div class="row d_flex">
         <div class="col-md-6">
            <div class="airmic">
              
               <form action="" method="post">
                  <input type="submit" id="start" name="start" onclick="startRecording()" value="Start record" class="read_more">
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
                  echo "<script>alert(' Recording completed');</script>";
                  
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
               <form action="" method="post">
                  <input type="submit" id="stop" name="stop" value="Start convert" class="read_more">
               </form>
               <div id="result-container">
                  <?php
                  if (isset($_POST['stop'])) {
                     $change = escapeshellcmd('speech_to_text.py');
                     $audioFilePath = 'output.wav';

                     $out = shell_exec("python $change $audioFilePath");
                     $result = json_decode($out, true);

                     echo '<div id="result-container ">' ;
                     if ($result !== null) {
                        echo "<div style='color: white; display: inline-block; background: #ffffff; color: #000; height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;'>";
                        echo 'Text from audio: ' . $result['result'];
                        echo '</div>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="text_to_save" value="' . htmlspecialchars($result['result']) . '">';
                        echo '<input type="text" name="file_name" id="file_name" placeholder="File name...." required>' . '<br>';
                        echo '<input style="font-size: 24px;" type="submit" value="Save text">';
                        echo '</form>';
                     } else {
                        echo '<div style="color: white; display: inline-block; background: #ffffff; color: #000;  height: 61px; line-height: 61px; width: 100%; font-size: 17px; text-align: center; font-weight: 500; border-radius: 10px; transition: ease-in all 0.5s; margin: 10px 0px;">
                        No audio or the audio is too low, please try again </div>';
                     }
                     echo '</div>';
                  }

                  if (isset($_POST['text_to_save'])) {
                     $textToSave = $_POST['text_to_save'];
                     $uploadDirectory = 'uploads/';
                     $filename = $_POST['file_name'];
     
                     if (!file_exists($uploadDirectory)) {
                         mkdir($uploadDirectory, 0777, true);
                     }
     
                     $filePath = $uploadDirectory . $filename . '.txt';
     
                     if (file_put_contents($filePath, $textToSave)) {
                         echo '<script>alert("Saved successfully!");</script>';
                     } else {
                         echo '<script>alert("Error saving the text.");</script>';
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