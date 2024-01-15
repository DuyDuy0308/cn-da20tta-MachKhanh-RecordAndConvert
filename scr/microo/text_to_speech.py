
from gtts import gTTS
import sys

def text_to_speech(text, language='en'):
    tts = gTTS(text=text, lang=language, slow=False)
    tts.save("chuyen.mp3")

if __name__ == "__main__":
    if len(sys.argv) > 1:
        text_to_speech(sys.argv[1])
    else:
        print("Vui lòng cung cấp một văn bản để chuyển đổi.")
