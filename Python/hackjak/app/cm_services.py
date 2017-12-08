import sys
import cPickle as pkl

param1 = sys.argv[1]
param2 = sys.argv[2]
tree = pkl.load(open('tree.pkl', 'rb'))

def greetings(suhu=param1, hujan=param2):
    hasil = tree.predict([[suhu, hujan]])
    print hasil

if __name__ == "__main__":
    greetings()
