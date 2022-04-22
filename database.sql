
Create database Verifica20220422;
Use Verifica20220422;

Create table tUtenti(
                        IDUtente int not null primary key auto_increment,
                        nomeUtente varchar(40) not null unique,
                        passwordUtente varchar(255) not null,
                        isAdmin boolean default False
);

Create table tAnime (
                        IDAnime int not null primary key auto_increment,
                        titoloAnime varchar (60) not null unique,
                        dataAnime date,
                        tipoAnime varchar(10),
                        episodiAnime int default 1
);

Create table tMecha (
                        IDMecha int not null primary key auto_increment,
                        nomeMecha varchar (40) not null unique,
                        altezzaMecha float (6,2),
                        pesoMecha float (6,2)
);

Create table rAppare (
                         IDAppare int not null primary key auto_increment,
                         kAnime int not null,
                         kMecha int not null,
                         FOREIGN KEY (KAnime) REFERENCES tAnime(IDAnime),
                         FOREIGN KEY (kMecha) REFERENCES tMecha(IDMecha),
                         CONSTRAINT rAnimeMecha UNIQUE (kAnime,kMecha)
);

INSERT INTO tAnime (titoloAnime, dataAnime, tipoAnime, episodiAnime)
VALUES ('Mazinga Z', '1972/12/03', 'SerieTV', 92),
       ('Il grande Mazinga', '1974/09/08', 'SerieTV', 56),
       ('Mobil Suit Gundam', '1979/04/07', 'SerieTV', 43);

INSERT INTO tMecha (nomeMecha, altezzaMecha, pesoMecha)
VALUES ('Mazinga Z', 18,20),
       ('Afrodite A', 18,15),
       ('Grande Mazinga', 25,32),
       ('Venus Alfa', 20,23),
       ('RX78-2 Gundam', 18,60),
       ('MS06F ZakuII', 17.5,73.3),
       ('MS09B Dom', 18.6,81.8);

INSERT INTO rAppare (kAnime, kMecha)
VALUES (1,1),
       (1,2),
       (2,1),
       (2,3),
       (2,4),
       (3,5),
       (3,6),
       (3,7);