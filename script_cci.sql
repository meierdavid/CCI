DROP TABLE ADMINISTRATEUR ;
DROP TABLE COMMERCANT ;
DROP TABLE CLIENT ;
DROP TABLE COMPORTER_PANIER ;
DROP TABLE ENTREPRISE ;
DROP TABLE FAIRE_PARTIE ; 
DROP TABLE PANIER ; 
DROP TABLE POSTER_AVIS ;
DROP TABLE PRODUIT ; 
DROP TABLE SOUSPANIER ; 
DROP TABLE SOUSPRODUIT ;

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
	pointClient     INT  NOT NULL  ,
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
	idClient              INT  NOT NULL ,
	numSiret           INT NOT NULL,
	CONSTRAINT PANIER_PK PRIMARY KEY (idPanier),
	CONSTRAINT PANIER_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret),
	CONSTRAINT PANIER_CLIENT_FK FOREIGN KEY (idClient) REFERENCES CLIENT(idClient)
);


CREATE TABLE SOUSPANIER(
	idPanier          INT  NOT NULL ,
	idSousPanier        INT  NOT NULL ,
	montantSousPanier   FLOAT  NOT NULL ,
	numSiret          INT NOT NULL,
	CONSTRAINT SOUSPANIER_PK PRIMARY KEY (idPanier,idSousPanier),
	CONSTRAINT SOUSPANIER_PANIER_FK FOREIGN KEY (idPanier) REFERENCES PANIER(idPanier),
	CONSTRAINT SOUSPANIER_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret)
);

CREATE TABLE PRODUIT(
	idProduit             INT NOT NULL AUTO_INCREMENT ,
	nomProduit            VARCHAR (50) NOT NULL ,
	categorieProduit VARCHAR (50) NOT NULL,
	numSiret       INT NOT NULL ,
	descriptionProduit    VARCHAR (2000)  NOT NULL ,
	prixUnitaireProduit   FLOAT  NOT NULL ,
	reducProduit          FLOAT ,
	CONSTRAINT PRODUIT_PK PRIMARY KEY (idProduit),
	CONSTRAINT PRODUIT_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret));



CREATE TABLE SOUSPRODUIT(
	idProduit          INT  NOT NULL ,
	idSousProduit        INT  NOT NULL ,
	tailleSousProduit    VARCHAR (50) NOT NULL ,
	couleurSousProduit   VARCHAR (50) NOT NULL ,
	nbDispoSousProduit   INT  NOT NULL  ,
	CONSTRAINT SOUSPRODUIT_PK PRIMARY KEY (idProduit,idSousProduit),
	CONSTRAINT SOUSPRODUIT_PRODUIT_FK FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit));

CREATE TABLE FAIRE_PARTIE(
	numSiret   INT  NOT NULL ,
	idCommercant     INT  NOT NULL  ,
	CONSTRAINT FAIRE_PARTIE_PK PRIMARY KEY (numSiret,idCommercant)

	,CONSTRAINT FAIRE_PARTIE_ENTREPRISE_FK FOREIGN KEY (numSiret) REFERENCES ENTREPRISE(numSiret)
	,CONSTRAINT FAIRE_PARTIE_COMMERCANT_FK FOREIGN KEY (idCommercant) REFERENCES COMMERCANT(idCommercant)
);


CREATE TABLE COMPORTER_PANIER(
	idProduit              INT  NOT NULL ,
	idSousProduit            INT  NOT NULL ,
	idPanier               INT  NOT NULL ,
	idSousPanier             INT  NOT NULL ,
	quantiteProd           INT  NOT NULL ,
	livraisonReservation   TINYINT  NOT NULL  ,
	CONSTRAINT COMPORTER_PANIER_PK PRIMARY KEY (idProduit,idSousProduit,idPanier,idSousPanier)

	,CONSTRAINT COMPORTER_PANIER_SOUSPRODUIT_FK FOREIGN KEY (idProduit,idSousProduit) REFERENCES SOUSPRODUIT(idProduit,idSousProduit)
	,CONSTRAINT COMPORTER_PANIER_SOUSPANIER0_FK FOREIGN KEY (idPanier,idSousPanier) REFERENCES SOUSPANIER(idPanier,idSousPanier)
);


CREATE TABLE POSTER_AVIS(
	idProduit   INT  NOT NULL ,
	idClient       INT  NOT NULL ,
	avisClient     VARCHAR (2000)  NOT NULL  ,
	CONSTRAINT POSTER_AVIS_PK PRIMARY KEY (idProduit,idClient)

	,CONSTRAINT POSTER_AVIS_PRODUIT_FK FOREIGN KEY (idProduit) REFERENCES PRODUIT(idProduit)
	,CONSTRAINT POSTER_AVIS_CLIENT_FK FOREIGN KEY (idClient) REFERENCES CLIENT(idClient)
);
