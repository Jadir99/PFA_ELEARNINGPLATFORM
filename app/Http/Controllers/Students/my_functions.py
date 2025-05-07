# api.py
from flask import Flask, request, jsonify

app = Flask(__name__)

def say_hello(name):
    return f"Hello, {name}"

@app.route('/hello', methods=['POST'])
def hello():
    data = request.json
    name = data.get('name')
    return jsonify({'message': say_hello(name)})

if __name__ == '__main__':
    app.run(port=5000)
