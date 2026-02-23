CREATE TABLE armaduras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ext_id INT UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    tipo ENUM('head', 'chest', 'gloves', 'waist', 'legs') NOT NULL,
    defensa_base INT DEFAULT 0,
    defensa_max INT DEFAULT 0,
    res_fuego INT DEFAULT 0,
    res_agua INT DEFAULT 0,
    res_rayo INT DEFAULT 0,
    res_hielo INT DEFAULT 0,
    res_draco INT DEFAULT 0,
    slots JSON,
    habilidades JSON,
    imagen VARCHAR(255)
);