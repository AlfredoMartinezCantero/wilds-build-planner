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

-- LEATHER (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Leather Headgear','head',1),
('Leather Vest','chest',1),
('Leather Gloves','gloves',1),
('Leather Belt','waist',1),
('Leather Pants','legs',1);

-- CHAINMAIL (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Chainmail Headgear','head',1),
('Chainmail Vest','chest',1),
('Chainmail Gloves','gloves',1),
('Chainmail Belt','waist',1),
('Chainmail Pants','legs',1);

-- BONE (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Bone Helm','head',1),
('Bone Mail','chest',1),
('Bone Vambraces','gloves',1),
('Bone Coil','waist',1),
('Bone Greaves','legs',1);

-- HOPE (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Hope Mask','head',1),
('Hope Mail','chest',1),
('Hope Vambraces','gloves',1),
('Hope Coil','waist',1),
('Hope Greaves','legs',1);

-- TALIOTH (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Talioth Mask','head',1),
('Talioth Mail','chest',1),
('Talioth Vambraces','gloves',1),
('Talioth Coil','waist',1),
('Talioth Greaves','legs',1);

-- PIRAGILL (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Piragill Helm','head',1),
('Piragill Mail','chest',1),
('Piragill Vambraces','gloves',1),
('Piragill Coil','waist',1),
('Piragill Greaves','legs',1);

-- VESPOID (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Vespoid Helm','head',1),
('Vespoid Mail','chest',1),
('Vespoid Vambraces','gloves',1),
('Vespoid Coil','waist',1),
('Vespoid Greaves','legs',1);

-- BULAQCHI (Rarity 1)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Bulaqchi Specs','head',1),
('Bulaqchi Mail','chest',1),
('Bulaqchi Vambraces','gloves',1),
('Bulaqchi Coil','waist',1),
('Bulaqchi Greaves','legs',1);

-- CONGA (Rarity 2)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Conga Helm','head',2),
('Conga Mail','chest',2),
('Conga Vambraces','gloves',2),
('Conga Coil','waist',2),
('Conga Greaves','legs',2);

-- BALAHARA (Rarity 2)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Balahara Helm','head',2),
('Balahara Mail','chest',2),
('Balahara Vambraces','gloves',2),
('Balahara Coil','waist',2),
('Balahara Greaves','legs',2);

-- DOSHAGUMA (Rarity 2)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Doshaguma Helm','head',2),
('Doshaguma Mail','chest',2),
('Doshaguma Braces','gloves',2),
('Doshaguma Coil','waist',2),
('Doshaguma Greaves','legs',2);

-- AJARAKAN (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Ajarakan Helm','head',3),
('Ajarakan Mail','chest',3),
('Ajarakan Vambraces','gloves',3),
('Ajarakan Coil','waist',3),
('Ajarakan Greaves','legs',3);

-- COMAQCHI (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Comaqchi Helm','head',3),
('Comaqchi Mail','chest',3),
('Comaqchi Vambraces','gloves',3),
('Comaqchi Coil','waist',3),
('Comaqchi Greaves','legs',3);

-- HIRABAMI (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Hirabami Headdress','head',3),
('Hirabami Mail','chest',3),
('Hirabami Vambraces','gloves',3),
('Hirabami Coil','waist',3),
('Hirabami Greaves','legs',3);

-- INGOT (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Ingot Helm','head',3),
('Ingot Mail','chest',3),
('Ingot Vambraces','gloves',3),
('Ingot Coil','waist',3),
('Ingot Greaves','legs',3);

-- ROMPOPOLO (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Rompopolo Helm','head',3),
('Rompopolo Mail','chest',3),
('Rompopolo Vambraces','gloves',3),
('Rompopolo Coil','waist',3),
('Rompopolo Greaves','legs',3);

-- NERSCYLLA (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Nerscylla Helm','head',3),
('Nerscylla Mail','chest',3),
('Nerscylla Vambraces','gloves',3),
('Nerscylla Coil','waist',3),
('Nerscylla Greaves','legs',3);

-- KRANODATH (Rarity 3)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Kranodath Helm','head',3),
('Kranodath Mail','chest',3),
('Kranodath Vambraces','gloves',3),
('Kranodath Coil','waist',3),
('Kranodath Greaves','legs',3);

-- GUARDIAN DOSHAGUMA (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('G. Doshaguma Helm','head',4),
('G. Doshaguma Mail','chest',4),
('G. Doshaguma Braces','gloves',4),
('G. Doshaguma Coil','waist',4),
('G. Doshaguma Greaves','legs',4);

-- UTH DUNA (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Uth Duna Helm','head',4),
('Uth Duna Mail','chest',4),
('Uth Duna Vambraces','gloves',4),
('Uth Duna Coil','waist',4),
('Uth Duna Greaves','legs',4);

-- REY DAU (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Rey Dau Helm','head',4),
('Rey Dau Mail','chest',4),
('Rey Dau Vambraces','gloves',4),
('Rey Dau Coil','waist',4),
('Rey Dau Greaves','legs',4);

-- NU UDRA (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Nu Udra Helm','head',4),
('Nu Udra Mail','chest',4),
('Nu Udra Vambraces','gloves',4),
('Nu Udra Coil','waist',4),
('Nu Udra Greaves','legs',4);

-- GUARDIAN EBONY (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('G. Ebony Helm','head',4),
('G. Ebony Mail','chest',4),
('G. Ebony Braces','gloves',4),
('G. Ebony Coil','waist',4),
('G. Ebony Greaves','legs',4);

-- XU WU (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('Xu Wu Helm','head',4),
('Xu Wu Mail','chest',4),
('Xu Wu Vambraces','gloves',4),
('Xu Wu Coil','waist',4),
('Xu Wu Greaves','legs',4);

-- GUARDIAN ARKVELD (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('G. Arkveld Helm','head',4),
('G. Arkveld Mail','chest',4),
('G. Arkveld Vambraces','gloves',4),
('G. Arkveld Coil','waist',4),
('G. Arkveld Greaves','legs',4);

-- GUARDIAN RATHALOS (Rarity 4)
INSERT INTO armaduras (nombre,tipo,rareza) VALUES
('G. Rathalos Helm','head',4),
('G. Rathalos Mail','chest',4),
('G. Rathalos Vambraces','gloves',4),
('G. Rathalos Coil','waist',4),
('G. Rathalos Greaves','legs',4);
