/* Simon HAMERY : simon.hamery2@etu.unistra.fr

    Création des tables de la base
    
*/
create table categorie(
	id_categorie number(3), /* clef primaire */
	nom_categorie varchar2(15) NOT NULL,
	CONSTRAINT PK_CATEGORIE PRIMARY KEY (id_categorie)
);

create table emission(
	id_ems number(3), /* clef primaire */
	nbEpisodes_ems number(3) NOT NULL,
	id_categorie number(3) NOT NULL,
	CONSTRAINT PK_EMISSION PRIMARY KEY (id_ems),
	FOREIGN KEY (id_categorie) REFERENCES categorie on delete cascade
);

create table video (
	id_vid number(3), /* clef primaire */
	nom_vid varchar(25) NOT NULL,
	descr_vid varchar2(60) NOT NULL,
	duree_vid number(4) NOT NULL,
	anneeDif_vid date NOT NULL,
	dateFinDif_vid date NOT NULL,
	boolMultiLang_vid CHAR(1) NOT NULL, /* 'Y' ou 'N' */
	formatLang_vid varchar2(6) NOT NULL,
	nbJourReplay_vid number(3) NOT NULL,
	id_categ number(3) NOT NULL,
	pays varchar2(15) NOT NULL, 
	id_ems number(3) NOT NULL,
	numero_episode number(3) NOT NULL,
	CONSTRAINT PK_VIDEO PRIMARY KEY (id_vid),
	FOREIGN KEY (id_ems) REFERENCES emission (id_ems) ,
	CONSTRAINT DATE_INTERVAL CHECK ((trunc(dateFinDif_vid)-trunc(anneeDif_vid)) >= 7)
);


create table archive (
	id_vid number(3), /* clef primaire */
	nom_vid varchar(25) NOT NULL,
	descr_vid varchar2(60),
	duree_vid number(4) NOT NULL,
	anneeDif_vid date NOT NULL,
	dateFinDif_vid date NOT NULL,
	boolMultiLang_vid CHAR(1) NOT NULL, /* 'Y' ou 'N' */
	formatLang_vid varchar2(6) NOT NULL,
	nbJourReplay_vid number(3) NOT NULL,
	id_categ number(3) NOT NULL,
	pays varchar2(15) NOT NULL, 
	id_ems number(3),
	numero_episode number(3) NOT NULL,
	CONSTRAINT PK_VIDEOARCHIVE PRIMARY KEY (id_vid)
);

create table utilisateur(
	id_user  number(3), /* clef primaire */
	nom_user varchar2(20),
	prenom_user varchar2(20) NOT NULL,
	login_user varchar2(20) NOT NULL,
	mdp_user varchar2(20) NOT NULL,
	dateNaiss_user date NOT NULL,
	mail_user varchar2(25) NOT NULL,
	pays varchar2(15) NOT NULL,
	boolAdmin_user CHAR(1) DEFAULT 'N', /* 'Y' ou 'N'*/
	boolNews_user CHAR(1)  DEFAULT 'N', /* 'Y' ou 'N'*/
	nb_favoris number(3),
	CONSTRAINT PK_UTILISATEUR PRIMARY KEY (id_user),
	CONSTRAINT MAX_FAVORIS CHECK (nb_favoris <= 300)
);

create table diffusion(
	id_diff number(3), /* clef primaire */
	date_diff date NOT NULL,
	id_vid number(3) NOT NULL,
	CONSTRAINT PK_DIFF PRIMARY KEY (id_diff),
	FOREIGN KEY (id_vid) REFERENCES video on delete cascade
);

create table interesse(
	id_categorie number(3),
	id_user number(3),
	FOREIGN KEY (id_categorie) REFERENCES categorie,
	FOREIGN KEY (id_user) REFERENCES utilisateur on delete cascade
);

create table abonnement(
	id_ems number(3),
	id_user number(3),
	FOREIGN KEY (id_ems) REFERENCES emission on delete cascade,
	FOREIGN KEY (id_user) REFERENCES utilisateur on delete cascade
);

create table favoris (
	id_vid number(3),
	id_user number(3),
	FOREIGN KEY (id_vid) REFERENCES video on delete cascade,
	FOREIGN KEY (id_user) REFERENCES utilisateur on delete cascade
);

create table historique(
	id_histo number(3), /* clef primaire */
	date_visio date, 
	id_user number(3),
	id_vid number(3),
	CONSTRAINT PK_HISTORIQUE PRIMARY KEY (id_histo),
	FOREIGN KEY (id_user) REFERENCES utilisateur on delete cascade,
	FOREIGN KEY (id_vid) REFERENCES video on delete cascade
);




