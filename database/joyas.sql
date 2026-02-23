CREATE TABLE joyas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    nivel INT NOT NULL,
    habilidad VARCHAR(100),
    puntos_habilidad INT DEFAULT 1,
    descripcion TEXT
);