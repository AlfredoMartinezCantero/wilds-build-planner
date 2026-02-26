DROP TABLE IF EXISTS build_items;
DROP TABLE IF EXISTS builds;

CREATE TABLE builds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,                       
    titulo VARCHAR(150) NOT NULL,               
    notas TEXT NULL,                            
    es_publica TINYINT(1) NOT NULL DEFAULT 0,   
    target_monster VARCHAR(100) NULL,          
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- borra las builds si se borra el usuario
);

CREATE INDEX idx_builds_user ON builds(user_id);            
CREATE INDEX idx_builds_public ON builds(es_publica);       
CREATE INDEX idx_builds_monster ON builds(target_monster);  

-- Items asociados a una build (arma, armadura, joyas, talismanes...)
CREATE TABLE build_items (
    build_id   INT NOT NULL,                                
    item_type  ENUM('weapon','armor','jewel','charm') NOT NULL, 
    item_ref_id INT NOT NULL,                               
    position   ENUM(
        'weapon_main',   -- arma principal
        'weapon_sub',    -- segunda arma
        'head',
        'chest',
        'arms',
        'waist',
        'legs',
        'charm',
        'jewel'
    ) NOT NULL,
    overrides_json JSON NULL, -- ajustes personalizados (stats alterados)
    
    PRIMARY KEY (build_id, position, item_type, item_ref_id), -- impide duplicados de un mismo item en esa posición
    FOREIGN KEY (build_id) REFERENCES builds(id) ON DELETE CASCADE
);

CREATE INDEX idx_build_items_build ON build_items(build_id);      
CREATE INDEX idx_build_items_position ON build_items(position);   
CREATE INDEX idx_build_items_type ON build_items(item_type);      