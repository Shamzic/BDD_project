/* Simon HAMERY : simon.hamery2@etu.unistra.fr
    
    Contraintes d'intégrité dynamiques

*/

CREATE OR REPLACE TRIGGER TRG_FAVORIS 
before UPDATE
ON utilisateur
 FOR EACH ROW 
DECLARE 
  n number(3);
BEGIN
    n:= :new.nb_favoris;
    IF (n >= 300) THEN
        raise_application_error(-20001, 'Erreur : 300 favoris max');
    END if;
END;
/
SHOW ERRORS TRIGGER TRG_FAVORIS ;


CREATE OR REPLACE TRIGGER AJOUT_FAVORIS
AFTER INSERT ON favoris
FOR EACH ROW
BEGIN
	update utilisateur set nb_favoris=nb_favoris+1 where id_user=:new.id_user;
end;
/
SHOW ERRORS TRIGGER AJOUT_FAVORIS;



CREATE OR REPLACE TRIGGER DATE_DISPO_DIFF
before INSERT OR UPDATE
ON diffusion
FOR EACH ROW
DECLARE 
    v_date date;
BEGIN
    select max(date_diff) into v_date from diffusion where id_vid = :new.id_vid;
    if (v_date is NULL) or (v_date < :new.date_diff)
    then
        v_date := :new.date_diff;
    end if;
    update video set dateFinDif_vid = v_date + interval '14' day where id_vid = :new.id_vid;
end;
/

SHOW ERRORS TRIGGER DATE_DISPO_DIFF ;


CREATE OR REPLACE TRIGGER ARCHIVAGE
AFTER DELETE 
ON video 
FOR EACH ROW
DECLARE 
    v_nb_episodes number(3);
BEGIN
    update emission set nbEpisodes_ems=nbEpisodes_ems-1 where id_ems=:old.id_ems;
    select nbEpisodes_ems into v_nb_episodes from emission where id_ems=:old.id_ems;
    IF (v_nb_episodes= 0) THEN
	 DBMS_OUTPUT.PUT_LINE(' IL y a maintenant ZERO épisodes dans la table emission n°'||:old.id_ems);
	 delete from emission where id_ems=:old.id_ems;
	 DBMS_OUTPUT.PUT_LINE('Cette emission est supprimée');
    END IF;
    insert into archive values(
    :old.id_vid,
    :old.nom_vid,
    :old.descr_vid,
    :old.duree_vid,
    :old.anneeDif_vid,
    :old.dateFinDif_vid,
    :old.boolMultiLang_vid,
    :old.formatLang_vid,
    :old.nbJourReplay_vid,
    :old.id_categ,:old.pays,
    :old.id_ems,
    :old.numero_episode);
end;
/
SHOW ERRORS TRIGGER ARCHIVAGE ;


CREATE OR REPLACE TRIGGER AJOUT_VIDEO
AFTER INSERT ON VIDEO
FOR EACH ROW
BEGIN
	update emission set nbEpisodes_ems=nbEpisodes_ems+1 where id_ems=:new.id_ems;
end;
/
SHOW ERRORS TRIGGER AJOUT_VIDEO;

-- Afin de limiter le spam de visionnage, un utilisateur ne pourra pas lancer plus de ​ 3
-- visionnages par minute. => 
CREATE OR REPLACE TRIGGER LIMIT_SPAM
BEFORE UPDATE OR INSERT
ON historique
FOR EACH ROW
DECLARE 
  compte_videos number(3);
BEGIN
    select count(*) into compte_videos from historique h where h.id_user=:new.id_user and trunc(to_char(h.date_visio,'mi'))=trunc(to_char(:new.date_visio,'mi')) and trunc(to_char(h.date_visio,'hh'))=trunc(to_char(:new.date_visio,'hh')) and trunc(to_char(h.date_visio,'dd'))=trunc(to_char(:new.date_visio,'dd')) and trunc(to_char(h.date_visio,'mm'))=trunc(to_char(:new.date_visio,'mm')) and trunc(to_char(h.date_visio,'yyyy'))=trunc(to_char(:new.date_visio,'yyyy'));
    IF (compte_videos >= 3) THEN
        raise_application_error(-20500, 'ERROR SPAM : 3 visionnages maximum par minute !');
    END if;
END;
/
SHOW ERRORS TRIGGER LIMIT_SPAM;



CREATE OR REPLACE TRIGGER DATE_VISIO_HISTO
before INSERT OR UPDATE
ON historique
FOR EACH ROW
BEGIN
    if (:new.date_visio >= sysdate)
    then
         raise_application_error(-20580, 'ERROR HISTO : date historique > sysdate... Impossible de visionner des vidéos dans le futur !');
    end if;
end;
/
SHOW ERRORS TRIGGER DATE_VISIO_HISTO ;




