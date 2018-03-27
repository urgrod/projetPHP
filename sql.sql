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
        tmax_pourcent Int ,
        tmax_mm       Int ,
        fmax_pourcent Int ,
        fmax_mm       Int ,
        nb_pts        Int ,
        date_creation Date ,
        fic_img       Varchar (25) ,
        fig_csv       Varchar (25) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cambrure
#------------------------------------------------------------

CREATE TABLE cambrure(
        id           int (11) Auto_increment  NOT NULL ,
        x            Int ,
        t            Int ,
        f            Int ,
        y_intra      Int ,
        y_extra      Int ,
        lgx          Int ,
        id_parametre Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE cambrure ADD CONSTRAINT FK_cambrure_id_parametre FOREIGN KEY (id_parametre) REFERENCES parametre(id);
