CREATE DATABASE prueba1
USE prueba1

 CREATE TABLE Roles (
    id_rol INT PRIMARY KEY IDENTITY(1,1),
    nombre_rol VARCHAR(50) NOT NULL,
    descripcion TEXT
);
CREATE TABLE Usuarios (
    id_usuario INT PRIMARY KEY IDENTITY(1,1),
    id_rol INT,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    edad TINYINT,
    celular VARCHAR(20),
    FOREIGN KEY (id_rol) REFERENCES Roles(id_rol)
);

CREATE TABLE Cursos (
    id_curso INT PRIMARY KEY IDENTITY(1,1),
    nombre_curso VARCHAR(255) NOT NULL,
    descripcion TEXT,
    status TINYINT NOT NULL DEFAULT 1, -- 1 = Activo, 0 = Archivado
    version INT DEFAULT 1,
    imagen VARBINARY(MAX)  -- VARBINARY(MAX) para almacenar im�genes o archivos grandes
);

CREATE TABLE Modulos (
    id_modulo INT PRIMARY KEY IDENTITY(1,1),
    nombre_modulo VARCHAR(255) NOT NULL,
    id_curso INT,
    version INT DEFAULT 1,
    contenido TEXT,
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
);

CREATE TABLE Recursos (
    id_recurso INT PRIMARY KEY IDENTITY(1,1),
    id_modulo INT,
    tipo_recurso VARCHAR(50),  -- video, pdf, imagen, etc.
    url_recurso TEXT,  -- ruta del archivo o contenido multimedia
    descripcion TEXT,
    FOREIGN KEY (id_modulo) REFERENCES Modulos(id_modulo)
);

CREATE TABLE Evaluaciones (
    id_evaluacion INT PRIMARY KEY IDENTITY(1,1),
    id_curso INT,
    nombre_evaluacion VARCHAR(255) NOT NULL,
    descripcion TEXT,
    fecha DATE,
    tipo VARCHAR(50),  -- tarea, cuestionario, examen, etc.
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso)
);

CREATE TABLE Rubricas (
    id_rubrica INT PRIMARY KEY IDENTITY(1,1),
    id_evaluacion INT,
    criterio VARCHAR(255),
    puntaje_maximo INT,
    FOREIGN KEY (id_evaluacion) REFERENCES Evaluaciones(id_evaluacion)
);

CREATE TABLE Calificaciones (
    id_calificacion INT PRIMARY KEY IDENTITY(1,1),
    id_usuario INT,
    id_evaluacion INT,
    puntaje_obtenido INT,
    fecha_evaluacion DATE,
    comentarios TEXT,
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario),
    FOREIGN KEY (id_evaluacion) REFERENCES Evaluaciones(id_evaluacion)
);

CREATE TABLE Notificaciones (
    id_notificacion INT PRIMARY KEY IDENTITY(1,1),
    id_usuario INT,
    titulo VARCHAR(255),
    texto_comentario TEXT,
    fecha DATETIME DEFAULT GETDATE(), -- Fecha y hora actual al crear la notificaci�n
    leido TINYINT DEFAULT 0,  -- 0 = no le�do, 1 = le�do
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE Foros (
    id_foro INT PRIMARY KEY IDENTITY(1,1),
    id_curso INT,
    id_usuario INT,
    titulo VARCHAR(255),
    texto TEXT,
    fecha DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (id_curso) REFERENCES Cursos(id_curso),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE RespuestasForo (
    id_respuesta INT PRIMARY KEY IDENTITY(1,1),
    id_foro INT,
    id_usuario INT,
    texto TEXT,
    fecha DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (id_foro) REFERENCES Foros(id_foro),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);

CREATE TABLE Logs (
    id_log INT PRIMARY KEY IDENTITY(1,1),
    id_usuario INT,
    accion VARCHAR(255),
    fecha DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (id_usuario) REFERENCES Usuarios(id_usuario)
);
