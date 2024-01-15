const audioElement = document.getElementById('myAudio');
const saverecoding = document.getElementById('submitButton');
const fileNameInput = document.getElementById("fileName");
const DUOIInput = document.getElementById("chon");
let mediaRecorder;
let audioChunks = [];
saverecoding.addEventListener("click", saverecording);

navigator.mediaDevices.getUserMedia({ audio: true })
    .then(function (stream) {
        mediaRecorder = new MediaRecorder(stream,{sampleRate: 16000 });

        mediaRecorder.ondataavailable = function (e) {
            if (e.data.size > 0) {
                audioChunks.push(e.data);
            }
        };

        mediaRecorder.onstop = function () {
            const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
            audioElement.src = URL.createObjectURL(audioBlob);
        };
    })
    .catch(function (err) {
        console.error('Không thể truy cập microphone:', err);
    });

function saverecording() {
    if (audioChunks.length > 0) {
        // Tiến hành gửi yêu cầu POST
        var audioBlob = new Blob(audioChunks, { type: "audio/wav" });
        audioChunks = [];

        var formData = new FormData();
        formData.append("myAudio", audioBlob);
        formData.append("fileName", fileNameInput.value);
        formData.append("chon", DUOIInput.value);

        fetch("save_file.php", {
            method: "POST",
            body: formData
        })
        
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Lỗi trong quá trình gửi yêu cầu.');
            }
            alert('Âm thanh đã được lưu thành công!');
            location.reload();
        })
        .catch(function(error) {
            console.error('Lỗi: ' + error.message);
            // Hiển thị thông báo lỗi cho người dùng
        });
    }
}
  
    
