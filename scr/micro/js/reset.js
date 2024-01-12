function resetAudio() {
    var audio = document.getElementById("myAudio");
    
    // Set lại nguồn audio về trống
    audio.src = "";
    
    // Dừng audio nếu đang chạy
    audio.pause();
    
    // Reset thời điểm đang chơi về đầu
    audio.currentTime = 0;
}