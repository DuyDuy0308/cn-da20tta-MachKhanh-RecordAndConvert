<?php
include("header.php");
?>
<div id="top_section" class=" banner_main">
    <div class="container">
        <div class="row d_flex">
            <div class="col-md-6">
                <div class="airmic">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" id="audioFile" name="audioFile" accept="audio/*" required class="uploads"> <br>
                        <input type="submit" name="upload" value="Tải lên" onclick="resetAudio()" class="read_more">
                    </form>

                    <div>
                        <audio controls id="myAudio">
                            <source src="uploads/upload.wav" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="col-md-6 change">
                <div class="airmic">
                    <form action="" method="post">
                        <input type="submit" id="stop" name="stop" value="Start convert" class="read_more">
                    </form>
                    <div id="result-container">
                        <?php
                     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {
                        $target_dir = "uploads/";
                        $target_file = $target_dir . "upload.wav";  
                        $uploadOk = 1;
                        $audioFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        
                        // Kiểm tra định dạng file âm thanh
                        if ($audioFileType != "wav") {
                            echo "Chỉ chấp nhận file WAV.";
                        } else {
                            // Lưu file vào thư mục uploads với tên "upload.wav"
                            move_uploaded_file($_FILES["audioFile"]["tmp_name"], $target_file);
                            echo " File đã được lưu trong thư mục uploads với tên 'upload.wav'.";
                        }
                    }
                        if (isset($_POST['stop'])) {
                            $change = escapeshellcmd('upload.py');
                            $audioFilePath = 'uploads/upload.wav';

                            $out = shell_exec("python $change $audioFilePath");
                            $result = json_decode($out, true);

                            echo '<div id="result-container ">';
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