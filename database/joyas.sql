DROP TABLE IF EXISTS joyas;

CREATE TABLE joyas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre       VARCHAR(100) NOT NULL,
    rareza       INT          DEFAULT 1,
    nivel_slot   TINYINT      NOT NULL DEFAULT 1,  -- Slot 1, 2, 3, 4...
    descripcion  TEXT         NULL,
    created_at   DATETIME     DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX idx_joyas_nombre ON joyas(nombre);
CREATE INDEX idx_joyas_rareza ON joyas(rareza);
CREATE INDEX idx_joyas_nivel_slot ON joyas(nivel_slot);



-- (cuando tenga tabla skills)
-- CREATE TABLE joya_skills (
--     joya_id   INT NOT NULL,
--     skill_id  INT NOT NULL,
--     level     TINYINT NOT NULL DEFAULT 1,
--     PRIMARY KEY (joya_id, skill_id),
--     FOREIGN KEY (joya_id) REFERENCES joyas(id) ON DELETE CASCADE,
--     FOREIGN KEY (skill_id) REFERENCES skills(id) ON DELETE CASCADE
-- );