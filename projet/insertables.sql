/* Simon HAMERY : simon.hamery2@etu.unistra.fr

  Insère des valeurs dans la base
  
 ---------------------------------------------------------------------------------------------------------------
Récapitulatif de la base :

VIDEO(*id_vid*,nom_vid,descr_vid,duree_vid,anneeDif_vid,dateFinDif_vid,boolMultiLang_vid,formatLang_vid,
nbJourReplay_vid,id_categ,pays,"id_ems",numero_episode);

ARCHIVE(*id_video*,nom_vid,descr_vid,duree_vid,anneeDif_vid,dateFinDif_vid,boolMultiLang_vid,formatLang_vid,
nbJourReplay_vid,id_categ,pays,"id_ems",numero_episode);

UTILISATEUR(*id_user*,nom_user,prenom_user,login_user,mdp_user,dateNaiss_user,mail_user,pays,boolAdmin_user,
oolNews_user,nb_favoris);

DIFFUSION(*id_diff*,date_diff,id_vid);

EMISSION(*id_ems*,nbEpisodes_ems,"id_categorie");

CATEGORIE(*id_categorie*,nom_categorie);

ABONNEMENT("id_ems","id_user");

INTERESSE("id_categorie","id_user");

FAVORIS("id_vid","id_user");

HISTORIQUE(*id_histo*,date_visio,"id_user","id_vid");
-----------------------------------------------------------------------------------------------------------------

*/

insert into categorie values (1,'animaux');
insert into categorie values (2,'voyages');
insert into categorie values (3,'musique');
insert into categorie values (4,'spectacles');
insert into categorie values (5,'documentaire');
insert into categorie values (6,'sciences');
insert into categorie values (7,'humour');
insert into categorie values (8,'science-fiction');
insert into categorie values (9,'dessin-animé');
insert into categorie values (10,'sans catégorie');





insert into emission values (1,2,2);
insert into emission values (2,1,3);
insert into emission values (3,2,4);
insert into emission values (4,1,1);
insert into emission values (5,7,8);
insert into emission values (6,3,9);

insert into emission values (10,0,10);


insert into utilisateur values (1, 'Le Gal','Anne-Sophie','Soso22','Bretatagne',TO_DATE('1995/05/12', 'yyyy/mm/dd'),'annesolegal@gmail.com','FRANCE','Y','Y',2);
insert into utilisateur values (2, 'Fatch','Tintin','kirikou54','milou54',TO_DATE('1980/08/14', 'yyyy/mm/dd'),'tintinkirikou@gmail.com','BELGIQUE','N','N',2);
insert into utilisateur values (3, 'Sonntag','Benoit','dadidou','leking',TO_DATE('1978/09/11', 'yyyy/mm/dd'),'sonntagounet@gmail.com','FRANCE','N','Y',0);
insert into utilisateur values (4, 'Tamtam','Goldorak','Goldo28','gonagai',TO_DATE('1975/05/12', 'yyyy/mm/dd'),'annesolegal@gmail.com','FRANCE','Y','Y',1);
insert into utilisateur values (5, 'Schrein','Rudolph','ruru45','gutentag',TO_DATE('1995/05/22', 'yyyy/mm/dd'),'rudolphy@gmail.com','ALLEMAGNE','Y','Y',0);


