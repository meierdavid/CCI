DROP TABLE ADMINISTRATEUR ;
DROP TABLE COMMERCANT ;
DROP TABLE CLIENT ;
DROP TABLE ENTREPRISE ;
DROP TABLE FAIRE_PARTIE ;
DROP TABLE PANIER ;
DROP TABLE POSTER_AVIS ;
DROP TABLE PRODUIT ;
DROP TABLE BONREDUC;
DROP TABLE COMMANDER;

CREATE TABLE ADMINISTRATEUR(
	idAdministrateur        INT NOT NULL AUTO_INCREMENT,
	prenomAdministrateur   VARCHAR (50) NOT NULL ,
	nomAdministrateur VARCHAR (50) NOT NULL,
	mailAdministrateur VARCHAR (50) NOT NULL,
	adresseAdministrateur   VARCHAR (50) NOT NULL ,
	codePAdministrateur     INT  NOT NULL ,
	villeAdministrateur     VARCHAR (50) NOT NULL ,
	telAdministrateur       INT  NOT NULL ,
	mdpAdministrateur       VARCHAR (50) NOT NULL  ,
	superAdministrateur 	TINYINT DEFAULT 0 NOT NULL,
	CONSTRAINT ADMINISTRATEUR_PK PRIMARY KEY (idAdministrateur)
);

CREATE TABLE COMMERCANT(
	idCommercant        INT NOT NULL AUTO_INCREMENT,
	prenomCommercant    VARCHAR (50) NOT NULL ,
	nomCommercant VARCHAR (50) NOT NULL,
	mailCommercant VARCHAR (50) NOT NULL,
	adresseCommercant   VARCHAR (50) NOT NULL ,
	codePCommercant     INT  NOT NULL ,
	villeCommercant     VARCHAR (50) NOT NULL ,
	telCommercant       INT  NOT NULL ,
	mdpCommercant       VARCHAR (50) NOT NULL  ,
	CONSTRAINT COMMERCANT_PK PRIMARY KEY (idCommercant)
);

CREATE TABLE CLIENT(
	idClient        INT NOT NULL AUTO_INCREMENT ,
	prenomClient    VARCHAR (50) NOT NULL ,
	nomClient VARCHAR (50) NOT NULL,
	mailClient VARCHAR (50) NOT NULL,
	adresseClient   VARCHAR (50) NOT NULL ,
	codePClient     INT NOT NULL ,
	villeClient     VARCHAR (50) NOT NULL ,
	telClient       INT  NOT NULL ,
	mdpClient       VARCHAR (50) NOT NULL ,
	pointClient     INT DEFAULT 0 NOT NULL  ,
	creditClient FLOAT DEFAULT 0 NOT NULL,
	CONSTRAINT CLIENT_PK PRIMARY KEY (idClient)
);



CREATE TABLE ENTREPRISE(
	numSiret       INT NOT NULL ,
	nomEntreprise         VARCHAR (50) NOT NULL ,
	adresseEntreprise    VARCHAR (50) NOT NULL ,
	codePEntreprise        INT  NOT NULL ,
	villeEntreprise       VARCHAR (50) NOT NULL ,
	horairesEntreprise    VARCHAR (2000)  NOT NULL ,
	livraisonEntreprise   TINYINT  NOT NULL ,
	tempsReservMax   INT  ,
	siteWebEntreprise VARCHAR (100),
	logoEntreprise	VARCHAR (2000),
	soldeEntreprise FLOAT DEFAULT 0 NOT NULL,
	CONSTRAINT ENTREPRISE_PK PRIMARY KEY (numSiret)
);



CREATE TABLE PANIER(
	idPanier           INT NOT NULL AUTO_INCREMENT ,
	prixTotPanier      FLOAT  NOT NULL ,
	datePanier        DATETIME  NOT NULL ,
	annulationPanier   TINYINT  NOT NULL ,
	paiementPanier     TINYINT  NOT NULL ,
	finaliserPanier    TINYINT  NOT NULL ,
	codePromo         VARCHAR (50) NOT NULL ,
        chainePanier     varchar(12) NOT NULL,
	idClient              INT  NOT NULL ,
	CONSTRAINT PANIER_PK PRIMARY KEY (idPanier),
	CONSTRAINT PANIER_CLIENT_FK FOREIGN KEY (idClient) REFERENCES CLIENT(idClient)
);

CREATE TABLE PRODUIT(
	idProduit             INT NOT NULL AUTO_INCREMENT ,
	nomProduit            VARCHAR (50) NOT NULL ,
	categorieProduit VARCHAR (50) NOT NULL,
	numSiret       INT NOT NULL ,
	descriptionProduit    VARCHAR (2000)  NOT NULL ,
	prixUnitaireProduit   FLOAT  NOT NULL ,
	reducProduit          FLOAT ,
	couleurProduit   VARCHAR (50) NOT NULL ,
	nbDispoProduit   INT  NOT NULL  ,
	imageProduit	VARCHAR (2000),
	CONSTRAINT PRODUIT_PK PRIMARY KEY (idProduit),
	CONSTRAINT PRODUIT_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret));


CREATE TABLE FAIRE_PARTIE(
	numSiret   INT  NOT NULL ,
	idCommercant     INT  NOT NULL  ,
	CONSTRAINT FAIRE_PARTIE_PK PRIMARY KEY (numSiret,idCommercant)

	,CONSTRAINT FAIRE_PARTIE_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret)
	,CONSTRAINT FAIRE_PARTIE_COMMERCANT_FK FOREIGN KEY (idCommercant) REFERENCES COMMERCANT(idCommercant)
);

CREATE TABLE COMMANDER(
	idProduit              INT  NOT NULL ,
	idPanier               INT  NOT NULL ,
	quantiteProd           INT  NOT NULL ,
	livraisonCommande  TINYINT  NOT NULL  ,
        AnnulerCommande  TINYINT DEFAULT 0 NOT NULL  ,
        ReceptionCommande  TINYINT DEFAULT 0 NOT NULL  ,
	CONSTRAINT COMMANDER_PK PRIMARY KEY (idProduit,idPanier)

	,CONSTRAINT COMMANDER_PRODUIT_FK FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit)
	,CONSTRAINT COMPORTER_PANIER_FK FOREIGN KEY (idPanier) REFERENCES PANIER(idPanier)
);


CREATE TABLE POSTER_AVIS(
	idProduit   INT  NOT NULL ,
	idClient       INT  NOT NULL ,
	avisClient     VARCHAR (2000)  NOT NULL  ,
	noteClient	INT (30)	NOT NULL ,
	CONSTRAINT POSTER_AVIS_PK PRIMARY KEY (idProduit,idClient)

	,CONSTRAINT POSTER_AVIS_PRODUIT_FK FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit)
	,CONSTRAINT POSTER_AVIS_CLIENT_FK FOREIGN KEY (idClient) REFERENCES CLIENT(idClient)
);

CREATE TABLE BONREDUC (
	idBon INT NOT NULL AUTO_INCREMENT,
	numSiret     INT  NOT NULL  ,
	libelleBon VARCHAR (50) NOT NULL ,
	pourcentageBon INT NOT NULL,
	descriptionBon	VARCHAR (3000) NOT NULL,
	CONSTRAINT BONREDUC_PK PRIMARY KEY (idBon),
	CONSTRAINT BONREDUC_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret)
);