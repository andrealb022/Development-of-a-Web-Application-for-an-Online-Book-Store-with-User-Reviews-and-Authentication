drop table if exists libri cascade;
drop table if exists recensioni cascade;
drop table if exists utenti cascade;

create table libri(
    titolo varchar(50) not null,
	ISBN char(13) Primary Key,
	copertina varchar(40),
	genere varchar(20),
	descrizione varchar(600),
	pagine integer not null,
	autore varchar(30) not null,
	editore varchar(20) not null,
	anno integer,
	prezzo decimal(5,2) not null,
	num_recensioni integer default 0,
	voto decimal(3,2) default 0.0
);

create table utenti(
	nome varchar(20),
	cognome varchar(20),
    	nickname varchar(20) unique not null,
	mail varchar(40) primary key,
	passwd varchar(255) not null,
	risposta varchar(255) not null,
	data_di_nascita date not null
);

create table recensioni(
    libro char(13) references libri(ISBN) on delete cascade on update cascade,
	utente varchar(20) references utenti(nickname) on delete cascade on update cascade,
	nome varchar(20),
	contenuto varchar(500),
	voto integer not null,
	data_inserimento date not null,
	primary key (libro,utente)
);


						 
insert into libri values('Slender man', '9788834735367', 'Copertine/Slender man.jpg', 'Horror', 
						 'Mentre i suoi amici si disperano e la polizia la cerca freneticamente, Matt Barker, suo compagno nella scuola più esclusiva della città, comincia a sognare alberi minacciosi, cieli in tempesta e qualcosa di oscuro che si avvicina sempre di più. Una figura terrificante, alta, con lunghe braccia, si fa largo nel confine fra realtà e incubo.', 
						 192, 'Dexter Morgenstern ', 'Fanucci', 2018, 12.83);
						 
insert into libri values('The outsider', '9788820066239', 'Copertine/The outsider.jpg', 'Horror', 
						 'Un poliziotto un po'' in la con gli anni ma di grande esperienza ed un''investigatrice poco incline ad utilizzare metodi tradizionali per svolgere le indagini, si trovano ad affrontare l''omicidio di Frankie Peterson, undicenne barbaramente ucciso a Flint City, in Georgia, USA.', 
						 530, 'Stephen King', 'Sperling & Kupfer', 2018, 12.25);
						 
insert into libri values('Phobia ', '9788850256273', 'Copertine/Phobia.jpg', 'Horror', 
						'Sarah sta dormendo quando sente rientrare il marito, che sarebbe dovuto restare via per lavoro ancora qualche giorno. Ma l''uomo che trova in cucina intento a prepararsi un panino non è Stephen. Per Sarah e per Harvey, il figlio di sei anni, incomincia un incubo atroce, anche perché lo sconosciuto scompare così come era apparso e nessuno crede alla sua esistenza.', 
						324 , 'Wulf Dorn', 'TEA ', 2020, 4.75);	
						
insert into libri values('Spare. Il minore', '9788804754985', 'Copertine/Spare il minore.jpg', 'Biografia', 
						'È stata una delle più strazianti immagini del Ventesimo secolo: due ragazzini, due principi, che seguono il feretro della madre sotto gli occhi addolorati e inorriditi del mondo intero. Miliardi di persone si chiedevano quali pensieri affollassero la mente dei principi, quali emozioni passassero per i loro cuori, e come si sarebbero dipanate le loro vite da quel momento in poi. Finalmente Harry racconta la sua storia. Con la sua cruda e implacabile onestà, "Spare. Il minore" è una pubblicazione epocale.', 
						540, ' Prince Harry', 'Mondadori ', 2023, 23.75);	
						
insert into libri values('Open. La mia storia', '9788806229726', 'Copertine/Open la mia storia.jpg', 'Biografia', 
						'Costretto ad allenarsi sin da quando aveva quattro anni da un padre dispotico ma determinato a farne un campione a qualunque costo, Andre Agassi cresce con un sentimento fortissimo: l''odio smisurato per il tennis. Contemporaneamente però prende piede in lui anche la consapevolezza di possedere un talento eccezionale.', 
						502, 'Andre Agassi', 'Einaudi ', 2015, 13.77);	
						
						
