/* Simon HAMERY : simon.hamery2@etu.unistra.fr

  Fonction qui convertit au format ​json ​les informations d’une vidéo.
  L'id de la vidéo est donné en paramètre.
  
  Comment appeler cette fonction : 
  SQL> @fonction1.sql
  SQL> variable toto varchar2(500);
  SQL> call conv_video_json(X) into :toto;   //X étant l'id de vidéo...
  SQL> print toto;

  Exemple d'affichage de la vidéo 1 :

  {
nom_vid : Super-Chats,
	descr_vid : Voici des chatons fous,
	duree_vid : 30,
	anneeDif_vid : 01-JAN-16,
	dateFinDif_vid : 01-JAN-17,
	boolMultiLang_vid : Y,
	formatLang_vid : SMALL,
	nbJourReplay_vid : 10,
	id_categ : 1,
	pays : FRANCE,
	id_ems : 4,
	numero_episode : 1
}


*/

set serveroutput on format wrapped;

CREATE OR REPLACE FUNCTION conv_video_json(id_video INTEGER)
RETURN VARCHAR2 AS
	v_nom_vid varchar(25) ;
	v_descr_vid varchar2(60) ;
	v_duree_vid number(4) ;
	v_anneeDif_vid date ;
	v_dateFinDif_vid date ;
	v_boolMultiLang_vid CHAR(1) ; /* 'Y' ou 'N' */
	v_formatLang_vid varchar2(6) ;
	v_nbJourReplay_vid number(3) ;
	v_id_categ number(2) ;
	v_pays varchar2(15) ;
	v_id_ems number(2);
	v_numero_episode number(2) ;
	v_retour varchar2(500) := '';
	test number(3);
BEGIN
  SELECT count(*) into test from video where id_vid=id_video;
  IF ( test > 0) 
  THEN
    SELECT 
    nom_vid,
    descr_vid,
    duree_vid,
    anneeDif_vid,
    dateFinDif_vid,
    boolMultiLang_vid, 
    formatLang_vid,
    nbJourReplay_vid,
    id_categ,
    pays,
    id_ems,
    numero_episode 
    INTO 
    v_nom_vid, 
    v_descr_vid,
    v_duree_vid,
    v_anneeDif_vid,
    v_dateFinDif_vid,
    v_boolMultiLang_vid, 
    v_formatLang_vid,
    v_nbJourReplay_vid,
    v_id_categ,
    v_pays,
    v_id_ems,
    v_numero_episode 
    from video where id_vid=id_video;
    select '{'||chr(10)||'  nom_vid : '||v_nom_vid||',
  '||'descr_vid : '||v_descr_vid||',
  '||'duree_vid : '||v_duree_vid||',
  '||'anneeDif_vid : '||v_anneeDif_vid||',
  '||'dateFinDif_vid : '||v_dateFinDif_vid||',        
  '||'boolMultiLang_vid : '||v_boolMultiLang_vid||',
  '||'formatLang_vid : '||v_formatLang_vid||',
  '||'nbJourReplay_vid : '||v_nbJourReplay_vid||',
  '||'id_categ : '||v_id_categ||',      
  '||'pays : '||v_pays||',  
  '||'id_ems : '||v_id_ems||',      
  '||'numero_episode : '||v_numero_episode||chr(10)||'}' into v_retour from dual;
    return v_retour;
   ELSE
      dbms_output.put_line('Video inconnue au bataillon !');
   END IF;
END;
/
show errors function conv_video_json;
