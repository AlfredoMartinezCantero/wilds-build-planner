CREATE TABLE armas (
    id INT AUTO_INCREMENT PRIMARY KEY,          
    nombre       VARCHAR(100) NOT NULL,         
    tipo         VARCHAR(50)  NOT NULL,         
    rareza       INT          DEFAULT 1,        
    ataque       INT          DEFAULT 0,        
    elemento     VARCHAR(50)  DEFAULT NULL,     
    afinidad     INT          DEFAULT 0,        
    defensa      INT          DEFAULT 0,        
    created_at   DATETIME     DEFAULT CURRENT_TIMESTAMP 
);

CREATE INDEX idx_armas_nombre ON armas(nombre); -- Acelera búsquedas por nombre
CREATE INDEX idx_armas_tipo   ON armas(tipo);   -- Útil para filtrar por tipo de arma
CREATE INDEX idx_armas_rareza ON armas(rareza); -- Mejora consultas por rareza

----------------------

INSERT INTO armas (nombre, tipo, rareza, ataque, elemento, afinidad, defensa) VALUES
('Gran Espada',       'great_sword',   1, 100, NULL,  0, 0),
('Espada Larga',      'long_sword',    1,  95, NULL,  0, 0),
('Espada y Escudo',   'sword_shield',  1,  80, NULL,  0, 0),
('Doble Espadas',     'dual_blades',   1,  70, NULL,  0, 0),
('Lanza',             'lance',         1,  90, NULL,  0, 0),
('Lanza Pistola',     'gunlance',      1,  92, NULL,  0, 0),
('Martillo',          'hammer',        1, 105, NULL,  0, 0),
('Cornamusa',         'hunting_horn',  1,  98, NULL,  0, 0),
('Hacha Espada',      'switch_axe',    1,  96, NULL,  0, 0),
('Hacha Cargada',     'charge_blade',  1,  94, NULL,  0, 0),
('Insectoglaive',     'insect_glaive', 1,  85, NULL,  0, 0),
('Ballesta Ligera',   'lbg',           1,  75, NULL,  0, 0),
('Ballesta Pesada',   'hbg',           1,  85, NULL,  0, 0),
('Arco',              'bow',           1,  80, NULL,  0, 0);