insert into libri values('Io sono il calcio', '9788817108331', 'Copertine/Io sono il calcio.jpg', 'Biografia', 
						'Uno degli ultimi bad boy del calcio mondiale racconta in parole e immagini i vent''anni della sua inimitabile carriera. «Questo è il racconto del mio viaggio al servizio del calcio. Niente è impossibile per chi decide di non arrendersi mai e io l''ho dimostrato. Oltre a vittorie e trofei, il calcio mi ha dato una vita e una serenità che mai avrei potuto immaginare. Coltiva il tuo talento, credi in te stesso e lavora sodo. Nulla potrà più fermarti.»',
						300, 'Zlatan Ibrahimovic', 'Rizzoli ', 2018, 13.59);								
						
						
						

insert into libri values('Il dono','9788856690095','Copertine/Il dono.jpg','Thriller',
						 '«È stato il mio cuore. Non sono stato io.» Con queste parole, e un coltello insanguinato tra le mani, l''uomo accoglie la polizia. Tutti lo conoscono, è un giornalista che si è sempre occupato di cronaca nera, unica persona a cui molti criminali hanno deciso di rilasciare un''intervista. ...',
						 362,'Paola Barbato','Piemme',2023,18.90);

insert into libri values('Un giudizio immediato', '9798770317282', 'Copertine/Un giudizio immediato.jpg', 'Thriller', 
						 'Il corpo senza vita di Eleonora Cardillo, una studentessa promettente del Politecnico di Milano, viene ritrovato in un luogo desolato della periferia milanese. Jamal Babangida, ritenuto responsabile della sua morte, è in carcere.', 
						 162, 'Cristina Barbieri','Piemme',2021,10.39);

insert into libri values('Io so chi sei', '9788868369330', 'Copertine/Io so chi sei.jpg', 'Thriller', 
						 'Sono passati solo due anni, e di tutto ciò che è stata non è rimasto nulla. Lena era brillante, determinata, brava a detta di tutti, curata, buona. Poi nella sua vita era entrato Saverio, e tutto era stato stravolto. Quel ragazzo più giovane, che viveva per essere contro qualsiasi regola, pregiudizio, conformità, l''aveva trasformata. E non erano solo i vestiti, i capelli, le parole. Era lei, le sue sicurezze, il suo amor proprio. Tutto calpestato in nome di un amore che agli occhi di tutti gli altri era solo nella sua testa.',
						 520, 'Paola Barbato','Piemme',2019, 11.39);

insert into libri values('La grande avventura', '9788817158428', 'Copertine/La grande avventura.jpg', 'Avventura', 
						 '1942, Inghilterra. Dopo che una bomba ha distrutto la sua casa e gli ha portato via la famiglia, Harry si mette in cammino sulla costa. Il ragazzino troverà conforto in Don, un grosso cane lupo, che lo accompagnerà in questa avventura verso la salvezza, durante la quale Harry capirà le cose della vita, della guerra e dell''amore.',
						 230,'Robert Westall','Rizzoli',2021,9.50);

insert into libri values('La mappa dei desideri', '9788804655589', 'Copertine/La mappa dei desideri.jpg', 'Avventura', 
						 'Chi possiede la Mappa dei Desideri può arrivare ovunque voglia. Per il momento però nessuno può servirsi dei suoi poteri, perché è stata divisa in brandelli: il primo, la Rosa dei Venti, appare all''improvviso nel parcheggio di un supermercato insieme a un''onda d''acqua solcata da un vascello di corsari, sotto lo sguardo incredulo della dodicenne Marrill. Intenta a inseguire il suo gatto, Marrill si trova catapultata nella Corrente Pirata, un mondo popolato da foreste parlanti, farfalle di spuma di mare e crostacei con le piume.', 
						 345, 'Carrie Ryan', 'Mondadori',2015, 10.92);

insert into libri values('Il lupo e il leone', '9788836244614', 'Copertine/Il lupo e il leone.jpg', 'Avventura', 
						 'Alla morte del nonno Alma torna nella casa dell’infanzia, su un’isola in mezzo a un lago circondato dalle foreste. La tranquillità delle sue giornate è sconvolta quando all’improvviso nella sua vita fanno irruzione un lupacchiotto e un leoncino. La ragazza decide di prendersene cura di nascosto da tutti, per proteggerli dagli uomini che li vogliono catturare e rinchiudere. I due cuccioli crescono giocando insieme come fratelli. Ma un giorno il segreto viene scoperto: il lupo è rinchiuso in una riserva naturale e il leone spedito in un circo.', 
						 112, 'Gilles de Maistre','Gallucci',2022,9.40);
						 
