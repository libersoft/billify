BEGIN;

DROP TABLE bug, invitation_code, pagina, paypal;
RENAME TABLE cliente TO contatto;

ALTER TABLE contatto
ADD COLUMN class_key INT DEFAULT 1
AFTER note;

ALTER TABLE contatto
ADD COLUMN contatto VARCHAR(255)
AFTER stato;

ALTER TABLE contatto
ADD COLUMN nazione VARCHAR(255)
AFTER cap;

ALTER TABLE fattura 
ADD COLUMN class_key INT DEFAULT 1
AFTER calcola_tasse;

ALTER TABLE fattura
ADD COLUMN contatto_string VARCHAR(255)
AFTER cliente_id;

ALTER TABLE fattura
ADD COLUMN descrizione VARCHAR(255)
AFTER contatto_string;

ALTER TABLE fattura
ADD COLUMN data_scadenza DATE
AFTER data_stato;

ALTER TABLE fattura
ADD COLUMN imposte FLOAT
AFTER spese_anticipate;

ALTER TABLE fattura
DROP COLUMN totale_mem;

ALTER TABLE fattura
DROP COLUMN imponibile_mem;

ALTER TABLE fattura
ADD COLUMN imponibile FLOAT(20)
AFTER imposte;


COMMIT;
