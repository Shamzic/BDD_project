/* Simon HAMERY : simon.hamery2@etu.unistra.fr
  
  Cette procédure génére la liste des vidéos populaires, conseillées pour un utilisateur, c’est à dire fonction
  des catégories de vidéos qu’il suit.
  
  SQL> @procedure4.sql
  SQL> exec pop(4);

  L'utilisateur est fan de : science-fiction

  Videos populaires dans cette catégorie en ce moment :
  -STAR WARS 1
  -STAR WARS 3
  -STAR WARS 3
  -STAR WARS 4
  -STAR WARS 4
  -STAR WARS 5
  -STAR WARS 5
  -STAR WARS 6
  -STAR WARS 6
  -STAR WARS 7
  -STAR WARS 7

  L'utilisateur est fan de : animaux

  Videos populaires dans cette catégorie en ce moment :
  -Super-Chats

  PL/SQL procedure successfully completed.


*/
set serveroutput on format wrapped;

CREATE OR REPLACE PROCEDURE pop(id integer)
IS
  CURSOR curs_categ IS (select c.id_categorie as "id_categcurs",c.nom_categorie as "nom_categcurs" 
                        from interesse i,categorie c 
                        where c.id_categorie=i.id_categorie and i.id_user=id);
  v_nb_vid number(3);
  test number(3);
  
BEGIN

  SELECT count(*) into test from utilisateur where id_user=id;
  IF test > 0 THEN
    FOR curs in curs_categ 
    LOOP
        dbms_output.put_line(chr(10)||'L'|| '''' ||'utilisateur est fan de : '||curs."nom_categcurs");
        select count(distinct (h.id_vid)) 
        into v_nb_vid 
        from video v,historique h, emission e 
        where v.id_ems=e.id_ems and e.id_categorie=curs."id_categcurs" and h.id_vid=v.id_vid and date_visio 
        between trunc(sysdate-10) and sysdate; -- Nombre de vidéos populaires (sur les 10 derniers jours, valeur arbitraire)
        --dbms_output.put_line('Nombre de videos populaire ces 10 derniers jours dans cette catégorie : '||v_nb_vid); 
        IF ( v_nb_vid = 0) 
        THEN 
            dbms_output.put_line('Aucune vidéo populaire dans cette catégorie sur les 10 derniers jours...'); 
        ELSE
            dbms_output.put_line(chr(10)||'Videos populaires dans cette catégorie en ce moment :');
            FOR famous IN (select v.id_vid ,v.nom_vid,count(h.id_vid) as NB_VUES from video v,historique h, emission e 
                           where v.id_ems=e.id_ems and e.id_categorie=curs."id_categcurs" 
                             and h.id_vid=v.id_vid and date_visio between trunc(sysdate-10) and sysdate group by (v.id_vid ,nom_vid) order by NB_VUES DESC)
            LOOP            
                dbms_output.put_line('-'||famous.nom_vid||', nombre de vues cette semaine :'||famous.NB_VUES);  
            END LOOP;
        END IF;

    END LOOP;
  ELSE
      RAISE_APPLICATION_ERROR(-20666,'Utilisateur inconnu au bataillon !') ;
  END IF;
END;
/
show errors procedure pop;
