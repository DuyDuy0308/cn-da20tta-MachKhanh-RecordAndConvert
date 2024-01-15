import speech_recognition as sr
import sys
import json

def audio_to_text(audio_file):
    recognizer = sr.Recognizer()

    try:
        with sr.AudioFile(audio_file) as source:
            audio_data = recognizer.record(source)
            text = recognizer.recognize_google(audio_data)
            return text
    except sr.UnknownValueError:
        print("Không thể nhận diện giọng nói")
        return None
    except sr.RequestError as e:
        print(f"Lỗi trong quá trình gửi yêu cầu đến API: {e}")
        return None


audio_file_path = 'uploads/upload.wav'

result = audio_to_text(audio_file_path)


result_json = json.dumps({"result": result})


print(result_json)