CREATE TABLE armas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ext_id INT UNIQUE, 
    nombre VARCHAR(150) NOT NULL,
    tipo_arma ENUM('Gran Espada', 'Espada Larga', 'Espada y Escudo', 'Dualas', 'Martillo', 'Cornamusa', 'Lanza', 'Lanza Pistola', 'Hacha Cargada', 'Hacha Espada', 'Glaive Insecto', 'Ballesta Ligera', 'Ballesta Pesada', 'Arco') NOT NULL,
    ataque INT DEFAULT 0,
    afinidad INT DEFAULT 0,
    elemento ENUM('Fuego', 'Agua', 'Rayo', 'Hielo', 'Draco', 'Nitro', 'Veneno', 'Parálisis', 'Sueño', 'Ninguno') DEFAULT 'Ninguno',
    valor_elemento INT DEFAULT 0,
    afilado JSON,
    bonus_defensa INT DEFAULT 0,
    slots JSON,
    habilidades_arma JSON,
    imagen VARCHAR(255)
);