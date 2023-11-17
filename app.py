from flask import Flask, render_template, request, redirect, url_for, session, flash
from flask_sqlalchemy import SQLAlchemy
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)
app.config['SECRET_KEY'] = 'clave_secreta'
app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///usuarios.db'  # Utilizaremos SQLite para simplificar el ejemplo
db = SQLAlchemy(app)

class Usuario(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    nombre_usuario = db.Column(db.String(80), unique=True, nullable=False)
    contraseña = db.Column(db.String(120), nullable=False)

db.create_all()

@app.route('/')
def index():
    if 'nombre_usuario' in session:
        return 'Sesión iniciada como ' + session['nombre_usuario'] + '<br>' + \
               "<b><a href='/logout'>Haz clic aquí para cerrar sesión</a></b>"
    return "No has iniciado sesión <br><a href='/login'></b>" + \
           "Haz clic aquí para iniciar sesión</b></a>"

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        nombre_usuario = request.form['nombre_usuario']
        contraseña = request.form['contraseña']
        usuario = Usuario.query.filter_by(nombre_usuario=nombre_usuario).first()
        if usuario and check_password_hash(usuario.contraseña, contraseña):
            session['nombre_usuario'] = nombre_usuario
            flash('¡Inicio de sesión exitoso!', 'success')
            return redirect(url_for('index'))
        else:
            flash('Inicio de sesión fallido. Por favor, verifica tu nombre de usuario y contraseña.', 'danger')
    return render_template('login.html')

@app.route('/logout')
def logout():
    session.pop('nombre_usuario', None)
    return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)
