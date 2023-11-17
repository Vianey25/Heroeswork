-- Crear la tabla Empresa
CREATE TABLE Empresa (
    id_empresa INTEGER PRIMARY KEY,
    nombre TEXT NOT NULL,
    direccion TEXT,
    telefono TEXT,
    correo_electronico TEXT,
    descripcion TEXT,
    RFC TEXT
);

-- Crear la tabla Vacantes
CREATE TABLE Vacantes (
    id_vacante INTEGER PRIMARY KEY,
    id_empresa INTEGER REFERENCES Empresa(id_empresa),
    titulo TEXT NOT NULL,
    descripcion TEXT,
    tiempo TEXT,
    sueldo REAL,
    requisitos TEXT,
    responsabilidades TEXT
);

-- Crear la tabla Solicitud
CREATE TABLE Solicitud (
    id_solicitud INTEGER PRIMARY KEY,
    id_vacante INTEGER REFERENCES Vacantes(id_vacante),
    id_candidato INTEGER,
    estado TEXT,
    fecha TEXT,
    FOREIGN KEY (id_candidato) REFERENCES Candidato(id_candidato)
);

-- Crear la tabla Test
CREATE TABLE Test (
    id_test INTEGER PRIMARY KEY,
    id_solicitud INTEGER REFERENCES Solicitud(id_solicitud),
    id_candidato INTEGER,
    resultados TEXT,
    FOREIGN KEY (id_solicitud, id_candidato) REFERENCES Solicitud(id_solicitud, id_candidato)
);

-- Crear la tabla Candidato
CREATE TABLE Candidato (
    id_candidato INTEGER PRIMARY KEY,
    id_escuela INTEGER REFERENCES Escuela(id_escuela),
    nombre TEXT NOT NULL,
    direccion TEXT,
    edad INTEGER,
    discapacidad TEXT,
    habilidades TEXT,
    telefono TEXT,
    sexo TEXT,
    correo TEXT
);

-- Crear la tabla Escuela
CREATE TABLE Escuela (
    id_escuela INTEGER PRIMARY KEY,
    nombre TEXT NOT NULL,
    direccion TEXT,
    telefono TEXT
);
