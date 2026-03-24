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

-- GREAT SWORD (oficiales)
INSERT INTO armas (nombre,tipo) VALUES
('Sieglinde','great_sword'),
('Rooster Decapitator','great_sword'),
('Prinvrilo''s Dissolution','great_sword'),
('Firetrail Blaisdell','great_sword'),
('Ravager Blade','great_sword'),
('Precipice Metallam','great_sword'),
('Whitefire Rathguard','great_sword'),
('Rathalos Firesword','great_sword'),
('Immolator Blade','great_sword'),
('Düsterstolz','great_sword'),
('Bone Slasher','great_sword'),
('Abaddonian Krake','great_sword'),
('Poison King','great_sword'),
('Grimslayer Urgeom','great_sword'),
('Fulgurcleaver Guardiana','great_sword'),
('G. Stalwart Lamorak','great_sword'),
('Freezer Speartuna','great_sword'),
('Destructive Torpor','great_sword'),
('Varianza','great_sword'),
('Esperanza Blade','great_sword');

-- LONG SWORD (oficiales)
INSERT INTO armas (nombre,tipo) VALUES
('Akanesasu','long_sword'),
('Fellslayer Dangeom','long_sword'),
('Stalwart Lamorak','long_sword'),
('Giant Jawblade','long_sword'),
('Blazing Veiah','long_sword'),
('Hope Blade V','long_sword'),
('Valkyrie Blade II','long_sword'),
('Chicken Decapitator II','long_sword'),
('Quematrice Espada IV','long_sword'),
('Jin Dhavaar I','long_sword'),
('Immane Blade III','long_sword'),
('Schattenstolz I','long_sword'),
('Nu Krake II','long_sword'),
('Veldian Gladius I','long_sword'),
('Paretic Blade IV','long_sword'),
('Artian Blade II','long_sword'),
('Zoh Veiah I','long_sword'),
('Nihil Great Sword II','long_sword'),
('Buster Sword III','long_sword'),
('Albirath Wing II','long_sword');

-- SWORD & SHIELD (oficiales)
INSERT INTO armas (nombre,tipo) VALUES
('Red Wing I','sword_shield'),
('Bone Blade IV','sword_shield'),
('Slaughter II','sword_shield'),
('Hope Edge I','sword_shield'),
('Quematrice Edge II','sword_shield'),
('Gypceros Knives I','sword_shield'),
('Kut-Ku Pick I','sword_shield'),
('Gravios Scrapper I','sword_shield'),
('Rathalos Edge I','sword_shield'),
('Arkveld Shortblade I','sword_shield');

-- DUAL BLADES (oficiales)
INSERT INTO armas (nombre,tipo) VALUES
('Twin Flames I','dual_blades'),
('Nerscylla Fangs I','dual_blades'),
('Hirabami Cutters I','dual_blades'),
('Rompopolo Claws I','dual_blades'),
('Ajarakan Daggers I','dual_blades'),
('Balahara Skinners I','dual_blades'),
('Doshaguma Talons I','dual_blades'),
('Nu Udra Rippers I','dual_blades'),
('Rey Dau Twinblades I','dual_blades'),
('Uth Duna Slashers I','dual_blades');

INSERT INTO armas (nombre, tipo) VALUES
('Chatacabra Longblade','long_sword'),
('Balahara Carver','long_sword'),
('Uth Duna Edge','long_sword'),
('Nu Udra Piercer','long_sword'),
('Rey Dau Royal Katana','long_sword');

INSERT INTO armas (nombre, tipo) VALUES
('Rathalos Buckblade','sword_shield'),
('Nerscylla Cutter Shield','sword_shield'),
('Ajarakan Guardblade','sword_shield'),
('Gravios Towerblade','sword_shield'),
('Lala Barina Crest Shield','sword_shield');

INSERT INTO armas (nombre, tipo) VALUES
('Kut-Ku Twin Talons','dual_blades'),
('Nerscylla Slicers','dual_blades'),
('Hirabami Wingblades','dual_blades'),
('Balahara Whirlblades','dual_blades'),
('Doshaguma Claws','dual_blades');

INSERT INTO armas (nombre, tipo) VALUES
('Gravios Breakmaul','hammer'),
('Chatacabra Thumpdrum','hammer'),
('Rey Dau Crowncrusher','hammer'),
('Uth Duna Impact Horn','hammer'),
('Nerscylla Skullbash','hammer');

INSERT INTO armas (nombre, tipo) VALUES
('Lala Barina Serenade','hunting_horn'),
('Gore Symphony','hunting_horn'),
('Ajarakan Chant','hunting_horn'),
('Nu Udra Resonant Horn','hunting_horn'),
('Balahara Echo Drum','hunting_horn');

INSERT INTO armas (nombre, tipo) VALUES
('Guardian Rathalos Lance','lance'),
('Arkveld Guardpiercer','lance'),
('Rompopolo Spear','lance'),
('Chatacabra Impaler','lance'),
('Doshaguma Fanglance','lance');

INSERT INTO armas (nombre, tipo) VALUES
('Rey Dau Mortarlance','gunlance'),
('Nu Udra Burstlance','gunlance'),
('Gravios Slamcannon','gunlance'),
('Kut-Ku Flarebeak','gunlance'),
('Quematrice Blastlance','gunlance');

INSERT INTO armas (nombre, tipo) VALUES
('Nerscylla Morphslicer','switch_axe'),
('Balahara Switchcleaver','switch_axe'),
('Rey Dau Kingsplitter','switch_axe'),
('Arkveld Fissure Axe','switch_axe'),
('Gypceros Flash Axe','switch_axe');

INSERT INTO armas (nombre, tipo) VALUES
('Nu Udra Shieldbinder','charge_blade'),
('Uth Duna Voltblade','charge_blade'),
('Arkveld Corecleaver','charge_blade'),
('Quematrice Ignition Guard','charge_blade'),
('Rey Dau Royal Phalanx','charge_blade');

INSERT INTO armas (nombre, tipo) VALUES
('Nerscylla Glaive','insect_glaive'),
('Hirabami Skytracer','insect_glaive'),
('Chatacabra Glidepole','insect_glaive'),
('Uth Duna Leapglaive','insect_glaive'),
('Nu Udra Stormstaff','insect_glaive');

INSERT INTO armas (nombre, tipo) VALUES
('Balahara Quickshot','lbg'),
('Nerscylla Venom LBG','lbg'),
('Kut-Ku Featherbolt','lbg'),
('Lala Barina Scout Gun','lbg'),
('Quematrice Ember LBG','lbg');

INSERT INTO armas (nombre, tipo) VALUES
('Gravios Howitzer','hbg'),
('Rey Dau Siege Cannon','hbg'),
('Balahara Burrower HBG','hbg'),
('Uth Duna Thunder Roar','hbg'),
('Arkveld Rupture Cannon','hbg');

INSERT INTO armas (nombre, tipo) VALUES
('Kut-Ku Wingbow','bow'),
('Nerscylla Silkbow','bow'),
('Lala Barina Heartstring','bow'),
('Nu Udra Stormbow','bow'),
('Rey Dau Regal Bow','bow');