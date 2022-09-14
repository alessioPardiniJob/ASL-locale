--
-- Database: `asl`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Esame`
--

CREATE TABLE `esame` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` dateTime NOT NULL,
  `id_prestazione` varchar(4) NOT NULL,
  `temperatura_corporea_gradi` double DEFAULT NULL,
  `pressione_sanguigna_mmHG` double DEFAULT NULL,
  `frequenza_respiratoria_attiMinuto` double DEFAULT NULL,
  `ossigenazione_sanguigna_percentuale` int(11) DEFAULT NULL,
  `frequenza_cardiaca_bpm` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `esame`
--

-- INSERT INTO `esame` (`id_esame`, `data_prenotazione`, `id_prestazione`, `temperatura_corporea_gradi`, `pressione_sanguigna_mmHG`, `frequenza_respiratoria_attiMinuto`, `ossigenazione_sanguigna_percentuale`, `frequenza_cardiaca_bpm`) VALUES
-- ('00001','2020-03-14:15-15-0','0001','37.2','60.2','30.2','80','80.1');
-- INSERT INTO `esame` (`id_esame`, `data_prenotazione`, `id_prestazione`, `temperatura_corporea_gradi`, `pressione_sanguigna_mmHG`, `frequenza_respiratoria_attiMinuto`, `ossigenazione_sanguigna_percentuale`, `frequenza_cardiaca_bpm`) VALUES
-- ('00001','2021-03-20:12-0-0','0001','37.2','60.2','30.2','80','80.1');
-- INSERT INTO `esame` (`id_esame`, `data_prenotazione`, `id_prestazione`, `temperatura_corporea_gradi`, `pressione_sanguigna_mmHG`, `frequenza_respiratoria_attiMinuto`, `ossigenazione_sanguigna_percentuale`, `frequenza_cardiaca_bpm`) VALUES
-- ('00001','2021-06-25:12-0-0','0001','37.2','60.2','30.2','80','80.1');

-- --------------------------------------------------------

--
-- Struttura della tabella `Prountuario`
--