insert into video values (1,'Super-Chats','Voici des chatons fous',30,TO_DATE('2016/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,1,'FRANCE',4,1);
insert into video values (2,'Paysages de Bretagne','Les côtes bretonnes sous toutes leurs couleurs',120,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'N','LARGE',10,2,'FRANCE',1,1);
insert into video values(3,'Covers : dust in the wind','Covers of the famous song',90,TO_DATE('2015/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','LARGE',7,3,'UK',2,1);
insert into video values (4,'Magic cards','Magic turns in Africa',350,TO_DATE('2014/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','LARGE',8,4,'SOUTH AFRICA',3,1);
insert into video values (5,'Magic cards 2','Magic turns in Africa',350,TO_DATE('2014/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','LARGE',8,4,'SOUTH AFRICA',3,2);


insert into video values (6,'STAR WARS 1','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,1);
insert into video values (7,'STAR WARS 2','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,2);
insert into video values (8,'STAR WARS 3','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,3);
insert into video values (9,'STAR WARS 4','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,4);
insert into video values (10,'STAR WARS 5','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,5);
insert into video values (11,'STAR WARS 6','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,6);
insert into video values (12,'STAR WARS 7','episode de la série culte star wars',5400,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',10,8,'FRANCE',5,7);

insert into video values (13,'Oui-Oui 1','Les aventures du petit OUi-OUi',350,TO_DATE('2014/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',8,9,'FRANCE',6,1);
insert into video values (14,'Oui-Oui 2','Les aventures du petit OUi-OUi',350,TO_DATE('2014/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',8,9,'FRANCE',6,2);
insert into video values (15,'Oui-Oui 3','Les aventures du petit OUi-OUi',350,TO_DATE('2014/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'Y','SMALL',8,9,'FRANCE',6,3);

insert into video values(16,'Paysages de CHINE','Recits de voyages chinois',120,TO_DATE('2012/01/01','yyyy/mm/dd'),TO_DATE('2017/01/01','yyyy/mm/dd'),'N','LARGE',10,2,'CHINA',1,2);



insert into diffusion values (1, TO_DATE('2012/05/03 21:02:30', 'yyyy/mm/dd hh24:mi:ss'), 2);
insert into diffusion values (2, TO_DATE('2013/06/13 18:14:00', 'yyyy/mm/dd hh24:mi:ss'), 2);
insert into diffusion values (3, TO_DATE('2014/05/18 12:02:00', 'yyyy/mm/dd hh24:mi:ss'), 2);

insert into diffusion values (4, TO_DATE('2015/05/03 18:02:44', 'yyyy/mm/dd hh24:mi:ss'), 3);
insert into diffusion values (5, TO_DATE('2016/05/19 15:02:44', 'yyyy/mm/dd hh24:mi:ss'), 3);
insert into diffusion values (6, TO_DATE('2016/06/03 10:02:44', 'yyyy/mm/dd hh24:mi:ss'), 3);
insert into diffusion values (7, TO_DATE('2016/07/03 08:02:44', 'yyyy/mm/dd hh24:mi:ss'), 3);

insert into diffusion values  (8, TO_DATE('2014/11/11 18:00:00', 'yyyy/mm/dd hh24:mi:ss'), 4);
insert into diffusion values  (9, TO_DATE('2016/11/05 16:14:00', 'yyyy/mm/dd hh24:mi:ss'), 4);
insert into diffusion values (10, TO_DATE('2016/11/06 18:35:00', 'yyyy/mm/dd hh24:mi:ss'), 4);
insert into diffusion values (11, TO_DATE('2016/11/28 17:14:00', 'yyyy/mm/dd hh24:mi:ss'), 4);
insert into diffusion values (12, TO_DATE('2016/11/11 17:14:00', 'yyyy/mm/dd hh24:mi:ss'), 5);
insert into diffusion values (13, TO_DATE('2016/11/29 10:15:30', 'yyyy/mm/dd hh24:mi:ss'), 1);

insert into diffusion values  (14, TO_DATE('2016/10/25 18:00:00', 'yyyy/mm/dd hh24:mi:ss'), 6);
insert into diffusion values  (15, TO_DATE('2016/10/25 20:00:00', 'yyyy/mm/dd hh24:mi:ss'), 7);
insert into diffusion values  (16, TO_DATE('2016/10/25 22:00:00', 'yyyy/mm/dd hh24:mi:ss'), 8);
insert into diffusion values  (17, TO_DATE('2016/10/26 10:00:00', 'yyyy/mm/dd hh24:mi:ss'), 9);
insert into diffusion values  (18, TO_DATE('2016/10/26 12:00:00', 'yyyy/mm/dd hh24:mi:ss'), 10);
insert into diffusion values  (19, TO_DATE('2016/10/26 14:00:00', 'yyyy/mm/dd hh24:mi:ss'), 11);
insert into diffusion values  (20, TO_DATE('2016/10/26 16:00:00', 'yyyy/mm/dd hh24:mi:ss'), 12);
insert into diffusion values  (21, TO_DATE('2016/11/05 20:00:00', 'yyyy/mm/dd hh24:mi:ss'), 15);
insert into diffusion values  (22, TO_DATE('2016/11/10 20:00:00', 'yyyy/mm/dd hh24:mi:ss'), 15);


insert into historique values (1,TO_DATE('2012/05/04 21:22:30', 'yyyy/mm/dd hh24:mi:ss'),1,2);
insert into historique values (2,TO_DATE('2015/05/10 18:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,3);

insert into historique values (3,TO_DATE('2016/11/12 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,2);

insert into historique values (4,TO_DATE('2016/11/15 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,2);
insert into historique values (5,TO_DATE('2016/11/19 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,2);

insert into historique values (6,TO_DATE('2015/05/05 15:02:44', 'yyyy/mm/dd hh24:mi:ss'),2,3);
insert into historique values (7,TO_DATE('2014/12/14 20:00:00', 'yyyy/mm/dd hh24:mi:ss'),2,4);
insert into historique values (8,TO_DATE('2014/12/13 22:00:00', 'yyyy/mm/dd hh24:mi:ss'),4,4);
insert into historique values (9,TO_DATE('2016/11/23 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),4,3);
insert into historique values (10,TO_DATE('2016/11/25 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),4,3);

insert into historique values (11,TO_DATE('2016/11/25 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),3,3);

insert into historique values (12,TO_DATE('2016/11/25 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),5,3);
insert into historique values (13,TO_DATE('2016/11/25 20:02:44', 'yyyy/mm/dd hh24:mi:ss'),5,2);
insert into historique values (14,TO_DATE('2016/11/25 22:02:44', 'yyyy/mm/dd hh24:mi:ss'),5,2);


insert into historique values (15,TO_DATE('2016/11/25 22:02:44', 'yyyy/mm/dd hh24:mi:ss'),4,6);
insert into historique values (16,TO_DATE('2016/11/25 21:02:44', 'yyyy/mm/dd hh24:mi:ss'),2,6);
insert into historique values (17,TO_DATE('2016/11/25 22:02:44', 'yyyy/mm/dd hh24:mi:ss'),3,7);
insert into historique values (18,TO_DATE('2016/10/25 23:02:44', 'yyyy/mm/dd hh24:mi:ss'),1,6);

insert into historique values (19,TO_DATE('2016/10/26 16:00:00', 'yyyy/mm/dd hh24:mi:ss'),1,8);
insert into historique values (20,TO_DATE('2016/10/26 16:00:00', 'yyyy/mm/dd hh24:mi:ss'),2,8);

insert into historique values (21,TO_DATE('2016/10/26 18:00:00', 'yyyy/mm/dd hh24:mi:ss'),1,9);
insert into historique values (22,TO_DATE('2016/10/26 18:00:00', 'yyyy/mm/dd hh24:mi:ss'),2,9);

insert into historique values (23,TO_DATE('2016/10/26 20:00:00', 'yyyy/mm/dd hh24:mi:ss'),1,10);
insert into historique values (24,TO_DATE('2016/10/26 20:00:00', 'yyyy/mm/dd hh24:mi:ss'),2,10);


insert into historique values (25,TO_DATE('2016/10/26 22:00:00', 'yyyy/mm/dd hh24:mi:ss'),1,11);
insert into historique values (26,TO_DATE('2016/10/26 22:00:00', 'yyyy/mm/dd hh24:mi:ss'),2,11);

insert into historique values (27,TO_DATE('2016/10/26 23:50:00', 'yyyy/mm/dd hh24:mi:ss'),1,12);
insert into historique values (28,TO_DATE('2016/10/26 23:50:00', 'yyyy/mm/dd hh24:mi:ss'),2,12);

insert into historique values (29,TO_DATE('2016/11/26 23:50:00', 'yyyy/mm/dd hh24:mi:ss'),3,6);


insert into historique values (30,TO_DATE('2014/12/26 23:50:00', 'yyyy/mm/dd hh24:mi:ss'),3,13);

insert into historique values (31,TO_DATE('2014/12/26 23:50:00', 'yyyy/mm/dd hh24:mi:ss'),4,14);


insert into historique values (32,TO_DATE('2016/11/02 20:50:00', 'yyyy/mm/dd hh24:mi:ss'),1,1);

insert into historique values (33,TO_DATE('2016/10/20 20:50:00', 'yyyy/mm/dd hh24:mi:ss'),1,1);


insert into favoris values (1,2);
insert into favoris values (1,3);
insert into favoris values (2,3);
insert into favoris values (2,4);
insert into favoris values (4,4);

insert into abonnement values (1,1);
insert into abonnement values (2,1);
insert into abonnement values (1,2);
insert into abonnement values (1,3);

insert into interesse values (1,1);
insert into interesse values (1,2);
insert into interesse values (2,1);
insert into interesse values (2,2);
insert into interesse values (2,3);

insert into interesse values (1,3);
insert into interesse values (3,2);

insert into interesse values (8,4);
insert into interesse values (1,4);