insert into libri values('Fahrenheit 451','9788804665298','Copertine/F451.jpg','Fantascienza',
						 'Ambientato in un imprecisato futuro, vi si descrive una società distopica in cui leggere o possedere libri è considerato un reato, per contrastare il quale è stato istituito un apposito corpo di vigili del fuoco impegnato a bruciare ogni tipo di volume.Il protagonista, Montag, lavora nei vigili del fuoco. Nella sua epoca però i pompieri, "la milizia del fuoco", non spengono gli incendi, ma invece danno fuoco alle case di coloro che hanno violato la legge, e nello specifico a coloro che detengono e nascondono libri, assolutamente illegali.',
						 192,'Ray Bradbury','Mondadori',1956,12.50);

insert into libri values('The Truth Untold','9791259571793','Copertine/TruthUntoldjpg.jpg','Fantascienza',
						 'C’erano una volta una città divisa, un amore indissolubile, una bugia da svelare. Ogni fiaba ha un lieto fine? In una città dilaniata dall’odio, i Red e i White vivono divisi. Alti cancelli separano i loro due mondi, almeno fino al giorno in cui il sindaco non decide di trasferire gli studenti della Red School alla White Academy, per far sì che le fazioni si mescolino e la tensione che ormai da troppo tempo imperversa si stemperi...',
						 592,'Rokia','Magazzini Salani',2022,16.05);

insert into libri values('Anna','9788806234485','Copertine/Anna.jpg','Fantascienza',
						 'In una Sicilia diventata un''immensa rovina, una tredicenne cocciuta e coraggiosa parte alla ricerca del fratellino rapito. Fra campi arsi e boschi misteriosi, ruderi di centri commerciali e città abbandonate, fra i grandi spazi deserti di un''isola riconquistata dalla natura e selvagge comunità di sopravvissuti, Anna ha come guida il quaderno che le ha lasciato la mamma con le istruzioni per farcela.',
						 314,'Niccolò Ammaniti','Einaudi',2015,14.50);

insert into libri values('Delitti a Fleat House','9788809953680','Copertine/DelittiFleatjpg.jpg','Azione',
						 'L''improvvisa morte di Charlie Cavendish, nell’austero dormitorio di Fleat House, è un evento scioccante che il preside è subito propenso a liquidare come un tragico incidente. Ma la polizia non può escludere che si tratti di un crimine e il caso richiede il ritorno in servizio dell’ispettore Jazmine “Jazz” Hunter.',
						 498,'Lucinda Riley','Giunti',2022,19.80);

insert into libri values('Metro 2033','9788863550979','Copertine/Metro2033.jpg','Azione',
						 'L’anno è il 2033. Il mondo è ridotto ad un cumulo di macerie. L’umanità è vicina all’estinzione. Le città mezze distrutte sono diventate inagibili a causa delle radiazioni. Al di fuori dei loro confini, si dice, solo deserti e foreste bruciate. I sopravvissuti ancora narrano la passata grandezza dell’umanità. Ma gli ultimi barlumi della civiltà fanno già parte di una memoria lontana, a cavallo tra realtà e mito.',
						 779,'Dmitry Glukhovsky','MPlayer Edizioni',2010,17.90);

insert into libri values('Metro 2034','9788863553710','Copertine/Metro2034.jpg','Azione', 
						 'Più profondo e filosofico rispetto al primo capitolo, Metro 2034 è stato definito “un noir post atomico” unico nel suo genere, in cui molti dei personaggi già centrali in metro 2033, vengono meglio definiti nel carattere con l’aggiunta di una nuova giovane eroina adolescente, attraverso cui Glukhovsky introdurrrà per la prima volta il tema dell’amore.',
						 464,'Dmitry Glukhovsky','Multiplayer Edizioni',2016,17.90);
						 
