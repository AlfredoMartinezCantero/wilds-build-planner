CREATE TABLE armaduras (
    id INT AUTO_INCREMENT PRIMARY KEY,              -- Clave primaria, numérica, autoincremental. Identifica de forma única cada armadura
    nombre       VARCHAR(100) NOT NULL,             
    tipo         ENUM('head','chest','gloves','waist','legs') NOT NULL, 
    rareza       INT          DEFAULT 1,            
    defensa      INT          DEFAULT 0,            
    elem_fuego   INT          DEFAULT 0,            
    elem_agua    INT          DEFAULT 0,            
    elem_rayo    INT          DEFAULT 0,            
    elem_hielo   INT          DEFAULT 0,            
    elem_dragon  INT          DEFAULT 0,            
    slots        TINYINT      DEFAULT 0,            
    created_at   DATETIME     DEFAULT CURRENT_TIMESTAMP -- Fecha y hora de creación del registro; se rellena automáticamente con el momento de inserción
);

-- Índice para acelerar consultas filtrando por tipo de pieza y rareza
CREATE INDEX idx_armaduras_tipo_rareza ON armaduras(tipo, rareza);

-- Índice sobre 'nombre' para buscar armaduras por nombre más rápido
CREATE INDEX idx_armaduras_nombre      ON armaduras(nombre);

---------------

INSERT INTO armaduras (nombre, tipo, rareza, defensa, elem_fuego, elem_agua, elem_rayo, elem_hielo, elem_dragon, slots) VALUES
('Casco de Cazador',     'head',  1, 20, 0, 0, 0, 0, 0, 1),
('Pechera de Cazador',   'chest', 1, 22, 0, 0, 0, 0, 0, 1),
('Brazales de Cazador',  'gloves',1, 18, 0, 0, 0, 0, 0, 1),
('Faja de Cazador',      'waist', 1, 19, 0, 0, 0, 0, 0, 1),
('Grebas de Cazador',    'legs',  1, 21, 0, 0, 0, 0, 0, 1);
