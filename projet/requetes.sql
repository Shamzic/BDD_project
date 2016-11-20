/* Simon HAMERY : simon.hamery2@etu.unistra.fr
    
    Requêtes SQL

*/

-- 1) 
-- Nombre de visionnages de vidéos par catégories de vidéos, pour les visionnages de moins de
-- deux semaines.

select c.nom_categorie,count(h.date_visio) as "NB_VUES_SUR_2_SEMAINES" from video v,historique h,categorie c where h.id_vid=v.id_vid and c.id_categorie=v.id_categ and trunc(sysdate)-trunc(h.date_visio)<=14 group by (c.nom_categorie) order by count(h.date_visio) DESC;



-- 2) 
-- Par utilisateur, le nombre d’abonnements, de favoris et de vidéos visionnées.


select u.id_user, 
(select count(h.id_user) from historique h where h.id_user = u.id_user ) as NB_VUES,
(select count(f.id_user) from favoris f where f.id_user = u.id_user) as NB_FAVORIS,
(select count(a.id_user) from abonnement a where a.id_user = u.id_user) as NB_ABO
from utilisateur u
group by u.id_user;



-- 3) Pour chaque vidéo, le nombre de visionnages par des utilisateurs français, le nombre de
-- visionnage par des utilisateurs allemands, la différence entre les deux, triés par valeur
-- absolue de la différence entre les deux. */



select v.id_vid,v.nom_vid, 
(select count(h1.id_user) from utilisateur fr, historique h1 where fr.pays='FRANCE' and h1.id_user=fr.id_user and h1.id_vid=v.id_vid  ) as NB_VISO_FR, 
(select count(h2.id_user) from utilisateur de , historique h2 where de.pays='ALLEMAGNE' and h2.id_user=de.id_user and h2.id_vid=v.id_vid ) as NB_VISIO_DE,
ABS((select count(h1.id_user) from utilisateur fr, historique h1 where fr.pays='FRANCE' and h1.id_user=fr.id_user and h1.id_vid=v.id_vid  )-(select count(h2.id_user) from utilisateur de , historique h2 where de.pays='ALLEMAGNE' and h2.id_user=de.id_user and h2.id_vid=v.id_vid ) ) as DIFF
from video v 
group by v.id_vid,v.nom_vid order by DIFF;


/* 4)
Les épisodes d’émissions qui ont au moins deux fois plus de visionnage que la moyenne des visionnages des autres épisodes de l’émission.
*/

WITH 
  NBVUES1 as (select distinct v.id_vid, v.nom_vid, v.id_ems, ( select count (h.id_histo) from historique h where h.id_vid=v.id_vid) as nb_vues from video v, emission e),
  NBVUES2 as (select distinct v.id_vid,v.id_ems,( select count (h.id_histo) from historique h where h.id_vid=v.id_vid) as nb_vues from video v, emission e) 
select NBVUES1.id_vid, NBVUES1.nom_vid, NBVUES1.id_ems, NBVUES1.nb_vues 
from NBVUES1 where NBVUES1.nb_vues >= 2*(select avg(NBVUES2.nb_vues) from NBVUES2 where NBVUES1.id_ems=NBVUES2.id_ems and NBVUES1.id_vid!=NBVUES2.id_vid);


/* 5) 
Les 10 couples de vidéos apparaissant le plus souvent simultanément dans un historique de
visionnage d’utilisateur.
*/

select * from 
  ( WITH VIDEOS as (select distinct
       case when v1.id_vid<=v2.id_vid and v1.id_vid!=v2.id_vid then v1.id_vid else v2.id_vid end VIDEO1,
       case when v1.id_vid<=v2.id_vid and v1.id_vid!=v2.id_vid then v2.id_vid else v1.id_vid end VIDEO2
    from video v1 cross join video v2) -- Tous les couples de vidéos possibles en enlevant les doublons intra-champs
  select VIDEOS.VIDEO1, VIDEOS.VIDEO2, 
  (
  select count(distinct u.id_user) from utilisateur u,historique h1,historique h2 
  where 
    h1.id_histo!=h2.id_histo 
    and u.id_user=h1.id_user and h1.id_vid=VIDEOS.VIDEO1
    and u.id_user=h2.id_user and h2.id_vid=VIDEOS.VIDEO2
  ) as NB_USER_AVEC_COUPLE_DANS_HISTO from VIDEOS order by NB_USER_AVEC_COUPLE_DANS_HISTO DESC ) 
where ROWNUM BETWEEN 0 AND 10;

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