insert into libri values('Conan il Barbaro','9788804669685','Copertine/conan.jpg','Fantasy',
						 'Nella remota era Hyboriana, vive Conan; è un mercenario rozzo e violento, ma anche un uomo dotato di lealtà e coraggio, il più riuscito rappresentante del fantasy eroico.',
						 738,'Robert E. Howard','Mondadori',2016,25);

insert into libri values('Il Ciclo di Shannara','9788804637332','Copertine/shannara.jpg','Fantasy',
						 'Un’epopea che si snoda tra poesia e avventura, tra sortilegi e terrore, ricca di sorprese e di mistero; un universo narrativo che è considerato la più straordinaria creazione fantasy dei suoi anni.',
						 1167,'Terry Brooks','Mondadori',2013,25);

insert into libri values('Le Cronache di Narnia','9788804586074','Copertine/narnia.jpg','Fantasy',
						 'Un capolavoro che trascende il genere fantasy, ormai riconosciuto tra i classici della letteratura inglese del Novecento. Un''incredibile girandola di personaggi per il ritmo incalzante dell''avventura.',
						 1168,'Clive Staples Lewis','Mondadori',2008,22);

insert into libri values('Pancreas','9788877824936','Copertine/pancreas.jpg','Umoristico',
						 'Tra piccole vendette lombarde e tamburini sordi, Giobbe Covatta ci offre una rilettura esilarante del capolavoro di De Amicis, dando libero sfogo alla sua irresistibile vena comica.',
						 149,'Giobbe Covatta','Mondadori',2013,9.5);

insert into libri values('Libro','9788891828934','Copertine/libro.jpg','Umoristico',
						 'Un''autobiografia sincera e profonda in cui il lettore, dopo aver finito di leggere i lunghi preamboli all''inizio, scopre le passioni segrete di Marcello e come ha fatto a diventare famoso Maccio.',
						 222,'Maccio Capatonda','Mondadori Electa',2020,16.9);

insert into libri values('Mistero Brutto','9788891838049','Copertine/misterobrutto.jpg','Umoristico',
						 'Il sottotitolo è "Il vangelo secondo me", quindi di cosa parlerà mai il libro? Del vangelo. Possiamo dire che ogni racconto è una piccola perla. Un gioiellino proprio.',
						 204,'Max Angioni','Mondadori Electa',2023,18.9);

CREATE OR REPLACE FUNCTION aggiorna_recensioni()
RETURNS TRIGGER AS $$
DECLARE
    media_voti DECIMAL(3,2);
BEGIN
    -- Aggiorna il numero di recensioni incrementandolo di 1
    UPDATE libri
    SET num_recensioni = num_recensioni + 1
    WHERE ISBN = NEW.libro;

    -- Calcola la media dei voti delle recensioni sul libro
    SELECT AVG(voto) INTO media_voti
    FROM recensioni
    WHERE libro = NEW.libro;

    -- Aggiorna la colonna voto con la media calcolata
    UPDATE libri
    SET voto = media_voti
    WHERE ISBN = NEW.libro;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trigger_aggiorna_recensioni
AFTER INSERT ON recensioni
FOR EACH ROW
EXECUTE FUNCTION aggiorna_recensioni();





CREATE OR REPLACE FUNCTION decrementa_recensioni()
RETURNS TRIGGER AS $$
DECLARE
    media_voti DECIMAL(3,2);
BEGIN
    -- Aggiorna il numero di recensioni incrementandolo di 1
    UPDATE libri
    SET num_recensioni = num_recensioni - 1
    WHERE ISBN = OLD.libro;

    -- Calcola la media dei voti delle recensioni sul libro
    SELECT AVG(voto) INTO media_voti
    FROM recensioni
    WHERE libro = OLD.libro;

    -- Aggiorna la colonna voto con la media calcolata
    UPDATE libri
    SET voto = media_voti
    WHERE ISBN = OLD.libro;

    RETURN null;
END;
$$ LANGUAGE plpgsql;


CREATE TRIGGER trigger_decrementa_recensioni
AFTER delete ON recensioni
FOR EACH ROW
EXECUTE FUNCTION decrementa_recensioni();



GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO www;
GRANT ALL PRIVILEGES ON ALL SEQUENCES IN SCHEMA public TO www;