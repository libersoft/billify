
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- banca
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `banca`;


CREATE TABLE `banca`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`nome_banca` VARCHAR(255)  NOT NULL,
	`abi` VARCHAR(255)  NOT NULL,
	`cab` VARCHAR(255)  NOT NULL,
	`cin` VARCHAR(255)  NOT NULL,
	`iban` VARCHAR(255)  NOT NULL,
	`numero_conto` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `banca_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- contatto
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contatto`;


CREATE TABLE `contatto`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`azienda` CHAR default '' NOT NULL,
	`ragione_sociale` VARCHAR(255),
	`via` VARCHAR(255),
	`citta` VARCHAR(100),
	`provincia` VARCHAR(5),
	`cap` VARCHAR(5),
	`nazione` VARCHAR(255),
	`piva` VARCHAR(20),
	`cf` VARCHAR(50),
	`cognome` VARCHAR(50),
	`nome` VARCHAR(50),
	`telefono` VARCHAR(20),
	`fax` VARCHAR(20),
	`cellulare` VARCHAR(20),
	`email` VARCHAR(100),
	`modo_pagamento_id` INTEGER,
	`stato` CHAR default 'a' NOT NULL,
	`contatto` VARCHAR(255),
	`id_tema_fattura` INTEGER,
	`id_banca` INTEGER,
	`calcola_ritenuta_acconto` CHAR default 'a' NOT NULL,
	`includi_tasse` CHAR default 'n' NOT NULL,
	`calcola_tasse` CHAR default 's' NOT NULL,
	`cod` VARCHAR(255),
	`note` TEXT,
	`class_key` INTEGER default 1,
	PRIMARY KEY (`id`),
	KEY `cliente_cognome_index`(`cognome`),
	KEY `cliente_id_banca_index`(`id_banca`),
	KEY `cliente_FI_1`(`modo_pagamento_id`),
	KEY `id_utente`(`id_utente`),
	KEY `piva`(`piva`),
	KEY `id_tema_fattura`(`id_tema_fattura`),
	CONSTRAINT `contatto_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `contatto_FK_2`
		FOREIGN KEY (`modo_pagamento_id`)
		REFERENCES `modo_pagamento` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `contatto_FK_3`
		FOREIGN KEY (`id_tema_fattura`)
		REFERENCES `tema_fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `contatto_FK_4`
		FOREIGN KEY (`id_banca`)
		REFERENCES `banca` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- codice_iva
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `codice_iva`;


