from flask import Flask, request, jsonify
import cPickle as pkl

service = Flask('text_classification')
tree = pkl.load(open('tree.pkl', 'rb'))

# localhost:5000/
@service.route('/')
def index():
    return jsonify(message='success')


# localhost:5000/classify?text=
@service.route('/classify')
def classify():
    suhu = request.args.get('suhu')
    hujan = request.args.get('hujan')
    # data = ' '.join([str(suhu), str(hujan)])

    prediction = tree.predict([[suhu, hujan]])
    prediction = prediction[0]
    return jsonify(hasil=prediction)


if __name__ == '__main__':
    service.run(debug=True)
