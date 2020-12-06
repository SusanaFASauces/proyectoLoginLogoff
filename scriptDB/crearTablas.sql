-- Autor.- Susana Fabián Antón
-- Fecha creación.- 06/12/2020
-- Última modificación.- 06/12/2020

-- creamos la tabla Usuario
CREATE TABLE IF NOT EXISTS T01_Usuario (
    T01_CodUsuario VARCHAR(15) NOT NULL,
    T01_Password VARCHAR(64) NOT NULL,
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT DEFAULT 0,
    T01_FechaHoraUltimaConexion TIMESTAMP ,
    T01_Perfil ENUM('administrador', 'usuario') DEFAULT 'usuario',
    T01_ImagenUsuario MEDIUMBLOB,
    PRIMARY KEY(T01_CodUsuario)
) ENGINE=InnoDB;