CREATE TABLE `codice_iva`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER,
	`nome` VARCHAR(255)  NOT NULL,
	`valore` INTEGER default 0 NOT NULL,
	`descrizione` TEXT  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `codice_iva_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- categoria
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `categoria`;


CREATE TABLE `categoria`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- dettagli_fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `dettagli_fattura`;


CREATE TABLE `dettagli_fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`fattura_id` INTEGER default 0 NOT NULL,
	`descrizione` TEXT,
	`qty` VARCHAR(10) default '0' NOT NULL,
	`sconto` VARCHAR(10) default '0' NOT NULL,
	`iva` INTEGER default 0 NOT NULL,
	`prezzo` VARCHAR(50) default '0' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `dettagli_fattura_FI_1`(`fattura_id`),
	CONSTRAINT `dettagli_fattura_FK_1`
		FOREIGN KEY (`fattura_id`)
		REFERENCES `fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `fattura`;


CREATE TABLE `fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`num_fattura` VARCHAR(255),
	`cliente_id` INTEGER,
	`contatto_string` VARCHAR(100),
	`descrizione` VARCHAR(255),
	`data` DATE  NOT NULL,
	`anno` INTEGER  NOT NULL,
	`data_stato` DATE,
	`data_scadenza` DATE,
	`modo_pagamento_id` INTEGER,
	`sconto` INTEGER default 0,
	`vat` INTEGER default 20,
	`spese_anticipate` FLOAT default 0,
	`imposte` DOUBLE,
	`imponibile` DOUBLE,
	`stato` CHAR default 'n',
	`iva_pagata` CHAR default 'n',
	`iva_depositata` CHAR default 'n',
	`commercialista` CHAR default 'n',
	`categoria_id` INTEGER,
	`note` TEXT,
	`calcola_ritenuta_acconto` CHAR default 'a',
	`includi_tasse` CHAR default 'n',
	`calcola_tasse` CHAR default 's',
	`class_key` INTEGER default 1,
	`id_tema_fattura` INTEGER,
	PRIMARY KEY (`id`),
	KEY `fattura_num_fattura_index`(`num_fattura`),
	KEY `fattura_cliente_id`(`cliente_id`),
	KEY `fattura_modo_pagamento_id`(`modo_pagamento_id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `fattura_FK_1`
		FOREIGN KEY (`modo_pagamento_id`)
		REFERENCES `modo_pagamento` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	INDEX `fattura_FI_2` (`categoria_id`),
	CONSTRAINT `fattura_FK_2`
		FOREIGN KEY (`categoria_id`)
		REFERENCES `categoria` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `fattura_FK_3`
		FOREIGN KEY (`cliente_id`)
		REFERENCES `contatto` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	INDEX `fattura_FI_4` (`id_tema_fattura`),
	CONSTRAINT `fattura_FK_4`
		FOREIGN KEY (`id_tema_fattura`)
		REFERENCES `tema_fattura` (`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL,
	CONSTRAINT `fattura_FK_5`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- impostazione
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `impostazione`;


CREATE TABLE `impostazione`
(
	`id_utente` INTEGER default 0 NOT NULL,
	`num_clienti` INTEGER default 20 NOT NULL,
	`num_fatture` INTEGER default 20 NOT NULL,
	`righe_dettagli` INTEGER default 5 NOT NULL,
	`ritenuta_acconto` VARCHAR(255) default '0/100' NOT NULL,
	`tipo_ritenuta` VARCHAR(255) default 'debito' NOT NULL,
	`riepilogo_home` CHAR default 's' NOT NULL,
	`consegna_commercialista` CHAR default 'n' NOT NULL,
	`deposita_iva` CHAR default 'n' NOT NULL,
	`fattura_automatica` CHAR default 's' NOT NULL,
	`codice_cliente` CHAR default 'n' NOT NULL,
	`invoice_decorator_type` VARCHAR(255) default 'plain',
	`label_imponibile` VARCHAR(255) default 'Imponibile' NOT NULL,
	`label_spese` VARCHAR(255) default 'Spese Anticipate' NOT NULL,
	`label_imponibile_iva` VARCHAR(255) default 'Imponibile ai fini iva' NOT NULL,
	`label_iva` VARCHAR(255) default 'Iva' NOT NULL,
	`label_totale_fattura` VARCHAR(255) default 'Totale Fattura' NOT NULL,
	`label_ritenuta_acconto` VARCHAR(255) default 'Ritenuta d\'acconto' NOT NULL,
	`label_netto_liquidare` VARCHAR(255) default 'Netto da liquidare' NOT NULL,
	`label_quantita` VARCHAR(255) default 'Qty' NOT NULL,
	`label_descrizione` VARCHAR(255) default 'Descrizione' NOT NULL,
	`label_prezzo_singolo` VARCHAR(255) default 'Prezzo Singolo' NOT NULL,
	`label_prezzo_totale` VARCHAR(255) default 'Prezzo Totale' NOT NULL,
	`label_sconto` VARCHAR(255) default 'Sconto' NOT NULL,
	PRIMARY KEY (`id_utente`),
	CONSTRAINT `impostazione_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- modo_pagamento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `modo_pagamento`;


CREATE TABLE `modo_pagamento`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER,
	`num_giorni` INTEGER default 0 NOT NULL,
	`descrizione` VARCHAR(50),
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `modo_pagamento_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- tassa
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tassa`;


CREATE TABLE `tassa`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`nome` VARCHAR(255)  NOT NULL,
	`valore` VARCHAR(255)  NOT NULL,
	`descrizione` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `tassa_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- tema_fattura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tema_fattura`;


CREATE TABLE `tema_fattura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_utente` INTEGER default 0 NOT NULL,
	`nome` VARCHAR(100)  NOT NULL,
	`template` TEXT  NOT NULL,
	`css` TEXT  NOT NULL,
	`logo` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `id_utente`(`id_utente`),
	CONSTRAINT `tema_fattura_FK_1`
		FOREIGN KEY (`id_utente`)
		REFERENCES `utente` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- utente
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `utente`;


CREATE TABLE `utente`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`id_invitation_code` INTEGER,
	`username` VARCHAR(255)  NOT NULL,
	`nome` VARCHAR(255)  NOT NULL,
	`cognome` VARCHAR(255)  NOT NULL,
	`ragione_sociale` VARCHAR(255)  NOT NULL,
	`partita_iva` VARCHAR(255)  NOT NULL,
	`codice_fiscale` VARCHAR(255)  NOT NULL,
	`email` VARCHAR(255)  NOT NULL,
	`password` VARCHAR(255)  NOT NULL,
	`data_attivazione` DATE  NOT NULL,
	`data_rinnovo` DATE  NOT NULL,
	`tipo` VARCHAR(255)  NOT NULL,
	`stato` VARCHAR(255),
	`fattura` CHAR default '' NOT NULL,
	`lastlogin` DATETIME  NOT NULL,
	`approva_contratto` INTEGER default 0 NOT NULL,
	`approva_policy` INTEGER default 0 NOT NULL,
	`sconto` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `username` (`username`),
	KEY `id_invitation_code`(`id_invitation_code`)
)Engine=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
