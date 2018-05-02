#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: parametre
#------------------------------------------------------------

CREATE TABLE parametre(
        id            int (11) Auto_increment  NOT NULL ,
        libelle       Varchar (25) ,
        corde         Int ,
        tmax_mm       Int ,
        tmax_pourcent Int ,
        fmax_mm       Int ,
        fmax_pourcent Int ,
        nb_points     Int ,
        date_creation Date ,
        fic_img       Varchar (25) ,
        fic_csv       Varchar (25) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cambrure
#------------------------------------------------------------

CREATE TABLE cambrure(
        id           int (11) Auto_increment  NOT NULL ,
        x            Float ,
        t            Float ,
        f            Float ,
        yintra       Float ,
        yextra       Float ,
        lgx          Float ,
        id_parametre Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE cambrure ADD CONSTRAINT FK_cambrure_id_parametre FOREIGN KEY (id_parametre) REFERENCES parametre(id);
