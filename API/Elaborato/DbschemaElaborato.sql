--
-- Database: `asl`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Esame`
--


CREATE TABLE `esame` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` date NOT NULL,
  `id_prestazione` varchar(4) NOT NULL,
  `temperatura_corporea_gradi` double DEFAULT NULL,
  `pressione_sanguigna_mmHG` double DEFAULT NULL,
  `frequenza_respiratoria_attiMinuto` double DEFAULT NULL,
  `ossigenazione_sanguigna_percentuale` int(11) DEFAULT NULL,
  `frequenza_cardiaca_bpm` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `EsameOperatore`
--

CREATE TABLE `esameoperatore` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` date NOT NULL,
  `matricola` varchar(5) NOT NULL DEFAULT '',
  `ruolo` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `Credenziali`
--

CREATE TABLE `credenziali` (
  `id_utente` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struttura della tabella `Report`
--

CREATE TABLE `report` (
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` date NOT NULL,
  `id_cartella_clinica` varchar(5) NOT NULL,
  `codice_tessera` varchar(20) NOT NULL,
  `matricola` varchar(5) NOT NULL,
  `dataOra_inizio` dateTime DEFAULT NULL,
  `dataOra_fine` dateTime DEFAULT NULL,
  `descrizione` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `provetta`
--

CREATE TABLE `provetta` (
  `id_provetta` varchar(16) NOT NULL DEFAULT '',
  `id_esame` varchar(5) NOT NULL DEFAULT '',
  `data_prenotazione` date NOT NULL,
  `id_laboratorio` varchar(5) NOT NULL DEFAULT '',
  `tipologia_prelievo` varchar(30) DEFAULT NULL,
  `capienza_ml^3` double DEFAULT NULL,
  `lunghezza_mm` double DEFAULT NULL,
  `diametro_mm` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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


--
-- Struttura della tabella `Analisi`
--

CREATE TABLE `analisi` (
  `id_analisi` varchar(10) NOT NULL DEFAULT '',
  `id_laboratorio` varchar(5) NOT NULL,
  `id_cartella_clinica` varchar(5) NOT NULL,
  `codice_tessera` varchar(20) NOT NULL,
  `risultato_analisi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indici per la tabella scaricate
--

--
-- Indici per la tabella `esame`
--

ALTER TABLE `esame`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`),
  ADD KEY `EsameProntuario` (`id_prestazione`);

--
-- Indici per la tabella `prontuario`
--

ALTER TABLE `prontuario`
  ADD PRIMARY KEY (`id_prestazione`);

--
-- Indici per la tabella `esameoperatore`
--

ALTER TABLE `esameoperatore`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`,`matricola`);

--
-- Indici per la tabella `operatore`
--
ALTER TABLE `operatore`
  ADD PRIMARY KEY (`matricola`);

--
-- Indici per la tabella `credenziali`
--

ALTER TABLE `credenziali`
  ADD PRIMARY KEY (`id_utente`);

--
-- Indici per la tabella `paziente`
--

ALTER TABLE `paziente`
  ADD PRIMARY KEY (`codice_tessera`);

--
-- Indici per la tabella `report`
--

ALTER TABLE `report`
  ADD PRIMARY KEY (`id_esame`,`data_prenotazione`),
  ADD KEY `ReportCartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD KEY `ReportOperatore` (`matricola`);

--
-- Indici per la tabella `provetta`
--

ALTER TABLE `provetta`
  ADD PRIMARY KEY (`id_provetta`),
  ADD KEY `provettaEsame` (`id_esame`,`data_prenotazione`),
  ADD KEY `provettaLaboratorio` (`id_laboratorio`);

--
-- Indici per la tabella `laboratorio`
--

ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`);

--
-- Indici per la tabella `analisi`
--

ALTER TABLE `analisi`
  ADD PRIMARY KEY (`id_analisi`),
  ADD KEY `analisiCartellaClinica` (`id_cartella_clinica`,`codice_tessera`),
  ADD KEY `analisiLaboratorio` (`id_laboratorio`);

--
-- Indici per la tabella `cartellaClinica`
--

ALTER TABLE `cartellaClinica`
  ADD PRIMARY KEY (`id_cartella_clinica`,`codice_tessera`);

--
-- Limiti per la tabella scaricate
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