CREATE TABLE `prontuario` (
  `id_prestazione` varchar(4) NOT NULL DEFAULT '',
  `tempo_espletamento_min` int(11) DEFAULT NULL,
  `descrizione` text DEFAULT NULL,
  `n_medici` int(11) DEFAULT NULL,
  `n_infermieri` int(11) DEFAULT NULL,
  `prezzo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prontuario`
--

--  INSERT INTO `prontuario` (`id_prestazione`, `tempo_espletamento_min`, `descrizione`, `n_medici`, `n_infermieri`, `prezzo`) VALUES
--  (0001,15,"Intervento x",1,2,300);

-- --------------------------------------------------------

--
-- Struttura della tabella `EsameOperatore`
--

CREATE TABLE `esameoperatore` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` dateTime NOT NULL,
  `matricola` varchar(5) NOT NULL DEFAULT '',
  `ruolo` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `EsameOperatore`
--

--  INSERT INTO `EsameOperatore` (`id_esame`, `data_prenotazione`, `matricola`, `ruolo`) VALUES
--  ();

-- --------------------------------------------------------

--
-- Struttura della tabella `Operatore`
--

CREATE TABLE `operatore` (
  `matricola` varchar(5)  NOT NULL DEFAULT '',
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `data_assunzione` date  DEFAULT NULL,
  `cognome` varchar(40) DEFAULT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `sesso` varchar(1) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `nazionalita` varchar(30) DEFAULT NULL,
  `comune` varchar(20) DEFAULT NULL,
  `indirizzo_residenza` varchar(30) DEFAULT NULL,
  `cap_residenza` int(5) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `telefono_casa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `operatore`
--

--  INSERT INTO `operatore` (`matricola`,`codice_fiscale`, `data_assunzione`, `cognome`, `nome`,`sesso`,`data_nascita`, `nazionalita`, `comune`, `indirizzo_residenza`, `cap_residenza`, `telefono`,`telefono_casa`) VALUES
--  ('0001','BNCSFN77S16G702M','2018-03-10', 'Bianchi', 'Stefano', 'M', '1977-11-16', 'Italia','Pisa', 'Viale Carducci 34','56125','3249052011','0586123456');

-- --------------------------------------------------------

--
-- Struttura della tabella `ProntuarioOperatore`
--

CREATE TABLE `prontuariooperatore` (
  `id_prestazione` varchar(4) NOT NULL DEFAULT '',
  `matricola` varchar(5) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	
--
-- Struttura della tabella `Credenziali`
--

CREATE TABLE `credenziali` (
  `id_utente` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `credenziali`
--

--  INSERT INTO `credenziali` (`id_utente`, `email`, `password`) VALUES
--  ('0001','stefano.bianchi@gmail.com','asfksagfj$_ASFKGF12320_--kaajsKDGafAs$');

-- --------------------------------------------------------

--
-- Struttura della tabella `Paziente`
--

CREATE TABLE `paziente` (
  `codice_tessera` varchar(20) NOT NULL DEFAULT '',
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `cognome` varchar(40) DEFAULT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `sesso` varchar(1) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `nazionalita` varchar(30) DEFAULT NULL,
  `comune` varchar(20) DEFAULT NULL,
  `indirizzo_residenza` varchar(30) DEFAULT NULL,
  `cap_residenza` int(5) DEFAULT NULL,
  `indirizzo_domicilio` varchar(30) DEFAULT NULL,
  `cap_domicilio` int(5) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `telefono_casa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `paziente`
--

--  INSERT INTO `paziente` (`codice_tessera`, `codice_fiscale`, `cognome`, `nome`, `sesso`, `data_nascita`, `nazionalita`, `comune`, `indirizzo_residenza`, `cap_residenza`, `indirizzo_domicilio`, `cap_domicilio`, `telefono`, `telefono_casa`) VALUES
--  ('80380000900099515538','MZZMHL68H49E625X','Mazzoni','Michela','F','1968-06-09','Italia','Livorno','Viale giouse carducci 46','57124','Viale giouse carducci 46','57124','3480540446','3249052010');

-- --------------------------------------------------------

--
-- Struttura della tabella `Report`
--

CREATE TABLE `report` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` dateTime NOT NULL,
  `id_cartella_clinica` varchar(5) NOT NULL,
  `codice_tessera` varchar(20) NOT NULL,
  `matricola` varchar(5) DEFAULT NULL,
  `dataOra_inizio` dateTime DEFAULT NULL,
  `dataOra_fine` dateTime DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `report`
--

--  INSERT INTO `report` (`id_esame`, `data_prenotazione`, `id_cartella_clinica`, `codice_tessera`, `matricola`, `dataOra_inizio`, `dataOra_fine`, `descrizione`) VALUES
--  ('00001','2020-03-14:15-15-0','AAA1','80380000900101850626','0001','2020-03-14:15-15-0','2020-03-14:15-31-32','La mobilità della spalla risulta essere fortemente danneggiata');
-- INSERT INTO `report` (`id_esame`, `data_prenotazione`, `id_cartella_clinica`, `codice_tessera`, `matricola`, `dataOra_inizio`, `dataOra_fine`, `descrizione`) VALUES
--  ('00001','2021-03-20:12-0-0','AAA2','80380000900101850626','0001','2021-03-20:12-0-0','2021-03-20:12-15-0','La mobilità della spalla risulta essere fortemente danneggiata');
-- INSERT INTO `report` (`id_esame`, `data_prenotazione`, `id_cartella_clinica`, `codice_tessera`, `matricola`, `dataOra_inizio`, `dataOra_fine`, `descrizione`) VALUES
--  ('00001','2021-06-25:12-0-0','AAA2','80380000900101850626','0001','2021-06-25:12-0-0','2021-06-25:12-15-0','La mobilità della spalla risulta essere fortemente danneggiata');

-- --------------------------------------------------------

--
-- Struttura della tabella `provetta`
--

CREATE TABLE `provetta` (
  `id_provetta` varchar(16) NOT NULL DEFAULT '',
  `id_esame` varchar(5) NOT NULL,
  `data_prenotazione` dateTime NOT NULL,
  `id_laboratorio` varchar(5) NOT NULL,
  `id_analisi` varchar(10) NOT NULL,
  `tipologia_prelievo` varchar(30) DEFAULT NULL,
  `capienza_ml^3` double DEFAULT NULL,
  `lunghezza_mm` double DEFAULT NULL,
  `diametro_mm` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `provetta`
--

--  INSERT INTO `provetta` (`id_provetta`, `id_esame`, `data_prenotazione`,`id_laboratorio`,`id_analisi`, `tipologia_prelievo`, `capienza_ml^3`, `lunghezza_mm`, `diametro_mm`) VALUES
--  ('0000000000000001','00001','2020-03-14:15-15-0','00001','0000000001','','','','');

-- --------------------------------------------------------

--
-- Struttura della tabella `Laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` varchar(5) NOT NULL DEFAULT '',
  `nome` varchar(30) DEFAULT NULL,
  `comune` varchar(30) DEFAULT NULL,
  `indirizzo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--  INSERT INTO `laboratorio` (`id_laboratorio`, `nome`, `comune`, `indirizzo`) VALUES
--  ('00001','AslLab','Livorno','Viale ippolito nievo');

--
-- Struttura della tabella `Analisi`
--

CREATE TABLE `analisi` (
  `id_analisi` varchar(10) NOT NULL DEFAULT '',
  `id_laboratorio` varchar(5) NOT NULL,
  `id_cartella_clinica` varchar(5) NOT NULL,
  `codice_tessera` varchar(20) NOT NULL,
  `risultato_analisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- INSERT INTO `analisi` (`id_analisi`, `id_laboratorio`, `id_cartella_clinica`, `codice_tessera`, `risultato_analisi` ) VALUES
--   ('0000000001','00001','AAA1','80380000900101850626','I risultati hanno rivelato x nel paziente');

--
-- Struttura della tabella `CartellaClinica`
--

CREATE TABLE `cartellaClinica` (
  `id_cartella_clinica` varchar(5) NOT NULL DEFAULT '',
  `codice_tessera` varchar(20) NOT NULL DEFAULT 0,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `cf_medico_curante` varchar(16) DEFAULT NULL,
  `temperatura_gradi` double DEFAULT NULL,
  `peso_kg` double DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cartellaClinica`
--

--  INSERT INTO `cartellaClinica` (`id_cartella_clinica`, `codice_tessera`, `data_inizio`, `data_fine`, `cf_medico_curante`, `temperatura_gradi`, `peso_kg`, `descrizione`) VALUES
--  ('AAA1','80380000900101850626','2020-03-11','2020-04-12','MRALSS80A16E625R','36.7','58','Lesione del tendine della spalla');
-- INSERT INTO `cartellaClinica` (`id_cartella_clinica`, `codice_tessera`, `data_inizio`, `data_fine`, `cf_medico_curante`, `temperatura_gradi`, `peso_kg`, `descrizione`) VALUES
--  ('AAA2','80380000900101850626','2021-03-11','2021-04-12','MRALSS80A16E625R','36.7','58','Esame urine');
-- INSERT INTO `cartellaClinica` (`id_cartella_clinica`, `codice_tessera`, `data_inizio`, `data_fine`, `cf_medico_curante`, `temperatura_gradi`, `peso_kg`, `descrizione`) VALUES
--  ('AAA3','80380000900101850626','2021-05-12','','MRALSS80A16E625R','36.7','58','Lesione del tendine subriacomale');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `esame`
--

ALTER TABLE `esame`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`),
  ADD KEY `EsameProntuario` (`id_prestazione`);

--
-- Indici per le tabelle `prontuario`
--

ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`id_prestazione`);

--
-- Indici per le tabelle `esameoperatore`
--

ALTER TABLE `esameoperatore`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`,`matricola`);

--
-- Indici per le tabelle `operatore`
--

ALTER TABLE `operatore`
  ADD PRIMARY KEY (`matricola`);

--
-- Indici per le tabelle `prontuariooperatore`
--

ALTER TABLE `prontuariooperatore`
  ADD PRIMARY KEY (`id_prestazione`,`matricola`);

--
-- Indici per le tabelle `credenziali`
--

ALTER TABLE `credenziali`
  ADD PRIMARY KEY (`id_utente`);

--
-- Indici per le tabelle `paziente`
--

ALTER TABLE `paziente`
  ADD PRIMARY KEY (`codice_tessera`);


--
-- Indici per le tabelle `report`
--

ALTER TABLE `report`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`),
  ADD KEY `ReportCartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD KEY `ReportOperatore` (`matricola`);


--
-- Indici per le tabelle `provetta`
--

ALTER TABLE `provetta`
  ADD PRIMARY KEY (`id_provetta`),
  ADD KEY `provettaEsame` (`id_esame`,`data_prenotazione`),
  ADD KEY `provettaLaboratorio` (`id_laboratorio`);

--
-- Indici per le tabelle `laboratorio`
--

ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);


--
-- Indici per le tabelle `analisi`
--

ALTER TABLE `analisi`
  ADD PRIMARY KEY (`id_analisi`),
  ADD KEY `analisiCartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD KEY `analisiLaboratorio` (`id_laboratorio`);

--
-- Indici per le tabelle `cartellaClinica`
--

ALTER TABLE `cartellaClinica`
  ADD PRIMARY KEY (`id_cartella_clinica`,`codice_tessera`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `esame`
--

ALTER TABLE `esame`
  ADD CONSTRAINT `EsameProntuario` FOREIGN KEY (`id_prestazione`) REFERENCES `prontuario` (`id_prestazione`);

--
-- Limiti per la tabella `esameoperatore`
--

ALTER TABLE `esameoperatore`
  ADD CONSTRAINT `EsameoperatoreEsame` FOREIGN KEY (`id_esame`,`data_prenotazione`) REFERENCES `esame` (`id_esame`,`data_prenotazione`),
  ADD CONSTRAINT `EsameoperatoreOperatore` FOREIGN KEY (`matricola`) REFERENCES `operatore` (`matricola`);

--
-- Limiti per la tabella `operatore`
--

ALTER TABLE `operatore`
  ADD CONSTRAINT `operatoreCredenziali` FOREIGN KEY (`matricola`) REFERENCES `credenziali` (`id_utente`);

--
-- Limiti per la tabella `paziente`
--

ALTER TABLE `paziente`
  ADD CONSTRAINT `pazienteCredenziali` FOREIGN KEY (`codice_tessera`) REFERENCES `credenziali` (`id_utente`);

--
-- Limiti per la tabella `prontuariooperatore`
--

ALTER TABLE `prontuariooperatore`
  ADD CONSTRAINT `prontuariooperatoreProntuario` FOREIGN KEY (`id_prestazione`) REFERENCES `prontuario` (`id_prestazione`),
  ADD CONSTRAINT `prontuariooperatoreOperatore` FOREIGN KEY (`matricola`) REFERENCES `operatore` (`matricola`);
  
--
-- Limiti per la tabella `report`
--

ALTER TABLE `report`
  ADD CONSTRAINT `ReportCartellaClinica` FOREIGN KEY (`id_cartella_clinica`,`codice_tessera`) REFERENCES `cartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD CONSTRAINT `ReportOperatore` FOREIGN KEY (`matricola`) REFERENCES `operatore` (`matricola`),
  ADD CONSTRAINT `ReportEsame` FOREIGN KEY (`id_esame`,`data_prenotazione`) REFERENCES `esame` (`id_esame`,`data_prenotazione`);

--
-- Limiti per la tabella `provetta`
--

ALTER TABLE `provetta`
  ADD CONSTRAINT `provettaEsame` FOREIGN KEY (`id_esame`,`data_prenotazione`) REFERENCES `esame` (`id_esame`,`data_prenotazione`),
  ADD CONSTRAINT `provettaLaboratorio` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`);
 
--
-- Limiti per la tabella `analisi`
--

ALTER TABLE `analisi`
  ADD CONSTRAINT `analisiCartellaClinica` FOREIGN KEY (`id_cartella_clinica`,`codice_tessera`) REFERENCES `cartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD CONSTRAINT `analisiLaboratorio` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`);
 
--
-- Limiti per la tabella `cartellaClinica`
--

ALTER TABLE `cartellaClinica`
  ADD CONSTRAINT `cartellaClinicaPaziente` FOREIGN KEY (`codice_tessera`) REFERENCES `paziente` (`codice_tessera`);
COMMIT;
