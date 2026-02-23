CREATE TABLE builds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nombre_build VARCHAR(100) DEFAULT 'Nueva Build',
    id_casco INT,
    id_pechera INT,
    id_brazales INT,
    id_faja INT,
    id_botas INT,
    descripcion TEXT,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_casco) REFERENCES armaduras(id),
    FOREIGN KEY (id_pechera) REFERENCES armaduras(id),
    FOREIGN KEY (id_brazales) REFERENCES armaduras(id),
    FOREIGN KEY (id_faja) REFERENCES armaduras(id),
    FOREIGN KEY (id_botas) REFERENCES armaduras(id)
);